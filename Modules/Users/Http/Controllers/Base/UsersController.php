<?php

namespace Modules\Users\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Modules\Users\Entities\User;
use Modules\Users\Exports\UsersExport;
use Modules\Users\Jobs\BulkDeleteUsers;
use Modules\Users\Jobs\GDPRExportData;
use App\Entities\Desk;

abstract class UsersController extends Controller {
    /**
     * Request instance
     *
     * @var Request
     */
    protected $request;
    /**
     * User Model
     *
     * @var User
     */
    protected $user;

    /**
     * Create a new controller instance.
     */
    public function __construct(Request $request, User $user) {

        $this->middleware([
            'auth',
            'verified',
            '2fa'
        ]);
        $this->request = $request;
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index() {

        $data['filter'] = $this->request->filter;
        $data['page'] = $this->getPage();

        return view('users::index')->with($data);
    }

    public function create() {

        return view('users::modal.create');
    }

    public function edit(User $user) {
        $data['user'] = $user;

        return view('users::modal.update')->with($data);
    }

    public function suspend(User $user) {
        if (can('users_delete')) {
            $data['user'] = $user;
            return view('users::modal.suspend')->with($data);
        }
    }

    public function impersonate($id) {
        $user = User::findOrFail($id);
        if (!$user->hasRole('admin')) {
            Auth::user()->setImpersonating($user->id);
        } else {
            toastr()->warning('Impersonate disabled for this user', langapp('response_status'));
        }

        return redirect()->back();
    }

    public function stopImpersonate() {
        Auth::user()->stopImpersonating();
        toastr()->success('Welcome Back', langapp('response_status'));

        return redirect()->back();
    }

    public function regenerateKey() {
        Auth::user()->update(['calendar_token' => str_random(60)]);
        toastr()->success('Calendar Token regenerated', langapp('response_status'));

        return redirect()->back();
    }

    public function gdprExport() {
        GDPRExportData::dispatch(Auth::user());
        toastr()->info('We will send you an email when your data is available', langapp('response_status'));

        return redirect(url()->previous());
    }

    /**
     * Export users as CSV
     */
    public function export() {
        if (isAdmin()) {
            return (new UsersExport)->download('users_' . now()->toIso8601String() . '.csv');
        }
        abort(404);
    }

    public function permissions(User $user) {
        $data['user'] = $user;

        return view('users::modal.permissions')->with($data);
    }

    /**
     * Change user permissions
     *
     * @param  Request $request
     * @param  User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePermission(Request $request, User $user) {
        $request->validate(['user_id' => 'required']);
        $permissions = [];
        if ($request->has('perm')) {
            foreach ($request->perm as $key => $value) {
                $permissions[] = $key;
            }
            $user->syncPermissions($permissions);
        }
        $data['message'] = langapp('changes_saved_successful');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }

    public function delete(User $user) {
        $data['user'] = $user;
        return view('users::modal.delete')->with($data);
    }

    public function bulkDelete() {
        if ($this->request->has('checked')) {
            BulkDeleteUsers::dispatch($this->request->checked, Auth::id());
            $data['message'] = langapp('deleted_successfully');
            $data['redirect'] = url()->previous();
            return ajaxResponse($data);
        }
        return response()->json([
            'message' => 'No users selected',
            'errors'  => ['missing' => ["Please select atleast 1 user"]]
        ], 500);
    }

    public function pin($entity = null, $module = null) {
        classByName($module)->findOrFail($entity)->addSidebar();

        toastr()->info(langapp('action_completed'), langapp('response_status'));

        \Cache::forget('quick-access-' . Auth::id());

        return redirect(url()->previous());
    }

    public function holiday($status = null) {
        if ($status == 'enable') {
            Auth::user()->update(['on_holiday' => 1]);
            toastr()->warning(langapp('holiday_mode_enabled'), langapp('response_status'));
        } else {
            Auth::user()->update(['on_holiday' => 0]);
            toastr()->info(langapp('holiday_mode_disabled'), langapp('response_status'));
        }
        return redirect(url()->previous());
    }

    /**
     * Show user dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function view(User $user, $tab = 'overview') {
        $allowed = [
            'deals',
            'files',
            'overview',
            'projects',
            'tickets',
            'timesheet'
        ];
        $tab = in_array($tab, $allowed) ? $tab : 'overview';
        $data['user'] = $user;
        $data['page'] = $this->getPage();
        $data['tab'] = $tab;

        return view('users::view')->with($data);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tableData() {
        //Get names of all desks
        $tmpDesks = Desk::all()->toArray();
        $allDesks = [];

        //set $key to be id of every desk
        foreach ($tmpDesks as $key => $desk) {
            $allDesks[$desk['id']] = $desk['name'];
        }

        $model = $this->applyFilter()->with(['profile:user_id,job_title,mobile,city,use_gravatar,avatar']);

        $data = DataTables::eloquent($model)->editColumn('name', function ($user) {
                return '<a href="' . route('users.view', $user->id) . '"><span class="thumb-xs avatar lobilist-check"><img src="' . $user->profile->photo . '" class="img-circle"></span> ' . str_limit($user->name, 15) . '</a>';
            })->editColumn('chk', function ($user) {
                return '<label><input type="checkbox" name="checked[]" value="' . $user->id . '"><span class="label-text"></span></label>';
            })->editColumn('job_title', function ($user) {
                $str = $user->on_holiday ? '<i class="fas fa-plane-departure text-danger"></i> ' : '';
                return $str .= str_limit($user->profile->job_title, 15);
            })->editColumn('mobile', function ($user) {
                return $user->profile->mobile;
            })->editColumn('city', function ($user) {
                return $user->profile->city;
            })->editColumn('created_at', function ($user) {
                return dateFormatted($user->created_at);
            })->editColumn('role', function ($user) {
                return $user->roles->pluck('name');
            })->editColumn('desk', function ($user) use ($allDesks) {
                //set desk name
                return $allDesks[$user->desk_id];
            })->rawColumns([
                'name',
                'chk',
                'job_title',
                'role',
                'user'
            ])->make(true);

        return $data;
    }

    protected function applyFilter() {
        if ($this->request->filled('filter')) {

            return $this->user->role($this->request->filter);
        }
        if (Auth::user()->hasRole('desk manager')) {
            return $this->user->whereHas('roles', function ($query) {
                return $query->where('name', '!=', 'office manager')->where('name', '!=', 'admin');
            })->where('desk_id', Auth::user()->desk_id);
        }

        return $this->user->query();
    }

    private function getPage() {
        return langapp('users');
    }

    public function usersData() {
        if (Auth::user()->hasRole('sales agent')) {
            return User::where('id', Auth::user()->id)->get()->pluck('name');
        }
        if (Auth::user()->hasRole('sales team leader') || Auth::user()->hasRole('desk manager')) {
            return User::where('desk_id', Auth::user()->desk_id)->get()->pluck('name');
        } else {
            return User::all()->pluck('name');
        }
        return 'users';
    }
}
