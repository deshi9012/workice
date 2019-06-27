<?php

namespace Modules\Creditnotes\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Clients\Entities\Client;
use Modules\Comments\Transformers\CommentsResource;
use Modules\Creditnotes\Emails\CreditNoteMail;
use Modules\Creditnotes\Entities\Credited;
use Modules\Creditnotes\Entities\CreditNote;
use Modules\Creditnotes\Events\CreditNoteSent;
use Modules\Creditnotes\Http\Requests\ApplyCreditsRequest;
use Modules\Creditnotes\Http\Requests\CreditNoteRequest;
use Modules\Creditnotes\Http\Requests\SendCreditRequest;
use Modules\Creditnotes\Transformers\CreditResource;
use Modules\Creditnotes\Transformers\CreditsResource;
use Modules\Invoices\Entities\Invoice;
use Modules\Items\Transformers\ItemsResource;

class CreditsApiController extends Controller
{
    protected $request;
    protected $credit;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->credit  = new CreditNote;
        $this->middleware('localize');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {
        $credits = new CreditsResource(
            $this->credit->whereNull('archived_at')
                ->with(['company:id,name,primary_contact'])
                ->orderByDesc('id')
                ->paginate(40)
        );

        return response($credits, Response::HTTP_OK);
    }

    /**
     * Show the specified resource.
     *
     * @return Response
     */
    public function show($id = null)
    {
        $credit = $this->credit->findOrFail($id);
        $this->authorize('view', $credit);
        return response(new CreditResource($credit), Response::HTTP_OK);
    }

    public function save(CreditNoteRequest $request)
    {
        if ($request->currency == 'CL') {
            $request->request->add(['currency' => Client::findOrFail($request->client_id)->currency]);
        }
        $creditnote = $this->credit->create($request->except('tags'));
        if ($request->has('line_items')) {
            foreach ($request->line_items as $item) {
                $creditnote->items()->create($item);
            }
        }
        return ajaxResponse(
            [
                'id'       => $creditnote->id,
                'message'  => langapp('saved_successfully'),
                'redirect' => route('creditnotes.view', $creditnote->id),
            ],
            true,
            Response::HTTP_CREATED
        );
    }

    public function update(CreditNoteRequest $request, $id = null)
    {
        $creditnote = $this->credit->findOrFail($id);
        $this->authorize('update', $creditnote);
        $creditnote->update($request->except('id', 'tags', 'reference_no'));
        return ajaxResponse(
            [
                'id'       => $creditnote->id,
                'message'  => langapp('changes_saved_successful'),
                'redirect' => route('creditnotes.view', $creditnote->id),
            ],
            true,
            Response::HTTP_OK
        );
    }

    public function useCredits(ApplyCreditsRequest $request)
    {
        $cr = $this->credit->findOrFail($request->creditnote_id);

        if ($request->credited_amount > $cr->balance()) {
            return response()->json(['errors' => ['amount_entered' => ['Amount entered is higher than the balance']]], 500);
        }
        if ($cr->status != 'open') {
            return response()->json(['errors' => ['credit_status' => ['Credit Note is not open']]], 500);
        }
        $invoiceBalance = optional(Invoice::findOrFail($request->invoice_id))->due();
        if ($request->credited_amount > $invoiceBalance) {
            $request->request->add(['credited_amount' => $invoiceBalance]);
        }
        $credited = Credited::create($request->all());
        if ($credited->credit->balance() <= 0) {
            $cr->update(['status' => 'closed']);
        }
        return ajaxResponse(
            [
                'id'       => $request->invoice_id,
                'message'  => langapp('saved_successfully'),
                'redirect' => route('invoices.view', $request->invoice_id),
            ],
            true,
            Response::HTTP_OK
        );
    }

    public function send(SendCreditRequest $request, $id = null)
    {
        $creditnote = $this->credit->findOrFail($id);
        \Mail::to($request->to)->cc($request->has('cc') ? $request->cc : [])->bcc($request->has('bcc') ? $request->bcc : [])
            ->send(new CreditNoteMail($creditnote, $request->subject, $request->message, $creditnote->pdf(false)));

        event(new CreditNoteSent($creditnote, \Auth::id()));
        return ajaxResponse(
            [
                'id'       => $creditnote->id,
                'message'  => langapp('sent_successfully'),
                'redirect' => route('creditnotes.view', $creditnote->id),
            ],
            true,
            Response::HTTP_OK
        );
    }

    public function deleteCredit()
    {
        $cr = Credited::findOrFail($this->request->id);
        $cr->delete();
        $cr->credit->update(['status' => 'open']);
        return ajaxResponse(
            [
                'message'  => langapp('deleted_successfully'),
                'redirect' => route('invoices.view', $cr->invoice->id),
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
        $credit   = $this->credit->findOrFail($id);
        $comments = new CommentsResource($credit->comments()->orderBy('id', 'desc')->paginate(50));
        return response($comments, Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function items($id = null)
    {
        $credit = $this->credit->findOrFail($id);
        $items  = new ItemsResource($credit->items()->orderBy('id', 'desc')->paginate(100));
        return response($items, Response::HTTP_OK);
    }

    public function delete($id = null)
    {
        $credit = $this->credit->findOrFail($id);
        $credit->delete();
        return ajaxResponse(
            [
                'message'  => langapp('deleted_successfully'),
                'redirect' => route('creditnotes.index'),
            ],
            true,
            Response::HTTP_OK
        );
    }
}
