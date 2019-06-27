<article id="message-{{$message->id}}" class="chat-item left">
  <a href="#" class="pull-left thumb-sm avatar">
  <img src="{{ $message->sender->profile->photo }}" class="img-circle"></a>
  
  <section class="chat-body">
    <div class="panel b-light text-sm m-b-none shadowed">
      <div class="panel-body">
        <span class="arrow left"></span>
        <div class="message other-message float-right m-b-sm">
          @parsedown($message->message)
        </div>
        <span class="message-data-name text-muted" >
          <a href="#" class="talkDeleteMessage" data-message-id="{{$message->id}}" title="Delete Message">
            @icon('solid/trash-alt', 'pull-right')
          </a>
        </span>
        @include('partial._show_files', ['files' => $message->files, 'limit' => true])
      </div>
    </div>
    <small class="text-muted message-data-time small">
    @icon('solid/user-circle') {{ $message->sender->name }} <span class="m-l-sm">@icon('solid/calendar-alt') {{ $message->humans_time }} @langapp('ago') </span>
    </small>
    
  </section>
</article>