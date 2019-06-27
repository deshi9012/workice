<?php echo $__env->make('partial.base_currency', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo app('arrilot.widget')->run('Invoices.TotalsWidget'); ?>
<?php echo app('arrilot.widget')->run('Invoices.TotalsWidget2'); ?>
<?php echo app('arrilot.widget')->run('Invoices.InvoicingChart'); ?>
