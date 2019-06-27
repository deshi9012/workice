<?php

namespace App\Widgets\Deals;

use Arrilot\Widgets\AbstractWidget;

class NewDeals extends AbstractWidget
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
        $data['deals'] = \Modules\Deals\Entities\Deal::where('status', 'open')->with(['category', 'pipe'])->orderBy('id', 'desc')->get();

        return view(
            'widgets.deals.new_deals', [
            'config' => $this->config,
            ]
        )->with($data);
    }
}
