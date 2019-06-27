<?php

namespace App\Widgets\Deals;

use Arrilot\Widgets\AbstractWidget;

class StagesChart extends AbstractWidget
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
        $pipeline = $this->getPipeline(request('pipeline'));
        $stages   = \App\Entities\Category::wherePipeline($pipeline)->get();
        return view(
            'widgets.deals.stages_chart', [
            'config' => $this->config,
            'stages' => $stages,
            ]
        );
    }

    private function getPipeline($req)
    {
        if (is_null($req)) {
            return \App\Entities\Category::whereModule('pipeline')->first()->id;
        }
        return $req;
    }
}
