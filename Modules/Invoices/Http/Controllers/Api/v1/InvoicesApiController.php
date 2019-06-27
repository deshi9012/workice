<?php

namespace Modules\Invoices\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Clients\Entities\Client;
use Modules\Comments\Transformers\CommentsResource;
use Modules\Invoices\Emails\InvoiceMail;
use Modules\Invoices\Emails\PoliteReminder;
use Modules\Invoices\Entities\Invoice;
use Modules\Invoices\Events\InvoicePoliteReminder;
use Modules\Invoices\Events\InvoiceSent;
use Modules\Invoices\Events\InvoiceUpdated;
use Modules\Invoices\Http\Requests\InvoiceRequest;
use Modules\Invoices\Http\Requests\SendInvoiceRequest;
use Modules\Invoices\Transformers\InvoiceResource;
use Modules\Invoices\Transformers\InvoicesResource;
use Modules\Items\Transformers\ItemsResource;
use Modules\Payments\Transformers\PaymentsResource;

class InvoicesApiController extends Controller
{
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;
    /**
     * Invoice Model
     *
     * @var \Modules\Invoices\Entities\Invoice
     */
    protected $invoice;

    public function __construct(Request $request)
    {
        $this->middleware('localize');
        $this->request = $request;
        $this->invoice = new Invoice;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $invoices = new InvoicesResource(
            $this->invoice->whereNull('cancelled_at')->whereNull('archived_at')
                ->with(['company:id,name,primary_contact'])
                ->orderByDesc('id')
                ->paginate(40)
        );

        return response($invoices, Response::HTTP_OK);
    }

    /**
     * Show the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        $invoice = $this->invoice->findOrFail($id);
        return response(new InvoiceResource($invoice), Response::HTTP_OK);
    }
    /**
     * Save Invoice
     *
     * @param  \Modules\Invoices\Http\Requests\InvoiceRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(InvoiceRequest $request)
    {
        $perc_total = array_sum(request('partial-amount', [100]));

        if ($perc_total != 100) {
            return response()->json(['message' => 'Error', 'errors' => ['terms' => ["Check your Invoice Installments"]]], 500);
        }
        if ($request->currency === 'CL') {
            $request->request->add(['currency' => Client::findOrFail($request->client_id)->currency]);
        }
        $invoice = $this->invoice->create($request->except(['partial-amount', 'partial-due_date', 'partial-notes', 'id', 'tags']));

        if ($request->has('partial-amount')) {
            $invoice->update(['due_date' => $request->input('partial-due_date.1')]);
        }

        if ($request->has('line_items')) {
            foreach ($request->line_items as $item) {
                $invoice->items()->create($item);
            }
        }

        return ajaxResponse(
            [
                'id'       => $invoice->id,
                'message'  => langapp('saved_successfully'),
                'redirect' => route('invoices.view', $invoice->id),
            ],
            true,
            Response::HTTP_CREATED
        );
    }
    /**
     * Update Invoice
     *
     * @param  \Modules\Invoices\Http\Requests\InvoiceRequest $request
     * @param  string                                         $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(InvoiceRequest $request, $id = null)
    {
        $invoice    = $this->invoice->findOrFail($id);
        $perc_total = array_sum(request('partial-amount', [100]));

        if ($perc_total != 100) {
            return response()->json(['message' => 'Error', 'errors' => ['terms' => ["Check your Invoice Installments"]]], 500);
        }

        $invoice->update($request->except(['recurring', 'partial-amount', 'partial-due_date', 'partial-notes', 'id', 'tags']));

        if ($request->has('recurring')) {
            $request->recurring['frequency'] != 'none' ? $invoice->recur() : '';
        } else {
            $invoice->stopRecurring();
        }

        if ($invoice->hasPayment() == 0 && $request->has('partial-amount')) {
            $invoice->update(['due_date' => $request->input('partial-due_date.1')]);
        }
        event(new InvoiceUpdated($invoice));

        return ajaxResponse(
            [
                'id'       => $invoice->id,
                'message'  => langapp('changes_saved_successful'),
                'redirect' => route('invoices.view', $invoice->id),
            ],
            true,
            Response::HTTP_OK
        );
    }

    /**
     * Show the specified invoice payments.
     *
     * @return \Illuminate\Http\Response
     */
    public function payments($id = null)
    {
        $invoice  = $this->invoice->findOrFail($id);
        $payments = new PaymentsResource($invoice->payments()->orderBy('id', 'desc')->paginate(50));
        return response($payments, Response::HTTP_OK);
    }
    /**
     * Send Invoice to client via email
     *
     * @param \Modules\Invoices\Http\Requests\SendInvoiceRequest $request
     * @param string                                             $id
     */
    public function send(SendInvoiceRequest $request, $id = null)
    {
        $invoice = $this->invoice->findOrFail($id);
        \Mail::to($request->to)->cc($request->has('cc') ? $request->cc : [])->bcc($request->has('bcc') ? $request->bcc : [])
            ->send(new InvoiceMail($invoice, $request->subject, $request->message, $invoice->pdf(false)));

        event(new InvoiceSent($invoice, \Auth::id()));
        return ajaxResponse(
            [
                'id'       => $invoice->id,
                'message'  => langapp('sent_successfully'),
                'redirect' => route('invoices.view', $invoice->id),
            ],
            true,
            Response::HTTP_OK
        );
    }
    /**
     * Send invoice reminder to client
     *
     * @param string $id
     */
    public function remind($id = null)
    {
        $this->request->validate(
            [
                'id'      => 'required|numeric',
                'subject' => 'required',
            ]
        );
        $invoice = $this->invoice->findOrFail($id);
        \Mail::to($invoice->company)->cc($this->request->has('cc') ? $this->request->cc : [])
            ->bcc($this->request->has('bcc') ? $this->request->bcc : [])
            ->send(new PoliteReminder($invoice, $this->request->subject, $this->request->message, $invoice->pdf(false)));
        $invoice->update(['reminder1' => now()]);
        event(new InvoicePoliteReminder($invoice));
        return ajaxResponse(
            [
                'id'       => $invoice->id,
                'message'  => langapp('sent_successfully'),
                'redirect' => route('invoices.view', $invoice->id),
            ],
            true,
            Response::HTTP_OK
        );
    }

