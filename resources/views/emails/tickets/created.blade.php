@component('mail::layout')
<div class="reply-above">
	##- Please type your reply above this line -##
</div>

@slot('header')

@endslot

# @langmail('tickets.created.greeting', ['name' => $recipient])  

@langmail('tickets.created.body', ['subject' => $ticket->subject])  

{{ route('tickets.view', $ticket->id) }}  

@langmail('tickets.created.footer', ['company' => get_option('company_name')])  

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ get_option('company_name') }}. All rights reserved.
@endcomponent
@endslot
@endcomponent