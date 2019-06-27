<?php

namespace App\Widgets\Items;

use Arrilot\Widgets\AbstractWidget;

class ShowItems extends AbstractWidget
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
            'widgets.items.show_items', [
            'config' => $this->config,
            ]
        );
    }
}
