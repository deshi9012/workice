<?php

namespace App\Widgets\Leads;

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

        $stats = [
            'jan' => $metrics->leadsByMonth(1, $year),
            'feb' => $metrics->leadsByMonth(2, $year),
            'mar' => $metrics->leadsByMonth(3, $year),
            'apr' => $metrics->leadsByMonth(4, $year),
            'may' => $metrics->leadsByMonth(5, $year),
            'jun' => $metrics->leadsByMonth(6, $year),
            'jul' => $metrics->leadsByMonth(7, $year),
            'aug' => $metrics->leadsByMonth(8, $year),
            'sep' => $metrics->leadsByMonth(9, $year),
            'oct' => $metrics->leadsByMonth(10, $year),
            'nov' => $metrics->leadsByMonth(11, $year),
            'dec' => $metrics->leadsByMonth(12, $year),
        ];

        return view(
            'widgets.leads.yearly_overview', [
            'config' => $this->config,
            'year' => $year,
            'stats' => $stats,
            ]
        );
    }
}
