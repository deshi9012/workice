<?php

namespace App\Widgets\Estimates;

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

        $accepted = [
            'jan' => $metrics->estimatesByMonth(1, $year),
            'feb' => $metrics->estimatesByMonth(2, $year),
            'mar' => $metrics->estimatesByMonth(3, $year),
            'apr' => $metrics->estimatesByMonth(4, $year),
            'may' => $metrics->estimatesByMonth(5, $year),
            'jun' => $metrics->estimatesByMonth(6, $year),
            'jul' => $metrics->estimatesByMonth(7, $year),
            'aug' => $metrics->estimatesByMonth(8, $year),
            'sep' => $metrics->estimatesByMonth(9, $year),
            'oct' => $metrics->estimatesByMonth(10, $year),
            'nov' => $metrics->estimatesByMonth(11, $year),
            'dec' => $metrics->estimatesByMonth(12, $year),
        ];

        $declined = [
            'jan' => $metrics->estimatesByMonth(1, $year, 'rejected'),
            'feb' => $metrics->estimatesByMonth(2, $year, 'rejected'),
            'mar' => $metrics->estimatesByMonth(3, $year, 'rejected'),
            'apr' => $metrics->estimatesByMonth(4, $year, 'rejected'),
            'may' => $metrics->estimatesByMonth(5, $year, 'rejected'),
            'jun' => $metrics->estimatesByMonth(6, $year, 'rejected'),
            'jul' => $metrics->estimatesByMonth(7, $year, 'rejected'),
            'aug' => $metrics->estimatesByMonth(8, $year, 'rejected'),
            'sep' => $metrics->estimatesByMonth(9, $year, 'rejected'),
            'oct' => $metrics->estimatesByMonth(10, $year, 'rejected'),
            'nov' => $metrics->estimatesByMonth(11, $year, 'rejected'),
            'dec' => $metrics->estimatesByMonth(12, $year, 'rejected'),
        ];

        return view(
            'widgets.estimates.yearly_overview', [
            'config' => $this->config,
            'year' => $year,
            'accepted' => $accepted,
            'declined' => $declined,
            ]
        );
    }
}
