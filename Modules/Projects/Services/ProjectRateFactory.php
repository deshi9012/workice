<?php

namespace Modules\Projects\Services;

class ProjectRateFactory
{
    public function getProjectRateType($projectType)
    {
        $className = "Modules\\Projects\\Rates\\" . studly_case($projectType) . "Type";

        if (! class_exists($className)) {
            throw new \Exception('Project Rate implementation '.$className.' missing');
        }
        
        return new $className;
    }
}
