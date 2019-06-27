@component('mail::layout')
<div class="reply-above">
	##- Please type your reply above this line -##
</div>

@slot('header')

@endslot

#@langmail('tickets.replied.greeting', ['name' => $recipient]) 

@langmail('tickets.replied.body', ['code' => $ticket->code, 'subject' => $ticket->subject])

@component('mail::panel')
{{ $comment->message }}
@endcomponent

@langmail('tickets.replied.footer')  

{{ route('tickets.view', $ticket->id) }} 

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ get_option('company_name') }}. All rights reserved.
@endcomponent
@endslot
@endcomponent