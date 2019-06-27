<?php

namespace App\Widgets\Todos;

use Arrilot\Widgets\AbstractWidget;

class ShowTodos extends AbstractWidget
{

    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'todos' => [],
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $data['todos'] = $this->config['todos'];

        return view(
            'widgets.todos.show_todos', [
            'config' => $this->config,
            ]
        )->with($data);
    }
}
