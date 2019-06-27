<?php

namespace App\Widgets\Activities;

use Arrilot\Widgets\AbstractWidget;

class Feed extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'activities' => [],
        'view' => 'feed'
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $data['activities'] = $this->config['activities'];

        return view(
            'widgets.activities.'.$this->config['view'], [
            'config' => $this->config,
            ]
        )->with($data);
    }
}
