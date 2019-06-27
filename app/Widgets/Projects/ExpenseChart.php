<?php

namespace App\Widgets\Projects;

use Arrilot\Widgets\AbstractWidget;

class ExpenseChart extends AbstractWidget
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
            'widgets.projects.expense_chart', [
            'config' => $this->config,
            ]
        )->with($data);
    }
}
