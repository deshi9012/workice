<?php

namespace App\Widgets\Payments;

use Arrilot\Widgets\AbstractWidget;

class TotalsWidget2 extends AbstractWidget
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

        return view('widgets.payments.totals_widget2', [
            'config' => $this->config,
        ]);
    }
}
