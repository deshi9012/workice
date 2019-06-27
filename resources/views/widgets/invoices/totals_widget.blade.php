<div class="row m-l-none m-r-none m-sm">
    <div class="col-sm-6 col-md-3 padder-v lt pallete b-b">
        <a class="clear" href="{{ route('invoices.index') }}">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-calendar-day fa-stack-1x text-success"></i>
            </span>
            
            <small class="text-uc" data-rel="tooltip" title="@langapp('invoiced') @langapp('today') {{ dateFormatted(today()) }}">@langapp('today')</small>
            <span class="h4 block m-t-xs text-dark">@metrics('invoiced_today')</span>
        </a>
    </div>
    <div class="col-sm-6 col-md-3 padder-v lt pallete b-b">
        <a class="clear" href="{{ route('invoices.index') }}">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-calendar-alt fa-stack-1x text-danger"></i>
            </span>
            <small class="text-uc" data-rel="tooltip" title="{{ dateFormatted(now()->startOfWeek()) }} - {{ dateFormatted(now()->endOfWeek()) }}">@langapp('this_week')</small>
            <span class="h4 block m-t-xs text-dark">@metrics('invoiced_this_week')</span>
        </a>
    </div>
    <div class="col-sm-6 col-md-3 padder-v pallete b-b">
        <a class="clear" href="{{ route('reports.index', ['m' => 'invoices']) }}">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-calendar-check fa-stack-1x text-warning"></i>
            </span>
            
            <small class="text-uc" data-rel="tooltip" title="{{ dateFormatted(today()) }}">@langapp('paid') @langapp('today')</small>
            <span class="h4 block m-t-xs text-dark">@metrics('paid_today')</span> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v pallete b-b">
            <a class="clear" href="{{ route('reports.index', ['m' => 'invoices']) }}">
                <span class="fa-stack fa-2x pull-left m-r-xs">
                    <i class="fas fa-square fa-stack-2x text-white"></i>
                    <i class="fas fa-calendar-week fa-stack-1x text-info"></i>
                </span>
                
                <small class="text-uc" data-rel="tooltip" title="{{ dateFormatted(now()->startOfWeek()) }} - {{ dateFormatted(now()->endOfWeek()) }}">@langapp('weekly') @langapp('income')</small>
                <span class="h4 block m-t-xs text-dark">@metrics('paid_this_week')</span>
            </a>
        </div>
        
    </div>