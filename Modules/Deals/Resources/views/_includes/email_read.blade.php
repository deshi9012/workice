@php $email = Emailing::findOrFail($option); @endphp

<div class="wrapper b-b b-light">
    <a href="#" class="pull-left m-r-sm">@icon('solid/'.{{ $email->opened ? 'envelope' : 'envelope-open'  }})</a>

    <a href="{{ route('deals.emails', ['id' => $email->id, 'action' => 'delete'])  }}" data-toggle="ajaxModal" class="pull-right text">@svg('solid/trash-alt')
    </a>

    <h4 class="m-n"> {{ $email->subject }}</h4>
</div>
<div class="padder m-t">
    <div class="block clearfix m-b">
        <a href="#" class="thumb-xs inline">
            <img src="{{ avatar($email->from) }}" class="img-circle"></a>
        <span class="inline m-t-xs">{{ $email->sender->name }}
            <a href="mailto:{{ $email->meta['sender'].'?subject='.$email->subject }}">
                &lt; {{ $email->meta['sender'] }} &gt; </a> to <small class="text-muted"> {{ implode(',', $email->meta['to']) }}</small>
        </span>
        <div class="pull-right inline">{{ dateTimeFormatted($email->created_at) }} (<em>{{ dateElapsed($email->created_at) }}</em>)

        </div>
    </div>
    <div class="line pull-in"></div>
    @parsedown($email->message)

    <div class="m-sm">


        <ul class="mail-attachments">
            @foreach ($email->files() as $file)
                <li>
                    <span class="mail-attachments-preview">
                        @icon('solid/'{{ getIcon($file-ext) }}, 'fa-2x')
                    </span>

                    <div class="mail-attachments-content">
                        <span class="text-semibold">{{ $file->filename }}</span>

                        <ul class="list-inline list-inline-condensed no-margin">
                            <li class="text-muted">{{ $file->size }} KB</li>
                            <li>
                                <a href="{{ route('files.download', ['id' => $file->id]) }}">
                                    @langapp('download') 
                                </a>
                            </li>
                            <li><a href="{{ route('files.delete', ['id' => $file->id]) }}" data-toggle="ajaxModal">
                                    @langapp('delete') 
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endforeach


        </ul>
    </div>

</div>





<section class="comment-list block">
    @foreach ($email->replies() as $reply)
        <article id="comment-id-1" class="comment-item">
            <a class="pull-left thumb-sm avatar">
                <img src="{{ avatar($reply->from) }}" class="img-circle">
            </a>
            <span class="arrow left"></span>
            <section class="comment-body panel panel-default">
                <header class="panel-heading bg-white">
                    <a href="#">{{ $reply->sender->name }}</a>
                    <label class="label bg-info m-l-xs">{{ $reply->meta['to'] }}</label>
                    <span class="text-muted m-l-sm pull-right">
                            @icon('solid/calendar-alt')
                        {{ dateElapsed($reply->created_at) }}
                          </span>
                </header>
                <div class="panel-body">
                    <div>@parsedown($reply->message)</div>

                </div>
            </section>
        </article>

@endforeach



<!-- comment form -->
    <article class="comment-item media" id="comment-form">
        <a class="pull-left thumb-sm avatar"><img src="{{ avatar() }}" class="img-circle"></a>
        <section class="media-body display-block">

            <div class="padder">
                <div class="panel bg-light">
                    <div class="panel-body">
                        <h4 class="font-thin ">Type email reply (Will be sent to {{ $email->meta['sender'] }})</h4>

                        {!! Form::open(['route' => 'deals.emailReply', 'class' => 'm-b-none ajaxifyForm', 'novalidate']) !!}

                        <input type="hidden" name="deal_id" value="{{  $deal->id  }}">
                        <input type="hidden" name="reply_id" value="{{  $email->id  }}">
                        <input type="hidden" name="recipient" value="{{  $email->meta['sender']  }}">
                        <input type="hidden" name="subject" value="{{  $email->subject  }}">
                        <textarea name="message" class="markdownEditor"></textarea>

                        <footer class="panel-footer bg-light lter">
                            {!!  renderAjaxButton('send')  !!}
                            <ul class="nav nav-pills nav-sm">
                            </ul>
                        </footer>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>



        </section>
    </article>
</section>




@php $email->markRead(); @endphp
