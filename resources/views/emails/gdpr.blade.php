@component('mail::message')
# @langmail('gdpr.import.greeting',['name' => $user->name])

@langmail('gdpr.import.body')  

{{ get_option('email_signature') }}  

@langmail('gdpr.import.footer')

@endcomponent