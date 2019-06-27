<?php

namespace Modules\Invoices\EventCreators;

use App\Contracts\EventCreatorInterface;

class InvoicesEventCreator implements EventCreatorInterface
{
    public function logEvent($model)
    {
        $model->schedules()->updateOrCreate(
            [
                'calendar_id' => get_option('default_calendar', '1'),
                'user_id'     => \Auth::id(),
                'event_name'  => 'Invoice [' . $model->reference_no . ']',
            ],
            [
                'start_date'  => $model->due_date,
                'end_date'    => $model->due_date,
                'color'       => '#589f7e',
                'location'    => get_option('company_city'),
                'description' => 'Invoice ' . $model->reference_no . ' due date',
                'url'         => 'calendar/view/' . $model->id . '/invoices',
            ]
        );
    }
}
