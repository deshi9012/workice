<?php

namespace Modules\Deals\EventCreators;

use App\Contracts\EventCreatorInterface;

class DealsEventCreator implements EventCreatorInterface
{
    public function logEvent($model)
    {
        $model->schedules()->updateOrCreate(
            [
            'calendar_id' => get_option('default_calendar', '1'),
            'user_id' => \Auth::id(),
            'event_name' => $model->title,
            ],
            [
            'start_date' => $model->due_date,
            'end_date' => $model->due_date,
            'color' => '#b95781',
            'location' => get_option('company_city'),
            'description' => 'Deal '.$model->title.' expected to close',
            'url' => 'calendar/view/'.$model->id.'/deals'
            ]
        );
    }
}
