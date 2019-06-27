@component('mail::message')
@langmail('invoices.sending.greeting', ['name' => $invoice->company->name])  

@langmail('invoices.sending.body', ['name' => get_option('company_name'), 'code' => $invoice->name, 'balance' => formatCurrency($invoice->currency, $invoice->due()), 'date' => dateFormatted($invoice->due_date)])

@if(!empty($message))
@component('mail::panel')
{{ $message }}
@endcomponent
@endif

@if(config('system.show_items_invoice_mail'))
@component('mail::table')
| @langapp('name')        | @langapp('tax')          | @langapp('total')   |
| ------------- |:-------------:| --------:|
@foreach($invoice->items as $item)
| {{ str_limit($item->name, 35) }}     | {{ formatCurrency($invoice->currency, $item->tax_total) }}      | {{ formatCurrency($invoice->currency, $item->total_cost) }}     |
@endforeach
| 		| @langapp('sub_total') : 	| {{ formatCurrency($invoice->currency, $invoice->subTotal()) }} 		|
| 		| @langapp('tax') : 	| {{ formatCurrency($invoice->currency, $invoice->totalTax()) }} 		|
| 		| @langapp('discount') : 	| {{ formatCurrency($invoice->currency, $invoice->discounted()) }} 		|
| 		| @langapp('balance') : 	| {{ formatCurrency($invoice->currency, $invoice->due()) }} 		|

@endcomponent
@else
## @langapp('overview') 
@langapp('sub_total') : {{ formatCurrency($invoice->currency, $invoice->subTotal()) }}  
@langapp('tax') : {{ formatCurrency($invoice->currency, $invoice->totalTax()) }}  
@langapp('discount') : {{ formatCurrency($invoice->currency, $invoice->discounted()) }}  
@langapp('balance') : {{ formatCurrency($invoice->currency, $invoice->due()) }}  
@endif

@component('mail::button', ['url' => URL::signedRoute('invoices.guest', $invoice->id), 'color' => 'blue'])
@langapp('preview') @langapp('invoice') 
@endcomponent



{{ get_option('email_signature') }}

@endcomponent