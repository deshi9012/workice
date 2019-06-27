<?php

namespace Modules\Extras\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Extras\Http\Requests\MessageRequest;
use Modules\Users\Entities\CannedResponse;

class CannedApiController extends Controller
{
    protected $canned;
    /**
     * Create a new controller instance.
     */
    public function __construct(CannedResponse $canned)
    {
        $this->canned = $canned;
    }

    public function save(MessageRequest $request)
    {
        if ($request->ajax()) {
            if ($canned = $this->canned->create($request->all())) {
                $html = view('extras::_ajax.response', compact('canned'))->render();

                return response()->json(['status' => 'success', 'html' => $html, 'message' => langapp('saved_successfully')], 200);
            }
        }
    }

    public function update(MessageRequest $request, $id = null)
    {
        $response = $this->canned->findOrFail($id);
        $response->update($request->all());
        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = '/extras/user-templates';

        return ajaxResponse($data, true, Response::HTTP_OK);
    }
    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $canned = $this->canned->findOrFail($request->id);
            if ($canned->delete()) {
                return response()->json(['status' => 'success', 'message' => langapp('deleted_successfully')], 200);
            }

            return response()->json(['status' => 'errors', 'message' => 'something went wrong'], 401);
        }
    }
}
