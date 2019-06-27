<?php
namespace App\Services;

class EventCreatorFactory
{
    public function getEventCreator($type)
    {
        $className = "Modules\\".ucfirst($type)."\\EventCreators\\" . studly_case($type) . "EventCreator";

        if (! class_exists($className)) {
            throw new \Exception('Module event creator implementation '.$className.' missing');
        }
        
        return new $className;
    }
}
