<?php

namespace App\Widgets\Invoices;

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
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    
    /**
     * The number of seconds before each reload.
     *
     * @var int|float
     */
    public $reloadTimeout = 30;

    public function run()
    {
        return view(
            'widgets.invoices.totals_widget',
            [
            'config' => $this->config,
            ]
        );
    }
    public function placeholder()
    {
        return 'Loading...';
    }
}
