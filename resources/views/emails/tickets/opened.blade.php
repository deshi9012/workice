@component('mail::layout')
<div class="reply-above">
	##- Please type your reply above this line -##
</div>

@slot('header')

@endslot

#@langmail('tickets.opened.greeting', ['name' => $recipient])

@langmail('tickets.opened.body', ['subject' => $ticket->subject])

{{ route('tickets.view', $ticket->id) }}

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ get_option('company_name') }}. All rights reserved.
@endcomponent
@endslot
@endcomponent