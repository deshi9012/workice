@component('mail::message')
@langmail('invoices.reminder.reminder1.greeting', ['name' => $invoice->company->name])  
@langmail('invoices.reminder.reminder1.body', ['code' => $invoice->reference_no])

@component('mail::button', ['url' => url()->signedRoute('invoices.guest', $invoice->id), 'color' => 'blue'])
@langapp('preview') @langapp('invoice')
@endcomponent

@if(!empty($message))
@component('mail::panel')
{{ $message }}
@endcomponent
@endif

{{ get_option('email_signature') }}

@endcomponent