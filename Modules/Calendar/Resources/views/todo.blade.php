@extends('layouts.app')
@section('content')
<section id="content">
    <section class="hbox stretch">

            <section class="vbox">
                <header class="header bg-white b-b b-light">
                    
                    @if (isAdmin() || can('events_create'))
                    <a href="{{  route('calendar.create', ['module' => 'events'])  }}" data-toggle="ajaxModal"
                        class="btn btn-sm btn-{{ get_option('theme_color') }}">
                    @icon('solid/calendar-plus') @langapp('add_event')  </a>
                    
                    @endif
                    
                    <a href="{{ route('calendar.ical') }}" data-toggle="ajaxModal" data-rel="tooltip" title="@langapp('download') " data-placement="bottom" class="btn btn-sm btn-{{  get_option('theme_color')  }} pull-right">
                    @icon('solid/calendar-alt') iCal</a>
                    
                    
                </header>
                <section class="scrollable wrapper bg overflow-x-auto">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body collapse in">
                                    <div class="card-block">
                                        <div class="overflow-hidden">
                                            <div id="todo-lists-basic-demo"
                                                class="lobilists-wrapper lobilists single-line sortable ps-container ps-theme-dark ps-active-x">

                                                @widget('Todos\Today')
                                                @widget('Todos\Tomorrow')
                                                @widget('Todos\ThisWeek')
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </section>
            </section>

    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>


@include('todos::_ajax.todojs')
@endsection