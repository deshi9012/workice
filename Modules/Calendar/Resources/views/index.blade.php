@extends('layouts.app')

@section('content')

<section id="content">
    <section class="hbox stretch">

        <aside>
            <section class="vbox">
                <header class="header bg-white b-b b-light">

                @if (isAdmin() || can('events_create')) 
                        <a href="{{ route('calendar.create', ['module' => 'events']) }}" data-toggle="ajaxModal"
                           class="btn btn-sm btn-{{ get_option('theme_color') }}">
                       @icon('solid/calendar-plus') @langapp('add_event')  </a>
                                    
                        <a href="{{ route('calendar.appointments') }}" class="btn btn-sm btn-{{ get_option('theme_color') }}">
                        @icon('solid/calendar-check') @langapp('appointments')</a>

                @endif

                @admin
                <a href="{{ route('settings.calendars.show') }}" data-toggle="ajaxModal" class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right" data-rel="tooltip" title="@langapp('calendars')" data-placement="bottom">
                    @icon('solid/cogs')
                </a>
                @endadmin

                <div class="btn-group pull-right">
                        <button class="btn btn-{{ get_option('theme_color') }} btn-sm dropdown-toggle btn-responsive"
                        data-toggle="dropdown"> @langapp('calendars') <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            @foreach (Modules\Calendar\Entities\CalendarType::get() as $cal)
                            <li>
                            <a href="{{  route('set.calendar.type', ['view' => $cal->id])  }}">
                                {{ $cal->name }}
                            </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <a href="{{ route('calendar.ical') }}" data-toggle="ajaxModal" title="@langapp('download') " data-placement="bottom" class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right">
                    @icon('solid/calendar-alt') iCal</a>

                </header>
                <section class="scrollable wrapper bg">

                        <div class="calendar" id="calendar"></div>

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
    @include('partial.calendar')
@endpush

@endsection