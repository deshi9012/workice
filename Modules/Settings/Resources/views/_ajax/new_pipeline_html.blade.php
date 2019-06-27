<li class="list-group-item" draggable="true" id="pipeline-{{ $pipeline->id }}">
    <span class="pull-right">
        <a href="{{ route('settings.pipelines.edit', $pipeline->id) }}" data-toggle="ajaxModal" data-dismiss="modal">
            @icon('solid/pencil-alt', 'icon-muted fa-fw m-r-xs')
        </a>
        <a href="#" class="deletePipeline" data-pipeline-id="{{ $pipeline->id }}">
            @icon('solid/times', 'icon-muted fa-fw')
        </a>
    </span>
    <span class="pull-left media-xs">@icon('solid/arrows-alt', 'm-r-sm')</span>
    <div class="clear">{{ $pipeline->name }}</div>
</li>