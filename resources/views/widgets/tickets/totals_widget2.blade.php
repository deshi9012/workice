<div class="row m-l-none m-r-none m-t-sm">
    <div class="col-sm-6 col-md-3 padder-v pallete b-b">
        <a class="clear" href="{{ route('tickets.index') }}">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-bell fa-stack-1x text-success"></i>
            </span>
            
            <small class="text-uc">@langapp('open') </small>
            <span class="h4 block m-t-xs text-dark">{{ getCalculated('tickets_open') }}</span> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v pallete b-b">
            <a class="clear" href="{{ route('reports.index', ['m' => 'tickets']) }}">
                <span class="fa-stack fa-2x pull-left m-r-xs">
                    <i class="fas fa-square fa-stack-2x text-white"></i>
                    <i class="fas fa-check-circle fa-stack-1x text-dracula"></i>
                </span>
                
                <small class="text-uc">@langapp('closed')   </small>
                <span class="h4 block m-t-xs text-dark">{{ getCalculated('tickets_closed') }}</span>
            </a>
        </div>
        
        <div class="col-sm-6 col-md-3 padder-v lt border-l pallete b-b">
            <a class="clear" href="{{ route('reports.index', ['m' => 'tickets']) }}">
                <span class="fa-stack fa-2x pull-left m-r-xs">
                    <i class="fas fa-square fa-stack-2x text-white"></i>
                    <i class="far fa-life-ring fa-stack-1x text-info"></i>
                </span>
                <small class="text-uc">@langapp('tickets')  </small>
                <span class="h4 block m-t-xs text-dark">{{ getCalculated('tickets_total') }}</span>
            </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v lt pallete b-b">
            <a class="clear" href="{{ route('reports.index', ['m' => 'tickets']) }}">
                <span class="fa-stack fa-2x pull-left m-r-xs">
                    <i class="fas fa-square fa-stack-2x text-white"></i>
                    <i class="fas fa-comments fa-stack-1x text-danger"></i>
                </span>
                <small class="text-uc">@langapp('response_time')  </small>
                <span class="h4 block m-t-xs text-dark small">{{ round(getCalculated('tickets_avg_response'), 2) }} @langapp('hours')</span>
            </a>
        </div>
        
    </div>