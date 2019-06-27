<?php

namespace App\Widgets\Todos;

use Arrilot\Widgets\AbstractWidget;

class Today extends AbstractWidget
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
        return view(
            'widgets.todos.today', [
            'config' => $this->config,
            ]
        );
    }
}
