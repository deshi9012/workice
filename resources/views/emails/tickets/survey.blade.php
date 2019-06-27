@component('mail::message')
@langmail('tickets.survey.greeting', ['name' => $ticket->user->name])  
### @langmail('tickets.survey.heading')  

@langmail('tickets.survey.body', ['company' => get_option('company_name')])  

@component('mail::button', ['url' => URL::signedRoute('tickets.feedback', $ticket->id)])
   Rate Support
@endcomponent

@langmail('tickets.survey.footer')  
{{ get_option('company_name') }}
@endcomponent
