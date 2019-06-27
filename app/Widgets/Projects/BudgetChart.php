<?php

namespace App\Widgets\Projects;

use Arrilot\Widgets\AbstractWidget;

class BudgetChart extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'project' => []
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $data['project'] = $this->config['project'];

        return view(
            'widgets.projects.budget_chart', [
            'config' => $this->config,
            ]
        )->with($data);
    }
}
