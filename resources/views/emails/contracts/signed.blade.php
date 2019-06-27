@component('mail::message')
# @langmail('contracts.signed.subject')

@langmail('contracts.signed.body', ['title' => $contract->contract_title])

@component('mail::button', ['url' => route('contracts.view', $contract->id), 'color' => 'blue'])
@langapp('preview') @langapp('contract')
@endcomponent

@langmail('contracts.signed.footer')  
{{ get_option('company_name') }}
@endcomponent