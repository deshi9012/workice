<div class="">
    @if ($project->client_id <= 0)
    <div class="alert alert-danger">
        <button class="close" data-dismiss="alert" type="button">×</button>
        @icon('solid/info-circle') {{ __('No Client attached to this project.') }}
    </div>
    @endif
    
    <div>
        <strong>
        @langapp('progress')
        </strong>
        <div class="pull-right">
            <strong class="{{ ($project->progress < 100) ? 'text-danger' : 'text-success' }}">
            {{ $project->progress }}%
            </strong>
        </div>
    </div>
    <div class="progress-xxs mb-0 {{ ($project->progress != '100') ? 'progress-striped active' : '' }} inline-block progress">
        <div class="progress-bar progress-bar-{{ get_option('theme_color') }} " data-original-title="{{ $project->progress }}%" data-toggle="tooltip" style="width: {{ $project->progress }}%">
        </div>
    </div>

    @asyncWidget('Projects.TimerChart', ['project' => $project->id])

    
    <div class="row m-t-sm">
        <div class="col-lg-4 b-r">
            <div class="m-t m-b">
                <div class="line"></div>
<small class="text-uc text-xs text-muted">@langapp('name')</small>
<div class="m-xs">{{ $project->name }}</div>

            @can('projects_view_clients')
                @if ($project->client_id > 0)
            <div class="line"></div>
            <small class="text-uc text-xs text-muted">@langapp('client')</small>
            <div class="m-xs">
                <a href="{{  route('clients.view', ['id' => $project->client_id])  }}">{{ $project->company->name }}</a>
            </div>
                @endif
            @endcan

            @if ($project->deal_id > 0)
            <div class="line"></div>
            <small class="text-uc text-xs text-muted">@langapp('deal')</small>
            <div class="m-xs">
                <a href="{{  route('deals.view', $project->deal_id)  }}">{{ $project->deal->name }}</a>
            </div>
                
            @endif

            @if ($project->contract_id > 0)
            <div class="line"></div>
            <small class="text-uc text-xs text-muted">@langapp('contract')</small>
            <div class="m-xs">
                <a href="{{  route('contracts.view', ['id' => $project->contract_id])  }}">{{ $project->contract->contract_title }}</a>
            </div>
                
            @endif

            <div class="line"></div>
            <small class="text-uc text-xs text-muted">@langapp('information')</small>
            <div class="m-xs">
                <span class="text-muted">@langapp('start_date'): </span>
                <span class="">{{ dateTimeFormatted($project->start_date)  }}</span>
            </div>
            
            <div class="m-xs">
                <span class="text-muted">@langapp('due_date'): </span>
                @if (!empty($project->due_date))

                <span class="">{{ dateTimeFormatted($project->due_date)  }}
                @if (time() > strtotime($project->due_date) && $project->progress < 100)
                    <span class="badge bg-danger">
                        @langapp('overdue')
                    </span>
                    @endif
                </span>
                @else
                    @langapp('ongoing')
                @endif
            </div>

            @if ($project->progress < 100)
            <div class="m-xs">
                <span class="text-muted">@langapp('deadline'): </span>
                <span class="">{{ (time() > strtotime($project->due_date)) ? '- ' : '' }} {{ dueInDays($project->due_date) }} @langapp('days')</span>
            </div>
            @endif

            <div class="m-xs">
                <span class="text-muted">@langapp('status'): </span>
                <span class="">{{ $project->status }}</span>
            </div>


            @can('projects_view_cost')
            <div class="line"></div>
            <small class="text-uc text-xs text-muted">@langapp('cost')</small>
            <div class="m-xs">
                <span class="text-muted">@langapp('estimated_hours'): </span>
                <span class="">{{ $project->estimate_hours }} <small>@langapp('hours')</small></span>
            </div>

            <div class="m-xs">
                <span class="text-muted">@langapp('hourly_rate'): </span>
                <span class="">{{ $project->hourly_rate }}<small>/hr</small></span>
            </div>

            <div class="m-xs">
                <span class="text-muted">@langapp('estimated_price'): </span>
                <span class="">{{  formatCurrency($project->currency, $project->estimate_hours *  $project->hourly_rate) }}</span>
            </div>

            <div class="m-xs">
                <span class="text-muted">@langapp('used_budget'): </span>
                <span class="badge bg-{{ ($project->used_budget > 100) ? 'danger' : 'success' }}">
                    {{ $project->used_budget }}%
                </span>
            </div>

            @endcan

            @can('projects_view_expenses')
            <div class="line"></div>
            <small class="text-uc text-xs text-muted">@langapp('expenses')</small>
            <div class="m-xs">
                <span class="text-muted">@langapp('amount'): </span>
                <span class="">{{ formatCurrency($project->currency, $project->total_expenses) }}</span>
            </div>
            @endcan
                
    
            <div class="line"></div>
            @if($project->isTeam() || isAdmin() || can('projects_view_team'))
            <small class="text-uc text-xs text-muted">@langapp('team_members')</small>

                <ul class="media-list m-t-md">
                    @foreach ($project->assignees as $member)
                    <li class="media">
                        <span class="pull-right text-muted">
                            @icon('regular/clock', 'text-primary') {{ $member->user->profile->hourly_rate }}/ hr

                            @if(isAdmin() || Auth::id() == $project->manager)
                            <a href="{{ route('teams.manager', ['project_id' => $project->id, 'member_id' => $member->user->id]) }}" class="m-r-xs" data-rel="tooltip" title="Modify Project Manager">@icon('solid/user-tie', $member->user->id == $project->manager ? 'text-danger' : 'text-muted')</a>
                            @endif

                            @if(isAdmin() || Auth::id() == $project->manager)
                            <a href="{{ route('teams.remove', ['project_id' => $project->id, 'member_id' => $member->user->id]) }}" data-toggle="ajaxModal">@icon('regular/trash-alt')</a>
                            @endif

                        </span>
                        <span class="pull-left thumb-xs m-r-xs">
                            <a href="#">
                                <img alt="" class="img-sm img-circle" src="{{ $member->user->profile->photo }}">
                            </a>
                        </span>
                        <div class="media-body media-middle m-l-xs">
                            {{ $member->user->name }}
                            <div class="media-annotation">
                                {{ $member->user->profile->job_title }}
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>

        @endif

