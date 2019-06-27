<?php

namespace Modules\Projects\Rates;

use Modules\Projects\Contracts\ProjectRateInterface;

class HourlyTaskRateType implements ProjectRateInterface
{
    public function calculateCost($model)
    {
        $amount = 0;
        foreach ($model->tasks as $task) {
            $amount += $task->hourly_rate * toHours($task->time);
        }
        return $amount;
    }
}
