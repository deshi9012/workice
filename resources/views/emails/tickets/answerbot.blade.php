@component('mail::message')
# Hello {{ $ticket->user->name }},

@langmail('tickets.answer.body')

@foreach($articles as $article)
* [{{ $article->subject }}]({{ route('kb.view', $article->id) }})
@endforeach

@component('mail::button', ['url' => route('tickets.view', $ticket->id)])
@langapp('close')
@endcomponent

@langmail('tickets.answer.footer')  
{{ get_option('company_name') }}
@endcomponent
