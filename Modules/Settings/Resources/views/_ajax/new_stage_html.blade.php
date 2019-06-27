<li class="list-group-item" draggable="true" id="stage-{{ $stage->id }}">
                    <span class="pull-right">
                    <a href="{{ route('settings.stages.edit', $stage->id) }}" data-toggle="ajaxModal" data-dismiss="modal">
                            @icon('solid/pencil-alt', 'icon-muted fa-fw m-r-xs')
                    </a>
                        <a href="#" class="deleteStage" data-stage-id="{{ $stage->id }}">
                            @icon('solid/times', 'icon-muted fa-fw')
                        </a>
                    </span>

                    <span class="pull-left media-xs">@icon('solid/arrows-alt', 'm-r-sm')</span>

                    <div class="clear">{{ $stage->name }}
                        @if($stage->module === 'deals')
                        <span class="badge bg-info">{{ $stage->AsPipeline()->name }}</span>
                        @endif
                    </div>
                </li>