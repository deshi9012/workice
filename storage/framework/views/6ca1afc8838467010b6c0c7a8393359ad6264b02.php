<div class="row m-l-none m-r-none m-sm">
    <div class="col-sm-6 col-md-3 padder-v lt pallete b-b">
        <a class="clear" href="<?php echo e(route('invoices.index')); ?>">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-calendar-day fa-stack-1x text-success"></i>
            </span>
            
            <small class="text-uc" data-rel="tooltip" title="<?php echo trans('app.'.'invoiced'); ?> <?php echo trans('app.'.'today'); ?> <?php echo e(dateFormatted(today())); ?>"><?php echo trans('app.'.'today'); ?></small>
            <span class="h4 block m-t-xs text-dark"><?php echo metrics('invoiced_today'); ?></span>
        </a>
    </div>
    <div class="col-sm-6 col-md-3 padder-v lt pallete b-b">
        <a class="clear" href="<?php echo e(route('invoices.index')); ?>">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-calendar-alt fa-stack-1x text-danger"></i>
            </span>
            <small class="text-uc" data-rel="tooltip" title="<?php echo e(dateFormatted(now()->startOfWeek())); ?> - <?php echo e(dateFormatted(now()->endOfWeek())); ?>"><?php echo trans('app.'.'this_week'); ?></small>
            <span class="h4 block m-t-xs text-dark"><?php echo metrics('invoiced_this_week'); ?></span>
        </a>
    </div>
    <div class="col-sm-6 col-md-3 padder-v pallete b-b">
        <a class="clear" href="<?php echo e(route('reports.index', ['m' => 'invoices'])); ?>">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-calendar-check fa-stack-1x text-warning"></i>
            </span>
            
            <small class="text-uc" data-rel="tooltip" title="<?php echo e(dateFormatted(today())); ?>"><?php echo trans('app.'.'paid'); ?> <?php echo trans('app.'.'today'); ?></small>
            <span class="h4 block m-t-xs text-dark"><?php echo metrics('paid_today'); ?></span> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v pallete b-b">
            <a class="clear" href="<?php echo e(route('reports.index', ['m' => 'invoices'])); ?>">
                <span class="fa-stack fa-2x pull-left m-r-xs">
                    <i class="fas fa-square fa-stack-2x text-white"></i>
                    <i class="fas fa-calendar-week fa-stack-1x text-info"></i>
                </span>
                
                <small class="text-uc" data-rel="tooltip" title="<?php echo e(dateFormatted(now()->startOfWeek())); ?> - <?php echo e(dateFormatted(now()->endOfWeek())); ?>"><?php echo trans('app.'.'weekly'); ?> <?php echo trans('app.'.'income'); ?></small>
                <span class="h4 block m-t-xs text-dark"><?php echo metrics('paid_this_week'); ?></span>
            </a>
        </div>
        
    </div>