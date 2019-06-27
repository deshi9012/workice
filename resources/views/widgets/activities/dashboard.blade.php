<ul class="streamline streamline-dotted m-t-lg list-feed">
    @foreach ($activities as $key => $activity)
    <li class="border-{{ get_option('theme_color') }} small sl-item">
        <div class="text-muted">
            <strong>{{ $activity->user->name }}</strong>
            <a href="{{ $activity->url }}" class="pull-right">{{ dateElapsed($activity->created_at) }}</a>
            
        </div>
        <span class="">
            @langactivity($activity->action, ['value1' => '<span class="text-semibold">'.$activity->value1.'</span>', 'value2' => '<span class="text-semibold">'.$activity->value2.'</span>'])
        </span>
    </li>
    @endforeach
    
</ul>