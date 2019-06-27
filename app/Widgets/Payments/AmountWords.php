<?php

namespace App\Widgets\Payments;

use Arrilot\Widgets\AbstractWidget;

class AmountWords extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'currency' => 'USD',
        'amount' => ''
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $data['amount'] = $this->config['amount'];
        $data['currency'] = $this->config['currency'];

        return view(
            'widgets.payments.amount_words', [
            'config' => $this->config,
            ]
        )->with($data);
    }
}
