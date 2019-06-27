<?php

namespace App\Widgets\Tickets;

use Arrilot\Widgets\AbstractWidget;

class YearlyChartWidget extends AbstractWidget
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

        $closed = [
            'jan' => $metrics->ticketsByMonth(1, $year, 'closed'),
            'feb' => $metrics->ticketsByMonth(2, $year, 'closed'),
            'mar' => $metrics->ticketsByMonth(3, $year, 'closed'),
            'apr' => $metrics->ticketsByMonth(4, $year, 'closed'),
            'may' => $metrics->ticketsByMonth(5, $year, 'closed'),
            'jun' => $metrics->ticketsByMonth(6, $year, 'closed'),
            'jul' => $metrics->ticketsByMonth(7, $year, 'closed'),
            'aug' => $metrics->ticketsByMonth(8, $year, 'closed'),
            'sep' => $metrics->ticketsByMonth(9, $year, 'closed'),
            'oct' => $metrics->ticketsByMonth(10, $year, 'closed'),
            'nov' => $metrics->ticketsByMonth(11, $year, 'closed'),
            'dec' => $metrics->ticketsByMonth(12, $year, 'closed'),
        ];
        $open = [
            'jan' => $metrics->ticketsByMonth(1, $year, 'open'),
            'feb' => $metrics->ticketsByMonth(2, $year, 'open'),
            'mar' => $metrics->ticketsByMonth(3, $year, 'open'),
            'apr' => $metrics->ticketsByMonth(4, $year, 'open'),
            'may' => $metrics->ticketsByMonth(5, $year, 'open'),
            'jun' => $metrics->ticketsByMonth(6, $year, 'open'),
            'jul' => $metrics->ticketsByMonth(7, $year, 'open'),
            'aug' => $metrics->ticketsByMonth(8, $year, 'open'),
            'sep' => $metrics->ticketsByMonth(9, $year, 'open'),
            'oct' => $metrics->ticketsByMonth(10, $year, 'open'),
            'nov' => $metrics->ticketsByMonth(11, $year, 'open'),
            'dec' => $metrics->ticketsByMonth(12, $year, 'open'),
        ];

        return view(
            'widgets.tickets.yearly_chart_widget', [
            'config' => $this->config,
            'year'   => $year,
            'open'   => $open,
            'closed' => $closed,
            ]
        );
    }
}
