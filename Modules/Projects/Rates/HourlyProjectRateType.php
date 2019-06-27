<?php

namespace Modules\Projects\Rates;

use Modules\Projects\Contracts\ProjectRateInterface;

class HourlyProjectRateType implements ProjectRateInterface
{
    public function calculateCost($model)
    {
        return $model->hourly_rate * toHours($model->billable_time);
    }
}
