<?php

namespace App\Widgets\Projects;

use Arrilot\Widgets\AbstractWidget;
use Facades\App\Helpers\Report;

class StatusChart extends AbstractWidget
{

    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

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
        return view(
            'widgets.projects.status_chart', [
            'config' => $this->config,
            ]
        );
    }
    public function placeholder()
    {
        return 'Loading...';
    }
}
