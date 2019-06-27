<?php

namespace Modules\Projects\Services;

use Modules\Projects\Services\ProjectRateFactory;

class ProjectRate
{
    protected $type;

    private $simpleFactory;

    public function __construct(ProjectRateFactory $simpleFactory)
    {
        $this->simpleFactory = $simpleFactory;
    }

    public function calculateCost($model)
    {
        $projectRateType = $this->simpleFactory->getProjectRateType($this->type);

        return $projectRateType->calculateCost($model);
    }
    public function setType($type)
    {
        $this->type = $type;
    }
}
