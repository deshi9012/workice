@component('mail::message')
# @langapp('daily_summary_for',['date' => now()->toFormattedDateString()])

@component('mail::table')
| @langapp('name')    | @langapp('total')   |
| ------------- |: --------:|
@foreach($summary as $key => $value)
| {{ humanize($key) }}     | **{{ $value }}**  |
@endforeach

@endcomponent

@endcomponent