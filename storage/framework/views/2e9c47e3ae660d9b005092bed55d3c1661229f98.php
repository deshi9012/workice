<div class="row m-l-none m-r-none m-sm">
    <div class="col-sm-6 col-md-3 padder-v lt pallete b-b">
        <a class="clear" href="<?php echo e(route('invoices.index')); ?>">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-exclamation-circle fa-stack-1x text-dracula"></i>
            </span>
            
            <small class="text-uc" data-rel="tooltip" title="<?php echo trans('app.'.'outstanding'); ?>"><?php echo trans('app.'.'outstanding'); ?></small>
            <span class="h4 block m-t-xs text-dark"><?php echo metrics('outstanding_balance'); ?></span>
        </a>
    </div>
    <div class="col-sm-6 col-md-3 padder-v lt pallete b-b">
        <a class="clear" href="<?php echo e(route('invoices.index')); ?>">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-file-invoice-dollar fa-stack-1x text-danger"></i>
            </span>
            <small class="text-uc" data-rel="tooltip" title="<?php echo trans('app.'.'invoiced'); ?> <?php echo trans('app.'.'year'); ?> <?php echo e(date('Y')); ?>"><?php echo trans('app.'.'invoiced'); ?> </small>
            <span class="h4 block m-t-xs text-dark"><?php echo metrics('invoiced_year_'.date('Y')); ?></span>
        </a>
    </div>
    <div class="col-sm-6 col-md-3 padder-v pallete b-b">
        <a class="clear" href="<?php echo e(route('reports.index', ['m' => 'invoices'])); ?>">
            <span class="fa-stack fa-2x pull-left m-r-xs">
                <i class="fas fa-square fa-stack-2x text-white"></i>
                <i class="fas fa-calendar fa-stack-1x text-warning"></i>
            </span>
            
            <small class="text-uc" data-rel="tooltip" title="<?php echo trans('app.'.'invoiced'); ?> <?php echo trans('app.'.'this_month'); ?>"><?php echo trans('app.'.'this_month'); ?> </small>
            <span class="h4 block m-t-xs text-dark"><?php echo metrics('invoiced_this_month'); ?></span> </a>
        </div>
        <div class="col-sm-6 col-md-3 padder-v pallete b-b">
            <a class="clear" href="<?php echo e(route('reports.index', ['m' => 'invoices'])); ?>">
                <span class="fa-stack fa-2x pull-left m-r-xs">
                    <i class="fas fa-square fa-stack-2x text-white"></i>
                    <i class="far fa-calendar fa-stack-1x text-info"></i>
                </span>
                
                <small class="text-uc" data-rel="tooltip" title="<?php echo trans('app.'.'invoiced'); ?> <?php echo trans('app.'.'last_month'); ?>"><?php echo trans('app.'.'last_month'); ?>   </small>
                <span class="h4 block m-t-xs text-dark"><?php echo metrics('invoiced_last_month'); ?></span>
            </a>
        </div>
        
    </div>