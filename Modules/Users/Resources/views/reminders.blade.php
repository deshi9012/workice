@extends('layouts.app')
@section('content')
<section id="content">
    <section class="hbox stretch">
        <aside>
            <section class="vbox">
                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-12 m-b-xs">
                            <p class="h3">@langapp('reminders') 
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

                    @foreach (Auth::user()->reminders as $reminder)
                        <article class="media">
                        <span class="pull-left thumb-sm">
                            <img src="{{ $reminder->recipient->profile->photo }}" data-rel="tooltip" title="{{ $reminder->recipient->name }}" data-placement="right" class="img-circle"></span>
                        <div class="media-body">
                          <div class="pull-right media-xs text-center text-muted">
                            <strong class="h4">{{ dateTimeFormatted($reminder->reminder_date) }}</strong><br>
                            <small class="label bg-light">{{ dateElapsed($reminder->reminder_date) }}</small>
                          </div>
                          <a href="#" class="h4">{{ $reminder->remindable->name }}</a>
                          <small class="block"><a href="#" class="">{{ $reminder->user->name }}</a></small>
                          <small class="block m-t-sm">@parsedown($reminder->description)</small>
                        </div>
                      </article>
                      <div class="line pull-in"></div>
                    @endforeach

                    
                    
                    
                </section>
            </section>
        </aside>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
@endsection