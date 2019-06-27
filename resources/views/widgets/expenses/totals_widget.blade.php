<div class="row m-l-none m-r-none m-sm">
        <div class="col-sm-6 col-md-3 padder-v lt border-l pallete b-b">
            <a class="clear" href="{{ route('reports.index', ['m' => 'expenses']) }}">
                                <span class="fa-stack fa-2x pull-left m-r-xs"> 
                                    <i class="fas fa-square fa-stack-2x text-white"></i> 
                                    <i class="fas fa-calendar-day fa-stack-1x text-dracula"></i>
                                </span>
                <small class="text-uc" data-rel="tooltip" title="{{ dateFormatted(today()) }}">@langapp('today')</small>
                <span class="h4 block m-t-xs text-dark">@metrics('expenses_today')</span>
            </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v lt pallete b-b">
            <a class="clear" href="{{ route('reports.index', ['m' => 'expenses']) }}">
                                    <span class="fa-stack fa-2x pull-left m-r-xs"> 
                                        <i class="fas fa-square fa-stack-2x text-white"></i> 
                                        <i class="fas fa-calendar-week fa-stack-1x text-success"></i>
                                    </span>
                <small class="text-uc" data-rel="tooltip" title="{{ dateFormatted(now()->startOfWeek()) }} - {{ dateFormatted(now()->endOfWeek()) }}">@langapp('this_week')</small>
                <span class="h4 block m-t-xs text-dark">@metrics('expenses_this_week')</span>
            </a>
        </div>
        
    <div class="col-sm-6 col-md-3 padder-v lt border-l pallete b-b">
        <a class="clear" href="{{ route('reports.index', ['m' => 'expenses']) }}">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-check-double fa-stack-1x text-success"></i>
            </span>
            <small class="text-uc">@langapp('billed')</small>
            <span class="h4 block m-t-xs text-dark">@metrics('expenses_billed')</span>
        </a>
    </div>

        <div class="col-sm-6 col-md-3 padder-v pallete b-b">
            <a class="clear" href="{{ route('reports.index', ['m' => 'expenses']) }}">
            <span class="fa-stack fa-2x pull-left m-r-xs"> 
                <i class="fas fa-square fa-stack-2x text-white"></i> 
                <i class="far fa-check-circle fa-stack-1x text-warning"></i>
            </span>
                                        
                <small class="text-uc" data-rel="tooltip" title="@langapp('expenses') @langapp('year') {{ date('Y') }}">@langapp('this_year') </small>
                <span class="h4 block m-t-xs text-dark">@metrics('expenses_year_'.date('Y'))</span> </a>
        </div>
        
    </div>