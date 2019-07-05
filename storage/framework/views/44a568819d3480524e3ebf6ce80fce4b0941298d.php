<div class="btn-group">

    <button class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm dropdown-toggle" data-toggle="dropdown">
        <?php echo trans('app.'.'modules'); ?>  - <?php echo trans('app.'.$module); ?>
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">

        <li><a href="<?php echo e(route('reports.index', ['m' => 'deals'])); ?>"><?php echo trans('app.'.'deals'); ?> </a></li>
        <li><a href="<?php echo e(route('reports.index', ['m' => 'leads'])); ?>"><?php echo trans('app.'.'leads'); ?> </a></li>
        <li><a href="<?php echo e(route('reports.index', ['m' => 'invoices'])); ?>"><?php echo trans('app.'.'invoices'); ?> </a></li>
        <li><a href="<?php echo e(route('reports.index', ['m' => 'expenses'])); ?>"><?php echo trans('app.'.'expenses'); ?> </a></li>
        <li><a href="<?php echo e(route('reports.index', ['m' => 'payments'])); ?>"><?php echo trans('app.'.'payments'); ?> </a></li>
        <li><a href="<?php echo e(route('reports.index', ['m' => 'estimates'])); ?>"><?php echo trans('app.'.'estimates'); ?> </a></li>
        <li><a href="<?php echo e(route('reports.index', ['m' => 'creditnotes'])); ?>"><?php echo trans('app.'.'creditnotes'); ?> </a></li>
        <li><a href="<?php echo e(route('reports.index', ['m' => 'projects'])); ?>"><?php echo trans('app.'.'projects'); ?> </a></li>
        <li><a href="<?php echo e(route('reports.index', ['m' => 'tasks'])); ?>"><?php echo trans('app.'.'tasks'); ?> </a></li>
        <li><a href="<?php echo e(route('reports.index', ['m' => 'timesheets'])); ?>"><?php echo trans('app.'.'timesheets'); ?> </a></li>
        <li><a href="<?php echo e(route('reports.index', ['m' => 'tickets'])); ?>"><?php echo trans('app.'.'tickets'); ?> </a></li>
    </ul>
</div>

<div class="btn-group pull-right">

        <button class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm dropdown-toggle" data-toggle="dropdown">
                <?php echo trans('app.'.'year'); ?>  <span class="caret"></span>
        </button>

        <ul class="dropdown-menu">
            <?php
            $max = date('Y');
            $min = $max - 3;
            ?>
            <?php $__currentLoopData = range($min, $max); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <li><a href="?setyear=<?php echo e($year); ?>"><?php echo e($year); ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </ul>

    </div>

    <a href="#" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?> pull-right commandBtn" data-rel="tooltip" data-id="analytics-compute" title="Compute all analytics data">Compute Analytics</a>

<?php echo $__env->make('analytics::_'.$module.'.topmenu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
