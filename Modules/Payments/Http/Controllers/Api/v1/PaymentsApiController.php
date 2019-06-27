<?php

namespace Modules\Payments\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Comments\Transformers\CommentsResource;
use Modules\Files\Helpers\Uploader;
use Modules\Payments\Entities\Payment;
use Modules\Payments\Helpers\PaymentEngine;
use Modules\Payments\Http\Requests\PaymentRequest;
use Modules\Payments\Transformers\PaymentResource;
use Modules\Payments\Transformers\PaymentsResource;

class PaymentsApiController extends Controller
{
    protected $request;
    protected $payment;

    public function __construct(Request $request)
    {
        $this->middleware('localize');
        $this->request = $request;
        $this->payment = new Payment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {
        $payments = new PaymentsResource(
            $this->payment->whereNull('archived_at')
                ->with(['company:id,name,primary_contact'])
                ->orderByDesc('id')
                ->paginate(40)
        );
        return response($payments, Response::HTTP_OK);
    }
    /**
     * Process payment
     */
    public function pay(PaymentRequest $request)
    {
        $data    = $request->only(['invoice_id', 'gateway', 'send_email', 'amount', 'payment_date', 'payment_method', 'notes']);
        $payment = (new PaymentEngine('offline', $data))->transact();

        if ($request->hasFile('uploads')) {
            $this->makeUploads($payment, $request);
        }
        return ajaxResponse(
            [
                'id'       => $payment->id,
                'message'  => langapp('saved_successfully'),
                'redirect' => route('invoices.view', $request->invoice_id),
            ],
            true,
            Response::HTTP_OK
        );
    }

    /**
     * Show the specified resource.
     *
     * @return Response
     */
    public function show($id = null)
    {
        $payment = $this->payment->findOrFail($id);
        return response(new PaymentResource($payment), Response::HTTP_OK);
    }

    public function update(PaymentRequest $request, $id = null)
    {
        $payment = $this->payment->findOrFail($id);
        $payment->update($request->except(['id', 'uploads', 'code', 'tags']));

        if ($request->hasFile('uploads')) {
            $this->makeUploads($payment, $request);
        }
        return ajaxResponse(
            [
                'id'       => $payment->id,
                'message'  => langapp('changes_saved_successful'),
                'redirect' => route('payments.view', $payment->id),
            ],
            true,
            Response::HTTP_OK
        );
    }
    /**
     * Mark a payment as refunded
     */
    public function refund($id = null)
    {
        $payment = $this->payment->findOrFail($id);
        $payment->update(['is_refunded' => 1]);
        return ajaxResponse(
            [
                'id'       => $payment->id,
                'message'  => langapp('changes_saved_successful'),
                'redirect' => route('payments.view', $payment->id),
            ],
            true,
            Response::HTTP_OK
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function comments($id = null)
    {
        $payment  = $this->payment->findOrFail($id);
        $comments = new CommentsResource($payment->comments()->orderByDesc('id')->paginate(50));
        return response($comments, Response::HTTP_OK);
    }

    protected function makeUploads($payment, $request)
    {
        $request->request->add(['module' => 'payments']);
        $request->request->add(['module_id' => $payment->id]);
        $request->request->add(['title' => 'Transaction ' . $payment->code]);
        $request->request->add(['description' => 'Payment ' . $payment->code . ' file']);

        return (new Uploader)->save('uploads/payments', $request);
    }

    public function delete($id = null)
    {
        $payment = $this->payment->findOrFail($id);
        $payment->delete();
        return ajaxResponse(
            [
                'message'  => langapp('deleted_successfully'),
                'redirect' => route('payments.index'),
            ],
            true,
            Response::HTTP_OK
        );
    }
}
