<?php

namespace App\Widgets\Projects;

use Arrilot\Widgets\AbstractWidget;
use Modules\Projects\Entities\Project;

class TimerChart extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'project' => ''
    ];
    /**
     * The number of seconds before each reload.
     *
     * @var int|float
     */
    public $reloadTimeout = 20;

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $data['project'] = Project::findOrFail($this->config['project']);

        return view(
            'widgets.projects.timer_chart', [
            'config' => $this->config,
            ]
        )->with($data);
    }

    public function placeholder()
    {
        return 'Loading...';
    }
}
