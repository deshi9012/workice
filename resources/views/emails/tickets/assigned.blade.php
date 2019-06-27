@component('mail::message')

# @langmail('tickets.assigned.greeting',['name' => $ticket->agent->name])

@langmail('tickets.assigned.body', ['subject' => $ticket->subject])  

{{ route('tickets.view', $ticket->id) }}

@langmail('tickets.assigned.footer')

@endcomponent