<?php

namespace App\Widgets\Users;

use Arrilot\Widgets\AbstractWidget;

class BusyChart extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'user' => ''
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $year = date('Y');
        $user = $this->config['user'];

        $metrics = new \App\Helpers\Report;

        $calendar = [];

        $calendar = \Cache::remember(
            'user-'.$user.'-busy-chart', 1440, function () use ($year, $metrics, $calendar, $user) {
                for ($m = 1; $m <= 12; $m++) {
                    foreach (datesMonth($m, $year) as $day) {
                        $calendar[] = [$day => $metrics->workedByDay($day, $user) ];
                    }
                }
                return array_collapse($calendar);
            }
        );


        return view(
            'widgets.users.busy_chart', [
            'config' => $this->config,
            'calendar' => $calendar,
            'year' => $year,
            ]
        );
    }
}
