<script type="text/javascript">
    $(document).ready(function () {
        $('#calendar').fullCalendar({
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
                        @foreach (Auth::user()->schedules->where('calendar_id', activeCalendar()) as $event) 
                        {
                            title: '{{ addslashes($event->event_name) }}',
                            start: '{{ date('Y-m-d H:i:s', strtotime($event->start_date)) }}',
                            end: '{{ date('Y-m-d H:i:s', strtotime($event->end_date)) }}',
                            url: '{{ $event->url }}',
                            type: 'fo',
                            allDay: false,
                            color: '{{ $event->color }}'
                        },
                        @endforeach
                        @if(!isAdmin() && Auth::user()->profile->company > 0)

                        @foreach (Auth::user()->profile->business->invoices as $inv) 
                        {
                            title: '{{ addslashes($inv->name) }}',
                            start: '{{ date('Y-m-d H:i:s', strtotime($inv->due_date)) }}',
                            end: '{{ date('Y-m-d H:i:s', strtotime($inv->due_date)) }}',
                            url: '{{ route('invoices.view', $inv->id) }}',
                            type: 'fo',
                            allDay: false,
                            color: '#545caf'
                        },
                        @endforeach

                        @foreach (Auth::user()->profile->business->estimates as $est) 
                        {
                            title: '{{ addslashes($est->name) }}',
                            start: '{{ date('Y-m-d H:i:s', strtotime($est->due_date)) }}',
                            end: '{{ date('Y-m-d H:i:s', strtotime($est->due_date)) }}',
                            url: '{{ route('estimates.view', $est->id) }}',
                            type: 'fo',
                            allDay: false,
                            color: '#4a68f8'
                        },
                        @endforeach

                        @foreach (Auth::user()->profile->business->contracts as $contract) 
                        {
                            title: '{{ addslashes($contract->contract_title) }}',
                            start: '{{ date('Y-m-d H:i:s', strtotime($contract->expiry_date)) }}',
                            end: '{{ date('Y-m-d H:i:s', strtotime($contract->expiry_date)) }}',
                            url: '{{ route('contracts.view', $contract->id) }}',
                            type: 'fo',
                            allDay: false,
                            color: '#00d65f'
                        },
                        @endforeach

                        @foreach (Auth::user()->profile->business->payments as $payment) 
                        {
                            title: '{{ addslashes($payment->code) }}',
                            start: '{{ date('Y-m-d H:i:s', strtotime($payment->payment_date)) }}',
                            end: '{{ date('Y-m-d H:i:s', strtotime($payment->payment_date)) }}',
                            url: '{{ route('invoices.view', $payment->invoice_id) }}',
                            type: 'fo',
                            allDay: false,
                            color: '#f43445'
                        },
                        @endforeach

                        @foreach (Auth::user()->profile->business->projects as $project) 
                        {
                            title: '{{ addslashes($project->name) }}',
                            start: '{{ date('Y-m-d H:i:s', strtotime($project->due_date)) }}',
                            end: '{{ date('Y-m-d H:i:s', strtotime($project->due_date)) }}',
                            url: '{{ route('projects.view', $project->id) }}',
                            type: 'fo',
                            allDay: false,
                            color: '#0772d1'
                        },
                        @endforeach

                        @endif
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