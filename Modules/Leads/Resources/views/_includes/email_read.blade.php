@php $email = Emailing::findOrFail($option); @endphp

<div class="wrapper b-b b-light">
    <a href="#" class="pull-left m-r-sm"><i class="fas fa-{{ $email->opened === 1 ? 'envelope-open text-success' : 'envelope text-danger'  }}"></i></a>

    <a href="{{ route('leads.emails', ['id' => $email->id, 'action' => 'delete'])  }}" data-toggle="ajaxModal" class="pull-right text">@svg('solid/trash-alt')
    </a>

    <h4 class="m-n"> {{ $email->subject }}</h4>
</div>
<div class="padder m-t">
    <div class="block clearfix m-b">
        <a href="#" class="thumb-xs inline">
            <img src="{{ $email->sender->profile->photo }}" class="img-circle"></a>
        <span class="inline m-t-xs">{{ $email->sender->name }}

            <a href="mailto:{{ $email->meta['sender'].'?subject='.$email->subject }}">
                &lt; {{ $email->meta['sender'] }} &gt; </a> to <small class="text-muted"> {{ implode(',', $email->meta['to']) }}</small>
        </span>
        <div class="pull-right inline">{{ dateTimeFormatted($email->created_at) }} (<span class="small">{{ dateElapsed($email->created_at) }}</span>)

        </div>
    </div>
    <div class="line pull-in"></div>
    <blockquote>@parsedown($email->message)</blockquote>

    <div class="m-sm">


        <ul class="mail-attachments">
            @foreach ($email->files() as $file)
                <li>
                                            <span class="mail-attachments-preview">
                                                <i class="fas {{ getIcon($file->ext) }} fa-2x"></i>
                                            </span>

                    <div class="mail-attachments-content">
                        <span class="">{{ $file->filename }}</span>

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
                    <label class="label bg-info m-l-xs">{{ implode(',', $reply->meta['to']) }}</label>

                    

                    <span class="text-muted m-l-sm pull-right">
                            @icon('solid/calendar-alt')
                        {{ dateTimeFormatted($reply->created_at) }} (<span class="small">{{ dateElapsed($reply->created_at) }}</span>)
                        <i class="fas fa-{{ $reply->opened === 1 ? 'envelope-open text-success' : 'envelope text-danger'  }}"></i>
                          </span>
                </header>
                <div class="panel-body">
                    @parsedown($reply->message)

                </div>
            </section>
        </article>

@endforeach



    <article class="comment-item media" id="comment-form">
        <a class="pull-left thumb-sm avatar"><img src="{{ avatar() }}" class="img-circle"></a>
        <section class="media-body display-block">

            <div class="padder">
                <div class="panel bg-light">
                    <div class="panel-body">
                        <h4 class="font-thin ">Type email reply (Will be sent to {{ $email->lead->email }})</h4>

                        {!! Form::open(['route' => 'leads.emailReply', 'class' => 'm-b-none ajaxifyForm', 'novalidate']) !!}

                        <input type="hidden" name="lead_id" value="{{  $lead->id  }}">
                        <input type="hidden" name="reply_id" value="{{  $email->id  }}">
                        <input type="hidden" name="to" value="{{  $email->lead->email  }}">
                        <input type="hidden" name="subject" value="{{  $email->subject  }}">
                        <textarea name="message" class="markdownEditor form-control"></textarea>

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
