<article id="comment-{{ $comment->id }}" class="comment-item">
                <a class="pull-left thumb-sm avatar">
                    <img src="{{  $comment->user->profile->photo }}" class="img-circle">
                </a>
                <span class="arrow left"></span>
                <section class="comment-body panel panel-default">
                    <header class="panel-heading bg-white">
                        <a href="#" class="text-semibold">
                            {{  $comment->user->name  }}
                        </a>

                            @if($comment->is_note === 1)
                                <span class="m-l-xs text-danger">
                                    ---- @icon('solid/sticky-note') Internal Note ----
                                </span>
                            @else
                                <label class="label bg-light m-l-xs">
                                    {{ $comment->user->profile->job_title }}
                                </label>
                            @endif

                        <span class="text-muted m-l-sm pull-right">
                            
                            @if ($comment->user_id === Auth::id())
                            <a href="#" class="deleteComment" data-comment-id="{{$comment->id}}" title="@langapp('delete') ">@icon('solid/trash-alt')</a>
                            @endif

                        </span>
                    </header>
                    <div class="panel-body">

                        @if($comment->is_note === 1)
                                <blockquote class="comment-note">
                                    @parsedown(str_replace('[NOTE]', '' , $comment->message))
                                </blockquote>
                            @else
                                <div class="text-justify">
                                    @parsedown($comment->message)
                                </div>
                        @endif


                    @if ($comment->user_id === Auth::id())
                            <a href="{{  route('comments.edit', ['id' => $comment->id])  }}" data-toggle="ajaxModal" class="pull-right m-r-sm">@icon('solid/pencil-alt')</a>
                    @endif


                        <div class="comment-action m-t-sm">
                            <small class="block text-muted">@icon('solid/clock') {{ dateElapsed($comment->date_posted) }}</small>
                        </div>

                        @include('partial._show_files', ['files' => $comment->files, 'limit' => true])

                    </div>
                </section>
            </article>