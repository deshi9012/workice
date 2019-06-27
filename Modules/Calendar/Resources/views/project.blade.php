<script type="text/javascript">
    $(document).ready(function () {
        $('#cal').fullCalendar({
            eventAfterRender: function (event, element, view) {
                $(element).attr('data-toggle', 'ajaxModal').addClass('ajaxModal');
            },
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            themeSystem: 'bootstrap3',
            nowIndicator: true,
            timezone: '{{ get_option('timezone') }}',
            eventSources: [
                {
                    events: [
                        @foreach ($project->tasks as $key => $task)
                        {
                            title: '{{ addslashes($task->name) }}',
                            start: '{{ date('Y-m-d', strtotime($task->due_date)) }}',
                            end: '{{ date('Y-m-d', strtotime($task->due_date)) }}',
                            url: '{{ route('calendar.view', ['id' => $task->id, 'module' => 'tasks']) }}',
                            color: '#3869D4'
                        },
                        @endforeach
                        @foreach ($project->schedules as $event)
                        {
                            title: '{{ addslashes($event->event_name) }}',
                            start: '{{ date('Y-m-d', strtotime($event->start_date))  }}',
                            end: '{{  date('Y-m-d', strtotime($event->end_date))  }}',
                            url: '{{  route('calendar.view', ['id' => $event->id, 'module' => 'events'])  }}',
                            color: '{{ $event->color }}'
                        },
                        @endforeach
                    ],
                    color: '#7266BA',
                    textColor: 'white'
                }
            ]
        });
    });
</script>
