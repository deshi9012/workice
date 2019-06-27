<?php

namespace Modules\Estimates\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Estimates\Emails\EstimateMail;
use Modules\Estimates\Entities\Estimate;
use Modules\Estimates\Events\EstimateDeclined;
use Modules\Estimates\Events\EstimateSent;
use Modules\Estimates\Http\Requests\EstimateRequest;
use Modules\Estimates\Http\Requests\SendEstimateRequest;
use Modules\Estimates\Transformers\EstimateResource;
use Modules\Estimates\Transformers\EstimatesResource;
use Modules\Items\Transformers\ItemsResource;

class EstimatesApiController extends Controller
{
    /**
     * Estimate model
     *
     * @var \Modules\Estimates\Entities\Estimate
     */
    protected $estimate;
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request;
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->middleware('localize');
        $this->request  = $request;
        $this->estimate = new Estimate;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response;
     */

    public function index()
    {
        $estimates = new EstimatesResource(
            $this->estimate->whereNull('archived_at')
                ->with(['company:id,name,primary_contact'])
                ->orderBy('id', 'desc')
                ->paginate(40)
        );

        return response($estimates, Response::HTTP_OK);
    }

    /**
     * Show the specified resource.
     *
     * @return \Illuminate\Http\Response;
     */
    public function show($id = null)
    {
        $estimate = $this->estimate->findOrFail($id);
        $this->authorize('view', $estimate);
        return response(new EstimateResource($estimate), Response::HTTP_OK);
    }
    /**
     * Save new estimate
     *
     * @param  \Modules\Estimates\Http\Requests\EstimateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(EstimateRequest $request)
    {
        $estimate = $this->estimate->create($request->except(['tags', 'new_deal']));
        if ($request->has('new_deal') && $request->deal_id === '0') {
            $estimate->newDeal();
        }
        if ($request->has('line_items')) {
            foreach ($request->line_items as $item) {
                $estimate->items()->create($item);
            }
        }
        return ajaxResponse(
            [
                'id'       => $estimate->id,
                'message'  => langapp('saved_successfully'),
                'redirect' => route('estimates.view', $estimate->id),
            ],
            true,
            Response::HTTP_CREATED
        );
    }
    /**
     * Update an estimate
     *
     * @param  \Modules\Estimates\Http\Requests\EstimateRequest $request
     * @param  string                                           $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EstimateRequest $request, $id = null)
    {
        $estimate = $this->estimate->findOrFail($id);
        $this->authorize('update', $estimate);
        $estimate->update($request->except(['id', 'tags']));
        return ajaxResponse(
            [
                'id'       => $estimate->id,
                'message'  => langapp('changes_saved_successful'),
                'redirect' => route('estimates.view', $estimate->id),
            ],
            true,
            Response::HTTP_OK
        );
    }
    /**
     * Convert estimate to invoice
     *
     * @param  string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function invoice($id = null)
    {
        $estimate = $this->estimate->findOrFail($id);
        $invoice  = $estimate->toInvoice();
        return ajaxResponse(
            [
                'id'       => $invoice->id,
                'message'  => langapp('estimate_invoiced_successfully'),
                'redirect' => route('invoices.view', $invoice->id),
            ],
            true,
            Response::HTTP_OK
        );
    }
    /**
     * Cancel an estimate
     *
     * @param  string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancel($id = null)
    {
        $estimate = $this->estimate->findOrFail($id);
        $this->authorize('decline', $estimate);
        event(new EstimateDeclined($estimate, \Auth::id()));
        return ajaxResponse(
            [
                'id'       => $estimate->id,
                'message'  => langapp('changes_saved_successful'),
                'redirect' => route('estimates.view', $estimate->id),
            ],
            true,
            Response::HTTP_OK
        );
    }
    /**
     * Convert estimate to project
     *
     * @param  string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function convert($id = null)
    {
        $estimate = $this->estimate->findOrFail($id);
        $project  = $estimate->toProject();
        return ajaxResponse(
            [
                'id'       => $estimate->id,
                'message'  => langapp('saved_successfully'),
                'redirect' => route('projects.view', $project->id),
            ],
            true,
            Response::HTTP_OK
        );
    }
    /**
     * Send estimate
     *
     * @param  \Modules\Estimates\Http\Requests\SendEstimateRequest $request
     * @param  string                                               $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(SendEstimateRequest $request, $id = null)
    {
        $estimate = $this->estimate->findOrFail($id);
        \Mail::to($request->to)->cc($request->has('cc') ? $request->cc : [])
            ->bcc($request->has('bcc') ? $request->bcc : [])
            ->send(new EstimateMail($estimate, $request->subject, $request->message, $estimate->pdf(false)));
        event(new EstimateSent($estimate, \Auth::id()));
        return ajaxResponse(
            [
                'id'       => $estimate->id,
                'message'  => langapp('sent_successfully'),
                'redirect' => route('estimates.view', $estimate->id),
            ],
            true,
            Response::HTTP_OK
        );
    }
    /**
     * Duplicate estimate
     *
     * @param  string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function copy($id = null)
    {
        $this->request->validate(
            [
                'id' => 'numeric|required',
            ]
        );
        $estimate    = $this->estimate->findOrFail($id);
        $newEstimate = $estimate->replicate();
        $newEstimate->save();
        foreach ($estimate->items as $item) {
            $newEstimate->items()->create(array_except($item->toArray(), ['id']));
        }
        $newEstimate->retag($estimate->tagList);
        return ajaxResponse(
            [
                'id'       => $newEstimate->id,
                'message'  => langapp('saved_successfully'),
                'redirect' => route('estimates.view', $newEstimate->id),
            ],
            true,
            Response::HTTP_OK
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function comments($id = null)
    {
        $estimate = $this->estimate->findOrFail($id);
        $comments = new \Modules\Comments\Transformers\CommentsResource($estimate->comments()->orderByDesc('id')->paginate(50));
        return response($comments, Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function items($id = null)
    {
        $estimate = $this->estimate->findOrFail($id);
        $items    = new ItemsResource($estimate->items()->orderByDesc('id')->paginate(100));
        return response($items, Response::HTTP_OK);
    }
    /**
     * Delete an estimate
     *
     * @param  string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id = null)
    {
        $estimate = $this->estimate->findOrFail($id);
        $this->authorize('update', $estimate);
        $estimate->delete();
        return ajaxResponse(
            [
                'message'  => langapp('deleted_successfully'),
                'redirect' => route('estimates.index'),
            ],
            true,
            Response::HTTP_OK
        );
    }
}
