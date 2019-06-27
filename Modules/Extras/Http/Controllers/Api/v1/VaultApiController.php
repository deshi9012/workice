<?php

namespace Modules\Extras\Http\Controllers\Api\v1;

use App\Entities\Vault;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Extras\Http\Requests\VaultRequest;

class VaultApiController extends Controller
{
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;
    /**
     * Vault model
     *
     * @var \App\Entities\Vault
     */
    protected $vault;

    public function __construct(Request $request, Vault $vault)
    {
        $this->middleware('localize');
        $this->request = $request;
        $this->vault   = $vault;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Modules\Extras\Http\Requests\VaultRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(VaultRequest $request)
    {
        $model = classByName($request->module)->findOrFail($request->module_id);
        $model->vault()->create(
            [
                'key'     => $request->key,
                'value'   => $request->value,
                'user_id' => \Auth::id(),
            ]
        );
        $data['message']  = langapp('saved_successfully');
        $data['redirect'] = $request->url;

        return ajaxResponse($data, true, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Modules\Extras\Http\Requests\VaultRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(VaultRequest $request)
    {
        $vault = $this->vault->findOrFail($request->id);
        $vault->update(
            [
                'key'     => $request->key,
                'value'   => $request->value,
                'user_id' => \Auth::id(),
            ]
        );
        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = $request->url;

        return ajaxResponse($data, true, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $vault = $this->vault->findOrFail($id);
        $vault->delete();
        $data['message']  = langapp('deleted_successfully');
        $data['redirect'] = $this->request->url;

        return ajaxResponse($data, true, Response::HTTP_OK);
    }
}
