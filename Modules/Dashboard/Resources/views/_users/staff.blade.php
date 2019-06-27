<aside class="b-l bg" id="">
    
    
    <section class="scrollable">
        <div class="slim-scroll" data-color="#333333" data-disable-fade-out="true" data-distance="0" data-height="auto" data-size="3px">
            <section class="padder">
                <div class="row m-l-none m-r-none m-sm">
                    <div class="col-sm-6 col-md-3 padder-v lt pallete b-b">
                        <a class="clear" href="{{ route('tasks.index') }}">
                            <span class="fa-stack fa-2x pull-left m-r-xs">
                                <i class="fas fa-square fa-stack-2x text-white"></i>
                                <i class="fas fa-tasks fa-stack-1x text-success"></i>
                            </span>
                            
                            <small class="text-uc" data-rel="tooltip" title="@langapp('tasks')">@langapp('tasks')</small>
                            <span class="h4 block m-t-xs text-dark">{{ Auth::user()->assignments()->where('assignable_type', Modules\Tasks\Entities\Task::class)->count() }}</span>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-3 padder-v lt pallete b-b">
                        <a class="clear" href="{{ route('projects.index') }}">
                            <span class="fa-stack fa-2x pull-left m-r-xs">
                                <i class="fas fa-square fa-stack-2x text-white"></i>
                                <i class="fas fa-clock fa-stack-1x text-dracula"></i>
                            </span>
                            <small class="text-uc" data-rel="tooltip" title="@langapp('projects')">@langapp('projects') </small>
                            <span class="h4 block m-t-xs text-dark">{{ Auth::user()->assignments()->where('assignable_type', Modules\Projects\Entities\Project::class)->count() }}</span>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-3 padder-v pallete b-b">
                        <a class="clear" href="{{ route('tickets.index') }}">
                            <span class="fa-stack fa-2x pull-left m-r-xs">
                                <i class="fas fa-square fa-stack-2x text-white"></i>
                                <i class="fas fa-life-ring fa-stack-1x text-warning"></i>
                            </span>
                            
                            <small class="text-uc" data-rel="tooltip" title="@langapp('tickets')">@langapp('tickets') </small>
                            <span class="h4 block m-t-xs text-dark"><span class="text-danger" data-rel="tooltip" title="Tickets">{{ Modules\Tickets\Entities\Ticket::where('assignee', Auth::id())->count() }}</span> </a>
                        </div>
                        <div class="col-sm-6 col-md-3 padder-v pallete b-b">
                            <a class="clear" href="{{ route('deals.index') }}">
                                <span class="fa-stack fa-2x pull-left m-r-xs">
                                    <i class="fas fa-square fa-stack-2x text-white"></i>
                                    <i class="fas fa-hand-holding-usd fa-stack-1x text-danger"></i>
                                </span>
                                
                                <small class="text-uc" data-rel="tooltip" title="@langapp('deals')">@langapp('deals')</small>
                                <span class="h4 block m-t-xs text-dark">{{ Auth::user()->deals->count() }}</span>
                            </a>
                        </div>
                        
                    </div>






            <section class="panel panel-default">
                <header class="panel-heading">@langapp('pending') @langapp('tasks')</header>
                    
                <div class="table-responsive">
                  <table class="table table-striped b-t b-light">
                    <thead>
                      <tr>
                        <th class="th-sortable" data-toggle="class">@langapp('name')</th>
                        <th>@langapp('project')</th>
                        <th>@langapp('progress')</th>
                        <th>@langapp('stage')</th>
                        <th>@langapp('due_date')</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach (Auth::user()->assignments()->where('assignable_type', Modules\Tasks\Entities\Task::class)->take(15)->get() as $task)
                            <tr>
                            <td><a href="{{ route('projects.view', ['id' => $task->assignable->project_id,'tab' => 'tasks','item' => $task->assignable->id]) }}">{{ str_limit($task->assignable->name,25) }}</a></td>
                            <td>{{ str_limit($task->assignable->name,25) }}</td>
                            <td>{{ $task->assignable->progress }}%</td>
                            <td>{{ $task->assignable->AsCategory->name }}</td>
                            <td>{{ dateTimeString($task->assignable->due_date) }}</td>
                      </tr>
                        @endforeach
                      
                      
                    </tbody>
                  </table>
                </div>


                
              </section>


