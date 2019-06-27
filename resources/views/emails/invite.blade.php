@component('mail::message')
@langmail('extras.invite.greeting')
@langmail('extras.invite.body')  


@langmail('extras.invite.button')

@component('mail::button', ['url' => route('invite.accept', ['token' => $invite->token]), 'color' => 'blue'])
@langapp('accept_invitation') 
@endcomponent

{{ get_option('email_signature') }} 

@endcomponent