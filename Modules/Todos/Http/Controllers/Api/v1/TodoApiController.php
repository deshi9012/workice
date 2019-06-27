<?php

namespace Modules\Todos\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Todos\Entities\Todo;
use Modules\Todos\Http\Requests\TodoRequest;
use Modules\Todos\Transformers\TodoResource;
use Modules\Todos\Transformers\TodosResource;

class TodoApiController extends Controller
{
    /**
     * Request instance
     *
     * @var Request
     */
    protected $request;
    /**
     * Todo Model
     *
     * @var Todo
     */
    protected $todo;

    public function __construct(Request $request)
    {
        $this->middleware('localize');
        $this->request = $request;
        $this->todo    = new Todo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $todos = new TodosResource($this->todo->orderByDesc('id')->paginate(50));
        return response($todos, Response::HTTP_OK);
    }

    /**
     * Show the specified resource.
     *
     * @return Response
     */
    public function show($id = null)
    {
        $todo = $this->todo->findOrFail($id);
        return response(new TodoResource($todo), Response::HTTP_OK);
    }

    public function save(TodoRequest $request)
    {
        $collection = collect($request->except(['module', 'module_id', 'url', 'json']));
        if (str_contains($request->subject, '@')) {
            $assigned = optional(getMentions($request->subject))[0];
            $collection->put('assignee', getUserIdExisting($assigned));
        }
        if (str_contains($request->subject, '[')) {
            $due_date = strBetween('[', ']', $request->subject);
            $collection->put('due_date', $due_date);
        }
        $collection->put('subject', str_before($request->subject, '['));
        $model = classByName($request->module)->findOrFail($request->module_id);
        $todo  = $model->todos()->create($collection->toArray());

        if ($this->request->has('json')) {
            $html = view('todos::newTodoHtml', compact('todo'))->render();
            return response()->json(['status' => 'success', 'html' => $html, 'message' => langapp('saved_successfully')], Response::HTTP_OK);
        }
        return ajaxResponse(
            [
                'id'       => $todo->id,
                'message'  => langapp('saved_successfully'),
                'redirect' => $request->url,
            ],
            true,
            Response::HTTP_CREATED
        );
    }

    public function subTask(TodoRequest $request)
    {
        $todo = $this->todo->findOrFail($request->parent);
        $todo->todoable->todos()->create($request->except(['url']));
        return ajaxResponse(
            [
                'id'       => $todo->id,
                'message'  => langapp('saved_successfully'),
                'redirect' => $request->url,
            ],
            true,
            Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TodoRequest $request
     * @return mixed
     */
    public function update(TodoRequest $request, $id = null)
    {
        $todo = $this->todo->findOrFail($id);
        if ($todo->user_id === \Auth::id()) {
            $todo->update($request->all());
            return ajaxResponse(
                [
                    'id'       => $todo->id,
                    'message'  => langapp('changes_saved_successful'),
                    'redirect' => $request->url,
                ],
                true,
                Response::HTTP_OK
            );
        }
        abort(401);
    }

    public function allDone()
    {
        $model = classByName($this->request->module)->findOrFail($this->request->id);
        $model->todos()->update(
            [
                'completed' => 1,
            ]
        );
        $model->update(['todo_percent' => 100.00]);
        $data['message'] = langapp('changes_saved_successful');

        return ajaxResponse($data, true, Response::HTTP_OK);
    }

    public function status($id = null)
    {
        $todo = $this->todo->findOrFail($this->request->id);
        if ($this->request->complete == '1') {
            $todo->update(['completed' => 1]);
            $todo->child()->each(
                function ($item) {
                    $item->update(['completed' => 1]);
                }
            );
        } else {
            $todo->update(['completed' => 0]);
        }
        $data['message']    = langapp('changes_saved_successful');
        $data['percentage'] = $todo->todoable->todo_percent;
        $data['todo']       = $todo->id;
        $data['status']     = $todo->completed == 0 ? 'danger' : 'success';

        return ajaxResponse($data, true, Response::HTTP_OK);
    }

    public function delete($id = null)
    {
        $todo = $this->todo->findOrFail($id);
        if ($todo->user_id === \Auth::id()) {
            if ($todo->delete()) {
                return response()->json(['status' => 'success', 'message' => langapp('deleted_successfully')], Response::HTTP_OK);
            }
            return response()->json(['status' => 'errors', 'message' => 'something went wrong'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        abort(401);
    }
}
