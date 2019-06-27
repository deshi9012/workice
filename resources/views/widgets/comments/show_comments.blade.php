<div id="commentMessages" class="with-responsive-img">
    @foreach ($comments as $key => $comment)
    @if($comment->isVisible())
    <article id="comment-{{ $comment->id }}" class="comment-item">
        <a class="pull-left thumb-sm avatar">
            <img src="{{ $comment->user->profile->photo }}" class="img-circle">
        </a>
        <span class="arrow left"></span>
        <section class="comment-body panel panel-default {{ $comment->user_id != Auth::id() ? 'comment-bg' : '' }}">
            <header class="panel-heading bg-white">
                <a href="#">
                    {{  $comment->user->name  }}
                </a>
                @if($comment->unread == 1 && $comment->user_id != Auth::id())
                <span class="label label-danger">@icon('solid/envelope-open') New</span>
                @endif
                @if($comment->is_note === 1)
                <span class="m-l-xs text-danger">
                    ---- @icon('solid/sticky-note') Internal Note ----
                </span>
                @else
                <label class="label bg-light m-l-xs">
                    {{ $comment->user->profile->job_title }} {{ $comment->user->profile->company > 0 ? ' - '.$comment->user->profile->business->name : '' }}
                </label>
                @endif
                
                <span class="text-muted m-l-sm pull-right">
                    @if ($comment->user_id == Auth::id() || can('comments_delete'))
                    <a href="#" class="deleteComment" data-comment-id="{{$comment->id}}" title="@langapp('delete')">
                        @icon('solid/trash-alt', 'pull-right')
                    </a>
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
                
                @if ($withReplies)
                <a href="{{ route('comments.reply', ['id' => $comment->id, 'module' => $comment->module])  }}"
                    data-toggle="ajaxModal" class="pull-right" data-rel="tooltip" title="@langapp('reply') ">
                    @icon('solid/comments')
                </a>
                
                @endif
                @if ($comment->user_id == Auth::id())
                <a href="{{  route('comments.edit', ['id' => $comment->id])  }}" data-toggle="ajaxModal" class="pull-right m-r-sm" data-rel="tooltip" title="@langapp('edit') ">
                    @icon('solid/pencil-alt')
                </a>
                @endif
                <div class="comment-action m-t-sm">
                    <small class="block text-muted">@icon('solid/calendar-alt') {{ dateElapsed($comment->created_at) }}</small>
                </div>
                @include('partial._show_files', ['files' => $comment->files, 'limit' => true])
                
                
            </div>
            @if ($withReplies)
            @if($comment->replies->count() > 0)
            <div class="panel-body">
                @widget('Comments\ShowComments', ['comments' => $comment->replies])
            </div>
            @endif
            @endif
        </section>
        
        
    </article>
    @php $comment->markRead();  @endphp
    @endif
    @endforeach
    @if ($comments->count() === 0)
    <article id="comment-id-1" class="comment-item">
        <section class="comment-body panel-default">
            
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                @icon('solid/info-circle') @langapp('no_comments_found')
            </div>
            
        </section>
    </article>
    @endif
    
</div>