<?php

namespace Modules\Projects\EventCreators;

use App\Contracts\EventCreatorInterface;

class ProjectsEventCreator implements EventCreatorInterface
{
    public function logEvent($model)
    {
        $model->schedules()->updateOrCreate(
            [
            'calendar_id' => get_option('default_calendar'),
            'user_id' => \Auth::id(),
            'event_name' => 'Project ['.$model->name.']',
            ], [
            'start_date' => $model->due_date,
            'end_date' => $model->due_date,
            'color' => '#459af0',
            'project_id' => $model->id,
            'location' => get_option('company_city'),
            'description' => 'Project '.$model->name.' expected close date',
            'url' => 'calendar/view/'.$model->id.'/projects'
            ]
        );
    }
}
