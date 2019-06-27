<?php

namespace Modules\Settings\Http\Controllers;

use App\Entities\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Tickets\Entities\Ticket;

class DepartmentController extends Controller
{
    public $page;
    public $department;
    public $request;
    /**
     * Create a new controller instance.
     */
    public function __construct(Department $department, Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa']);
        $this->request    = $request;
        $this->department = $department;
    }

    public function edit($id = null)
    {
        $data['department'] = $this->department->findOrFail($id);

        return view('settings::modal.update_department')->with($data);
    }

    public function update($id = null)
    {
        $department = $this->department->findOrFail($id);
        $department->update($this->request->all());
        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }

    public function departments($module = null)
    {
        $data['departments'] = $this->department->get();

        return view('settings::modal.departments')->with($data);
    }

    public function save()
    {
        if ($this->request->ajax()) {
            $this->request->validate(['deptname' => 'required']);
            if ($department = $this->department->create($this->request->all())) {
                $html = view('settings::_ajax.new_department_html', compact('department'))->render();

                return response()->json(['status' => 'success', 'html' => $html, 'message' => langapp('saved_successfully')], 200);
            }
        }
    }

    public function delete()
    {
        $id = $this->request->id;
        $department = $this->department->findOrFail($id);
        if ($this->request->ajax()) {
            if ($department->delete()) {
                Ticket::where('department', $department->deptid)->update(['department' => get_option('ticket_default_department')]);
                return response()->json(['status' => 'success', 'message' => langapp('deleted_successfully')], 200);
            }

            return response()->json(['status' => 'errors', 'message' => 'Something went wrong'], 401);
        }
    }
}
