<?php

namespace App\Services;

class EventCreator
{
    protected $type;

    private $simpleFactory;

    public function __construct(EventCreatorFactory $simpleFactory, $type)
    {
        $this->simpleFactory = $simpleFactory;
        $this->type = $type;
    }

    public function logEvent($model)
    {
        $creator = $this->simpleFactory->getEventCreator($this->type);

        return $creator->logEvent($model);
    }

    public function deleteEvent($model)
    {
        return $model->schedules()->delete();
    }
    public function setType($type)
    {
        $this->type = $type;
    }
}
