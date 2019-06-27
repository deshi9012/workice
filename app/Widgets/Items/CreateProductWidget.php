<?php

namespace App\Widgets\Items;

use Arrilot\Widgets\AbstractWidget;

class CreateProductWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'module_id' => '',
        'module'    => '',
        'order'     => '',
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $data['module_id'] = $this->config['module_id'];
        $data['module'] = $this->config['module'];
        $data['order'] = $this->config['order'];
        $data['scope'] = 'deals';

        return view(
            'widgets.items.create_product_widget', [
            'config' => $this->config,
            ]
        )->with($data);
    }
}
