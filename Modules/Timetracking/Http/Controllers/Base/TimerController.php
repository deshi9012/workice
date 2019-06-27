<?php

namespace Modules\Timetracking\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Projects\Entities\Project;
use Modules\Timetracking\Entities\TimeEntry;
use DataTables;
use Auth;

class TimerController extends Controller
{
    protected $timer;
    protected $request;
    /**
     * Create a new controller instance.
     */
    public function __construct(TimeEntry $timer, Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa']);
        $this->timer   = $timer;
        $this->request = $request;
    }

    public function view(TimeEntry $entry)
    {
        $data['entry'] = $entry;

        return view('timetracking::view')->with($data);
    }

    public function create($module = null, $id = null)
    {
        $data['module'] = $module;
        $data['id']     = $id;

        return view('timetracking::create')->with($data);
    }

    public function edit(TimeEntry $entry)
    {
        $data['entry'] = $entry;

        return view('timetracking::update')->with($data);
    }

    public function timers()
    {
        return view('timetracking::timers');
    }

    public function start($id, $module)
    {
        $model = classByName($module)->findOrFail($id);
        if (!$model->startClock()) {
            toastr()->error(langapp('timer_already_started'), langapp('response_status'));
            return redirect(url()->previous());
        }
        toastr()->info(langapp('timer_started_success'), langapp('response_status'));
        \Cache::forget('running-timers-' . \Auth::id());

        return redirect(url()->previous());
    }
    public function stop($id, $module)
    {
        $model = classByName($module)->findOrFail($id);
        if (!$model->stopClock()) {
            toastr()->error(langapp('timer_not_allowed'), langapp('response_status'));
            return redirect(url()->previous());
        }
        toastr()->info(langapp('timer_stopped_success'), langapp('response_status'));

        \Cache::forget('running-timers-' . \Auth::id());

        return redirect(url()->previous());
    }

    public function bill(TimeEntry $entry)
    {
        $entry->update(['billable' => 1]);
        toastr()->info(langapp('changes_saved_successful'), langapp('response_status'));

        return redirect()->route('projects.view', ['id' => $entry->timeable->id, 'tab' => 'timesheets']);
    }
    public function unbill(TimeEntry $entry)
    {
        $entry->update(['billable' => 0]);
        toastr()->info(langapp('changes_saved_successful'), langapp('response_status'));

        return redirect()->route('projects.view', ['id' => $entry->timeable->id, 'tab' => 'timesheets']);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tableData($project = null)
    {
        $project = Project::find($project);
        $model = $this->applyFilter($project->timesheets())->orderByDesc('id');

        return DataTables::eloquent($model)
            ->editColumn('name', function ($entry) {
                $str  = '<a href="'.route('timetracking.view', $entry->id).'" data-toggle="ajaxModal" class="text-ellipsis">';
                $str .= $entry->billed == 1 ? '<span class="text-success">✔</span>' : '<span class="text-danger">✘</span>';
                $str .= $entry->task_id > 0 ? str_limit($entry->task->name, 25) : str_limit($entry->timeable->name, 25);
                $str .= '</a>';
                return $str;
            })
            ->editColumn('chk', function ($entry) {
                return '<label><input type="checkbox" name="entries[]" value="' . $entry->id . '"><span class="label-text"></span></label>';
            })
            ->editColumn('user', function ($entry) {
                return str_limit($entry->user->name, 10);
            })
            ->editColumn('total_time', function ($entry) {
                if ($entry->is_started == 1) {
                    return '<label class="label label-danger"><i class="fas fa-sync-alt fa-spin"></i></label>';
                } else {
                    $text = $entry->billable == 1 ? 'check-circle' : 'times-circle text-danger';
                    return '<i class="fas fa-'.$text.'"></i> '.secToHours($entry->worked);
                }
            })
            ->editColumn('start', function ($entry) {
                if ($entry->start > 0) {
                    return dateTimeFormatted(dateFromUnix($entry->start));
                }
                return 'N/A';
            })
            ->editColumn('stop', function ($entry) {
                if ($entry->end > 0) {
                    return dateTimeFormatted(dateFromUnix($entry->end));
                }
                return 'N/A';
            })
            ->editColumn('date', function ($entry) {
                return dateFormatted($entry->created_at);
            })
            ->editColumn('action', function ($entry) {
                $str = '';
                if (isAdmin() || $entry->user_id == Auth::id()) {
                    if ($entry->billable == 0) {
                        $str .= '<a href="'.route('timetracking.bill', $entry->id).'" data-toggle="tooltip" data-title="'.langapp('billable').'" data-placement="left" class="m-r-sm">';
                        $str .= ' <i class="fas fa-clock text-success"></i></a>';
                    } else {
                        $str .= '<a href="'.route('timetracking.unbill', $entry->id).'" data-toggle="tooltip" data-title="'.langapp('not_billable').'" data-placement="left" class="m-r-sm">';
                        $str .= ' <i class="fas fa-clock text-danger"></i></a>';
                    }
                    if ($entry->is_started == 0) {
                        $str .= '<a href="'.route('timetracking.edit', $entry->id).'" data-toggle="ajaxModal" data-rel="tooltip" title="'.langapp('make_changes').'" data-placement="left" class="m-r-xs">';
                        $str .= '<i class="fas fa-pencil-alt"></i></a>';
                        $str .= '<a href="'.route('timetracking.delete', $entry->id).'" data-toggle="ajaxModal" data-rel="tooltip" title="'.langapp('delete').'" data-placement="left">';
                        $str .= ' <i class="fas fa-trash-alt"></i></a>';
                    }
                }

                return $str;
            })
            ->rawColumns(['name', 'total_time', 'chk', 'action'])
            ->make(true);
    }

    protected function applyFilter($query)
    {
        $filter = $this->request->filter;
        if ($filter === 'billable') {
            return $query->billable();
        }
        if ($filter === 'unbillable') {
            return $query->unbillable();
        }
        if ($filter === 'billed') {
            return $query->billed();
        }
        if ($filter === 'unbilled') {
            return $query->unbilled();
        }
        if ($filter === 'active') {
            return $query->running();
        }
        if ($filter === 'all') {
            return $query;
        }

        return $query;
    }

    public function delete(TimeEntry $entry)
    {
        $data['entry'] = $entry;

        return view('timetracking::delete')->with($data);
    }
}
