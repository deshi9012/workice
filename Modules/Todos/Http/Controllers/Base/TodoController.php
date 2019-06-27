<?php

namespace Modules\Todos\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Todos\Entities\Todo;

class TodoController extends Controller
{
    protected $todo;
    protected $request;
    /**
     * Create a new controller instance.
     */
    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa']);
        $this->todo    = new Todo;
        $this->request = $request;
    }

    public function create($module = null, $id = null, $parent = null)
    {
        $data['todoable_type'] = $module;
        $data['todoable_id']   = $id;
        $data['parent']        = $parent;

        return view('todos::modal.create')->with($data);
    }

    public function subtask($parent = null)
    {
        $data['parent'] = $this->todo->findOrFail($parent);

        return view('todos::modal.subtask')->with($data);
    }

    public function edit(Todo $todo)
    {
        $data['todo'] = $todo;

        return view('todos::modal.update')->with($data);
    }

    // public function saveSubtask(TodoRequest $request)
    // {
    //     $todo = $this->todo->findOrFail($request->parent);
    //     $todo->todoable->todos()->create($request->all());
    //     $data['message']  = langapp('saved_successfully');
    //     $data['redirect'] = url()->previous();

    //     return ajaxResponse($data);
    // }

    // public function reOrder(Request $request)
    // {
    //     $order = 0;
    //     if ($request->ajax()) {
    //         foreach ($request->data as $key => $item) {
    //             $order++;
    //             $task = $this->todo->find($item['id']);
    //             $task->update(['order' => $order, 'parent' => null]);
    //             if (isset($item['children'])) {
    //                 foreach ($item['children'] as $k => $child) {
    //                     $this->todo->find($child['id'])->update(['order' => $order++, 'parent' => $task->id]);
    //                 }
    //             }
    //         }
    //         return response()->json(
    //             ['status' => 'success', 'message' => langapp('changes_saved_successful')],
    //             200
    //         );
    //     }
    // }
}
