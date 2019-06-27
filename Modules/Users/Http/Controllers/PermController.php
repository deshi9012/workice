<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', '2fa', 'reauthenticate']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['page'] = $this->getPage();

        return view('users::permissions')->with($data);
    }

    public function create()
    {
        return view('users::modal.createPermission');
    }

    public function save(Request $request)
    {
        $request->validate(['name' => 'required']);
        Permission::create(['name' => $request->name, 'description' => $request->description]);
        $data['message']  = langapp('saved_successfully');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }

    public function edit(Permission $perm)
    {
        $data['permission'] = $perm;

        return view('users::modal.updatePermission')->with($data);
    }

    public function update(Request $request, Permission $perm)
    {
        $request->validate(['name' => 'required']);
        $perm->update(['name' => $request->name, 'description' => $request->description]);
        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }

    public function delete(Permission $perm)
    {
        $data['permission'] = $perm;

        return view('users::modal.deletePermission')->with($data);
    }

    public function destroy(Request $request, Permission $perm)
    {
        $perm->delete();
        toastr()->warning(langapp('deleted_successfully'), langapp('response_status'));

        return redirect()->route('users.perm');
    }
    private function getPage()
    {
        return langapp('users');
    }
}
