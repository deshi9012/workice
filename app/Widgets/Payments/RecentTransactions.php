<?php

namespace App\Widgets\Payments;

use Arrilot\Widgets\AbstractWidget;

class RecentTransactions extends AbstractWidget
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
        //

        return view(
            'widgets.payments.recent_transactions', [
            'config' => $this->config,
            ]
        );
    }
}
