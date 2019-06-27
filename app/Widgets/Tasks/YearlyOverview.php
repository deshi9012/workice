<?php

namespace App\Widgets\Tasks;

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

        $done = [
            'jan' => $metrics->doneTasksByMonth(1, $year),
            'feb' => $metrics->doneTasksByMonth(2, $year),
            'mar' => $metrics->doneTasksByMonth(3, $year),
            'apr' => $metrics->doneTasksByMonth(4, $year),
            'may' => $metrics->doneTasksByMonth(5, $year),
            'jun' => $metrics->doneTasksByMonth(6, $year),
            'jul' => $metrics->doneTasksByMonth(7, $year),
            'aug' => $metrics->doneTasksByMonth(8, $year),
            'sep' => $metrics->doneTasksByMonth(9, $year),
            'oct' => $metrics->doneTasksByMonth(10, $year),
            'nov' => $metrics->doneTasksByMonth(11, $year),
            'dec' => $metrics->doneTasksByMonth(12, $year),
        ];

        $all = [
            'jan' => $metrics->tasksByMonth(1, $year),
            'feb' => $metrics->tasksByMonth(2, $year),
            'mar' => $metrics->tasksByMonth(3, $year),
            'apr' => $metrics->tasksByMonth(4, $year),
            'may' => $metrics->tasksByMonth(5, $year),
            'jun' => $metrics->tasksByMonth(6, $year),
            'jul' => $metrics->tasksByMonth(7, $year),
            'aug' => $metrics->tasksByMonth(8, $year),
            'sep' => $metrics->tasksByMonth(9, $year),
            'oct' => $metrics->tasksByMonth(10, $year),
            'nov' => $metrics->tasksByMonth(11, $year),
            'dec' => $metrics->tasksByMonth(12, $year),
        ];

        return view(
            'widgets.tasks.yearly_overview', [
            'config' => $this->config,
            'year' => $year,
            'all' => $all,
            'done' => $done
            ]
        );
    }
}
