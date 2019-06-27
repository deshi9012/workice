<div class="row m-l-none m-r-none m-t-sm">

    <div class="col-sm-6 col-md-3 padder-v pallete b-b">
            <a class="clear" href="{{ route('tickets.index') }}">
            <span class="fa-stack fa-2x pull-left m-r-xs"> 
                <i class="fas fa-square fa-stack-2x text-white"></i> 
                <i class="fas fa-calendar-day fa-stack-1x text-success"></i>
            </span>
                                        
                <small class="text-uc" data-rel="tooltip" title="@langapp('today') {{ dateFormatted(today()) }}">@langapp('today')</small>
                <span class="h4 block m-t-xs text-dark">{{ getCalculated('tickets_today') }}</span> </a>
        </div>

    <div class="col-sm-6 col-md-3 padder-v pallete b-b">
            <a class="clear" href="{{ route('reports.index', ['m' => 'tickets']) }}">
            <span class="fa-stack fa-2x pull-left m-r-xs"> 
                <i class="fas fa-square fa-stack-2x text-white"></i> 
                <i class="fas fa-calendar-week fa-stack-1x text-dracula"></i>
            </span>
                                        
                <small class="text-uc" data-rel="tooltip" data-placement="bottom" title="{{ dateFormatted(now()->startOfWeek()) }} - {{ dateFormatted(now()->endOfWeek()) }}">@langapp('this_week')</small>
                <span class="h4 block m-t-xs text-dark">{{ getCalculated('tickets_this_week') }}</span>
            </a>
        </div>
        
        <div class="col-sm-6 col-md-3 padder-v lt border-l pallete b-b">
            <a class="clear" href="{{ route('reports.index', ['m' => 'tickets']) }}">
                <span class="fa-stack fa-2x pull-left m-r-xs"> 
                    <i class="fas fa-square fa-stack-2x text-white"></i> 
                    <i class="fas fa-calendar fa-stack-1x text-info"></i>
                </span>
                <small class="text-uc" data-rel="tooltip" data-placement="bottom" title="Created {{ date('M Y') }}">@langapp('this_month')</small>
                <span class="h4 block m-t-xs text-dark">{{ getCalculated('tickets_this_month') }}</span>
            </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v lt pallete b-b">
            <a class="clear" href="{{ route('reports.index', ['m' => 'tickets']) }}">
                <span class="fa-stack fa-2x pull-left m-r-xs"> 
                    <i class="fas fa-square fa-stack-2x text-white"></i> 
                    <i class="far fa-calendar fa-stack-1x text-danger"></i>
                </span>
                <small class="text-uc" data-rel="tooltip" data-placement="bottom" title="Created last month {{ now()->subMonth(1)->format('M Y') }}">@langapp('last_month')</small>
                <span class="h4 block m-t-xs text-dark small">{{ getCalculated('tickets_last_month') }}</span>
            </a>
        </div>
        
    </div>