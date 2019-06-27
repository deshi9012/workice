<div class="row m-l-none m-r-none m-sm">
    <div class="col-sm-6 col-md-3 padder-v lt border-l pallete b-b">
        <a class="clear" href="{{ route('payments.index') }}">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-calendar-day fa-stack-1x text-success"></i>
            </span>
            <small class="text-uc" data-rel="tooltip" title="{{ dateFormatted(today()) }}">@langapp('today')</small>
            <span class="h4 block m-t-xs text-dark">@metrics('paid_today')</span>
        </a>
    </div>
    <div class="col-sm-6 col-md-3 padder-v lt pallete b-b">
        <a class="clear" href="{{ route('payments.index') }}">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-calendar-week fa-stack-1x text-dracula"></i>
            </span>
            <small class="text-uc" data-rel="tooltip" title="{{ dateFormatted(now()->startOfWeek()) }} - {{ dateFormatted(now()->endOfWeek()) }}">@langapp('weekly') @langapp('income')</small>
            <span class="h4 block m-t-xs text-dark">@metrics('paid_this_week')</span>
        </a>
    </div>
    <div class="col-sm-6 col-md-3 padder-v pallete b-b">
        <a class="clear" href="{{ route('reports.index', ['m' => 'payments']) }}">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-calendar fa-stack-1x text-info"></i>
            </span>
            
            <small class="text-uc" data-rel="tooltip" title="@langapp('income') {{ date('Y') }}">@langapp('this_year') </small>
            <span class="h4 block m-t-xs text-dark">@metrics('revenue_year_'.date('Y'))</span> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v pallete b-b">
            <a class="clear" href="{{ route('reports.index', ['m' => 'payments']) }}">
                <span class="fa-stack fa-2x pull-left m-r-xs">
                    <i class="fas fa-square fa-stack-2x text-white"></i>
                    <i class="fas fa-exclamation-circle fa-stack-1x text-danger"></i>
                </span>
                
                <small class="text-uc" data-rel="tooltip" title="@langapp('balance_due')">@langapp('outstanding')</small>
                <span class="h4 block m-t-xs text-dark">@metrics('outstanding_balance')</span>
            </a>
        </div>
        
    </div>