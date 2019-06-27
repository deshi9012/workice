@component('mail::message')
@langmail('projects.survey.greeting', ['name' => $project->company->name])   
### @langmail('projects.survey.heading')  
@langmail('projects.survey.body', ['project' => $project->name])

@component('mail::button', ['url' => route('projects.feedback', $project->token), 'color' => 'blue'])
@langapp('send_feedback')
@endcomponent

{{ get_option('email_signature') }}  
@langmail('projects.survey.footer')

@endcomponent
