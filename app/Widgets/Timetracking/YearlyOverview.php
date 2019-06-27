<?php

namespace App\Widgets\Timetracking;

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

        $worked = [
            'jan' => toHours($metrics->workedByMonth(1, $year)),
            'feb' => toHours($metrics->workedByMonth(2, $year)),
            'mar' => toHours($metrics->workedByMonth(3, $year)),
            'apr' => toHours($metrics->workedByMonth(4, $year)),
            'may' => toHours($metrics->workedByMonth(5, $year)),
            'jun' => toHours($metrics->workedByMonth(6, $year)),
            'jul' => toHours($metrics->workedByMonth(7, $year)),
            'aug' => toHours($metrics->workedByMonth(8, $year)),
            'sep' => toHours($metrics->workedByMonth(9, $year)),
            'oct' => toHours($metrics->workedByMonth(10, $year)),
            'nov' => toHours($metrics->workedByMonth(11, $year)),
            'dec' => toHours($metrics->workedByMonth(12, $year)),
        ];

        $billed = [
            'jan' => toHours($metrics->workedByMonth(1, $year, 'billed')),
            'feb' => toHours($metrics->workedByMonth(2, $year, 'billed')),
            'mar' => toHours($metrics->workedByMonth(3, $year, 'billed')),
            'apr' => toHours($metrics->workedByMonth(4, $year, 'billed')),
            'may' => toHours($metrics->workedByMonth(5, $year, 'billed')),
            'jun' => toHours($metrics->workedByMonth(6, $year, 'billed')),
            'jul' => toHours($metrics->workedByMonth(7, $year, 'billed')),
            'aug' => toHours($metrics->workedByMonth(8, $year, 'billed')),
            'sep' => toHours($metrics->workedByMonth(9, $year, 'billed')),
            'oct' => toHours($metrics->workedByMonth(10, $year, 'billed')),
            'nov' => toHours($metrics->workedByMonth(11, $year, 'billed')),
            'dec' => toHours($metrics->workedByMonth(12, $year, 'billed')),
        ];

        return view(
            'widgets.timetracking.yearly_overview', [
            'config' => $this->config,
            'year' => $year,
            'billed' => $billed,
            'worked' => $worked
            ]
        );
    }
}
