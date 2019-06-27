<section class="comment-list block">
        <section class="slim-scroll" data-height="500" data-disable-fade-out="true" data-distance="0"
            data-size="5px" data-color="#333333">
            @foreach ($activities as $key => $activity)
            <article id="comment-id-1" class="comment-item small">
                <div class="pull-left thumb-sm">
                    <img src="{{ $activity->owner->profile->photo }}"
                    class="img-circle">
                </div>
                <section class="comment-body m-b-md">
                    <header class="b-b">
                        <strong class="text-muted">
                        {{ $activity->owner->name }}</strong>
                        <span class="text-muted text-xs pull-right">
                            {{ dateElapsed($activity->activity_date) }}
                        </span>
                    </header>
                    <div class="m-t-xs">
                        {!! __('activity.'.$activity->activity, ['value1' => '<strong>'.$activity->value1.'</strong>', 'value2' => '<strong>'.$activity->value2.'</strong>']) !!}
                    </div>
                </section>
            </article>
            
            @endforeach
        </section>
    </section>