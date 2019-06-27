@component('mail::message')
# Test Email

{{ $message }}

😁👍💚 Emails working correctly,<br>
{{ get_option('company_name') }}
@endcomponent