<?php

namespace App\Widgets\Payments;

use Arrilot\Widgets\AbstractWidget;
use Modules\Payments\Entities\Payment;

class RecentPayments extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $data['payments'] = Payment::where('is_refunded', '0')->with(['AsInvoice', 'company', 'paymentMethod'])
            ->latest()->get()->take(30);

        return view(
            'widgets.payments.recent_payments', [
            'config' => $this->config,
            ]
        )->with($data);
    }
}
