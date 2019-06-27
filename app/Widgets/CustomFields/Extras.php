<?php

namespace App\Widgets\CustomFields;

use Arrilot\Widgets\AbstractWidget;

class Extras extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'custom' => [],
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $data['custom'] = $this->config['custom'];

        return view(
            'widgets.custom_fields.extras', [
            'config' => $this->config,
            ]
        )->with($data);
    }
}
