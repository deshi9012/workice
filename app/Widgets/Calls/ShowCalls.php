<?php

namespace App\Widgets\Calls;

use Arrilot\Widgets\AbstractWidget;

class ShowCalls extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'calls' => [],
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $data['calls'] = $this->config['calls'];

        return view(
            'widgets.calls.show_calls', [
            'config' => $this->config,
            ]
        )->with($data);
    }
}
