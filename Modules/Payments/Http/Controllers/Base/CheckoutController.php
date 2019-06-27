<?php

namespace Modules\Payments\Http\Controllers\Base;

use App\Entities\AcceptPayment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Invoices\Entities\Invoice;
use Twocheckout;
use Twocheckout_Charge;
use Twocheckout_Error;

abstract class CheckoutController extends Controller
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
        $this->request = $request;
        $this->invoice = new Invoice;
    }

    public function checkout()
    {
        $invoice = $this->invoice->find($this->request->id);
        Twocheckout::privateKey(config('services.2checkout.privateKey'));
        Twocheckout::sellerId(config('services.2checkout.sellerId'));
        Twocheckout::sandbox(settingEnabled('2checkout_live') ? false : true);
        // Twocheckout::verifySSL(false);

        try {
            $charge = Twocheckout_Charge::auth(
                array(
                        'merchantOrderId' => $invoice->id,
                        'token' => $this->request->token,
                        'currency' => $invoice->currency,
                        'total' => $this->request->amount,
                        'billingAddr' => array(
                            'name' => $invoice->company->name,
                            'addrLine1' => $invoice->company->address1,
                            'city' => $invoice->company->city,
                            'state' => $invoice->company->state,
                            'zipCode' => $invoice->company->zip_code,
                            'country' => $invoice->company->country,
                            'email' => $invoice->company->email,
                            'phoneNumber' => $invoice->company->phone,
                        ),
                )
            );
            if ($charge['response']['responseCode'] == 'APPROVED') {
                $payment = (new \Modules\Payments\Helpers\PaymentEngine('checkout', $charge))->transact();
                toastr()->success('Payment processed successfully', langapp('response_status'));
                return redirect()->route('invoices.view', $invoice->id);
            }
        } catch (Twocheckout_Error $e) {
            \Log::error($e->getMessage());
            toastr()->error('Payment failed please contact admin', langapp('response_status'));
            return redirect()->route('invoices.index', $invoice->id);
        }
    }
}
