@extends('layouts.app')
@section('content')
<section id="content">
  <section class="hbox stretch">
    <aside class="aside-lg" id="subNav">
      <header class="dk header b-b">
        <div class="padder-v">@langapp('messages')  <a href="{{ route('messages.new') }}" class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right">
        @icon('solid/paper-plane') @langapp('send') </a>
      </div>
        
        
      </header>
        <section class="scrollable">
          <section class="slim-scroll msg-thread" data-height="500px">
            
            @include('messages::threads')
            
          </section>
        </section>
      </aside>        
      <aside class="lter b-l" id="email-list">
        <section class="vbox">
          <header class="header bg-white b-b clearfix">
            <div class="row m-t-sm">
              <div class="col-sm-4 col-sm-offset-8 m-b-xs">

                
              </div>
            </div>
          </header>
          <section class="scrollable wrapper bg">
            
            <div class="chat-history conversations">
              
              <section class="chat-list panel-body" id="msg-list">

                
                @include('messages::partials.search')
              

                <ul id="talkMessages" class="list">
                  @foreach($messages as $message)

                  @if($message->sender->id == Auth::id())
                  <article id="message-{{$message->id}}" class="chat-item left">
                    <a href="#" class="pull-left thumb-sm avatar">
                    <img src="{{ $message->sender->profile->photo }}" class="img-circle"></a>
                    
                    <section class="chat-body">
                      <div class="panel b-light text-sm m-b-none shadowed">
                        <div class="panel-body">
                          <span class="arrow left"></span>
                          <div class="message other-message m-b-sm">
                            @parsedown($message->message)
                          </div>

                          <span class="message-data-name">
                              <a href="#" class="talkDeleteMessage" data-message-id="{{$message->id}}" title="Delete Message">
                              @icon('solid/trash-alt', 'pull-right')</a> 
                              @icon('solid/user-circle') {{ $message->sender->name }}
                            </span>
                          
                          @include('partial._show_files', ['files' => $message->files, 'limit' => true])

                          

                        </div>
                      </div>
                      <small class="text-muted message-data-time">
                        @icon('solid/calendar-alt') {{ $message->created_at->diffForHumans() }}
                      </small>
                      
                    </section>
                  </article>
                  
                  @else
                  <article id="message-{{$message->id}}" class="chat-item right">
                    <div class="message-data">
                      <a href="#" class="pull-right thumb-sm avatar">
                      <img src="{{ $message->sender->profile->photo }}" class="img-circle"></a>
                      
                      <section class="chat-body">
                        <div class="panel bg text-sm m-b-none chat-bg1">
                          <div class="panel-body">
                            <span class="arrow right"></span>
                            <div class="message my-message m-b-sm">
                              @parsedown($message->message)
                            </div>
                            <span class="message-data-name">
                              <a href="#" class="talkDeleteMessage text-white" data-message-id="{{$message->id}}" title="Delete Message">
                              @icon('solid/trash-alt', 'pull-right')</a> 
                              @icon('solid/user-circle') {{ $message->sender->name }}
                            </span>

                              @include('partial._show_files', ['files' => $message->files, 'limit' => true])

                            </div>

                          </div>
                          <small class="text-muted message-data-time">
                            @icon('solid/calendar-alt') {{ $message->created_at->diffForHumans() }}
                          </small>
                        </section>
                      </div>
                    </article>
                    
                    @endif



                    {{ $message->user_id != Auth::id() ? Modules\Messages\Facades\Talk::makeSeen($message->id) : '' }}

                    @endforeach
                  </ul>
                </section>
                
                
                
                <article class="chat-item chat-message clearfix" id="chat-form">
                  <a class="pull-left thumb-sm avatar">
                  <img src="{{ avatar() }}" class="img-circle"></a>
                  <section class="chat-body">
                    <form class="m-b-none" method="post" id="talkSendMessage">
                      {{ csrf_field() }}
                      <input type="hidden" name="_id" value="{{@request()->route('id')}}">
                      
                      <input type="hidden" name="to[]" value="{{@request()->route('id')}}">
                      <textarea name="message-data" id="message-data" class="form-control markdownEditor"></textarea>
                      <div class="line"></div>
                      {!! renderAjaxButton('send') !!}
                    </form>
                  </section>
                </article>
                </div> 
                
              </section>
            </section>
          </aside>
        </section>

        <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>

      </section>

      @push('pagescript')

      @include('stacks.js.markdown')

      @include('stacks.js.list')
      @include('stacks.js.talk')

      <script>
        var options = {
            valueNames: [ 'message' ]
        };

        var msgList = new List('msg-list', options);
      
      function pusherCallback(data) {
        var from = data.sender.id;
        $.ajax({
            type: 'POST',
            url: '/messages/pusher-message/' +data.id,
            data: {
              id: data.id,
              _token: '{{ csrf_token() }}'
            },
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json', 
            success: function(data){
                  toastr.info( data.sender +' has sent you a message' , 'Message Received');
                   $('#talkMessages').append(data.html);
            },

      
      });
      };
      </script>
      @endpush
      
      @endsection
