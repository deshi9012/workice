<?php echo $__env->make('partial.base_currency', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo app('arrilot.widget')->run('Deals.TotalsWidget'); ?>
<?php echo app('arrilot.widget')->run('Deals.TotalsWidget2'); ?>
<?php echo app('arrilot.widget')->run('Deals.WonLostChart'); ?>
<?php echo app('arrilot.widget')->run('Deals.StagesChart'); ?>