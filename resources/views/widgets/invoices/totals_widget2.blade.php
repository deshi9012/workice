<div class="row m-l-none m-r-none m-sm">
    <div class="col-sm-6 col-md-3 padder-v lt pallete b-b">
        <a class="clear" href="{{ route('invoices.index') }}">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-exclamation-circle fa-stack-1x text-dracula"></i>
            </span>
            
            <small class="text-uc" data-rel="tooltip" title="@langapp('outstanding')">@langapp('outstanding')</small>
            <span class="h4 block m-t-xs text-dark">@metrics('outstanding_balance')</span>
        </a>
    </div>
    <div class="col-sm-6 col-md-3 padder-v lt pallete b-b">
        <a class="clear" href="{{ route('invoices.index') }}">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-file-invoice-dollar fa-stack-1x text-danger"></i>
            </span>
            <small class="text-uc" data-rel="tooltip" title="@langapp('invoiced') @langapp('year') {{ date('Y') }}">@langapp('invoiced') </small>
            <span class="h4 block m-t-xs text-dark">@metrics('invoiced_year_'.date('Y'))</span>
        </a>
    </div>
    <div class="col-sm-6 col-md-3 padder-v pallete b-b">
        <a class="clear" href="{{ route('reports.index', ['m' => 'invoices']) }}">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-calendar fa-stack-1x text-warning"></i>
            </span>
            
            <small class="text-uc" data-rel="tooltip" title="@langapp('invoiced') @langapp('this_month')">@langapp('this_month') </small>
            <span class="h4 block m-t-xs text-dark">@metrics('invoiced_this_month')</span> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v pallete b-b">
            <a class="clear" href="{{ route('reports.index', ['m' => 'invoices']) }}">
                <span class="fa-stack fa-2x pull-left m-r-xs">
                    <i class="fas fa-square fa-stack-2x text-white"></i>
                    <i class="far fa-calendar fa-stack-1x text-info"></i>
                </span>
                
                <small class="text-uc" data-rel="tooltip" title="@langapp('invoiced') @langapp('last_month')">@langapp('last_month')   </small>
                <span class="h4 block m-t-xs text-dark">@metrics('invoiced_last_month')</span>
            </a>
        </div>
        
    </div>