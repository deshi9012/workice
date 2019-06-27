<?php

namespace Modules\Projects\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Projects\Entities\Project;
use Modules\Projects\Jobs\BulkDeleteProjects;
use Modules\Projects\Jobs\BulkInvoiceProjects;

abstract class ProjectsController extends Controller
{
    /**
     * Request instance
     * @var \Illuminate\Http\Request
     */
    protected $request;
    /**
     * Project Model
     * @var \Modules\Projects\Entities\Project
     */
    protected $project;

    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'impersonate', 'verified', '2fa', 'can:menu_projects']);
        $this->request = $request;
        $this->project = new Project;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['page']   = $this->getPage();
        $data['filter'] = $this->request->filter;

        return view('projects::index')->with($data);
    }
    /**
     * Show Project Overview
     */
    public function view(Project $project, $tab = 'dashboard', $item = null)
    {
        $allowedTabs     = ['issues', 'calendar', 'comments', 'expenses', 'files', 'gantt', 'invoices', 'links', 'milestones', 'notes', 'tasks', 'timesheets'];
        $data['tab']     = in_array($tab, $allowedTabs) ? $tab : 'dashboard';
        $data['page']    = $this->getPage();
        $data['project'] = $project;
        $data['item']    = $item;
        $data['filter'] = $this->request->filter;

        return view('projects::view')->with($data);
    }
    /**
     * Show create project form
     */
    public function create($client = null)
    {
        $data['page']         = $this->getPage();
        $data['selectClient'] = $client;
        return view('projects::create')->with($data);
    }
    /**
     * Show update project form
     */
    public function edit(Project $project)
    {
        $data['page']    = $this->getPage();
        $data['project'] = $project;

        return view('projects::update')->with($data);
    }
    /**
     * Show invoice project modal
     */
    public function invoice(Project $project)
    {
        $data['project'] = $project;

        return view('projects::modal.invoice')->with($data);
    }
    /**
     * Show duplicate project modal
     */
    public function copy(Project $project)
    {
        $data['project'] = $project;

        return view('projects::modal.clone')->with($data);
    }

    /**
     * Show project template modal
     */
    public function fromTemplate(Project $project)
    {
        $data['project'] = $project;

        return view('projects::modal.from_template')->with($data);
    }

    /**
     * Mark project as complete form
     */
    public function done(Project $project)
    {
        $data['project'] = $project;

        return view('projects::modal.done')->with($data);
    }
    /**
     * Download project summary as PDF
     */
    public function pdf(Project $project)
    {
        if (isset($project->id)) {
            return $project->pdf();
        }
        abort(404);
    }
    /**
     * Determine project progress using tasks or manually
     */
    public function autoProgress(Project $project)
    {
        $project->update(['auto_progress' => $project->auto_progress ? 0 : 1]);

        toastr()->info(langapp('changes_saved_successful'), langapp('response_status'));

        return redirect(url()->previous());
    }

    public function delete(Project $project)
    {
        $data['project'] = $project;

        return view('projects::modal.delete')->with($data);
    }
    /**
     * Delete multiple projects
     */
    public function bulkDelete()
    {
        if ($this->request->has('checked')) {
            BulkDeleteProjects::dispatch($this->request->checked);
            $data['message']  = langapp('deleted_successfully');
            $data['redirect'] = url()->previous();
            return ajaxResponse($data);
        }
        return response()->json(['message' => 'No projects selected', 'errors' => ['missing' => ["Please select atleast 1 project"]]], 500);
    }
    /**
     * Invoice multiple projects
     */
    public function bulkInvoice()
    {
        if ($this->request->has('checked')) {
            BulkInvoiceProjects::dispatch($this->request->checked, \Auth::id());
            $data['message']  = langapp('action_completed');
            $data['redirect'] = url()->previous();
            return ajaxResponse($data);
        }
        return response()->json(['message' => 'No projects selected', 'errors' => ['missing' => ["Please select atleast 1 project"]]], 500);
    }

    /**
     * Get projects to display on datatable
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tableData()
    {
        $model = $this->applyFilter()->with('company:id,name,currency');

        return DataTables::eloquent($model)
            ->addColumn('team', function ($project) {
                $str = '';
                foreach ($project->assignees->take(3) as $member):
                    $str .= '<a class="thumb-xs avatar"> <img src="' . $member->user->profile->photo . '" class="img-circle" rel="tooltip" title="' . $member->user->name . '" data-placement="top"></a>';
                endforeach;

                return $str;
            })
            ->editColumn('chk', function ($project) {
                return '<label><input type="checkbox" name="checked[]" value="' . $project->id . '"><span class="label-text"></span></label>';
            })
            ->editColumn('name', function ($project) {
                $str = $project->progress == 100 ? '<span class="text-success">✔ </span>' : '';
                $str .= '<a href="' . route('projects.view', $project->id) . '">' . str_limit($project->name, 30) . '</a>';
                return $str;
            })
            ->editColumn('client_id', function ($project) {
                return $project->client_id > 0 ? '<a href="' . route('clients.view', $project->client_id) . '">' . str_limit($project->company->name, 20) . '</a>' : 'N/A';
            })
            ->editColumn('billable_time', function ($project) {
                return '<span class="text-dark">' . secToHours($project->billable_time) . '</span>';
            })
            ->editColumn('used_budget', function ($project) {
                $color = $project->used_budget > 100 ? 'danger' : 'bold';
                return '<span class="text-' . $color . '">' . percent($project->used_budget) . '%</span>';
            })
            ->editColumn('sub_total', function ($project) {
                return formatCurrency($project->currency, $project->sub_total);
            })
            ->editColumn('total_expenses', function ($project) {
                return formatCurrency($project->currency, $project->total_expenses);
            })
            ->rawColumns(['team', 'client_id', 'chk', 'name', 'billable_time', 'used_budget'])
            ->make(true);
    }

    public function applyFilter()
    {
        $filter = $this->request->filter;
        if ($filter == 'active') {
            return $this->project->apply(['status' => 'Active', 'archived' => 0]);
        }
        if ($filter == 'on_hold') {
            return $this->project->apply(['status' => 'On Hold', 'archived' => 0]);
        }
        if ($filter == 'done') {
            return $this->project->apply(['status' => 'Done', 'archived' => 0]);
        }
        if ($filter == 'archived') {
            return $this->project->apply(['archived' => 1]);
        }
        if ($filter == 'templates') {
            return $this->project->apply(['template' => 1]);
        }
        return $this->project->apply(['template' => 0, 'archived' => 0]);
    }

    private function getPage()
    {
        return langapp('projects');
    }
}
