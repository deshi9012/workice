<?php

namespace Modules\Estimates\EventCreators;

use App\Contracts\EventCreatorInterface;

class EstimatesEventCreator implements EventCreatorInterface
{
    public function logEvent($model)
    {
        $model->schedules()->updateOrCreate(
            [
            'calendar_id' => get_option('default_calendar'),
            'user_id' => \Auth::id(),
            'event_name' => 'Estimate ['.$model->reference_no.']',
            ], [
            'start_date' => $model->due_date,
            'end_date' => $model->due_date,
            'color' => '#09a9a9',
            'location' => get_option('company_city'),
            'description' => 'Estimate '.$model->reference_no.' due date',
            'url' => 'calendar/view/'.$model->id.'/estimates'
            ]
        );
    }
}
