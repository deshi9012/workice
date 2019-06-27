<?php

namespace App\Widgets\Invoices;

use Arrilot\Widgets\AbstractWidget;

class InvoicingChart extends AbstractWidget
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
        $year = chartYear();
        $metrics = new \App\Helpers\Report;

        $invoiced = [
            'jan' => $metrics->invoicedByMonth(1, $year),
            'feb' => $metrics->invoicedByMonth(2, $year),
            'mar' => $metrics->invoicedByMonth(3, $year),
            'apr' => $metrics->invoicedByMonth(4, $year),
            'may' => $metrics->invoicedByMonth(5, $year),
            'jun' => $metrics->invoicedByMonth(6, $year),
            'jul' => $metrics->invoicedByMonth(7, $year),
            'aug' => $metrics->invoicedByMonth(8, $year),
            'sep' => $metrics->invoicedByMonth(9, $year),
            'oct' => $metrics->invoicedByMonth(10, $year),
            'nov' => $metrics->invoicedByMonth(11, $year),
            'dec' => $metrics->invoicedByMonth(12, $year),
        ];

        $receipts = [
            'jan' => $metrics->paymentsByMonth(1, $year),
            'feb' => $metrics->paymentsByMonth(2, $year),
            'mar' => $metrics->paymentsByMonth(3, $year),
            'apr' => $metrics->paymentsByMonth(4, $year),
            'may' => $metrics->paymentsByMonth(5, $year),
            'jun' => $metrics->paymentsByMonth(6, $year),
            'jul' => $metrics->paymentsByMonth(7, $year),
            'aug' => $metrics->paymentsByMonth(8, $year),
            'sep' => $metrics->paymentsByMonth(9, $year),
            'oct' => $metrics->paymentsByMonth(10, $year),
            'nov' => $metrics->paymentsByMonth(11, $year),
            'dec' => $metrics->paymentsByMonth(12, $year),
        ];
        
        return view(
            'widgets.invoices.invoicing_chart',
        
            [
            'config' => $this->config,
            'year' => $year,
            'invoiced' => $invoiced,
            'receipts' => $receipts
            ]
        );
    }
}
