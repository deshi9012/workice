<?php

namespace Modules\Projects\Rates;

use Modules\Projects\Contracts\ProjectRateInterface;

class HourlyStaffRateType implements ProjectRateInterface
{
    public function calculateCost($model)
    {
        $amount = 0;
        foreach ($model->assignees as $member) {
            $amount += $member->user->profile->hourly_rate * $member->user->projectWorkedHours($model->id);
        }
        return $amount;
    }
}
