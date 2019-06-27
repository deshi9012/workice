<?php

namespace Modules\Extras\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Contracts\Entities\Clause;

class ClausesApiController extends Controller
{
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;
    /**
     * Clause Model
     *
     * @var \Modules\Contracts\Entities\Clause
     */
    protected $clause;

    public function __construct(Request $request)
    {
        $this->middleware('localize');
        $this->request = $request;
        $this->clause  = new Clause;
    }
    /**
     * Save contract agreement clause
     */
    public function save()
    {
        $this->request->validate(['name' => 'required', 'clause' => 'required']);
        $this->clause->create($this->request->all());
        $data['message']  = langapp('saved_successfully');
        $data['redirect'] = '/settings/clauses';
        return ajaxResponse($data, true, Response::HTTP_OK);
    }

    /**
     * Update contract agreement clause
     */
    public function update($id)
    {
        $this->request->validate(['clause' => 'required']);
        $clause = $this->clause->findOrFail($id);
        $clause->update(['clause' => $this->request->clause]);
        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = '/settings/clauses';
        return ajaxResponse($data, true, Response::HTTP_OK);
    }
    /**
     * Delete agreement clause
     */
    public function delete($id)
    {
        $clause = $this->clause->findOrFail($id);
        if ($clause->delete()) {
            return response()->json(['status' => 'success', 'message' => langapp('deleted_successfully')], 200);
        }

        return response()->json(['status' => 'errors', 'message' => 'something went wrong'], 401);
    }
}
