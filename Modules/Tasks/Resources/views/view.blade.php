<section class="panel panel-default">
    @if ($task->project_id == $project->id)
    <header class="header bg-white b-b clearfix">
        <div class="col-sm-12 m-b-xs m-t-sm">
            @if ($task->progress < 100 && $isTeam)
            @if ($task->timerRunning())
            <a class="btn btn-sm btn-danger"
                href="{{  route('clock.stop', ['id' => $task->id, 'module' => 'tasks'])  }}">
                @icon('solid/stop-circle') @langapp('stop')
            </a>
            @else
            <a class="btn btn-sm btn-success" href="{{  route('clock.start', ['id' => $task->id, 'module' => 'tasks'])  }}">
                @icon('solid/play') @langapp('start')
            </a>
            @endif
            @endif
            @can('reminders_create')
            <a href="{{ route('calendar.reminder', ['module' => 'tasks', 'id' => $task->id]) }}" class="btn btn-sm btn-{{ get_option('theme_color') }}" data-toggle="ajaxModal" data-rel="tooltip"  data-placement="bottom" title="@langapp('set_reminder')">
                @icon('solid/clock')
            </a>
            @endcan
            @if (can('tasks_update') || $task->user_id == \Auth::id())
            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-{{ get_option('theme_color') }}" data-toggle="ajaxModal" data-rel="tooltip" title="@langapp('make_changes')">
                @icon('solid/pencil-alt') @langapp('edit')
            </a>
            @endif
            <div class="btn-group btn-group-animated">
                <button type="button" class="btn btn-sm btn-{{ get_option('theme_color') }} dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                @icon('solid/ellipsis-h')
                </button>
                <ul class="dropdown-menu">
                    @if ($task->progress < 100 && $isTeam || can('tasks_complete'))
                    <li>
                        <a href="{{ route('tasks.close', $task->id) }}" data-rel="tooltip" title="@langapp('mark_as_complete')">
                            @icon('solid/check-circle') @langapp('mark_as_complete')
                        </a>
                    </li>
                    @endif
                    <li>
                        <a href="{{ route('files.upload', ['module' => 'tasks', 'id' => $task->id]) }}" data-toggle="ajaxModal">
                            @icon('solid/upload') @langapp('upload_file')
                        </a>
                    </li>
                    @if(can('tasks_update') || $task->user_id == \Auth::id())
                    <li>
                        <a href="{{ route('users.pin', ['id' => $task->id, 'module' => 'tasks']) }}" data-rel="tooltip" title="@langapp('pin_sidebar')" data-placement="top">
                            @icon('solid/bookmark') @langapp('pin_sidebar')
                        </a>
                    </li>
                    @endif
                    @if (can('tasks_create'))
                    <li>
                        <a href="{{ route('tasks.copy', $task->id) }}" data-toggle="ajaxModal" data-rel="tooltip" title="@langapp('copy')" data-placement="top">
                            @icon('solid/copy') @langapp('copy')
                        </a>
                    </li>
                    @endif
                    
                    
                    
                </ul>
            </div>
            @if (can('tasks_delete') || $task->user_id == \Auth::id())
            <a href="{{  route('tasks.delete', $task->id)  }}"
                data-toggle="ajaxModal" title="@langapp('delete')" class="btn btn-sm btn-danger pull-right">
                @icon('solid/trash-alt') @langapp('delete')
            </a>
            @endif
            
        </div>
    </header>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-body">
                    
                    <aside class="col-lg-4 b-r">
                        <section class="scrollable">
                            <div class="clearfix m-b">
                                <a href="#" class="pull-left thumb m-r">
                                    <img src="{{ $task->user->profile->photo }}" class="img-circle" data-toggle="tooltip" data-title="{{ $task->user->name  }}" data-placement="right">
                                </a>
                                <div class="clear">
                                    <div class="h3 m-t-xs m-b-xs">{{ $task->user->name }}</div>
                                    
                                    @icon('solid/tasks', 'text-muted') {{ $task->name }}
                                    
                                </div>
                            </div>
                            @if ($task->is_recurring)
                            <div class="alert alert-danger hidden-print">
                                @icon('solid/calendar-alt') This task will recur on {{ dateFormatted($task->recurring->next_recur_date) }}
                            </div>
                            @endif
                            
                            <div class="panel wrapper panel-success">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <a href="#">
                                            <span class="m-b-xs block">@langapp('total_time')  </span>
                                            <small class="text-muted">{{  secToHours($task->time)  }}</small>
                                        </a>
                                    </div>
                                    <div class="col-xs-6">
                                        <a href="#">
                                            <span class="m-b-xs block">@langapp('estimated_hours')  </span>
                                            <small class="text-muted">{{  $task->estimated_hours  }} @langapp('hours')  </small>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="progress progress-xs {{ $task->progress != '100' ? 'progress-striped active' : '' }} m-t-sm">
                                <div class="progress-bar progress-bar-{{get_option('theme_color') }}" data-toggle="tooltip" data-original-title="{{  $task->progress  }}%" style="width: {{ $task->progress }}%"></div>
                            </div>
                            <small class="text-uc text-xs text-muted">@langapp('hourly_rate')</small>
                            <div class="m-sm text-dark">{{ $task->hourly_rate }}/ hr</div>
                            <small class="text-uc text-xs text-muted">@langapp('estimated_price')</small>
                            <div class="m-sm text-dark">{{ $task->est_price }}</div>
                            <div>
                                @if ($task->milestone_id > 0)
                                <small class="text-uc text-xs text-muted">@langapp('milestone')  </small>
                                <p>
                                    <a href="{{  route('projects.view', ['id' => $task->project_id, 'tab' => 'milestones', 'item' => $task->milestone_id])  }}">
                                        {{  optional($task->AsMilestone)->milestone_name  }}
                                    </a>
                                </p>
                                @endif
                                <small class="text-uc text-xs text-muted">@langapp('start_date')</small>
                                <p>
                                    <label class="label label-success">
                                        {{ dateFormatted($task->created_at)  }}
                                    </label>
                                </p>
                                <small class="text-uc text-xs text-muted">@langapp('end_date')</small>
                                <p>
                                    <label class="label label-danger">
                                        {{  dateFormatted($task->due_date)  }}
                                    </label>
                                </p>

                                <small class="text-uc text-xs text-muted">@langapp('created_at')</small>
                                <p>
                                    <label class="label label-default">
                                        {{  dateFormatted($task->created_at)  }}
                                    </label>
                                </p>

                                <small class="text-uc text-xs text-muted">@langapp('description')  </small>
                                @parsedown($task->description)
                                @if ($project->isTeam() || can('projects_view_team'))
                                <div class="line"></div>
                                <small class="text-uc text-xs text-muted">@langapp('team_members')  </small>
                                
                                
                                <ul class="list-unstyled team-info m-sm">
                                    @foreach ($task->assignees as $assignee)
                                    <li><img src="{{ $assignee->user->profile->photo  }}" data-toggle="tooltip" data-title="{{  $assignee->user->name  }}" data-placement="top"></li>
                                    @endforeach
                                </ul>
                                
                                
                                @endif
                                
                                @if($isTeam || isAdmin())
                                <div class="line"></div>
                                <small class="text-uc text-xs text-muted">@langapp('tags')</small>
                                
                                @php
                                $data['tags'] = $task->tags;
                                @endphp
                                @include('partial.tags', $data)
                                
                                @endif
                                <small class="text-uc text-xs text-muted">
                                @langapp('vaults')
                                <a href="{{ route('extras.vaults.create', ['module' => 'tasks', 'id' => $task->id]) }}" class="btn btn-xs btn-danger pull-right" data-toggle="ajaxModal">@icon('solid/plus')</a>
                                </small>
                                <div class="line"></div>
                                @widget('Vaults\Show', ['vaults' => $task->vault])
                                <small class="text-uc text-xs text-muted">@langapp('files')  </small>
                                @include('partial._show_files', ['files' => $task->files, 'limit' => true])
                                
                                
                            </div>
                        </section>
                    </aside>
                    <aside class="col-lg-8">
                        <section class="scrollable">
                            <div id="tabs">
                                <ul class="nav nav-tabs" id="prodTabs">
                                    <li class="active"><a href="#tab_comments">@langapp('comments')</a></li>
                                    <li><a href="#tab_todos" data-url="/tasks/ajax/todos/{{ $task->id }}">@langapp('todo')</a></li>
                                    <li><a href="#tab_timesheets" data-url="/tasks/ajax/timesheets/{{ $task->id }}">@langapp('timesheets')</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab_comments" class="tab-pane active">
                                        <section class="comment-list block">
                                            <article class="comment-item" id="comment-form">
                                                <a class="pull-left thumb-sm avatar">
                                                    <img src="{{ avatar() }}" class="img-circle">
                                                </a>
                                                <span class="arrow left"></span>
                                                <section class="comment-body">
                                                    <section class="panel panel-default">
                                                        @widget('Comments\CreateWidget', ['commentable_type' => 'tasks' , 'commentable_id' => $task->id, 'hasFiles' => true])
                                                        
                                                        
                                                    </section>
                                                </section>
                                            </article>
                                            
                                            @widget('Comments\ShowComments', ['comments' => $task->comments])
                                            
                                            
                                            
                                        </section>
                                    </div>
                                    <div id="tab_todos" class="tab-pane active"></div>
                                    <div id="tab_timesheets" class="tab-pane active"></div>
                                </div>
                            </div>
                            
                            
                        </section>
                    </aside>
                    @endif
                    
                </div>
            </section>
        </div>
    </div>
    @push('pagescript')
    @include('stacks.js.markdown')
    @include('comments::_ajax.ajaxify')
    <script>
    $('#tabs').on('click','.tablink,#prodTabs a',function (e) {
    e.preventDefault();
    var url = $(this).attr("data-url");
    if (typeof url !== "undefined") {
        var pane = $(this), href = this.hash;
    $(href).load(url,function(result){
        pane.tab('show');
    });
    } else {
        $(this).tab('show');
    }
    });
    </script>
    @endpush