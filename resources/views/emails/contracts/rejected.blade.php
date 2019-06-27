@component('mail::message')
# @langmail('contracts.rejected.subject')

@langmail('contracts.rejected.body', ['title' => $contract->contract_title])

@component('mail::button', ['url' => route('contracts.view', $contract->id), 'color' => 'red'])
@langapp('preview') @langapp('contract')
@endcomponent

@langmail('contracts.rejected.footer')  
{{ get_option('company_name') }}
@endcomponent