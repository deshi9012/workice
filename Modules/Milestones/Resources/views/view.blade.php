<section class="panel panel-default">

    <header class="header bg-white b-b clearfix">
        <div class="row m-t-sm">
            <div class="col-sm-12 m-b-xs">


                @can('milestones_update')
                    <a href="{{ route('milestones.edit', ['id' => $milestone->id]) }}"
                       data-toggle="ajaxModal" class="btn btn-sm btn-{{ get_option('theme_color') }}">
                        @icon('solid/pencil-alt') @langapp('edit') 
                    </a>
                @endcan

                @can('milestones_delete')
                    <a href="{{ route('milestones.delete', ['id' => $milestone->id]) }}"
                       data-toggle="ajaxModal" title="@langapp('delete')  "
                       class="btn btn-sm btn-danger">@icon('solid/trash-alt') @langapp('delete')  
                    </a>
                @endcan

            </div>
        </div>
    </header>
    <div class="panel-body">

        <div class="col-md-6">

            <section class="panel panel-default">
                <header class="panel-heading">@icon('solid/info-circle') @langapp('milestone')  </header>
                <div class="panel-body">

                    <span class="text-uc text-xs text-muted">@langapp('milestone_name')  </span> :
                    <span class="">{{ $milestone->milestone_name }}</span>
                    <hr class="no-margin">

                    <span class="text-uc text-xs text-muted">@langapp('project')  </span>: 
                    <span class="">{{ $project->name }}</span>
                    <hr class="no-margin">

                    <div class="inline pull-right">
                        <div class="easypiechart text-success" data-percent="{{ $milestone->progress }}"
                             data-line-width="5" data-track-Color="#f0f0f0"
                             data-bar-color="{{ get_option('chart_color') }}" data-rotate="270"
                             data-scale-Color="false" data-size="70" data-animate="2000">
                            <span class="small text-muted">{{ $milestone->progress }}%</span>
                        </div>
                    </div>

                    <span class="text-uc text-xs text-muted">@langapp('start_date')  </span>
                    <p>{{  dateString($milestone->start_date)  }}</p>

                    <small class="text-uc text-xs text-muted">@langapp('due_date')  </small>
                    <p>{{ dateString($milestone->due_date)  }}
                        {!! $milestone->due_date < now() ? '<span class="label label-danger">'.langapp('overdue').'</span>' : '' !!}
                    </p>

                    <small class="text-uc text-xs text-muted">@langapp('description')  </small>
                    
                    @parsedown($milestone->description)

                </div>
            </section>
        </div>

        <div class="col-md-6">

            <section class="panel">
                <header class="panel-heading">@icon('solid/tasks') @langapp('tasks')  

                    @if (can('tasks_create') || $project->isTeam())

                        <a href="{{  route('tasks.create', ['id' => $milestone->project_id, 'milestone' => $milestone->id])  }}"
                           data-toggle="ajaxModal" class="btn btn-xs btn-{{  get_option('theme_color')  }} pull-right">
                            @icon('solid/plus') @langapp('create')  
                        </a>

                    @endif
                </header>
                <div class="">

                    <ul class="list-group alt">
                    @foreach ($milestone->tasks as $key => $task)
                      <li class="list-group-item">
                        <div class="media">
                          <span class="pull-left thumb-sm">
                            <img src="{{ $task->user->profile->photo }}" title="{{ $task->user->name }}" data-rel="tooltip" class="img-circle">
                        </span>
                          <div class="pull-right text-danger m-t-sm">
                            <span class="small text-muted">[{{ secToHours($task->time) }}]</span>
                            <span class="task_complete">
                            <label>
                                <input type="checkbox" name="visible" data-id="{{ $task->id }}" {{ $task->timerRunning() ? 'disabled' : '' }} {{ $task->progress === 100 ? 'checked' : '' }}>
                                <span class="label-text"></span>
                            </label>
                            </span>
                          </div>
                          <div class="media-body">
                            <div><a href="{{ route('projects.view', ['project' => $task->project_id, 'tab' => 'tasks', 'item' => $task->id]) }}">{{ $task->name }}</a></div>
                            <small class="text-muted">{{ dateElapsed($task->due_date) }} <span class="text-bold">[{{ $task->progress }}%]</span></small>
                          </div>
                        </div>
                      </li>
                    @endforeach
                    </ul>



                </div>
            </section>

        </div>


    </div>


</section>

@push('pagescript')
    @include('tasks::_ajax.done')
@endpush