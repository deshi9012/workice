@extends('layouts.app')

@section('content')
<section id="content">
    <section class="hbox stretch">

            <section class="vbox">
                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-8 m-xs">@icon('solid/bullhorn') @langapp('announcements')</div>
                        <div class="col-sm-4 m-b-xs">
                        </div>
                    </div>
                </header>
                <section class="scrollable wrapper bg" id="announcements">

                    {!! Form::open(['route' => 'announcements.api.save', 'novalidate' => '', 'id' => 'save-announcement']) !!}

                  <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                  <div class="row">
                            <div class="col-md-6">
                                <label>@langapp('subject') @required</label>
                                <input type="text" placeholder="Privacy Changes" name="subject" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label>URL</label>
                                <input type="text" placeholder="https://domain.com/privacy-changes" name="url" class="form-control">
                            </div>
                        </div>

                   

                    <div class="form-group">
                    <label class="control-label">@langapp('message') @required</label>

                        <textarea class="form-control markdownEditor" name="message" placeholder="Type text..."></textarea>
                    
                  </div>

                  <div class="form-group">
                <label>{{ langapp('schedule') }} (<span class="small text-muted">Default 10 minutes from now</span>)</label>
                <div class="input-group date">
                  <input type="text" class="form-control datetimepicker-input"
                  value="{{ timePickerFormat(now()->addMinutes(10)) }}" name="announce_at"
                  data-date-format="DD-MM-YYYY hh:mm A" data-date-start-date="0d">
                  <div class="input-group-addon">
                    @icon('solid/calendar-alt', 'text-muted')
                  </div>
                </div>
              </div>

                  <footer class="panel-footer bg-light lter m-b-sm">
                    {!!  renderAjaxButton()  !!}
                    <ul class="nav nav-pills nav-sm"></ul>
            </footer>


                {!! Form::close() !!}

                  <div class="panel-group m-b" id="accordion2">

                    <div class="input-group m-b-sm">
                <input type="text" class="form-control search" placeholder="Search by Subject or Message">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-{{ get_option('theme_color') }} btn-icon">@icon('solid/search')</button>
                </span>
              </div>
                    
                    <ul class="list no-style" id="announcement-list">
                    @foreach (Auth::user()->announcements as $announcement)
                    <li class="panel panel-default" id="announcement-{{ $announcement->id }}">
                      <div class="panel-heading">
                        <a class="accordion-toggle subject" data-toggle="collapse" data-parent="#accordion2" href="#{{ slugify($announcement->subject) }}">
                         @icon('solid/bullhorn') {{ $announcement->subject }}
                        </a>
                        <a href="#" class="delete-announcement pull-right text-muted" data-announcement-id="{{$announcement->id}}">@icon('solid/trash-alt')</a>
                        <a href="{{ route('announcements.update', $announcement->id) }}" class="pull-right text-muted m-l-xs" data-toggle="ajaxModal">@icon('solid/pencil-alt')</a>
                      </div>
                      <div id="{{ slugify($announcement->subject) }}" class="panel-collapse collapse">
                        <div class="panel-body message">
                          @parsedown($announcement->message)
                          @if(!empty($announcement->url))
                          <a class="btn btn-sm btn-info" href="{{ $announcement->url }}" target="_blank">Read More</a>
                          @endif
                        </div>
                      </div>

                      </li>
                    
                    @endforeach

                    </ul>
                    
                    
                    
                    
                  </div>


                </section>
            </section>

    </section>
</section>
<a class="hide nav-off-screen-block" data-target="#nav" data-toggle="class:nav-off-screen" href="#">
</a>

@push('pagestyle')
@include('stacks.css.datepicker')
@endpush

@push('pagescript')
    @include('stacks.js.markdown')
    @include('stacks.js.datepicker')
    <script src='{{ getAsset('plugins/apps/list.min.js') }}'></script>

    <script>
      $('.datetimepicker-input').datetimepicker({showClose: true, showClear: true, minDate: moment() });
      var options = {
      valueNames: [ 'subject', 'message' ]
    };
    var ResponseList = new List('announcements', options);
    </script>

    @include('users::announcements._ajaxify')
@endpush



@endsection
