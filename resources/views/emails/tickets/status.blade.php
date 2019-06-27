@component('mail::layout')
<div class="reply-above">
	##- Please type your reply above this line -##
</div>

@slot('header')

@endslot

# @langmail('tickets.status.greeting', ['name' => $recipient])  

@langmail('tickets.status.body', ['subject' => $ticket->subject, 'status' => $ticket->AsStatus->status])  

{{ route('tickets.view', $ticket->id) }}  

@langmail('tickets.status.footer', ['company' => get_option('company_name')])  

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ get_option('company_name') }}. All rights reserved.
@endcomponent
@endslot
@endcomponent