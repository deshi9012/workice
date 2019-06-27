<?php

namespace Modules\Payments\Http\Controllers\Base;

use App\Entities\AcceptPayment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Invoices\Entities\Invoice;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;

abstract class StripeController extends Controller
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
     * @var Invoice
     */
    protected $invoice;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->invoice = new Invoice;
    }
    /**
     * Process Stripe Payment
     */
    public function checkout()
    {
        try {
            $invoice = $this->invoice->find($this->request->invoice);
            Stripe::setApiKey(config('services.stripe.secret'));
            $customer = Customer::create(
                array(
                'email' => $this->request->stripeEmail,
                'source'  => $this->request->stripeToken
                )
            );
            $charge = Charge::create(
                array(
                'customer' => $customer->id,
                'amount'   => $this->request->amount * 100,
                'currency' => $invoice->currency,
                'metadata' => [
                'invoice_id' => $invoice->id,
                'payer' => \Auth::user()->name,
                'payer_email' => $invoice->company->email,
                'code' => $invoice->reference_no,
                ]
                )
            );

            if ($charge->paid == true) {
                $payment = (new \Modules\Payments\Helpers\PaymentEngine('stripe', $charge))->transact();
            }
            toastr()->success('Payment processed successfully', langapp('response_status'));
            return redirect()->route('invoices.view', $invoice->id);
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            toastr()->error('Payment failed please contact admin', langapp('response_status'));
            return redirect()->route('invoices.view', $this->request->invoice);
        }
    }
}
