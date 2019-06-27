<?php

namespace App\Widgets\Deals;

use Arrilot\Widgets\AbstractWidget;

class TotalsWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * The number of seconds before each reload.
     *
     * @var int|float
     */
    public $reloadTimeout = 20;

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

        return view(
            'widgets.deals.totals_widget', [
            'config' => $this->config,
            ]
        );
    }

    public function placeholder()
    {
        return 'Loading...';
    }
}
