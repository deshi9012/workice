<div class="col-md-12">
    <section class="panel panel-default b-top">
        <header class="panel-heading h3">

            @can('events_create') 

                <a href="{{  route('calendar.create', ['module' => 'leads', 'id' => $lead->id])  }}"
                   class="btn btn-xs btn-{{ get_option('theme_color') }} pull-right" data-toggle="ajaxModal">
               @icon('solid/calendar-plus') @langapp('schedule_event')  </a>

            @endcan

            @icon('solid/calendar-alt') @langapp('calendar')  
        </header>

            <section class="panel panel-body">

                <div class="calendar" id="appointments"></div>
            </section>


 </section>
</div>

@push('pagestyle')
    @include('stacks.css.fullcalendar')
@endpush

@push('pagescript')
@include('stacks.js.fullcalendar')

<script type="text/javascript">
    $(document).ready(function () {
        $('#appointments').fullCalendar({
            eventAfterRender: function (event, element, view) {
                $(element).attr('data-toggle', 'ajaxModal').addClass('ajaxModal');
            },
            themeSystem: 'bootstrap3',
            nowIndicator: true,
            timezone: '{{ get_option('timezone') }}',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            eventSources: [
                {
                    events: [
                        @foreach ($lead->schedules as $key => $event) 
                        {
                            title: '{{ addslashes($event->event_name) }}',
                            start: '{{  date('Y-m-d H:i', strtotime($event->start_date))  }}',
                            end: '{{  date('Y-m-d H:i', strtotime($event->end_date))  }}',
                            url: '{{  route('calendar.view', ['id' => $event->id, 'module' => 'events'])  }}',
                            color: '{{ $event->color }}'
                        },
                        @endforeach
                    ],
                    color: '#7266BA',
                    textColor: 'white'
                },
                {
                    events: [
                        @foreach ($lead->todos as $activity) 
                        {
                            title: '{{ addslashes($activity->subject) }}',
                            start: '{{  date('Y-m-d H:i:s', strtotime($activity->due_date))  }}',
                            end: '{{  date('Y-m-d H:i:s', strtotime($activity->due_date))  }}',
                            url: '{{  route('todo.edit', ['id' => $activity->id])  }}',
                            color: '#{{ $activity->completed === 1 ? 'ea2e49' : '22b66e' }}',
                        },
                        @endforeach
                    ],
                    textColor: 'white'
                }
            ]
        });
    });
</script>
@endpush

