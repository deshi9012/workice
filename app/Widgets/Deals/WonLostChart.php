<?php

namespace App\Widgets\Deals;

use Arrilot\Widgets\AbstractWidget;

class WonLostChart extends AbstractWidget
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

        $won = [
            'jan' => $metrics->dealsByMonth(1, $year, 'won'),
            'feb' => $metrics->dealsByMonth(2, $year, 'won'),
            'mar' => $metrics->dealsByMonth(3, $year, 'won'),
            'apr' => $metrics->dealsByMonth(4, $year, 'won'),
            'may' => $metrics->dealsByMonth(5, $year, 'won'),
            'jun' => $metrics->dealsByMonth(6, $year, 'won'),
            'jul' => $metrics->dealsByMonth(7, $year, 'won'),
            'aug' => $metrics->dealsByMonth(8, $year, 'won'),
            'sep' => $metrics->dealsByMonth(9, $year, 'won'),
            'oct' => $metrics->dealsByMonth(10, $year, 'won'),
            'nov' => $metrics->dealsByMonth(11, $year, 'won'),
            'dec' => $metrics->dealsByMonth(12, $year, 'won'),
        ];

        $lost = [
            'jan' => $metrics->dealsByMonth(1, $year, 'lost'),
            'feb' => $metrics->dealsByMonth(2, $year, 'lost'),
            'mar' => $metrics->dealsByMonth(3, $year, 'lost'),
            'apr' => $metrics->dealsByMonth(4, $year, 'lost'),
            'may' => $metrics->dealsByMonth(5, $year, 'lost'),
            'jun' => $metrics->dealsByMonth(6, $year, 'lost'),
            'jul' => $metrics->dealsByMonth(7, $year, 'lost'),
            'aug' => $metrics->dealsByMonth(8, $year, 'lost'),
            'sep' => $metrics->dealsByMonth(9, $year, 'lost'),
            'oct' => $metrics->dealsByMonth(10, $year, 'lost'),
            'nov' => $metrics->dealsByMonth(11, $year, 'lost'),
            'dec' => $metrics->dealsByMonth(12, $year, 'lost'),
        ];

        return view(
            'widgets.deals.won_lost_chart',
            [
            'config' => $this->config,
            'year' => $year,
            'won' => $won,
            'lost' => $lost
            ]
        );
    }
}
