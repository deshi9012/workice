<?php

namespace Modules\Settings\Http\Controllers;

use App\Entities\Status;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class StatusController extends Controller
{
    public $page;
    public $status;
    public $request;
    /**
     * Create a new controller instance.
     */
    public function __construct(Status $status, Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa']);
        $this->request = $request;
        $this->status  = $status;
    }

    public function index()
    {
        $data['statuses'] = $this->status->orderBy('id', 'asc')->get();

        return view('settings::modal.statuses')->with($data);
    }

    public function save()
    {
        if ($this->request->ajax()) {
            $this->request->validate(['status' => 'required']);
            if ($status = $this->status->create($this->request->all())) {
                $html = view('settings::_ajax.new_status_html', compact('status'))->render();

                return response()->json(
                    [
                        'status' => 'success', 'html' => $html, 'message' => langapp('saved_successfully')],
                    200
                );
            }
        }
    }

    public function edit($id = null)
    {
        $data['status'] = $this->status->findOrFail($id);

        return view('settings::modal.update_status')->with($data);
    }

    public function update($id = null)
    {
        $status = $this->status->findOrFail($id);
        $status->update($this->request->all());
        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }

    public function delete()
    {
        $id = $this->request->id;
        $status = $this->status->findOrFail($id);
        if ($this->request->ajax()) {
            if ($status->delete()) {
                return response()->json(
                    [
                        'status' => 'success', 'message' => langapp('deleted_successfully')],
                    200
                );
            }

            return response()->json(['status' => 'errors', 'message' => 'something went wrong'], 401);
        }
    }
}
