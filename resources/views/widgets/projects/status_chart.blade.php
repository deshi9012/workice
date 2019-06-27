<div class="row m-l-none m-r-none m-sm">
    <div class="col-sm-6 col-md-3 padder-v lt border-l pallete b-b">
        <a class="clear" href="{{ route('projects.index', ['filter' => 'Active']) }}">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-clock fa-stack-1x text-success"></i>
            </span>
            
            <small class="text-uc" data-rel="tooltip" title="@langapp('worked') @langapp('today') {{ dateFormatted(today()) }}">@langapp('today')</small>
            <span class="h4 block m-t-xs text-dark">{{ secToHours(getCalculated('time_today')) }}</span>
        </a>
    </div>
    <div class="col-sm-6 col-md-3 padder-v lt pallete b-b">
        <a class="clear" href="{{ route('reports.index', ['m' => 'projects']) }}">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-calendar-week fa-stack-1x text-dracula"></i>
            </span>
            <small class="text-uc" data-rel="tooltip" data-placement="bottom" title="{{ dateFormatted(now()->startOfWeek()) }} - {{ dateFormatted(now()->endOfWeek()) }}">@langapp('this_week')</small>
            <span class="h4 block m-t-xs text-dark">{{ secToHours(getCalculated('time_this_week')) }}</span>
        </a>
    </div>
    <div class="col-sm-6 col-md-3 padder-v pallete b-b">
        <a class="clear" href="{{ route('reports.index', ['m' => 'projects']) }}">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-balance-scale fa-stack-1x text-danger"></i>
            </span>
            
            <small class="text-uc" data-rel="tooltip" title="Average Billable">@langapp('average')</small>
            <span class="h4 block m-t-xs text-dark">{{ secToHours(round(getCalculated('projects_average_billable'))) }}</span>
        </a>
    </div>
    <div class="col-sm-6 col-md-3 padder-v pallete b-b">
        <a class="clear" href="{{ route('projects.index') }}">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-percent fa-stack-1x text-info"></i>
            </span>
            
            <small class="text-uc" data-rel="tooltip" data-placement="bottom" title="Average Budget">@langapp('budget')</small>
            <span class="h4 block m-t-xs text-dark">{{ round(getCalculated('projects_average_budget')) }}%</span> </a>
        </div>
        
    </div>