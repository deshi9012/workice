<section class="panel panel-default">
    <header class="header bg-white b-b clearfix">
        <div class="row m-t-sm">
            <div class="col-sm-12 m-b-xs">
                @if ($project->isTeam() || can('milestones_create'))
                
                <a href="{{ route('milestones.create', $project->id) }}" data-toggle="ajaxModal" class="btn btn-sm btn-{{ get_option('theme_color')  }}">
                    @icon('solid/plus') @langapp('create')
                </a>
                @endif
            </div>
        </div>
    </header>
    <section class="scrollable wrapper overflow-x-auto">
        
        <div class="card">
            <div class="card-body collapse in">
                <div class="card-block">
                    <div class="overflow-hidden">
                        <div id="todo-lists-basic-demo"
                            class="lobilists-wrapper lobilists single-line sortable ps-container ps-theme-dark ps-active-x">
                            @foreach ($project->milestones as $milestone)
                            <div class="lobilist-wrapper ps-container ps-theme-dark ps-active-y kanban-col">
                                <div id="lobilist-list-0" class="lobilist lobilist-info">
                                    <div class="lobilist-header ui-sortable-handle">
                                        <div class="lobilist-actions">
                                            @if (isAdmin() || can('tasks_create'))
                                            <a href="{{  route('tasks.create', ['project' => $project->id, 'milestone' => $milestone->id])  }}"
                                                data-toggle="ajaxModal"
                                                class="btn btn-xs btn-{{ get_option('theme_color') }} btn-rounded">
                                                @icon('solid/plus') @langapp('task')
                                            </a>
                                            @endif
                                        </div>
                                        <div class="lobilist-title text-ellipsis text-muted text-uc">
                                            <a href="{{ route('projects.view', ['id' => $milestone->project_id, 'tab' => 'milestones', 'item' => $milestone->id]) }}">
                                                {{  $milestone->milestone_name  }}
                                            </a>
                                            <div class="progress progress-xxs progress-striped active m-t-xs">
                                                <div class="progress-bar progress-bar-success" data-toggle="tooltip" data-original-title="{{ $milestone->progress }}%" style="width: {{ $milestone->progress }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="lobilist-body scrumboard slim-scroll" data-height="400" data-disable-fade-out="true"
                                        data-distance="0" data-size="5px"
                                        data-color="#333333">
                                        <ul class="lobilist-items ui-sortable" id="{{  $milestone->id  }}">
                                            @php
                                            $counter = 0;
                                            @endphp
                                            @foreach ($milestone->tasks as $task)
                                            <li id="{{  $task->id  }}" draggable="true" class="lobilist-item kanban-entry grab">
                                                <div class="lobilist-item-title text-ellipsis font14">
                                                    <a href="{{  route('projects.view', ['id' => $task->project_id, 'module' => 'tasks', 'item' => $task->id])  }}">
                                                        {{  $task->name  }}
                                                    </a>
                                                </div>
                                                <div class="lobilist-item-description text-muted">
                                                    <span class="">
                                                        {{  $task->user->name  }}
                                                    </span>
                                                    <div class="inline pull-right">
                                                        <div class="easypiechart text-success" data-percent="{{ $task->progress  }}"
                                                            data-line-width="2" data-track-Color="#f0f0f0"
                                                            data-bar-color="#00b393" data-rotate="270"
                                                            data-scale-Color="false" data-size="20" data-animate="2000" data-rel="tooltip" title="{{ $task->progress }}%">
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="lobilist-item-duedate">
                                                    {{ dateTimeString($task->due_date)  }}
                                                </div>
                                                <span class="thumb-xs avatar lobilist-check">
                                                    <img src="{{ $task->user->profile->photo }}" class="img-circle">
                                                </span>
                                                <div class="todo-actions">
                                                    <div class="edit-todo todo-action">
                                                        <a href="{{  route('tasks.edit', ['id' => $task->id])  }}"
                                                            data-toggle="ajaxModal">
                                                            @icon('solid/pencil-alt')
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="drag-handler"></div>
                                            </li>
                                            @php $counter++; @endphp
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="modal modal-static fade" id="processing-modal" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog processing-modal">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="text-center">
                                                @icon('solid/sync-alt', 'fa-4x fa-spin')
                                                <h4>Processing...</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
    </section>
    @push('pagescript')
    <script type="text/javascript">
    $(document).ready(function () {
    var kanbanCol = $('.scrumboard');
    draggableInit();
    $('.panel-heading').click(function () {
    var $panelBody = $(this).parent().children('.panel-body');
    $panelBody.slideToggle();
    });
    });
    function draggableInit() {
    var sourceId;
    $('[draggable=true]').bind('dragstart', function (event) {
    sourceId = $(this).parent().attr('id');
    event.originalEvent.dataTransfer.setData("text/plain", event.target.getAttribute('id'));
    });
    $('.scrumboard').bind('dragover', function (event) {
    event.preventDefault();
    });
    $('.scrumboard').bind('drop', function (event) {
    var children = $(this).children();
    var targetId = children.attr('id');
    if (sourceId != targetId) {
    var elementId = event.originalEvent.dataTransfer.getData("text/plain");
    $('#processing-modal').modal('toggle');
    setTimeout(function () {
    var element = document.getElementById(elementId);
    task_id = element.getAttribute('id');
    axios.post('/api/v1/tasks/'+task_id+'/milestone', {
    'milestone': targetId
    })
    .then(function (response) {
    toastr.success(response.data, '@langapp('success') ');
    })
    .catch(function (error) {
    toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
    });
    children.prepend(element);
    $('#processing-modal').modal('toggle');
    }, 1000);
    }
    event.preventDefault();
    });
    }
    </script>
    @endpush
</section>