@component('mail::message')
# @langmail('contracts.reminder.greeting', ['title' => $contract->contract_title])

@langmail('contracts.reminder.body')

### @langapp('information')

@langapp('start_date'):	**{{ dateTimeFormatted($contract->start_date) }}**  
@langapp('expiry_date'):	**{{ dateTimeFormatted($contract->expiry_date) }}**  

@component('mail::button', ['url' => URL::signedRoute('contracts.guest.show', $contract->id) ] )
@langapp('preview') @langapp('contract')
@endcomponent

@langmail('contracts.reminder.footer')  

{{ get_option('email_signature') }}
@endcomponent
