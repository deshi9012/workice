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
                              <a href="#" class="talkDeleteMessage text-white" data-message-id="{{$message->id}}" title="@langapp('delete')">
                              @icon('solid/trash-alt', 'pull-right')</a> 
                              @icon('solid/user-circle') {{ $message->sender->name }}</span>
                            </div>
                          </div>
                          <small class="text-muted message-data-time">@icon('solid/calendar-alt') {{ $message->humans_time }} @langapp('ago')</small>
                        </section>
                      </div>
                    </article>
                    