<section class="panel panel-default">
    <header class="header bg-white b-b clearfix">
        <div class="row m-t-sm">
            <div class="col-sm-12 m-b-xs">
                @if ($project->isTeam() || can('milestones_create'))
                    <a href="{{ route('milestones.create', $project->id) }}" data-toggle="ajaxModal" class="btn btn-sm btn-{{  get_option('theme_color')  }}"><i
                                class="fa fa-circle-o-notch"></i> @langapp('create')  </a>
                @endif

            </div>
        </div>
    </header>
    <div class="table-responsive">
        <table id="milestones-table" class="table table-striped">
            <thead>
            <tr>
                <th>@langapp('progress')  </th>
                <th>@langapp('milestone_name')  </th>
                <th class="col-date">@langapp('start_date')  </th>
                <th class="col-date">@langapp('due_date')  </th>

                @if (can('milestones_update') || $project->isTeam())
                    <th class="no-sort"></th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach ($project->milestones as $key => $milestone)
                <tr>
                    <td>
                        <div class="inline ">
                            <div class="easypiechart text-success" data-percent="{{ $milestone->getProgress()  }}"
                                 data-line-width="5" data-track-Color="#f0f0f0"
                                 data-bar-color="{{ get_option('chart_color') }}" data-rotate="270"
                                 data-scale-Color="false" data-size="40" data-animate="2000">
                                <span class="small text-muted">{{ $milestone->getProgress() }}%</span>
                            </div>
                        </div>

                    </td>

                    <td><a class="text-info"
                           href="{{ route('projects.view', ['id' => $milestone->project_id, 'tab' => 'milestones', 'item' => $milestone->id]) }}"
                           data-original-title="{{  $milestone->description  }}" data-toggle="tooltip"
                           data-placement="right" title="">{{  $milestone->milestone_name  }}</a></td>
                    <td>{{  dateFormatted($milestone->start_date)  }}</td>
                    <td>{{  dateFormatted($milestone->due_date)  }}

                        @if (time() > strtotime($milestone->due_date) && $milestone->getProgress() < 100)
                            <span class="badge bg-danger">@langapp('overdue')  </span>
                        @endif
                    </td>

                    @if ($project->isTeam() || can('milestones_update'))
                        <td>
                            <a class="btn btn-xs btn-default"
                               href="{{ route('milestones.edit', $milestone->id) }}"
                               data-toggle="ajaxModal">@icon('solid/pencil-alt')
                           </a>
                            <a href="{{ route('milestones.delete', $milestone->id) }}"
                               data-toggle="ajaxModal" title="@langapp('delete')  "
                               class="btn btn-xs btn-dark">@icon('solid/trash-alt')
                           </a>
                        </td>
                    @endif


                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    @push('pagestyle')
    @include('stacks.css.datatables')
    @endpush

    @push('pagescript')
    @include('stacks.js.datatables')
    <script>
        $(function() {
            $('#milestones-table').DataTable({
                processing: true,
                order: [[ 0, "desc" ]],
            });
        });
    </script>
    @endpush

</section>