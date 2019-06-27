@component('mail::message')
@langmail('credits.sending.greeting')  
@langmail('credits.sending.body', ['code' => $creditnote->reference_no])

@if(!empty($message))
@component('mail::panel')
{{ $message }}
@endcomponent
@endif

@langapp('overview'):  

@langapp('reference_no'): **{{ $creditnote->reference_no }}**   
@langapp('date') : **{{ dateTimeFormatted($creditnote->created_at) }}**   
@langapp('amount') : **{{ formatCurrency($creditnote->currency, $creditnote->balance) }}(in {{ $creditnote->currency }})**   

@component('mail::button', ['url' => route('creditnotes.view', ['id' => $creditnote->id]), 'color' => 'blue'])
@langapp('credit_note') 
@endcomponent



{{ get_option('email_signature') }}

@endcomponent