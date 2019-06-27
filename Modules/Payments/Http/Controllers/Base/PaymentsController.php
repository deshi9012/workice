<?php

namespace Modules\Payments\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use Modules\Payments\Entities\Payment;
use Modules\Payments\Jobs\BulkDeletePayments;

abstract class PaymentsController extends Controller
{
    /**
     * Payment Model
     *
     * @var \Modules\Payments\Entities\Payment
     */
    protected $payment;
    /**
     * Request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->middleware(['auth', 'verified', '2fa']);
        $this->request = $request;
        $this->payment = new Payment;
    }

    /**
     * Show payment list
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['page']   = $this->getPage();
        $data['filter'] = $this->request->filter;

        return view('payments::index')->with($data);
    }
    /**
     * Show Payment Overview
     */
    public function view(Payment $payment)
    {
        $data['page']    = $this->getPage();
        $data['payment'] = $payment;

        return view('payments::view')->with($data);
    }
    /**
     * Show payment editing form
     */
    public function edit(Payment $payment)
    {
        $data['form']    = true;
        $data['payment'] = $payment;

        return view('payments::modal.update')->with($data);
    }
    /**
     * Confirm payment refund
     */
    public function refund(Payment $payment)
    {
        $data['form']    = true;
        $data['payment'] = $payment;

        return view('payments::modal.refund')->with($data);
    }

    /**
     * Export Payments as CSV
     */
    public function export()
    {
        if (isAdmin()) {
            return (new \Modules\Payments\Exports\PaymentsExport)->download('payments_' . now()->toIso8601String() . '.csv');
        }
        abort(404);
    }
    /**
     * Download payment receipt
     */
    public function pdf(Payment $payment)
    {
        if (isset($payment->id)) {
            return $payment->pdf();
        }
        abort(404);
    }
    /**
     * Delete Multiple Payments
     */
    public function bulkDelete()
    {
        if ($this->request->has('checked')) {
            BulkDeletePayments::dispatch($this->request->checked, \Auth::id())->onQueue('normal');
            $data['message']  = langapp('deleted_successfully');
            $data['redirect'] = url()->previous();
            return ajaxResponse($data);
        }
        return response()->json(['message' => 'No payments selected', 'errors' => ['missing' => ["Please select atleast 1 transaction"]]], 500);
    }
    /**
     * Confirm Delete Payment
     */
    public function delete(Payment $payment)
    {
        $data['payment'] = $payment;

        return view('payments::modal.delete')->with($data);
    }

    /**
     * Get payments to display in table
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tableData()
    {
        $model = $this->applyFilter()->with(['company:id,name,currency', 'AsInvoice:id,created_at', 'paymentMethod:method_id,method_name']);

        return DataTables::eloquent($model)
            ->editColumn(
                'code',
                function ($payment) {
                    $str = $payment->statusIcon();
                    $str .= '<a href="' . route('payments.view', $payment->id) . '">' . $payment->code . '</a>';
                    return $str;
                }
            )
            ->editColumn(
                'chk',
                function ($payment) {
                    return '<label><input type="checkbox" name="checked[]" value="' . $payment->id . '"><span class="label-text"></span></label>';
                }
            )
            ->editColumn(
                'client_id',
                function ($payment) {
                    return optional($payment->company)->id > 0 ? '<a href="' . route('clients.view', $payment->client_id) . '">' . str_limit($payment->company->name, 25) . '</a>' : 'N/A';
                }
            )
            ->editColumn(
                'payment_date',
                function ($payment) {
                    return dateString($payment->payment_date);
                }
            )
            ->editColumn(
                'invoice_date',
                function ($payment) {
                    return optional($payment->AsInvoice)->id ? '<a href="' . route('invoices.view', $payment->invoice_id) . '">' . dateString($payment->AsInvoice->created_at) . '</a>' : 'N/A';
                }
            )
            ->editColumn(
                'amount',
                function ($payment) {
                    return $payment->amount_formatted;
                }
            )
            ->editColumn(
                'payment_method',
                function ($payment) {
                    return $payment->paymentMethod->method_name;
                }
            )
            ->rawColumns(['code', 'client_id', 'chk', 'invoice_date'])
            ->make(true);
    }

    protected function applyFilter()
    {
        if ($this->request->filter === 'today') {
            return $this->payment->apply(['date_range' => [today()->startOfDay(), today()->endOfDay(), 'payment_date']])->whereNull('archived_at');
        }
        if ($this->request->filter === 'yesterday') {
            return $this->payment->apply(['date_range' => [Date::parse('yesterday')->startOfDay(), Date::parse('yesterday')->endOfDay(), 'payment_date']])->whereNull('archived_at');
        }
        if ($this->request->filter === 'week') {
            return $this->payment->apply(['date_range' => [Date::parse('last monday')->startOfDay(), Date::parse('next friday')->endOfDay(), 'payment_date']])->whereNull('archived_at');
        }
        if ($this->request->filter === 'month') {
            return $this->payment->apply(['date_range' => [now()->startOfMonth(), now()->endOfMonth(), 'payment_date']])->whereNull('archived_at');
        }
        if ($this->request->filter === 'archived') {
            return $this->payment->apply(['archived' => 1]);
        }
        return $this->payment->query()->whereNull('archived_at');
    }

    private function getPage()
    {
        return langapp('payments');
    }
}
