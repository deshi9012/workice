<?php

namespace Modules\Tasks\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Projects\Entities\Project;
use Modules\Tasks\Entities\Task;
use Modules\Tasks\Http\Requests\TaskRequest;
use Modules\Tasks\Jobs\BulkCloseTasks;
use Modules\Tasks\Jobs\BulkDeleteTasks;
use Modules\Tasks\Transformers\TaskResource;
use Modules\Tasks\Transformers\TasksResource;

class TasksApiController extends Controller
{
    /**
     * Task Model
     *
     * @var Task
     */
    protected $task;
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Create a new controller instance.
     */
    public function __construct(Request $request)
    {
        $this->middleware('localize');
        $this->request = $request;
        $this->task    = new Task;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {
        $tasks = new TasksResource(
            $this->task->with(['AsProject:id,name', 'AsMilestone:id,milestone_name'])
                ->orderByDesc('id')
                ->paginate(50)
        );
        return response($tasks, Response::HTTP_OK);
    }

    /**
     * Show the specified resource.
     *
     * @return Response
     */
    public function show($id = null)
    {
        $task = $this->task->findOrFail($id);
        return response(new TaskResource($task), Response::HTTP_OK);
    }
    /**
     * Duplicate task
     */
    public function copy($id)
    {
        $task    = Task::findOrFail($id);
        $data    = $task->replicate();
        $project = Project::findOrFail($this->request->project_id);
        $newTask = $project->tasks()->create($data->toArray());
        $newTask->retag($task->tagList);
        foreach ($task->assignees as $key => $user) {
            $newTask->assignees()->create(['user_id' => $user->user_id]);
        }

        return ajaxResponse(
            [
                'id'       => $newTask->id,
                'message'  => langapp('saved_successfully'),
                'redirect' => route('projects.view', ['id' => $project->id, 'tab' => 'tasks', 'item' => $newTask->id]),
            ],
            true,
            Response::HTTP_OK
        );
    }
    /**
     * Save new task
     */
    public function save(TaskRequest $request)
    {
        $this->authorize('createTask', Project::find($request->project_id));
        $task = $this->task->create($request->except(['id', 'tags', 'name_auto']));
        if ($request->has('recurring') && $request->recurring['frequency'] != 'none') {
            $task->recur();
        } else {
            $task->stopRecurring();
        }
        $task->notifyTeam();
        return ajaxResponse(
            [
                'id'       => $task->id,
                'message'  => langapp('saved_successfully'),
                'redirect' => route('projects.view', ['id' => $task->project_id, 'tab' => 'tasks', 'item' => $task->id]),
            ],
            true,
            Response::HTTP_CREATED
        );
    }
    /**
     * Update task
     */
    public function update(TaskRequest $request, $id = null)
    {
        $task = $this->task->findOrFail($id);
        $this->authorize('update', $task);
        $task->update($request->except(['team', 'id', 'tags']));
        if ($request->has('recurring') && $request->recurring['frequency'] != 'none') {
            $task->recur();
        } else {
            $task->stopRecurring();
        }
        return ajaxResponse(
            [
                'id'       => $task->id,
                'message'  => langapp('changes_saved_successful'),
                'redirect' => route('projects.view', ['id' => $task->project_id, 'tab' => 'tasks', 'item' => $task->id]),
            ],
            true,
            Response::HTTP_OK
        );
    }

    public function changeMilestone($id)
    {
        $this->request->validate(['milestone' => 'required|numeric']);
        $task = $this->task->findOrFail($id);
        if (isset($task->id)) {
            $task->update(['milestone_id' => $this->request->milestone]);
            return langapp('changes_saved_successful');
        }
    }
    /**
     * Close multiple tasks
     */
    public function bulkClose()
    {
        if ($this->request->has('tasks')) {
            BulkCloseTasks::dispatch($this->request->tasks)->onQueue('high');
            $data['message']  = langapp('action_completed');
            $data['redirect'] = $this->request->url;
            return ajaxResponse($data, true, Response::HTTP_OK);
        }
        return response()->json(['message' => 'No tasks selected', 'errors' => ['missing' => ["Please select atleast 1 task"]]], 500);
    }
    /**
     * Delete multiple tasks
     */
    public function bulkDelete()
    {
        if ($this->request->has('tasks')) {
            BulkDeleteTasks::dispatch($this->request->tasks, \Auth::id());
            $data['message']  = langapp('action_completed');
            $data['redirect'] = $this->request->url;
            return ajaxResponse($data, true, Response::HTTP_OK);
        }
        return response()->json(['message' => 'No tasks selected', 'errors' => ['missing' => ["Please select atleast 1 task"]]], 500);
    }
    /**
     * Change task status
     */
    public function status($id = null)
    {
        $this->request->validate(['status' => 'required|numeric', 'id' => 'required|numeric']);
        $task = $this->task->findOrFail($id);
        if (isset($task->id)) {
            $task->update(['stage_id' => $this->request->status]);
            return langapp('changes_saved_successful');
        }
    }

    public function progress($id = null)
    {
        $task = $this->task->findOrFail($id);
        $task->update(['progress' => $this->request->done === '1' ? 100 : 0]);
        return ajaxResponse(
            [
                'id'      => $task->id,
                'message' => langapp('changes_saved_successful'),
            ],
            true,
            Response::HTTP_OK
        );
    }
    /**
     * Delete a task
     */
    public function delete($id = null)
    {
        $task = $this->task->findOrFail($id);
        $this->authorize('delete', $task);
        $task->delete();
        return ajaxResponse(
            [
                'message'  => langapp('deleted_successfully'),
                'redirect' => route('projects.view', ['id' => $task->project_id, 'tab' => 'tasks']),
            ],
            true,
            Response::HTTP_OK
        );
    }
}