@can('menu_projects')
              <section class="panel panel-default">
                <header class="panel-heading">@langapp('active') @langapp('projects')</header>
                    
                <div class="table-responsive">
                  <table class="table table-striped b-t b-light">
                    <thead>
                      <tr>
                        <th class="th-sortable" data-toggle="class">@langapp('name')</th>
                        <th>@langapp('sub_total')</th>
                        <th>@langapp('progress')</th>
                        <th>@langapp('expenses')</th>
                        <th>@langapp('due_date')</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach (Auth::user()->assignments()->where('assignable_type', Modules\Projects\Entities\Project::class)->take(15)->get() as $project)
                            <tr>
                            <td><a href="{{ route('projects.view', $project->assignable->id) }}">{{ str_limit($project->assignable->name,25) }}</a></td>
                            <td>{{ formatCurrency($project->assignable->currency, $project->assignable->sub_total) }}</td>
                            <td>{{ $project->assignable->progress }}%</td>
                            <td>{{ formatCurrency($project->assignable->currency, $project->assignable->total_expenses) }}</td>
                            <td>{{ dateTimeString($project->assignable->due_date) }}</td>
                      </tr>
                        @endforeach
                      
                      
                    </tbody>
                  </table>
                </div>


                
              </section>
   @endcan                 
@can('menu_leads')
            <section class="panel panel-default">
                <header class="panel-heading">@langapp('leads')</header>
                    
                <div class="table-responsive">
                  <table class="table table-striped b-t b-light">
                    <thead>
                      <tr>
                        <th>@langapp('name')</th>
                        <th>@langapp('source')</th>
                        <th>@langapp('stage')</th>
                        <th>@langapp('country')</th>
                        <th>@langapp('lead_value')</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach (Auth::user()->leads->take(15) as $lead)
                            <tr>
                            <td><a href="{{ route('leads.view', $lead->id) }}">{{ str_limit($lead->name,25) }}</a></td>
                            <td>{{ $lead->AsSource->name }}</td>
                            <td>{{ $lead->status->name }}</td>
                            <td>{{ $lead->country }}</td>
                            <td>{{ $lead->computed_value }}</td>
                      </tr>
                        @endforeach
                      
                      
                    </tbody>
                  </table>
                </div>


                
              </section>
@endcan
@can('menu_deals')

              <section class="panel panel-default">
                <header class="panel-heading">@langapp('deals')</header>
                    
                <div class="table-responsive">
                  <table class="table table-striped b-t b-light">
                    <thead>
                      <tr>
                        <th>@langapp('title')</th>
                        <th>@langapp('stage')</th>
                        <th>@langapp('source')</th>
                        <th>@langapp('pipeline')</th>
                        <th>@langapp('deal_value')</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach (Auth::user()->deals->take(15) as $deal)
                            <tr>
                            <td><a href="{{ route('deals.view', $deal->id) }}">{{ str_limit($deal->title,25) }}</a></td>
                            <td>{{ $deal->category->name }}</td>
                            <td>{{ $deal->AsSource->name }}</td>
                            <td>{{ $deal->pipe->name }}</td>
                            <td>{{ $deal->computed_value }}</td>
                      </tr>
                        @endforeach
                      
                      
                    </tbody>
                  </table>
                </div>


                
              </section>
                    
              @endcan      
                    
                </section>





            </div>

        </section>
        
    </aside>
    <aside class="aside-lg b-l">
        <section class="vbox">
            
            <section class="scrollable" id="feeds">
                <div class="slim-scroll padder" data-color="#333333" data-disable-fade-out="true" data-distance="0" data-height="auto" data-size="3px">
                    
                    @widget('Activities\Feed', ['activities' => Modules\Activity\Entities\Activity::where('user_id', Auth::id())->take(50)->orderByDesc('id')->get(), 'view' => 'dashboard'])
                    
                </div>
            </section>
            
        </section>
    </aside>