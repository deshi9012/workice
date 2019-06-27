<?php

namespace App\Widgets\Tickets;

use Arrilot\Widgets\AbstractWidget;
use Cache;

class BusyChart extends AbstractWidget
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
        $year = date('Y');

        $metrics = new \App\Helpers\Report;

        $calendar = [];

        $calendar = Cache::remember(
            'busy-chart', 1440, function () use ($year, $metrics, $calendar) {
                for ($m = 1; $m <= 12; $m++) {
                    foreach (datesMonth($m, $year) as $day) {
                        $calendar[] = [$day => $metrics->numTicketsByDay($day) ];
                    }
                }
                return array_collapse($calendar);
            }
        );

        return view(
            'widgets.tickets.busy_chart', [
            'config' => $this->config,
            'calendar' => $calendar,
            'year' => $year,
            ]
        );
    }
}
