<?php

namespace Modules\Projects\Rates;

use Modules\Projects\Contracts\ProjectRateInterface;

class FixedRateType implements ProjectRateInterface
{
    public function calculateCost($model)
    {
        return $model->fixed_price;
    }
}
