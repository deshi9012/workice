<?php

namespace Modules\Extras\Http\Controllers\Api\v1;

use App\Entities\Phone;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Extras\Http\Requests\CallRequest;
use Modules\Extras\Notifications\CallAlert;

class CallsApiController extends Controller
{
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;
    /**
     * Phone model
     *
     * @var \App\Entities\Phone
     */
    protected $phone;

    public function __construct(Request $request, Phone $phone)
    {
        $this->middleware('localize');
        $this->request = $request;
        $this->phone   = $phone;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Extras\Http\Requests\CallRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(CallRequest $request)
    {
        $entity = classByName($request->module)->findOrFail($request->module_id);
        $request->request->add(['duration' => timelog($request->duration)]);
        $call = $entity->calls()->create($request->except(['scheduled_date', 'reminder']));
        if ($request->has('scheduled')) {
            $when = dateParser($call->scheduled_date)->subMinutes($request->reminder);
            $call->agent->notify((new CallAlert($call))->delay($when));
            $call->update(['scheduled_date' => $request->scheduled_date, 'reminder' => $request->reminder]);
        } else {
            $call->update(['scheduled_date' => null, 'reminder' => null]);
        }
        $data['message']  = langapp('saved_successfully');
        $data['redirect'] = $request->url;
        return ajaxResponse($data, true, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Extras\Http\Requests\CallRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CallRequest $request, $id = null)
    {
        $call = $this->phone->findOrFail($id);
        $request->request->add(['duration' => timelog($request->duration)]);

        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = $request->url;

        return ajaxResponse($data, true, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function delete($id = null)
    {
        if ($this->request->ajax()) {
            $call = $this->phone->findOrFail($id);
            if ($call->delete()) {
                return response()->json(['status' => 'success', 'message' => langapp('deleted_successfully')], Response::HTTP_OK);
            }

            return response()->json(['status' => 'errors', 'message' => 'something went wrong'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
