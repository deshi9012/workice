<?php

namespace Modules\Issues\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Issues\Entities\Issue;
use Modules\Projects\Entities\Project;

abstract class IssuesController extends Controller
{
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;
    /**
     * Issue Model
     *
     * @var \Modules\Issues\Entities\Issue
     */
    protected $issue;

    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa']);
        $this->request = $request;
        $this->issue   = new Issue;
    }
    /**
     * Create issue form
     */
    public function create(Project $project, $status = null)
    {
        $data['project'] = $project;
        $data['status']  = $status === 'pending' ? 1 : $status;

        return view('issues::create')->with($data);
    }
    /**
     * Show update issue form
     */
    public function edit(Issue $issue)
    {
        $data['issue'] = $issue;

        return view('issues::update')->with($data);
    }

    /**
     * Show delete issue form
     */
    public function delete(Issue $issue)
    {
        $data['issue'] = $issue;

        return view('issues::delete')->with($data);
    }
    /**
     * Show issue modify status
     */
    public function status(Issue $issue)
    {
        $data['issue'] = $issue;

        return view('issues::status')->with($data);
    }

    /**
     * Show sentry integration
     */
    public function sentry($token = null)
    {
        $data['token'] = $token;

        return view('issues::sentry')->with($data);
    }

    public function ajaxFiles($id)
    {
        $data['issue'] = Issue::findOrFail($id);

        return view('issues::_ajax.files')->with($data);
    }
}
