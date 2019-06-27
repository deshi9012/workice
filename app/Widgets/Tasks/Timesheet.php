<?php

namespace App\Widgets\Tasks;

use Arrilot\Widgets\AbstractWidget;

class Timesheet extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'entries' => []
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $data['entries'] = $this->config['entries'];

        return view(
            'widgets.tasks.timesheet', [
            'config' => $this->config,
            ]
        )->with($data);
    }
}
