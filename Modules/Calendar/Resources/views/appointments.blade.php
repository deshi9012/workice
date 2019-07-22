@extends('layouts.app')

@section('content')

<section id="content">

    <section class="hbox stretch">

        <aside>
            <section class="vbox">
                <header class="header bg-white b-b b-light">

                @if (isAdmin() || can('events_create')) 
                        <a href="{{ route('calendar.create.appointment') }}" data-toggle="ajaxModal"
                           class="btn btn-sm btn-{{ get_option('theme_color') }}">
                       @icon('solid/calendar-plus') @langapp('add_appointment')</a>

                @endif


                </header>
                <section class="scrollable wrapper bg">

                        <div class="appointments" id="appointments"></div>

                </section>

            </section>
        </aside>

    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>

@push('pagestyle')
    @include('stacks.css.fullcalendar')
@endpush

@push('pagescript')
    @include('stacks.js.fullcalendar')
   <script type="text/javascript">
    $(document).ready(function () {
        $('#appointments').fullCalendar({
            googleCalendarApiKey: '{{ get_option('gcal_api_key') }}',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            themeSystem: 'bootstrap3',
            nowIndicator: true,
            dayClick: function(date, jsEvent, view) {
                
            },
            timezone: '{{ get_option('timezone') }}',
            timeFormat: 'h:mm a',
            eventAfterRender: function (event, element, view) {
                if (event.type == 'fo') {
                    $(element).attr('data-toggle', 'ajaxModal').addClass('ajaxModal');
                }
            },
            eventSources: [
                {
                    events: [
                        @foreach (Auth::user()->appointments as $event)
                        {
                            title: '{{ addslashes($event->name) }}',
                            start: '{{ date('Y-m-d H:i:s', strtotime($event->start_time)) }}',
                            end: '{{ date('Y-m-d H:i:s', strtotime($event->finish_time)) }}',
                            url: '/calendar/appointments/view/{{ $event->id }}',
                            type: 'fo',
                            allDay: false,
                            color: '#ca7171'
                        },
                        @endforeach
                    ],
                    color: '#38354a',
                    textColor: 'white'
                },
                {
                    googleCalendarId: '{{ get_option('gcal_id') }}'
                }
            ]
        });
    });
</script>
@endpush

@endsection