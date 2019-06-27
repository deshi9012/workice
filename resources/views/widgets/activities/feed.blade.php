<section class="comment-list block m-sm">
        <section class="scrollable">
            @foreach ($activities as $key => $activity)
            <article id="comment-id-{{ $activity->id }}" class="comment-item small">
                <div class="pull-left thumb-sm">
                    <img src="{{ $activity->user->profile->photo }}"
                    class="img-circle">
                </div>
                <section class="comment-body m-b-md">
                    <header class="b-b">
                        <strong class="text-muted">
                        {{ $activity->user->name }}</strong>
                        <span class="text-muted text-xs pull-right">
                            {{ dateElapsed($activity->created_at) }}
                        </span>
                    </header>
                    <div class="m-t-xs">
                        @langactivity($activity->action, ['value1' => '<span class="text-info">'.$activity->value1.'</span>', 'value2' => '<span class="text-success">'.$activity->value2.'</span>'])
                    </div>
                </section>
            </article>
            
            @endforeach
        </section>
    </section>