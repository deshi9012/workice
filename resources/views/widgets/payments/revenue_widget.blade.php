<div class="col-md-4">
    <section class="panel panel-default revenue">

        <header class="panel-heading">@langapp('payments') </header>

        <div class="panel-body text-center">
            <h4>@langapp('received_amount') </h4>
            <small class="text-muted block">@langapp('percentage_collection') </small>

            <div class="sparkline inline" data-type="pie" data-height="150"
                 data-slice-colors="['{{ get_option('chart_color') }}','#38354a']">
                 {{ getCalculated('percent_paid') }}, {{ getCalculated('percent_balance') }}
            </div>
            <div class="line pull-in"></div>
            <div>
                @icon('solid/circle', 'text-dark')
                @langapp('outstanding')  - {{ getCalculated('percent_balance') }}%
                @icon('solid/circle', get_option('chart_color'))
                @langapp('paid')  - {{ getCalculated('percent_paid') }}%
            </div>
        </div>
        <div class="panel-footer">
            <small>
                @langapp('outstanding')  : <strong>{{ getCalculated('oustanding_balance') }}</strong>
            </small>
        </div>
    </section>
</div>