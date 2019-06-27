<div class="row m-l-none m-r-none m-sm">
    <div class="col-sm-6 col-md-3 padder-v lt border-l pallete b-b">
        <a class="clear" href="<?php echo e(route('reports.index', ['m' => 'deals'])); ?>">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-check-circle fa-stack-1x text-success"></i>
            </span>
            <small class="text-uc"><?php echo trans('app.'.'won_deals'); ?></small>
            <span class="h4 block m-t-xs text-dark"><?php echo metrics('deals_won'); ?></span>
        </a>
    </div>
    <div class="col-sm-6 col-md-3 padder-v lt pallete b-b">
        <a class="clear" href="<?php echo e(route('reports.index', ['m' => 'deals'])); ?>">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-thumbs-down fa-stack-1x text-dracula"></i>
            </span>
            <small class="text-uc"><?php echo trans('app.'.'lost'); ?></small>
            <span class="h4 block m-t-xs text-dark"><?php echo metrics('deals_lost'); ?></span>
        </a>
    </div>
    <div class="col-sm-6 col-md-3 padder-v pallete b-b">
        <a class="clear" href="<?php echo e(route('reports.index', ['m' => 'deals'])); ?>">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-calendar-check fa-stack-1x text-warning"></i>
            </span>
            
            <small class="text-uc"><?php echo trans('app.'.'this_month'); ?> </small>
            <span class="h4 block m-t-xs text-dark"><?php echo metrics('deals_this_month'); ?></span>
        </a>
    </div>
    <div class="col-sm-6 col-md-3 padder-v pallete b-b">
        <a class="clear" href="<?php echo e(route('reports.index', ['m' => 'deals'])); ?>">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-chart-line fa-stack-1x text-info"></i>
            </span>
            
            <small class="text-uc"><?php echo trans('app.'.'forecasted'); ?>  </small>
            <span class="h4 block m-t-xs text-dark"><?php echo metrics('deals_forecast'); ?></span>
        </a>
    </div>
    
</div>