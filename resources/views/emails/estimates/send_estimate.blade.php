@component('mail::message')
@langmail('estimates.sending.greeting', ['name' => $estimate->company->primary_contact > 0 ? $estimate->company->contact_person : $estimate->company->name])  
@langmail('estimates.sending.body', ['amount' => formatCurrency($estimate->currency, $estimate->amount)])
 
@if(!empty($message))
@component('mail::panel')
{{ $message }}
@endcomponent
@endif

@if(config('system.show_items_estimate_mail'))
@component('mail::table')
| @langapp('name')        | @langapp('tax')          | @langapp('total')   |
| ------------- |:-------------:| --------:|
@foreach($estimate->items as $item)
| {{ str_limit($item->name, 35) }}     | {{ formatCurrency($estimate->currency, $item->tax_total) }}      | {{ formatCurrency($estimate->currency, $item->total_cost) }}     |
@endforeach
| 	| @langapp('sub_total') : | {{ formatCurrency($estimate->currency, $estimate->subTotal()) }} 		|
| 	| @langapp('tax') : | {{ formatCurrency($estimate->currency, $estimate->totalTax()) }} 		|
| 	| @langapp('discount') : | {{ formatCurrency($estimate->currency, $estimate->discounted()) }} 		|
| 	| @langapp('amount') : | {{ formatCurrency($estimate->currency, $estimate->amount) }} 		|

@endcomponent
@else
###@langapp('overview') 
@langapp('sub_total') : {{ formatCurrency($estimate->currency, $estimate->subTotal()) }}  
@langapp('discount') : {{ formatCurrency($estimate->currency, $estimate->discounted()) }}  
@langapp('tax') : {{ formatCurrency($estimate->currency, $estimate->totalTax()) }}  
@langapp('amount') : {{ formatCurrency($estimate->currency, $estimate->amount) }}  
@endif


@component('mail::button', ['url' => route('estimates.view', ['id' => $estimate->id]), 'color' => 'blue'])
@langapp('preview') @langapp('estimate') 
@endcomponent



{{ get_option('email_signature') }}

@endcomponent