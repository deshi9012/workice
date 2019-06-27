<?php

namespace App\Widgets\Expenses;

use Arrilot\Widgets\AbstractWidget;

class BillableChart extends AbstractWidget
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
        $year    = chartYear();
        $metrics = new \App\Helpers\Report;

        $billable = [
            'jan' => $metrics->expensesByMonth(1, $year, 'billable'),
            'feb' => $metrics->expensesByMonth(2, $year, 'billable'),
            'mar' => $metrics->expensesByMonth(3, $year, 'billable'),
            'apr' => $metrics->expensesByMonth(4, $year, 'billable'),
            'may' => $metrics->expensesByMonth(5, $year, 'billable'),
            'jun' => $metrics->expensesByMonth(6, $year, 'billable'),
            'jul' => $metrics->expensesByMonth(7, $year, 'billable'),
            'aug' => $metrics->expensesByMonth(8, $year, 'billable'),
            'sep' => $metrics->expensesByMonth(9, $year, 'billable'),
            'oct' => $metrics->expensesByMonth(10, $year, 'billable'),
            'nov' => $metrics->expensesByMonth(11, $year, 'billable'),
            'dec' => $metrics->expensesByMonth(12, $year, 'billable'),
        ];
        $billed = [
            'jan' => $metrics->expensesByMonth(1, $year, 'billed'),
            'feb' => $metrics->expensesByMonth(2, $year, 'billed'),
            'mar' => $metrics->expensesByMonth(3, $year, 'billed'),
            'apr' => $metrics->expensesByMonth(4, $year, 'billed'),
            'may' => $metrics->expensesByMonth(5, $year, 'billed'),
            'jun' => $metrics->expensesByMonth(6, $year, 'billed'),
            'jul' => $metrics->expensesByMonth(7, $year, 'billed'),
            'aug' => $metrics->expensesByMonth(8, $year, 'billed'),
            'sep' => $metrics->expensesByMonth(9, $year, 'billed'),
            'oct' => $metrics->expensesByMonth(10, $year, 'billed'),
            'nov' => $metrics->expensesByMonth(11, $year, 'billed'),
            'dec' => $metrics->expensesByMonth(12, $year, 'billed'),
        ];

        return view(
            'widgets.expenses.billable_chart', [
            'config'   => $this->config,
            'year'     => $year,
            'billable' => $billable,
            'billed'   => $billed,
            ]
        );
    }
}