    /**
     * Duplicate invoice
     */
    public function copy($id = null)
    {
        $invoice    = $this->invoice->findOrFail($id);
        $newInvoice = $invoice->replicate();
        $newInvoice->save();
        $newInvoice->retag($invoice->tagList);
        foreach ($invoice->items as $item) {
            $item              = $item->replicate();
            $item->itemable_id = $newInvoice->id;
            $item->save();
        }
        return ajaxResponse(
            [
                'id'       => $newInvoice->id,
                'message'  => langapp('saved_successfully'),
                'redirect' => route('invoices.view', $newInvoice->id),
            ],
            true,
            Response::HTTP_OK
        );
    }

    /**
     * Cancel Invoice
     */
    public function cancel()
    {
        $this->request->validate(['id' => 'required|numeric']);
        $invoice = $this->invoice->findOrFail($this->request->id);
        if ($invoice->hasPayment() != 0) {
            return response()->json(['message' => 'Error', 'errors' => ['payments' => ["It can only be called on an invoice that has no payments"]]], 500);
        }
        $invoice->update(['is_visible' => 0, 'cancelled_at' => now()]);
        return ajaxResponse(
            [
                'id'       => $invoice->id,
                'message'  => langapp('invoice_cancelled_successfully'),
                'redirect' => route('invoices.view', $invoice->id),
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
        $invoice  = $this->invoice->findOrFail($id);
        $comments = new CommentsResource($invoice->comments()->orderBy('id', 'desc')->paginate(50));
        return response($comments, Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function items($id = null)
    {
        $invoice = $this->invoice->findOrFail($id);
        $items   = new ItemsResource($invoice->items()->orderBy('id', 'desc')->paginate(100));
        return response($items, Response::HTTP_OK);
    }
    /**
     * Delete invoice
     */
    public function delete($id = null)
    {
        $invoice = $this->invoice->findOrFail($id);
        $invoice->delete();
        return ajaxResponse(
            [
                'message'  => langapp('deleted_successfully'),
                'redirect' => route('invoices.index'),
            ],
            true,
            Response::HTTP_OK
        );
    }
}
