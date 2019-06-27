<?php

namespace Modules\Tickets\Http\Controllers\Base;

use App\Entities\CustomField;
use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Http\Request;
use Modules\Tickets\Entities\Ticket;
use Modules\Tickets\Jobs\BulkCloseTickets;
use Modules\Tickets\Jobs\BulkDeleteTickets;

abstract class TicketsController extends Controller
{
    /**
     * Request instance
     *
     * @var Request
     */
    protected $request;
    /**
     * Ticket Model
     *
     * @var Ticket
     */
    protected $ticket;

    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa', 'can:menu_tickets']);
        $this->ticket  = new Ticket;
        $this->request = $request;
    }

    /**
     * Show tickets
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['page']       = $this->getPage();
        $data['filter']     = $this->request->filter;
        $data['department'] = $this->request->department;

        return view('tickets::index')->with($data);
    }
    /**
     * Show ticket overview
     */
    public function view(Ticket $ticket)
    {
        $this->authorize('show', $ticket);
        $data['page']   = $this->getPage();
        $data['ticket'] = $ticket;

        return view('tickets::view')->with($data);
    }
    /**
     * Show create ticket form
     */
    public function create()
    {
        $data['page'] = $this->getPage();

        return view('tickets::create')->with($data);
    }
    /**
     * Show update ticket form
     */
    public function edit(Ticket $ticket)
    {
        $data['page']   = $this->getPage();
        $data['ticket'] = $ticket;

        return view('tickets::update')->with($data);
    }

    public function ajaxFields()
    {
        $data['fields'] = CustomField::whereModule('tickets')->where(['deptid' => $this->request->department])->get();

        return view('partial.customfields.createNoCol')->with($data);
    }
    /**
     * Change ticket status
     */
    public function status(Ticket $ticket, $status = null)
    {
        $this->authorize('update', $ticket);
        $data['ticket'] = $ticket;
        $data['status'] = $status;

        return view('tickets::modal.status')->with($data);
    }
    /**
     * Show convert ticket to task modal
     */
    public function convert(Ticket $ticket)
    {
        $data['ticket'] = $ticket;
        return view('tickets::modal.convert')->with($data);
    }
    /**
     * Show ticket review
     */
    public function reviews(Ticket $ticket)
    {
        $data['review'] = $ticket->reviews()->first();

        return view('tickets::modal.reviews')->with($data);
    }

    public function lock()
    {
        $ticket = $this->ticket->findOrFail($this->request->id);
        $ticket->update(
            [
                'is_locked'   => 1,
                'locked_by'   => \Auth::id(),
                'locked_time' => now()->toDateTimeString(),
            ]
        );

        return response()->json('Ticket ' . $ticket->id . ' locked by ' . \Auth::user()->name, 200);
    }

    /**
     * Create task from ticket
     */

    public function createTask(Ticket $ticket)
    {
        $this->request->validate(['id' => 'required', 'project_id' => 'required']);
        $task = $ticket->createTask();

        $data['message']  = langapp('saved_successfully');
        $data['redirect'] = route('projects.view', ['id' => $this->request->project_id, 'tab' => 'tasks', 'item' => $task->id]);

        return ajaxResponse($data);
    }
    /**
     * Show confirm ticket deletion
     */
    public function delete(Ticket $ticket)
    {
        $data['ticket'] = $ticket;
        return view('tickets::modal.delete')->with($data);
    }
    /**
     * Delete multiple tickets
     */
    public function bulkDelete()
    {
        if ($this->request->has('checked')) {
            BulkDeleteTickets::dispatch($this->request->checked, \Auth::id())->onQueue('normal');
            $data['message']  = langapp('deleted_successfully');
            $data['redirect'] = url()->previous();
            return ajaxResponse($data);
        }
        return response()->json(['message' => 'No tickets selected', 'errors' => ['missing' => ["Please select atleast 1 ticket"]]], 500);
    }
    /**
     * Close multiple tickets
     */
    public function bulkClose()
    {
        if ($this->request->has('checked')) {
            BulkCloseTickets::dispatch($this->request->checked, \Auth::id())->onQueue('low');
            $data['message']  = langapp('changes_saved_successful');
            $data['redirect'] = url()->previous();
            return ajaxResponse($data);
        }
        return response()->json(['message' => 'No tickets selected', 'errors' => ['missing' => ["Please select atleast 1 ticket"]]], 500);
    }

    /**
     * Get tickets to display in table
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tableData()
    {
        $model = $this->applyFilter()->with(['user:id,username,name', 'dept:deptid,deptname', 'AsPriority:id,priority', 'AsStatus:id,status']);

        return DataTables::eloquent($model)
            ->editColumn(
                'subject',
                function ($ticket) {
                    $str = '<a href="' . route('tickets.view', $ticket->id) . '">' . str_limit($ticket->subject, 30) . '</a>';
                    return $str;
                }
            )
            ->editColumn(
                'chk',
                function ($ticket) {
                    return '<label><input type="checkbox" name="checked[]" value="' . $ticket->id . '"><span class="label-text"></span></label>';
                }
            )
            ->editColumn(
                'user',
                function ($ticket) {
                    return '<a href="' . route('users.view', $ticket->user_id) . '">' . $ticket->user->name . '</a>';
                }
            )
            ->editColumn(
                'department',
                function ($ticket) {
                    return $ticket->dept->deptname;
                }
            )
            ->editColumn(
                'created_at',
                function ($ticket) {
                    return dateString($ticket->created_at);
                }
            )
            ->editColumn(
                'due_date',
                function ($ticket) {
                    return dateString($ticket->due_date);
                }
            )
            ->editColumn(
                'status',
                function ($ticket) {
                    return '<span class="text-dark">' . $ticket->statusIcon() . ' ' . ucfirst($ticket->AsStatus->status) . '</span>';
                }
            )
            ->editColumn(
                'priority',
                function ($ticket) {
                    return $ticket->AsPriority->priority;
                }
            )
            ->rawColumns(['subject', 'chk', 'user', 'status', 'priority'])
            ->make(true);
    }

    protected function applyFilter()
    {
        if ($this->request->filter === 'department' || $this->request->department > 0) {
            return $this->ticket->apply(['department' => $this->request->department])->whereNull('archived_at');
        }
        if ($this->request->filter === 'archived') {
            return $this->ticket->apply(['archived' => 1]);
        }
        if ($this->request->filter === 'closed') {
            return $this->ticket->apply(['closed' => 1]);
        }
        if ($this->request->filter === 'mine') {
            return $this->ticket->apply(['assignee' => \Auth::id()]);
        }

        return $this->ticket->query()->pending()->whereNull('archived_at');
    }

    private function getPage()
    {
        return langapp('tickets');
    }
}
