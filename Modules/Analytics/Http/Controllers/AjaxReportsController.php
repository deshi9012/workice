<?php

namespace Modules\Analytics\Http\Controllers;

use App\Entities\Feedback;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Creditnotes\Entities\CreditNote;
use Modules\Deals\Entities\Deal;
use Modules\Estimates\Entities\Estimate;
use Modules\Expenses\Entities\Expense;
use Modules\Invoices\Entities\Invoice;
use Modules\Leads\Entities\Lead;
use Modules\Payments\Entities\Payment;
use Modules\Projects\Entities\Project;
use Modules\Tasks\Entities\Task;
use Modules\Tickets\Entities\Ticket;
use Modules\Timetracking\Entities\TimeEntry;
use Modules\Users\Entities\User;

class AjaxReportsController extends Controller
{
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->middleware('can:menu_reports');
        $this->request = $request;
    }
    /**
     * Display a listing of the deals.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deals(Deal $deal)
    {
        $range      = explode('-', $this->request->range);
        $start_date = date('Y-m-d', strtotime($range[0]));
        $end_date   = date('Y-m-d', strtotime($range[1]));
        $this->request->request->add(['date_range' => [$start_date, $end_date]]);
        $deals = $deal->apply($this->request->except(['range']))->with(['company', 'AsSource', 'category', 'pipe'])->get();
        $html  = view('analytics::_ajax._deals', compact('deals'))->render();

        return response()->json(['status' => 'success', 'html' => $html, 'message' => 'Processed successfully'], 200);
    }
    /**
     * Display a listing of the leads.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function leads(Lead $lead)
    {
        $range      = explode('-', $this->request->range);
        $start_date = date('Y-m-d', strtotime($range[0]));
        $end_date   = date('Y-m-d', strtotime($range[1]));
        $this->request->request->add(['date_range' => [$start_date, $end_date]]);
        $leads = $lead->apply($this->request->except(['range']))->with(['AsSource', 'status'])->get();
        $html  = view('analytics::_ajax._leads', compact('leads'))->render();

        return response()->json(['status' => 'success', 'html' => $html, 'message' => 'Processed successfully'], 200);
    }
    /**
     * Display a listing of the invoices.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function invoices(Invoice $invoice)
    {
        $range      = explode('-', $this->request->range);
        $start_date = date('Y-m-d', strtotime($range[0]));
        $end_date   = date('Y-m-d', strtotime($range[1]));
        $this->request->request->add(['date_range' => [$start_date, $end_date]]);
        $invoices = $invoice->apply($this->request->except(['range']))->with(['company:id,name'])->get();
        $html     = view('analytics::_ajax._invoices', compact('invoices'))->render();

        return response()->json(['status' => 'success', 'html' => $html, 'message' => 'Processed successfully'], 200);
    }
    /**
     * Display a listing of the expenses.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function expenses(Expense $expense)
    {
        $range      = explode('-', $this->request->range);
        $start_date = date('Y-m-d', strtotime($range[0]));
        $end_date   = date('Y-m-d', strtotime($range[1]));
        $this->request->request->add(['date_range' => [$start_date, $end_date]]);
        $expenses = $expense->apply($this->request->except(['range']))->with(['company:id,name', 'AsCategory:id,name'])->get();
        $html     = view('analytics::_ajax._expenses', compact('expenses'))->render();

        return response()->json(['status' => 'success', 'html' => $html, 'message' => 'Processed successfully'], 200);
    }
    /**
     * Display a listing of the payments.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function payments(Payment $payment)
    {
        $range      = explode('-', $this->request->range);
        $start_date = date('Y-m-d', strtotime($range[0]));
        $end_date   = date('Y-m-d', strtotime($range[1]));
        $this->request->request->add(['date_range' => [$start_date, $end_date]]);
        $payments = $payment->apply($this->request->except(['range']))->with(['company:id,name', 'AsInvoice:id,reference_no', 'paymentMethod'])->get();
        $html     = view('analytics::_ajax._payments', compact('payments'))->render();

        return response()->json(['status' => 'success', 'html' => $html, 'message' => 'Processed successfully'], 200);
    }
    /**
     * Display a listing of the estimates.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function estimates(Estimate $estimate)
    {
        $range      = explode('-', $this->request->range);
        $start_date = date('Y-m-d', strtotime($range[0]));
        $end_date   = date('Y-m-d', strtotime($range[1]));
        $this->request->request->add(['date_range' => [$start_date, $end_date]]);
        $estimates = $estimate->apply($this->request->except(['range']))->with(['company:id,name'])->get();
        $html      = view('analytics::_ajax._estimates', compact('estimates'))->render();

        return response()->json(['status' => 'success', 'html' => $html, 'message' => 'Processed successfully'], 200);
    }
    /**
     * Display a listing of the credits.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function credits(CreditNote $credits)
    {
        $range      = explode('-', $this->request->range);
        $start_date = date('Y-m-d', strtotime($range[0]));
        $end_date   = date('Y-m-d', strtotime($range[1]));
        $this->request->request->add(['date_range' => [$start_date, $end_date]]);
        $credits = $credits->apply($this->request->except(['range']))->with(['company:id,name'])->get();
        $html    = view('analytics::_ajax._credits', compact('credits'))->render();

        return response()->json(['status' => 'success', 'html' => $html, 'message' => 'Processed successfully'], 200);
    }
    /**
     * Display a listing of the projects.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function projects(Project $project)
    {
        $range      = explode('-', $this->request->range);
        $start_date = date('Y-m-d', strtotime($range[0]));
        $end_date   = date('Y-m-d', strtotime($range[1]));
        $this->request->request->add(['date_range' => [$start_date, $end_date]]);
        $projects = $project->apply($this->request->except(['range']))->with(['company:id,name'])->get();
        $html     = view('analytics::_ajax._projects', compact('projects'))->render();

        return response()->json(['status' => 'success', 'html' => $html, 'message' => 'Processed successfully'], 200);
    }
    /**
     * Display a listing of the tasks.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tasks(Task $task)
    {
        $range      = explode('-', $this->request->range);
        $start_date = date('Y-m-d', strtotime($range[0]));
        $end_date   = date('Y-m-d', strtotime($range[1]));
        $this->request->request->add(['date_range' => [$start_date, $end_date]]);
        $tasks = $task->apply($this->request->except(['range']))->with(['AsProject:id,name', 'AsMilestone:id,milestone_name'])->get();
        $html  = view('analytics::_ajax._tasks', compact('tasks'))->render();

        return response()->json(['status' => 'success', 'html' => $html, 'message' => 'Processed successfully'], 200);
    }

    /**
     * Display a listing of the timesheets.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function timesheets(TimeEntry $timer)
    {
        $range      = explode('-', $this->request->range);
        $start_date = date('Y-m-d', strtotime($range[0]));
        $end_date   = date('Y-m-d', strtotime($range[1]));
        $this->request->request->add(['date_range' => [$start_date, $end_date]]);
        $entries = $timer->apply($this->request->except(['range']))->with(['user:id,username,name'])->get();
        $html    = view('analytics::_ajax._timesheets', compact('entries'))->render();

        return response()->json(['status' => 'success', 'html' => $html, 'message' => 'Processed successfully'], 200);
    }
    /**
     * Display a listing of the tickets.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tickets(Ticket $ticket)
    {
        $range      = explode('-', $this->request->range);
        $start_date = date('Y-m-d', strtotime($range[0]));
        $end_date   = date('Y-m-d', strtotime($range[1]));
        $this->request->request->add(['date_range' => [$start_date, $end_date]]);
        $tickets = $ticket->apply($this->request->except(['range']))->with(['user:id,username,name', 'dept', 'AsStatus'])->get();
        $html    = view('analytics::_ajax._tickets', compact('tickets'))->render();

        return response()->json(['status' => 'success', 'html' => $html, 'message' => 'Processed successfully'], 200);
    }
    /**
     * Display a listing of the agents.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function agents()
    {
        $range      = explode('-', $this->request->range);
        $start_date = date('Y-m-d', strtotime($range[0]));
        $end_date   = date('Y-m-d', strtotime($range[1]));
        $this->request->request->add(['date_range' => [$start_date, $end_date]]);
        $data['range'] = $this->request->date_range;
        $agents        = User::permission('tickets_update')->get();
        $html          = view('analytics::_ajax._agents', compact('agents'))->with($data)->render();

        return response()->json(['status' => 'success', 'html' => $html, 'message' => 'Processed successfully'], 200);
    }
    /**
     * Display a listing of the ratings.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function happiness(Feedback $feedback)
    {
        $range      = explode('-', $this->request->range);
        $start_date = date('Y-m-d', strtotime($range[0]));
        $end_date   = date('Y-m-d', strtotime($range[1]));
        $this->request->request->add(['date_range' => [$start_date, $end_date]]);
        $ratings = $feedback->apply($this->request->except('range'))->where('reviewable_type', Ticket::class)->with('user:id,username,name')->get();
        $html    = view('analytics::_ajax._ratings', compact('ratings'))->render();

        return response()->json(['status' => 'success', 'html' => $html, 'message' => 'Processed successfully'], 200);
    }
}
