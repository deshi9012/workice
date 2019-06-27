<div class="col-lg-4">
    <section class="panel panel-default">
        <header class="panel-heading">
            @langapp('expenses')
        </header>
        <div class="panel-body text-center">
            <h4>
            {{ formatCurrency($project->currency, $project->total_expenses) }}
            </h4>
            <small class="text-muted block">
            @langapp('unbilled')
            </small>
            <div class="inline">
                <div class="easypiechart" data-bar-color="#afcf6f" data-line-cap="butt" data-line-width="30" data-percent="{{ percent($project->expensesPercent()) }}" data-scale-color="#fff" data-size="150" data-track-color="#eee">
                    <span class="h2 step font25">
                        {{ percent($project->expensesPercent()) }}
                    </span>%
                    <div class="easypie-text">
                        @langapp('billed')
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <small>
            @icon('solid/shopping-basket')
            @langapp('expenses') <span class="text-muted">({{ $project->expenses->count() }})</span>
            </small>
            
        </div>
    </section>
</div>