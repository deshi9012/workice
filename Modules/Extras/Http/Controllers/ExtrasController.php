<?php

namespace Modules\Extras\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Users\Entities\CannedResponse;

class ExtrasController extends Controller
{
    protected $page;
    protected $canned;
    /**
     * Create a new controller instance.
     */
    public function __construct(CannedResponse $canned)
    {
        $this->middleware(['auth', 'verified', '2fa']);
        $this->canned = $canned;
    }

    public function userTemplates()
    {
        $data['page'] = langapp('profile');
        return view('extras::index')->with($data);
    }

    public function cannedMessage(Request $request)
    {
        if ($request->response_id > 0) {
            return $this->canned->select('message')->whereId($request->response_id)->first();
        }
        return '';
    }

    public function editResponse(CannedResponse $message)
    {
        $data['response'] = $message;
        return view('extras::modal.update_response')->with($data);
    }
    public function editClause(\Modules\Contracts\Entities\Clause $clause)
    {
        $data['clause'] = $clause;
        return view('extras::modal.update_clause')->with($data);
    }
}
