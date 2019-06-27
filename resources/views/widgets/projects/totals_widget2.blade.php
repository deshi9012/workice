<div class="row m-l-none m-r-none m-sm">
    <div class="col-sm-6 col-md-3 padder-v lt border-l pallete b-b">
        <a class="clear" href="{{ route('projects.index', ['filter' => 'Active']) }}">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-spinner fa-stack-1x text-success"></i>
            </span>
            
            <small class="text-uc">@langapp('active')</small>
            <span class="h4 block m-t-xs text-dark">{{ getCalculated('projects_active') }}</span>
        </a>
    </div>
    <div class="col-sm-6 col-md-3 padder-v lt pallete b-b">
        <a class="clear" href="{{ route('reports.index', ['m' => 'projects']) }}">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-check-double fa-stack-1x text-dracula"></i>
            </span>
            <small class="text-uc">@langapp('done')</small>
            <span class="h4 block m-t-xs text-dark">{{ getCalculated('projects_done') }}</span>
        </a>
    </div>
    <div class="col-sm-6 col-md-3 padder-v pallete b-b">
        <a class="clear" href="{{ route('tasks.index') }}">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-exclamation-circle fa-stack-1x text-info"></i>
            </span>
            
            <small class="text-uc">@langapp('pending') @langapp('tasks')</small>
            <span class="h4 block m-t-xs text-dark">{{ getCalculated('tasks_active') }}</span> </a>
        </div>
        
        
        <div class="col-sm-6 col-md-3 padder-v pallete b-b">
            <a class="clear" href="{{ route('reports.index', ['m' => 'tasks']) }}">
                <span class="fa-stack fa-2x pull-left m-r-xs">
                    <i class="fas fa-square fa-stack-2x text-white"></i>
                    <i class="fas fa-tasks fa-stack-1x text-success"></i>
                </span>
                
                <small class="text-uc">@langapp('done') @langapp('tasks')</small>
                <span class="h4 block m-t-xs text-dark">{{ getCalculated('tasks_done') }}</span>
            </a>
        </div>
        
    </div>