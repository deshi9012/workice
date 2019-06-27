<?php

namespace App\Http\Controllers;

use App\Traits\Taggable;
use Illuminate\Http\Request;
use Modules\Invoices\Entities\Invoice;

class SearchController extends Controller
{
    use Taggable;

    protected $request;
    protected $search;
    protected $page;
    
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->request = $request;
    }

    public function search()
    {
        $this->request->validate(['keyword' => 'required']);
        $data['invoices'] = \Modules\Invoices\Entities\Invoice::select('id', 'reference_no', 'title')->WithAnyTags($this->request->keyword)->get();
        $data['estimates'] = \Modules\Estimates\Entities\Estimate::select('id', 'reference_no', 'title')->WithAnyTags($this->request->keyword)->get();
        $data['projects'] = \Modules\Projects\Entities\Project::select('id', 'name')->WithAnyTags($this->request->keyword)->get();
        $data['credits'] = \Modules\Creditnotes\Entities\CreditNote::select('id', 'reference_no')->WithAnyTags($this->request->keyword)->get();
        $data['deals'] = \Modules\Deals\Entities\Deal::select('id', 'title')->WithAnyTags($this->request->keyword)->get();
        $data['leads'] = \Modules\Leads\Entities\Lead::select('id', 'name')->WithAnyTags($this->request->keyword)->get();
        $data['expenses'] = \Modules\Expenses\Entities\Expense::select('id', 'code')->WithAnyTags($this->request->keyword)->get();
        $data['clients'] = \Modules\Clients\Entities\Client::select('id', 'name')->WithAnyTags($this->request->keyword)->get();
        $data['issues'] = \Modules\Issues\Entities\Issue::WithAnyTags($this->request->keyword)->get();
        $data['articles'] = \Modules\Knowledgebase\Entities\Knowledgebase::WithAnyTags($this->request->keyword)->get();
        $data['payments'] = \Modules\Payments\Entities\Payment::select('id', 'code')->WithAnyTags($this->request->keyword)->get();
        $data['tasks'] = \Modules\Tasks\Entities\Task::select('id', 'name', 'project_id')->WithAnyTags($this->request->keyword)->get();
        $data['tickets'] = \Modules\Tickets\Entities\Ticket::select('id', 'subject')->WithAnyTags($this->request->keyword)->get();
        $data['milestones'] = \Modules\Milestones\Entities\Milestone::select('id', 'milestone_name')->WithAnyTags($this->request->keyword)->get();
        $data['page'] = langapp('search');
        $data['keyword'] = $this->request->keyword;
        return view('searches')->with($data);
    }
}
