@extends('layouts.app')

@section('content')
<section id="content">
    <section class="hbox stretch">

            <section class="vbox">
                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-8 m-xs">
                            <strong>
                                {{ Auth::user()->name }}
                            </strong>
                        </div>
                        <div class="col-sm-4 m-b-xs">
                        </div>
                    </div>
                </header>
                <section class="scrollable wrapper bg" id="messages">

                	{!! Form::open(['route' => 'responses.api.save', 'novalidate' => '', 'id' => 'save-response']) !!}

                  <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                	<div class="form-group">
                                <label class="control-label">@langapp('subject') @required</label>
                               
                                    <input type="text" class="form-control" name="subject" placeholder="Message Subject" required>
                            </div>

                	<div class="form-group">
                    <label class="control-label">@langapp('message') @required</label>

                        <textarea class="form-control markdownEditor" name="message" placeholder="Type text..."></textarea>
                    
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
                  	
                  	<ul class="list no-style" id="responses-list">
                  	@foreach (Auth::user()->cannedResponses as $text)
                  	<li class="panel panel-default" id="response-{{ $text->id }}">
                      <div class="panel-heading">
                        <a class="accordion-toggle subject" data-toggle="collapse" data-parent="#accordion2" href="#{{ slugify($text->subject) }}">
                         @icon('solid/envelope-open') {{ $text->subject }}
                        </a>
                        <a href="#" class="delete-response pull-right text-muted" data-response-id="{{$text->id}}">@icon('solid/trash-alt')</a>
                        <a href="{{ route('extras.edit.response', ['id' => $text->id]) }}" class="pull-right text-muted m-l-xs" data-toggle="ajaxModal">@icon('solid/pencil-alt')</a>
                      </div>
                      <div id="{{ slugify($text->subject) }}" class="panel-collapse collapse">
                        <div class="panel-body message">
                          @parsedown($text->message)
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
@push('pagescript')
    @include('stacks.js.markdown')
    <script src='{{ getAsset('plugins/apps/list.min.js') }}'></script>

    <script>
      var options = {
      valueNames: [ 'subject', 'message' ]
    };
    var ResponseList = new List('messages', options);
    </script>

    @include('extras::_ajax.ajaxify')
@endpush



@endsection
