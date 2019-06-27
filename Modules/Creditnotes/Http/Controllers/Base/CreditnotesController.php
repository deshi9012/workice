<?php

namespace Modules\Creditnotes\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Http\Request;
use Modules\Creditnotes\Entities\Credited;
use Modules\Creditnotes\Entities\CreditNote;
use Modules\Creditnotes\Exports\CreditsExport;
use Modules\Invoices\Entities\Invoice;

abstract class CreditnotesController extends Controller
{
    /**
     * Page name
     *
     * @var string
     */
    protected $page;
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;
    /**
     * Credit Note model
     *
     * @var \Modules\Creditnotes\Entities\CreditNote
     */
    protected $creditnote;

    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa', 'can:menu_creditnotes']);
        $this->request    = $request;
        $this->creditnote = new CreditNote;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['page']   = $this->getPage();
        $data['filter'] = $this->request->filter;

        return view('creditnotes::index')->with($data);
    }
    // View credit note
    public function view(CreditNote $creditnote)
    {
        $data['page']       = $this->getPage();
        $data['creditnote'] = $creditnote;

        return view('creditnotes::view')->with($data);
    }
    // Show create credit form
    public function create()
    {
        $data['page'] = $this->getPage();

        return view('creditnotes::create')->with($data);
    }
    // Show edit credit form
    public function edit(CreditNote $creditnote)
    {
        $data['page']       = $this->getPage();
        $data['creditnote'] = $creditnote;

        return view('creditnotes::update')->with($data);
    }
    // Show creditnote activities
    public function activity(CreditNote $creditnote)
    {
        $data['activities'] = $creditnote->activities;

        return view('partial.activity')->with($data);
    }
    // Use credits
    public function credits(Invoice $invoice)
    {
        $data['invoice'] = $invoice;

        return view('creditnotes::modal.credits')->with($data);
    }
    // Remove used credits
    public function removeCredit(Credited $credited)
    {
        $data['credited'] = $credited;
        return view('creditnotes::modal.remove_credits')->with($data);
    }
    // Show credit note comments
    public function comments(CreditNote $creditnote)
    {
        $data['creditnote'] = $creditnote;

        return view('creditnotes::modal.comments')->with($data);
    }
    // Show send credit note form
    public function send(CreditNote $creditnote)
    {
        $data['creditnote'] = $creditnote;
        return view('creditnotes::modal.send')->with($data);
    }

    // Export credit notes
    public function export()
    {
        if (isAdmin()) {
            return (new CreditsExport)->download('credits_' . now()->toIso8601String() . '.csv');
        }
        abort(404);
    }
    // Download credit note as PDF
    public function pdf(CreditNote $creditnote)
    {
        if (isset($creditnote->id)) {
            return $creditnote->pdf();
        }
        abort(404);
    }
    // Confirm credit delete
    public function delete(CreditNote $creditnote)
    {
        $data['creditnote'] = $creditnote;

        return view('creditnotes::modal.delete')->with($data);
    }
    // Delete multiple credits
    public function bulkDelete()
    {
        if ($this->request->has('checked')) {
            \Modules\Creditnotes\Jobs\BulkDeleteCredits::dispatch($this->request->checked, \Auth::id())->onQueue('normal');
            $data['message']  = langapp('deleted_successfully');
            $data['redirect'] = url()->previous();
            return ajaxResponse($data);
        }
        return response()->json(['message' => 'No creditnote selected', 'errors' => ['missing' => ["Please select atleast 1 credit note"]]], 500);
    }
    // Send bulk credit notes to clients
    public function bulkSend()
    {
        if ($this->request->has('checked')) {
            \Modules\Creditnotes\Jobs\BulkSendCredits::dispatch($this->request->checked, \Auth::id())->onQueue('high');
            $data['message']  = langapp('sent_successfully');
            $data['redirect'] = url()->previous();
            return ajaxResponse($data);
        }
        return response()->json(['message' => 'No creditnote selected', 'errors' => ['missing' => ["Please select atleast 1 credit note"]]], 500);
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tableData()
    {
        $model = $this->applyFilter()->with(['company:id,name,currency']);
        return DataTables::eloquent($model)
            ->editColumn(
                'reference_no',
                function ($creditnote) {
                    $str = $creditnote->statusIcon();
                    $str .= '<a href="' . route('creditnotes.view', $creditnote->id) . '">' . $creditnote->reference_no . '</a>';
                    return $str;
                }
            )
            ->editColumn(
                'chk',
                function ($creditnote) {
                    return '<label><input type="checkbox" name="checked[]" value="' . $creditnote->id . '"><span class="label-text"></span></label>';
                }
            )
            ->editColumn(
                'client_id',
                function ($creditnote) {
                    return optional($creditnote->company)->id > 0 ? '<a href="' . route('clients.view', $creditnote->client_id) . '">' . $creditnote->company->name . '</a>' : 'N/A';
                }
            )
            ->editColumn(
                'created_at',
                function ($creditnote) {
                    return dateString($creditnote->created_at);
                }
            )
            ->editColumn(
                'status',
                function ($creditnote) {
                    return '<span class="text-dark text-uc">' . $creditnote->status . '</span>';
                }
            )
            ->editColumn(
                'amount',
                function ($creditnote) {
                    return formatCurrency($creditnote->currency, $creditnote->amount);
                }
            )
            ->editColumn(
                'balance',
                function ($creditnote) {
                    $bal = formatCurrency($creditnote->currency, $creditnote->balance);

                    return $creditnote->balance > 0 ? '<span class="text-danger">' . $bal . '</span>' : $bal;
                }
            )
            ->rawColumns(['reference_no', 'client_id', 'chk', 'status', 'balance'])
            ->make(true);
    }

    protected function applyFilter()
    {
        if ($this->request->filter === 'open') {
            return $this->creditnote->apply(['status' => 'open'])->whereNull('archived_at');
        }
        if ($this->request->filter === 'closed') {
            return $this->creditnote->apply(['status' => 'closed']);
        }
        if ($this->request->filter === 'void') {
            return $this->creditnote->apply(['status' => 'void']);
        }
        if ($this->request->filter === 'archived') {
            return $this->creditnote->apply(['archived' => 1]);
        }
        return $this->creditnote->query()->whereNull('archived_at');
    }

    private function getPage()
    {
        return langapp('creditnotes');
    }
}
