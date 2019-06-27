<?php

namespace App\Widgets\Creditnotes;

use Arrilot\Widgets\AbstractWidget;

class YearlyOverview extends AbstractWidget
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

        $open = [
            'jan' => $metrics->creditsByMonth(1, $year),
            'feb' => $metrics->creditsByMonth(2, $year),
            'mar' => $metrics->creditsByMonth(3, $year),
            'apr' => $metrics->creditsByMonth(4, $year),
            'may' => $metrics->creditsByMonth(5, $year),
            'jun' => $metrics->creditsByMonth(6, $year),
            'jul' => $metrics->creditsByMonth(7, $year),
            'aug' => $metrics->creditsByMonth(8, $year),
            'sep' => $metrics->creditsByMonth(9, $year),
            'oct' => $metrics->creditsByMonth(10, $year),
            'nov' => $metrics->creditsByMonth(11, $year),
            'dec' => $metrics->creditsByMonth(12, $year),
        ];

        $closed = [
            'jan' => $metrics->creditsByMonth(1, $year, 'closed'),
            'feb' => $metrics->creditsByMonth(2, $year, 'closed'),
            'mar' => $metrics->creditsByMonth(3, $year, 'closed'),
            'apr' => $metrics->creditsByMonth(4, $year, 'closed'),
            'may' => $metrics->creditsByMonth(5, $year, 'closed'),
            'jun' => $metrics->creditsByMonth(6, $year, 'closed'),
            'jul' => $metrics->creditsByMonth(7, $year, 'closed'),
            'aug' => $metrics->creditsByMonth(8, $year, 'closed'),
            'sep' => $metrics->creditsByMonth(9, $year, 'closed'),
            'oct' => $metrics->creditsByMonth(10, $year, 'closed'),
            'nov' => $metrics->creditsByMonth(11, $year, 'closed'),
            'dec' => $metrics->creditsByMonth(12, $year, 'closed'),
        ];

        return view(
            'widgets.creditnotes.yearly_overview', [
            'config' => $this->config,
            'year' => $year,
            'open' => $open,
            'closed' => $closed,
            ]
        );
    }
}
