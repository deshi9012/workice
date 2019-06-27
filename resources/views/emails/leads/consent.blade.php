@component('mail::message')
@langmail('leads.consent.greeting', ['name' => $lead->name])

@langmail('leads.consent.body.p1', ['company' => get_option('company_name')]) 

@langmail('leads.consent.body.p2') 

@langmail('leads.consent.body.p3') 

@component('mail::button', ['url' => route('leads.consent.accept', ['token' => $lead->token]), 'color' => 'green'])
@langapp('accept_consent')
@endcomponent

@langmail('leads.consent.body.p4', ['url' => route('leads.consent.decline', ['token' => $lead->token]), 'company' => get_option('company_name')]) 


{{ get_option('email_signature') }}

@endcomponent
