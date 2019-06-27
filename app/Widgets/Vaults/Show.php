<?php

namespace App\Widgets\Vaults;

use Arrilot\Widgets\AbstractWidget;

class Show extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'vaults' => []
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $data['vaults'] = $this->config['vaults'];

        return view(
            'widgets.vaults.show', [
            'config' => $this->config,
            ]
        )->with($data);
    }
}
