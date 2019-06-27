<?php

namespace Modules\Invoices\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Invoices\Entities\Invoice;

class GuestController extends Controller
{
    /**
     * Invoice Model
     *
     * @var \Modules\Invoices\Entities\Invoice
     */
    protected $invoice;

    public function __construct()
    {
        $this->invoice = new Invoice;
    }
    /**
     * Show invoice to guest
     */
    public function guest($id)
    {
        $invoice = $this->invoice->findOrFail($id);
        if (optional($invoice)->id) {
            $data['page']    = langapp('invoices');
            $data['invoice'] = $invoice;

            return view('invoices::guest')->with($data);
        }
    }
    /**
     * Guest download invoice in PDF
     */
    public function pdf($id)
    {
        $invoice = $this->invoice->findOrFail($id);
        if (isset($invoice->id)) {
            return $invoice->pdf();
        }
    }
}
