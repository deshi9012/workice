<div class="row proj-summary-band">
        @if (can('projects_update') || $project->isTeam())
        <div class="col-md-3 text-center animated fadeInRightBig">
            <label class="text-muted small">
                @langapp('cost')
            </label>
            <h4 class="cursor-pointer text-open small">
            {{ humanize($project->billing_method) }}
            </h4>
            @can('projects_view_cost')
            <h4>
            {{ formatCurrency($project->currency, $project->sub_total) }}
            </h4>
            @endcan
        </div>
        <div class="col-md-3 text-center animated fadeInRightBig">
            <label class="small text-muted">
                @langapp('unbilled')
            </label>
            @can('projects_view_expenses')
            <h4 class="cursor-pointer text-open small text-danger">
            + {{ formatCurrency($project->currency, $project->total_expenses) }} @langapp('expenses')
            </h4>
            <h4>
            {{ secToHours($project->unbilled)  }}
            </h4>
            @endcan
        </div>
        <div class="col-md-3 text-center animated fadeInRightBig">
            <label class="small text-muted">
                @langapp('invoiceable')
            </label>
            <h4 class="cursor-pointer text-success small">
            {{  gmsec($project->billable_time)  }}
            </h4>
            <h4>
            {{  secToHours($project->billable_time)  }}
            </h4>
        </div>
        <div class="col-md-3 text-center animated fadeInRightBig">
            <label class="small text-muted text-danger">
                @langapp('noninvoiceable')
            </label>
            <h4 class="cursor-pointer text-danger small">
            {{  gmsec($project->unbillable_time)  }}
            </h4>
            <h4>
            {{ secToHours($project->unbillable_time) }}
            </h4>
        </div>
        @endif
    </div>