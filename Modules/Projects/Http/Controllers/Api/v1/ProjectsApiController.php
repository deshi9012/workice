<?php

namespace Modules\Projects\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Expenses\Transformers\ExpensesResource;
use Modules\Invoices\Transformers\InvoicesResource;
use Modules\Projects\Entities\Project;
use Modules\Projects\Events\ProjectDone;
use Modules\Projects\Http\Requests\ProjectRequest;
use Modules\Projects\Jobs\CloneProject;
use Modules\Projects\Jobs\ProjectFromTemplate;
use Modules\Projects\Transformers\ProjectResource;
use Modules\Projects\Transformers\ProjectsResource;
use Modules\Tasks\Transformers\TasksResource;

class ProjectsApiController extends Controller
{
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    public $request;
    /**
     * Project Model
     *
     * @var \Modules\Projects\Entities\Project
     */
    public $project;

    public function __construct(Request $request)
    {
        $this->middleware('localize');
        $this->request = $request;
        $this->project = new Project;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {
        $projects = new ProjectsResource(
            $this->project->with(['company:id,name,primary_contact'])
                ->orderByDesc('id')
                ->paginate(50)
        );
        return response($projects, Response::HTTP_OK);
    }

    /**
     * Show the specified resource.
     *
     * @return Response
     */
    public function show($id = null)
    {
        $project = $this->project->findOrFail($id);
        $this->authorize('view', $project);
        return response(new ProjectResource($project), Response::HTTP_OK);
    }
    /**
     * Save Project
     */
    public function save(ProjectRequest $request)
    {
        $project = $this->project->create($request->except(['tags', 'team']));

        return ajaxResponse(
            [
            'id'       => $project->id,
            'message'  => langapp('saved_successfully'),
            'redirect' => route('projects.view', ['id' => $project->id, 'tab' => 'tasks']),
            ],
            true,
            Response::HTTP_CREATED
        );
    }
    /**
     * Update Project
     */
    public function update(ProjectRequest $request, $id = null)
    {
        $project = $this->project->findOrFail($id);
        $this->authorize('update', $project);
        $project->update($request->except(['id', 'tags', 'team']));
        return ajaxResponse(
            [
            'id'       => $project->id,
            'message'  => langapp('changes_saved_successful'),
            'redirect' => route('projects.view', $project->id),
            ],
            true,
            Response::HTTP_OK
        );
    }
    /**
     * Delete Project
     */
    public function delete($id = null)
    {
        $project = $this->project->findOrFail($id);
        $this->authorize('delete', $project);
        $project->delete();
        return ajaxResponse(
            [
            'message'  => langapp('deleted_successfully'),
            'redirect' => route('projects.index'),
            ],
            true,
            Response::HTTP_OK
        );
    }
    /**
     * Mark project as done
     */
    public function close($id = null)
    {
        $project = $this->project->findOrFail($id);
        $this->authorize('done', $project);
        event(new ProjectDone($project, \Auth::id()));
        return ajaxResponse(
            [
            'id'       => $project->id,
            'message'  => langapp('changes_saved_successful'),
            'redirect' => route('projects.view', $project->id),
            ],
            true,
            Response::HTTP_OK
        );
    }
    /**
     * Invoice a project
     */
    public function invoice($id = null)
    {
        $project = $this->project->findOrFail($id);
        if (!$this->request->has('expense') && $project->unbilled <= 0) {
            return response(['errors' => ['message' => ['No unbilled timesheets available']], 'success' => false], 500);
        }
        $invoice = $project->makeInvoice($this->request->invoice_style);
        return ajaxResponse(
            [
            'id'       => $invoice->id,
            'message'  => langapp('saved_successfully'),
            'redirect' => route('invoices.view', $invoice->id),
            ],
            true,
            Response::HTTP_OK
        );
    }
    /**
     * Duplicate a project
     */
    public function copy($id = null)
    {
        $this->request->validate(['id' => 'required|numeric']);
        CloneProject::dispatch($this->request)->onQueue('high');
        return ajaxResponse(
            [
            'message'  => langapp('copied_successfully'),
            'redirect' => route('projects.index'),
            ],
            true,
            Response::HTTP_OK
        );
    }

    /**
     * Create project from template
     */
    public function fromTemplate($id = null)
    {
        $this->request->validate(['id' => 'required|numeric']);
        ProjectFromTemplate::dispatch($this->request);
        return ajaxResponse(
            [
            'message'  => langapp('saved_successfully'),
            'redirect' => route('projects.index'),
            ],
            true,
            Response::HTTP_OK
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response|\Illuminate\View\View
     */
    public function invoices($id = null)
    {
        $project = $this->project->findOrFail($id);
        $this->authorize('invoices', $project);
        $invoices = new InvoicesResource($project->invoices()->orderBy('id', 'desc')->paginate(20));
        if ($this->request->has('json')) {
            $data['invoices'] = $invoices;
            return view('projects::_ajax._invoices')->with($data);
        }
        return response($invoices, Response::HTTP_OK);
    }

    /**
     * Show project expenses
     *
     * @return Response|\Illuminate\View\View
     */
    public function expenses($id = null)
    {
        $project = $this->project->findOrFail($id);
        $this->authorize('expenses', $project);
        $expenses = new ExpensesResource($project->expenses()->orderBy('id', 'desc')->paginate(20));
        if ($this->request->has('json')) {
            $data['expenses'] = $expenses;
            return view('projects::_ajax._expenses')->with($data);
        }
        return response($expenses, Response::HTTP_OK);
    }
    /**
     * Show project tasks
     *
     * @return Response
     */
    public function tasks($id = null)
    {
        $project = $this->project->findOrFail($id);
        $this->authorize('view', $project);
        $tasks   = new TasksResource($project->tasks()->with(['AsProject:id,name', 'AsMilestone:id,milestone_name'])->orderBy('id', 'desc')->paginate(50));
        return response($tasks, Response::HTTP_OK);
    }
}
