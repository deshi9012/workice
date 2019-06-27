@extends('layouts.app')
@section('content')
<section id="content">
    <section class="hbox stretch">
        <aside>
            <section class="vbox">
                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-12 m-b-xs">
                            <p class="h3">@langapp('notifications') 
                                @admin
                                <a href="{{ route('notifications.preferences') }}" class="btn btn-{{ get_option('theme_color') }} btn-sm pull-right">
                                    @icon('solid/cogs') @langapp('settings') 
                                </a>
                                @endadmin
                            </p>
                        </div>
                        
                    </div>
                </header>
                <section class="scrollable wrapper bg">
                    <div class="timeline">
                        @php
                        $bgs = array("primary", "success", "info", "dark", "warning");
                        @endphp
                        @foreach (Auth::user()->notifications->take(300) as $notification)
                        
                        <article class="timeline-item {{  $notification->created_at->minute % 2 == 0 ? '' : 'alt' }}">
                            <div class="timeline-caption">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <span class="arrow {{  $notification->created_at->minute % 2 == 0 ? 'left' : 'right' }}"></span>
                                        <span class="timeline-icon"><i class="fas fa-{{ $notification->data['icon'] }} time-icon bg-{{ array_random($bgs) }}"></i></span>
                                        <small class="timeline-date small">{{ dateTimeFormatted($notification->created_at) }}</small>
                                        
                                        <span class="text-muted">{{ $notification->data['subject'] }} {!! $notification->read() ? '<i class="fas fa-envelope-open text-success pull-right"></i>' : '' !!}</span>
                                        @parsedown($notification->data['activity'])
                                        
                                    </div>
                                </div>
                            </div>
                        </article>
                        {{ $notification->markAsRead() }}
                        @endforeach
                        
                        
                        <div class="timeline-footer"><a href="#">@icon('regular/calendar-alt', 'time-icon inline-block text-info')</a></div>
                    </div>
                    
                </section>
            </section>
        </aside>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
@endsection