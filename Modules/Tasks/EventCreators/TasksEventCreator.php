<?php

namespace Modules\Tasks\EventCreators;

use App\Contracts\EventCreatorInterface;

class TasksEventCreator implements EventCreatorInterface
{
    public function logEvent($model)
    {
        $model->schedules()->updateOrCreate(
            [
            'calendar_id' => get_option('default_calendar'),
            'user_id' => \Auth::id(),
            'event_name' => 'Task ['.$model->name.']',
            ], [
            'start_date' => $model->due_date,
            'end_date' => $model->due_date,
            'color' => '#fd6a56',
            'project_id' => $model->project_id,
            'location' => get_option('company_city'),
            'description' => 'Task '.$model->name.' due date',
            'url' => 'calendar/view/'.$model->id.'/tasks'
            ]
        );
    }
}
