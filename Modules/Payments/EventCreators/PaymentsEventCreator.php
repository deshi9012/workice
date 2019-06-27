<?php

namespace Modules\Payments\EventCreators;

use App\Contracts\EventCreatorInterface;

class PaymentsEventCreator implements EventCreatorInterface
{
    public function logEvent($model)
    {
        $model->schedules()->updateOrCreate(
            [
            'calendar_id' => get_option('default_calendar'),
            'user_id' => \Auth::id(),
            'event_name' => 'Transaction ['.$model->code.']',
            ],
            [
            'start_date' => $model->payment_date,
            'end_date' => $model->payment_date,
            'color' => '#5c6a77',
            'location' => get_option('company_city'),
            'description' => 'Payment of '.formatCurrency($model->currency, $model->amount).' received from '.$model->company->name,
            'url' => 'calendar/view/'.$model->id.'/payments'
            ]
        );
    }
}
