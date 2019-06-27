<?php

namespace Modules\Invoices\Http\Controllers\Base;

use App\Helpers\ExcelImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CSVRequest;
use DataTables;
use Illuminate\Http\Request;
use Modules\Invoices\Entities\Invoice;
use Modules\Invoices\Events\InvoiceSent;
use Modules\Invoices\Exports\InvoicesExport;
use Modules\Invoices\Jobs\BulkDeleteInvoices;
use Modules\Invoices\Jobs\BulkPayInvoices;
use Modules\Invoices\Jobs\BulkSendInvoices;

abstract class InvoicesController extends Controller
{
    /**
     * Invoice Model
     *
     * @var \Modules\Invoices\Entities\Invoice
     */
    protected $invoice;
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified', 'impersonate', '2fa', 'can:menu_invoices']);
        $this->request = $request;
        $this->invoice = new Invoice;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['page']   = $this->getPage();
        $data['filter'] = request('filter', 'all');

        return view('invoices::index')->with($data);
    }
    /**
     * Show invoice Overview
     */
    public function view(Invoice $invoice)
    {
        $data['page']    = $this->getPage();
        $data['invoice'] = $invoice;
        $data['showtax'] = settingEnabled('show_invoice_tax');

        return view('invoices::view')->with($data);
    }
    /**
     * Show invoice create form
     */
    public function create($client = null)
    {
        $data['page']         = $this->getPage();
        $data['selectClient'] = $client;

        return view('invoices::create')->with($data);
    }
    /**
     * Show invoice update form
     */
    public function edit(Invoice $invoice)
    {
        $data['page']    = $this->getPage();
        $data['invoice'] = $invoice;
        return view('invoices::update')->with($data);
    }
    /**
     * Pay invoice offline form
     */
    public function pay(Invoice $invoice)
    {
        $data['page']    = $this->getPage();
        $data['invoice'] = $invoice;

        return view('invoices::pay_invoice')->with($data);
    }
    /**
     * Show invoice to client
     */
    public function show(Invoice $invoice)
    {
        $invoice->update(['is_visible' => 1]);
        toastr()->info(langapp('changes_saved_successful'), langapp('response_status'));

        return redirect()->route('invoices.view', ['id' => $invoice->id]);
    }
    /**
     * Hide invoice to client
     */
    public function hide(Invoice $invoice)
    {
        $invoice->update(['is_visible' => 0]);
        toastr()->warning(langapp('changes_saved_successful'), langapp('response_status'));

        return redirect()->route('invoices.view', ['id' => $invoice->id]);
    }
    /**
     * Mark invoice as sent
     */
    public function markSent(Invoice $invoice)
    {
        event(new InvoiceSent($invoice, \Auth::id()));
        toastr()->success(langapp('sent_successfully'), langapp('response_status'));

        return redirect()->route('invoices.view', ['id' => $invoice->id]);
    }
    /**
     * Download invoice as PDF
     */
    public function pdf(Invoice $invoice)
    {
        if (isset($invoice->id)) {
            return $invoice->pdf();
        }
        abort(404);
    }
    /**
     * Show invoice sharing link
     */
    public function share($id)
    {
        $data['id'] = $id;

        return view('invoices::modal.share')->with($data);
    }

    /**
     * Show Duplicate invoice modal
     */
    public function copy(Invoice $invoice)
    {
        $data['invoice'] = $invoice;

        return view('invoices::modal.copy')->with($data);
    }

    /**
     * Show send invoice modal
     */
    public function send(Invoice $invoice)
    {
        $data['invoice'] = $invoice;
        return view('invoices::modal.send')->with($data);
    }

    /**
     * Export invoices as CSV
     */
    public function export()
    {
        if (isAdmin()) {
            return (new InvoicesExport)->download('invoices_' . now()->toIso8601String() . '.csv');
        }
        abort(404);
    }
    /**
     * Show invoice import modal
     */
    public function import()
    {
        $data['page'] = $this->getPage();

        return view('invoices::modal.uploadcsv')->with($data);
    }

    public function parseImport(CSVRequest $request, ExcelImport $importer)
    {
        $dt['page'] = $this->getPage();
        $path       = $request->file('csvfile')->getRealPath();
        if ($request->has('header')) {
            $data = $importer->getData($path);
        } else {
            $data = array_map('str_getcsv', file($path));
        }
        if (count($data) > 0) {
            if ($request->has('header')) {
                $csv_header_fields = [];
                foreach ($data[0] as $key => $value) {
                    $csv_header_fields[] = $key;
                }
            }
            $csv_data      = array_slice($data, 0, 2);
            $csv_data_file = \App\Entities\CsvData::create(
                [
                    'csv_filename' => $request->file('csvfile')->getClientOriginalName(),
                    'csv_header'   => $request->has('header'),
                    'csv_data'     => json_encode($data),
                ]
            );
        } else {
            return redirect()->back();
        }

        return view('invoices::import_fields', compact('csv_header_fields', 'csv_data', 'csv_data_file'))->with($dt);
    }

    public function processImport()
    {
        $validator = \Validator::make(
            array_flip($this->request->fields),
            [
                'reference_no' => 'required',
                'client_id'    => 'required',
                'due_date'     => 'required',
                'name'         => 'required',
                'unit_cost'    => 'required',
                'quantity'     => 'required',
            ]
        )->validate();
        (new \Modules\Invoices\Helpers\InvoiceCsvProcessor)->import($this->request);

        $data['message']  = langapp('data_imported');
        $data['redirect'] = route('invoices.index');

        return ajaxResponse($data);
    }
    /**
     * Show invoice transactions
     */
    public function transactions(Invoice $invoice)
    {
        $data['page']    = $this->getPage();
        $data['invoice'] = $invoice;

        return view('invoices::payments')->with($data);
    }
    /**
     * Show invoice remind modal
     */
    public function remind(Invoice $invoice)
    {
        $data['invoice'] = $invoice;

        return view('invoices::modal.reminder')->with($data);
    }
    /**
     * Mark invoice as paid modal
     */
    public function markPaid(Invoice $invoice)
    {
        $data['invoice'] = $invoice;

        return view('invoices::modal.mark_as_paid')->with($data);
    }
    /**
     * Cancel invoice modal
     */
    public function cancel(Invoice $invoice)
    {
        if (!$invoice->hasPayment()) {
            $data['invoice'] = $invoice;

            return view('invoices::modal.cancel')->with($data);
        }
    }
    /**
     * Show invoice activities
     */
    public function activity(Invoice $invoice)
    {
        $data['activities'] = $invoice->activities;

        return view('partial.activity')->with($data);
    }
    /**
     * Show invoices that have recurred from the invoice
     */
    public function children(Invoice $invoice)
    {
        $data['invoice'] = $invoice;

        return view('invoices::modal.children')->with($data);
    }
    /**
     * Show invoice comments
     */
    public function comments(Invoice $invoice)
    {
        $data['invoice'] = $invoice;

        return view('invoices::modal.comments')->with($data);
    }
    /**
     * Confirm deleting invoice
     */
    public function delete(Invoice $invoice)
    {
        $data['invoice'] = $invoice;

        return view('invoices::modal.delete')->with($data);
    }
    /**
     * Stop recurring invoice modal
     */
    public function stopRecurring(Invoice $invoice)
    {
        $data['invoice'] = $invoice;

        return view('invoices::modal.stop_recur')->with($data);
    }
    /**
     * End invoice recurring
     */
    public function endRecurring()
    {
        $invoice = $this->invoice->findOrFail($this->request->id);
        $invoice->stopRecurring();
        $data['message']  = langapp('changes_saved_successful');
        $data['redirect'] = route('invoices.view', ['id' => $this->request->id]);

        return ajaxResponse($data);
    }
    /**
     * Delete multiple invoices
     */
    public function bulkDelete()
    {
        if ($this->request->has('checked')) {
            BulkDeleteInvoices::dispatch($this->request->checked, \Auth::id())->onQueue('normal');
            $data['message']  = langapp('deleted_successfully');
            $data['redirect'] = url()->previous();
            return ajaxResponse($data);
        }
        return response()->json(['message' => 'No invoices selected', 'errors' => ['missing' => ["Please select atleast 1 invoice"]]], 500);
    }
    /**
     * Send multiple invoices to clients
     */
    public function bulkSend()
    {
        if ($this->request->has('checked')) {
            BulkSendInvoices::dispatch($this->request->checked, \Auth::id())->onQueue('high');
            $data['message']  = langapp('sent_successfully');
            $data['redirect'] = url()->previous();
            return ajaxResponse($data);
        }
        return response()->json(['message' => 'No invoices selected', 'errors' => ['missing' => ["Please select atleast 1 invoice"]]], 500);
    }
    /**
     * Pay multiple invoices
     */
    public function bulkPay()
    {
        if ($this->request->has('checked')) {
            BulkPayInvoices::dispatch($this->request->checked)->onQueue('high');
            $data['message']  = langapp('payments_received');
            $data['redirect'] = url()->previous();
            return ajaxResponse($data);
        }
        return response()->json(['message' => 'No invoices selected', 'errors' => ['missing' => ["Please select atleast 1 invoice"]]], 500);
    }

    /**
     * Get invoices to display on the table
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tableData()
    {
        $model = $this->applyFilter()->with(['company:id,name,currency', 'payments:id']);
        return DataTables::eloquent($model)
            ->editColumn(
                'reference_no',
                function ($invoice) {
                    $str = $invoice->statusIcon();
                    $str .= '<a href="' . route('invoices.view', $invoice->id) . '"> ' . $invoice->reference_no . '</a>';
                    $str .= $invoice->is_recurring ? ' <i class="fas fa-sync fa-spin text-danger"></i>' : '';
                    return $str;
                }
            )
            ->editColumn(
                'chk',
                function ($invoice) {
                    return '<label><input type="checkbox" name="checked[]" value="' . $invoice->id . '"><span class="label-text"></span></label>';
                }
            )
            ->editColumn(
                'client_id',
                function ($invoice) {
                    return optional($invoice->company)->id > 0 ? '<a href="' . route('clients.view', $invoice->client_id) . '">' . str_limit($invoice->company->name, 15) . '</a>' : 'N/A';
                }
            )
            ->editColumn(
                'status',
                function ($invoice) {
                    return '<label class="label label-info label-rounded">' . $invoice->status . '</label>';
                }
            )
            ->editColumn(
                'due_date',
                function ($invoice) {
                    return dateString($invoice->due_date);
                }
            )
            ->editColumn(
                'payable',
                function ($invoice) {
                    return formatCurrency($invoice->currency, $invoice->payable);
                }
            )
            ->editColumn(
                'balance',
                function ($invoice) {
                    return formatCurrency($invoice->currency, $invoice->balance);
                }
            )
            ->rawColumns(['reference_no', 'chk', 'client_id', 'status'])
            ->make(true);
    }

    public function applyFilter()
    {
        $filter = $this->request->filter;
        if ($filter === 'paid') {
            return $this->invoice->apply(['status' => 'fully_paid'])->whereNull('archived_at');
        }
        if ($filter === 'unpaid') {
            return $this->invoice->apply(['status' => 'not_paid'])->whereNull('archived_at');
        }
        if ($filter === 'partial') {
            return $this->invoice->apply(['status' => 'partially_paid'])->whereNull('archived_at');
        }
        if ($filter === 'archived') {
            return $this->invoice->apply(['archived' => 1]);
        }
        if ($filter === 'draft') {
            return $this->invoice->apply(['visible' => 0])->whereNull('archived_at');
        }
        if ($filter === 'unsent') {
            return $this->invoice->apply(['sent' => 0])->whereNull('archived_at');
        }
        if ($filter === 'sent') {
            return $this->invoice->apply(['sent' => 1])->whereNull('archived_at');
        }
        if ($filter === 'viewed') {
            return $this->invoice->apply(['viewed' => 1])->whereNull('archived_at');
        }
        if ($filter === 'overdue') {
            return $this->invoice->apply(['overdue' => 1])->whereNull('archived_at');
        }
        if ($filter === 'recurring') {
            return $this->invoice->apply(['recurring' => 1])->whereNull('archived_at');
        }
        return $this->invoice->query()->whereNull('archived_at');
    }

    private function getPage()
    {
        return langapp('invoices');
    }
}
