@extends('layouts.app')
@section('content')
<section id="content">

  <section class="hbox stretch">
    <aside class="aside-lg" id="subNav">
      <header class="dk header b-b">
        <div class="wrapper">@langapp('messages') <a href="{{ route('messages.new') }}" class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right">
        @icon('solid/paper-plane') @langapp('send')</a></div>
        
      </header>
        <section class="scrollable">
          <section class="slim-scroll msg-thread" data-height="500px" id="sender-list">
            @include('messages::partials.search')
            @include('messages::threads')
          </section>
        </section>
      </aside>       
      <aside class="bg-light lter b-l" id="email-list">
        <section class="vbox">
          <header class="header bg-white b-b clearfix">
            <div class="row m-t-sm">
              
            </div>
          </header>
          <section class="scrollable wrapper bg">
            {!! Form::open(['route' => ['message.send'], 'class' => 'ajaxifyForm bs-example', 'data-toggle' => 'validator', 'files' => true]) !!}

           
              <section class="panel panel-default">
                <header class="panel-heading">@icon('solid/info-circle') {{ __('An email will be sent to notify the user.') }}
                </header>
                <div class="panel-body">
                  
                  <div class="form-group">
                    <label class="control-label">@langapp('users') @required
                    </label>
                    <select class="select2-option width100" multiple="multiple" name="to[]">
                      @if(can('messages_send_to_all'))
                      @foreach (app('user')->select('id','username', 'name')->where('id', '!=', Auth::id())->offHoliday()->get() as $user)
                      <option value="{{ $user->id }}">{{  $user->name }}</option>
                      @endforeach
                      @else
                      @foreach (app('user')->role('admin')->where('id', '!=', Auth::id())->offHoliday()->get()  as $user)
                      <option value="{{ $user->id }}">{{ $user->name }}</option>
                      @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">@langapp('message') @required</label>
                    
                    <textarea name="message" class="form-control markdownEditor"></textarea>
                    
                  </div>
                  @can('files_create')
                  <div class="form-group">
                    <label class="control-label">@langapp('files')
                    </label>
                    <input type="file" name="uploads[]" multiple>
                  </div>
                  @endcan
                </div>
                <div class="panel-footer">
                  {!!  renderAjaxButton('send')  !!}
                </div>
              </section>
             {!! Form::close() !!}
          </section>
        </section>
      </aside>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
  </section>
  @push('pagestyle')
  @include('stacks.css.form')
  @endpush
  @push('pagescript')
  @include('stacks.js.form')
  @include('stacks.js.markdown')
  @include('stacks.js.list')
  <script>
  var options = {
    valueNames: [ 'sender-name' ]
  };
  var senderList = new List('sender-list', options);
  </script>
  @endpush

  @endsection