<small class="text-uc text-xs text-muted">
    @langapp('vaults')
    <a href="{{ route('extras.vaults.create', ['module' => 'projects', 'id' => $project->id]) }}" class="btn btn-xs btn-danger pull-right" data-toggle="ajaxModal">@icon('solid/plus')</a>
</small>
<div class="line"></div>
@widget('Vaults\Show', ['vaults' => $project->vault])

 @if($project->isTeam() || isAdmin())
                <div class="line"></div>
                <small class="text-uc text-xs text-muted">@langapp('tags')</small>
                    @php
                    $data['tags'] = $project->tags;
                    @endphp
                    @include('partial.tags', $data)
                @endif


                <h4 class="font-thin">@langapp('description')</h4>
                <div class="line"></div>
                <div class="m-t-sm with-responsive-img">
                    @parsedown($project->description)
                </div>
               
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row">

                @widget('Projects.BudgetChart', ['project' => $project])
                @widget('Projects.TaskChart', ['project' => $project])
                @widget('Projects.ExpenseChart', ['project' => $project])
                
            </div>
            <section class="slim-scroll" data-color="#333333" data-disable-fade-out="true" data-distance="0" data-height="600" data-size="5px">
                
                    <section class="panel panel-default">
            <header class="panel-heading">@langapp('activities')  </header>
                
                 @widget('Activities\Feed', ['activities' => $project->activities])

        </section>
            </section>
        </div>
    </div>
</div>

@push('pagescript')
    <script>
$(function () {
    $('.deleteConfirm').click(function (e) {
        e.preventDefault();
        if (window.confirm("Are you sure?")) {
            location.href = this.href;
        }
    });
});
</script>
@endpush
