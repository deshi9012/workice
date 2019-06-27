@component('mail::message')
@langmail('invoices.reminder.reminder3.greeting', ['name' => $invoice->company->name])  
@langmail('invoices.reminder.reminder3.body', [
	'code' => $invoice->reference_no, 'date' => dateFormatted($invoice->due_date),
	'balance' => formatCurrency($invoice->currency, $invoice->due())
	])

@component('mail::button', ['url' => url()->signedRoute('invoices.guest', $invoice->id), 'color' => 'blue'])
@langapp('preview') @langapp('invoice')
@endcomponent

{{ get_option('email_signature') }}

@endcomponent