<?php

namespace Modules\Projects\Contracts;

interface ProjectRateInterface
{
    public function calculateCost($model);
}
