<div class="row m-l-none m-r-none m-sm">
    <div class="col-sm-6 col-md-3 padder-v lt border-l pallete b-b">
        <a class="clear" href="{{ route('payments.index') }}">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-check-circle fa-stack-1x text-success"></i>
            </span>
            <small class="text-uc">@langapp('receipts')  </small>
            <span class="h4 block m-t-xs text-dark">@metrics('total_receipts')</span>
        </a>
    </div>
    <div class="col-sm-6 col-md-3 padder-v lt pallete b-b">
        <a class="clear" href="{{ route('creditnotes.index') }}">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-receipt fa-stack-1x text-dracula"></i>
            </span>
            <small class="text-uc">@langapp('credits')   </small>
            <span class="h4 block m-t-xs text-dark">@metrics('credits_open')</span>
        </a>
    </div>
    <div class="col-sm-6 col-md-3 padder-v pallete b-b">
        <a class="clear" href="{{ route('reports.index', ['m' => 'payments']) }}">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-calendar fa-stack-1x text-info"></i>
            </span>
            
            <small class="text-uc">@langapp('this_month') </small>
            <span class="h4 block m-t-xs text-dark">@metrics('revenue_this_month')</span> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v pallete b-b">
            <a class="clear" href="{{ route('reports.index', ['m' => 'payments']) }}">
                <span class="fa-stack fa-2x pull-left m-r-xs">
                    <i class="fas fa-square fa-stack-2x text-white"></i>
                    <i class="far fa-calendar fa-stack-1x text-danger"></i>
                </span>
                
                <small class="text-uc">@langapp('last_month')</small>
                <span class="h4 block m-t-xs text-dark">@metrics('revenue_last_month')</span>
            </a>
        </div>
        
    </div>