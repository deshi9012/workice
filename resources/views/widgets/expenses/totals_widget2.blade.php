<div class="row m-l-none m-r-none m-sm">

    <div class="col-sm-6 col-md-3 padder-v pallete b-b">
            <a class="clear" href="{{ route('reports.index', ['m' => 'expenses']) }}">
            <span class="fa-stack fa-2x pull-left m-r-xs"> 
                <i class="fas fa-square fa-stack-2x text-white"></i> 
                <i class="fas fa-times fa-stack-1x text-danger"></i>
            </span>
                                        
                <small class="text-uc">@langapp('unbillable')</small>
                <span class="h4 block m-t-xs text-dark">@metrics('expenses_unbillable')</span>
            </a>
        </div>
        
    <div class="col-sm-6 col-md-3 padder-v lt pallete b-b">
        <a class="clear" href="{{ route('reports.index', ['m' => 'expenses']) }}">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-balance-scale fa-stack-1x text-warning"></i>
            </span>
            <small class="text-uc">@langapp('average')</small>
            <span class="h4 block m-t-xs text-dark">@metrics('expenses_average')</span>
        </a>
    </div>
    <div class="col-sm-6 col-md-3 padder-v pallete b-b">
        <a class="clear" href="{{ route('reports.index', ['m' => 'expenses']) }}">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-calendar fa-stack-1x text-dracula"></i>
            </span>
            
            <small class="text-uc">@langapp('this_month') </small>
            <span class="h4 block m-t-xs text-dark">@metrics('expenses_this_month')</span> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v pallete b-b">
            <a class="clear" href="{{ route('reports.index', ['m' => 'expenses']) }}">
                <span class="fa-stack fa-2x pull-left m-r-xs">
                    <i class="fas fa-square fa-stack-2x text-white"></i>
                    <i class="far fa-calendar fa-stack-1x text-info"></i>
                </span>
                
                <small class="text-uc">@langapp('last_month')</small>
                <span class="h4 block m-t-xs text-dark">@metrics('expenses_last_month')</span>
            </a>
        </div>
        
    </div>