<?php

namespace Modules\Tasks\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Http\Request;
use Modules\Projects\Entities\Project;
use Modules\Tasks\Entities\Task;

abstract class TasksController extends Controller
{
    protected $page;
    protected $request;

    /**
     * Create a new controller instance.
     */
    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa']);
        $this->request = $request;
        $this->task    = new Task;
    }

    public function index()
    {
        $data['page']  = $this->getPage();
        $query         = $this->task->query()->where('project_id', '>', 0);
        $data['tasks'] = $this->applyFilter($query)->orderByDesc('id')->get();
        return view('tasks::index')->with($data);
    }

    public function edit(Task $task)
    {
        $data['task'] = $task;

        return view('tasks::update')->with($data);
    }

    public function copy(Task $task)
    {
        $data['task'] = $task;

        return view('tasks::copy')->with($data);
    }

    public function create(Project $project, $milestone_id = null)
    {
        $data['project']      = $project;
        $data['milestone_id'] = $milestone_id;

        return view('tasks::create')->with($data);
    }

    public function close(Task $task)
    {
        $task->update(['progress' => '100']);
        toastr()->info(langapp('changes_saved_successful'), langapp('response_status'));
        return redirect(url()->previous());
    }

    public function template()
    {
        return view('tasks::createTemplate');
    }

    public function editTemplate(Task $task)
    {
        $data['task'] = $task;

        return view('tasks::editTemplate')->with($data);
    }

    public function saveTemplate()
    {
        $this->request->validate([
            'name'            => 'required', 'description' => 'required',
            'estimated_hours' => 'numeric', 'hourly_rate'  => 'numeric',
        ]);
        $this->task->unsetEventDispatcher();
        $this->task->create($this->request->all());

        $data['message']  = langapp('saved_successfully');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }

    public function updateTemplate(Task $task)
    {
        $this->request->validate([
            'name'            => 'required', 'description' => 'required',
            'estimated_hours' => 'numeric', 'hourly_rate'  => 'numeric',
        ]);
        $this->task->unsetEventDispatcher();
        $task->update($this->request->except('id'));

        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = url()->previous();

        return ajaxResponse($data);
    }

    public function timesheet(Task $task)
    {
        $data['entries'] = $task->timesheets;

        return view('tasks::timesheet')->with($data);
    }

    public function autotasks()
    {
        $names = $this->task->groupBy('name')->orderBy('name', 'asc')->get();
        $name  = array();
        foreach ($names as $n) {
            $name[] = $n->name;
        }

        return ajaxResponse($name);
    }
    public function autotask()
    {
        $name = $this->task->whereName($this->request->name)->first();

        return ajaxResponse($name);
    }

    public function deleteTemplate(Task $task)
    {
        $data['task'] = $task;

        return view('tasks::deleteTemplate')->with($data);
    }

    public function delete(Task $task)
    {
        $data['task'] = $task;

        return view('tasks::delete')->with($data);
    }

    public function destroyTemplate()
    {
        $this->request->validate(['id' => 'required']);
        $task = $this->task->findOrFail($this->request->id);
        $task->delete();
        toastr()->warning(langapp('deleted_successfully'), langapp('response_status'));

        return redirect(url()->previous());
    }

    public function ajaxTodos($id)
    {
        $data['task'] = \Modules\Tasks\Entities\Task::findOrFail($id);

        return view('tasks::_ajax.todos')->with($data);
    }
    public function ajaxTimesheets($id)
    {
        $data['task'] = \Modules\Tasks\Entities\Task::findOrFail($id);

        return view('tasks::_ajax.timesheets')->with($data);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tableData($project = null)
    {
        $model = $this->applyFilter($this->task->where('project_id', $project))->orderByDesc('id');

        return DataTables::eloquent($model)
            ->editColumn('name', function ($task) {
                $str = $task->progress == 100 ? '<span class="text-success">✔︎</span>' : '';
                $str .= $task->is_recurring ? '<i class="fas fa-sync fa-spin text-danger"></i>' : '';
                return $str .= '<a href="' . route('projects.view', ['id' => $task->project_id, 'tab' => 'tasks', 'item' => $task->id]) . '"> ' . str_limit($task->name, 30) . '</a>';
            })
            ->editColumn('chk', function ($task) {
                return '<label><input type="checkbox" name="tasks[]" value="' . $task->id . '"><span class="label-text"></span></label>';
            })
            ->editColumn('hours', function ($task) {
                $str = '<strong>' . secToHours($task->time) . '</strong>';
                if ($task->timerRunning()) {
                    $str .= ' <i class="fas fa-sync-alt fa-spin text-danger"></i>';
                }

                return $str;
            })
            ->editColumn('hourly_rate', function ($task) {
                return $task->hourly_rate . '/ hr';
            })
            ->editColumn('progress', function ($task) {
                return "<div class=\"progress-xxs not-rounded mb-0 inline-block progress width100 m-r-5\">
                                <div class=\"progress-bar progress-bar-info \" role=\"progressbar\" aria-valuenow=\"$task->progress\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: $task->progress%;\" data-toggle=\"tooltip\" data-original-title=\"$task->progress%\">
                                </div>
                            </div>";
            })
            ->editColumn('due_date', function ($task) {
                return dateTimeFormatted($task->due_date);
            })
            ->editColumn('action', function ($task) {
                $str = '';
                if ($task->user_id == \Auth::id() || $task->isTeam() || isAdmin()):
                    $str .= '<a class="btn btn-xs btn-default" href="' . route('tasks.timesheet', $task->id) . '" data-toggle="ajaxModal" data-rel="tooltip" title="Time Entries"><i class="fas fa-stopwatch"></i> </a> <a class="btn btn-xs btn-default';
                $str .= '" href="' . route('users.pin', ['id' => $task->id, 'module' => 'tasks']) . '" data-rel="tooltip" title="';
                $str .= langapp('pin_sidebar');
                $str .= '" data-rel="tooltip"><i class="fas fa-map-pin"></i></a> <a class="btn btn-xs btn-dark" href="' . route('tasks.edit', $task->id) . '" data-toggle="ajaxModal"><i class="fas fa-pencil-alt"></i></a>';

                if ($task->progress < 100 && $task->isTeam()):
                        if ($task->timerRunning()) {
                            $str .= ' <a class="btn btn-xs btn-danger" data-toggle="tooltip" data-title="' . langapp('stop_timer') . '" href="' . route('clock.stop', ['id' => $task->id, 'module' => 'tasks']) . '"><i class="fas fa-clock"></i> </a>';
                        } else {
                            $str .= ' <a class="btn btn-xs btn-success" data-toggle="tooltip" data-title="' . langapp('start_timer') . '" href="' . route('clock.start', ['id' => $task->id, 'module' => 'tasks']) . '"><i class="fas fa-clock"></i> </a>';
                        }
                endif;
                endif;

                return $str;
            })
            ->rawColumns(['name', 'progress', 'chk', 'hours', 'action'])
            ->make(true);
    }

    protected function applyFilter($query)
    {
        $query  = $query->with('assignees');
        $filter = $this->request->filter;
        if ($filter === 'done') {
            return $query->completed();
        }
        if ($filter === 'backlog') {
            return $query->backlog();
        }
        if ($filter === 'ongoing') {
            return $query->ongoing();
        }
        if ($filter === 'overdue') {
            return $query->overdue();
        }
        if ($filter === 'mine') {
            return $query->mine();
        }
        if ($filter === 'all') {
            return $query;
        }

        return $query;
    }

    private function getPage()
    {
        return langapp('tasks');
    }
}
