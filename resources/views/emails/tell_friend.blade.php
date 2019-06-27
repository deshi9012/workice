@component('mail::message')
{{-- Share Workice with friend --}}
Hello,  
I thought you'd be interested in using Workice CRM to easily invoice clients, organize expenses and manage your projects.
@component('mail::button', ['url' => 'https://workice.com', 'color' => 'blue'])
I'm Interested
@endcomponent

@endcomponent