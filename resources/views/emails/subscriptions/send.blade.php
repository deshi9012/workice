@component('mail::message')
# @langmail('subscriptions.sending.greeting', ['contact' => optional($plan->owner->contact)->name])

@langmail('subscriptions.sending.body', ['name' => $plan->name])

@component('mail::button', ['url' => route('subscriptions.subscribe', $plan->id)])
@langapp('review_subscription')
@endcomponent

@langmail('subscriptions.sending.footer')  
{{ get_option('company_name') }}
@endcomponent
