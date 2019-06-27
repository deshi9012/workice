<?php

namespace App\Widgets\Todos;

use Arrilot\Widgets\AbstractWidget;

class ThisWeek extends AbstractWidget
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
        //

        return view(
            'widgets.todos.this_week', [
            'config' => $this->config,
            ]
        );
    }
}
