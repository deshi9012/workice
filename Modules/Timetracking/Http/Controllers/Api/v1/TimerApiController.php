<?php

namespace Modules\Timetracking\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Timetracking\Entities\TimeEntry;
use Modules\Timetracking\Http\Requests\TimerRequest;

class TimerApiController extends Controller
{
    protected $request;
    protected $timer;

    public function __construct(Request $request)
    {
        $this->middleware('localize');
        $this->request = $request;
        $this->timer   = new TimeEntry;
    }
    public function save(TimerRequest $request)
    {
        $entry = classByName($request->module)->find($request->module_id);
        if ($entry->isTeam() || isAdmin()) {
            if ($request->has('use_dates')) {
                $request->validate(['start' => 'required|date', 'end' => 'required|date|after:start']);
                $request->request->add(['start' => strtotime($request->start)]);
                $request->request->add(['end' => strtotime($request->end)]);
            } else {
                $request->validate(['total' => 'required']);
                $request->request->add(['start' => null]);
                $request->request->add(['end' => null]);
            }

            $entry->timesheets()->create($request->all());
            return ajaxResponse(
                [
                    'id'       => $entry->id,
                    'message'  => langapp('saved_successfully'),
                    'redirect' => $request->url,
                ],
                true,
                Response::HTTP_OK
            );
        }
        abort(401);
    }

    public function update($id = null)
    {
        $this->request->validate(['id' => 'required', 'total' => 'required']);
        $entry = $this->timer->findOrFail($id);
        $this->authorize('update', $entry);
        $entry->update($this->request->all());
        return ajaxResponse(
            [
                'id'       => $entry->id,
                'message'  => langapp('changes_saved_successful'),
                'redirect' => $this->request->url,
            ],
            true,
            Response::HTTP_OK
        );
    }

    public function delete($id)
    {
        $entry = $this->timer->findOrFail($id);
        $this->authorize('update', $entry);
        $entry->delete();
        return ajaxResponse(
            [
                'message'  => langapp('deleted_successfully'),
                'redirect' => route('projects.view', ['id' => $entry->timeable->id, 'tab' => 'timesheets']),
            ],
            true,
            Response::HTTP_OK
        );
    }

    /**
     * Delete multiple time entries
     */
    public function bulkDelete()
    {
        if ($this->request->has('entries')) {
            $entries = TimeEntry::whereIn('id', $this->request->entries)->get();
            foreach ($entries as $entry) {
                if ($entry->user_id == \Auth::id() || isAdmin()) {
                    $entry->delete();
                }
            }
            $data['message']  = langapp('action_completed');
            $data['redirect'] = $this->request->url;
            return ajaxResponse($data, true, Response::HTTP_OK);
        }
        return response()->json(['message' => 'No entries selected', 'errors' => ['missing' => ["Please select atleast 1 entry"]]], 500);
    }
}
