<section class="panel panel-default">
  <header class="panel-heading">
    <?php echo e($year); ?> - <?php echo trans('app.'.'yearly_overview'); ?>
    <div class="m-b-sm pull-right">
      <div class="btn-group">
        <button class="btn btn-dark btn-xs dropdown-toggle" data-toggle="dropdown"><?php echo trans('app.'.'year'); ?> <span
        class="caret"></span></button>
        <ul class="dropdown-menu">
          <?php $min = date('Y') - 3; ?>
          <?php $__currentLoopData = range($min, date('Y')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li><a href="?setyear=<?php echo e($y); ?>"><?php echo e($y); ?></a></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    </div>
    
  </header>
  <div class="panel-body">
    <div id="invoice-chart"></div>
  </div>
</section>
<?php $__env->startPush('pagescript'); ?>
<?php echo $__env->make('stacks.js.chart', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
let chart = new frappe.Chart( "#invoice-chart", {
data: {
  labels: ["<?php echo e(langdate('cal_jan')); ?>", "<?php echo e(langdate('cal_feb')); ?>", "<?php echo e(langdate('cal_mar')); ?>", "<?php echo e(langdate('cal_apr')); ?>", "<?php echo e(langdate('cal_may')); ?>", "<?php echo e(langdate('cal_jun')); ?>",
  "<?php echo e(langdate('cal_jul')); ?>", "<?php echo e(langdate('cal_aug')); ?>", "<?php echo e(langdate('cal_sep')); ?>", "<?php echo e(langdate('cal_oct')); ?>", "<?php echo e(langdate('cal_nov')); ?>", "<?php echo e(langdate('cal_dec')); ?>"],
  datasets: [
  {
    name: "<?php echo e(langapp('invoiced')); ?>", chartType: 'bar',
    values: [<?php echo e($invoiced['jan']); ?>, <?php echo e($invoiced['feb']); ?>, <?php echo e($invoiced['mar']); ?>, <?php echo e($invoiced['apr']); ?>, <?php echo e($invoiced['may']); ?>, <?php echo e($invoiced['jun']); ?>, <?php echo e($invoiced['jul']); ?>,
    <?php echo e($invoiced['aug']); ?>, <?php echo e($invoiced['sep']); ?>, <?php echo e($invoiced['oct']); ?>, <?php echo e($invoiced['nov']); ?>, <?php echo e($invoiced['dec']); ?>]
  },
  {
    name: "<?php echo e(langapp('receipts')); ?>", chartType: 'line',
    values: [<?php echo e($receipts['jan']); ?>, <?php echo e($receipts['feb']); ?>, <?php echo e($receipts['mar']); ?>, <?php echo e($receipts['apr']); ?>, <?php echo e($receipts['may']); ?>, <?php echo e($receipts['jun']); ?>, <?php echo e($receipts['jul']); ?>,
    <?php echo e($receipts['aug']); ?>, <?php echo e($receipts['sep']); ?>, <?php echo e($receipts['oct']); ?>, <?php echo e($receipts['nov']); ?>, <?php echo e($receipts['dec']); ?>]
  }
  ]
},
title: "<?php echo e(langapp('amount_in', ['currency' => get_option('default_currency')])); ?>",
type: 'axis-mixed',
height: 300,
colors: ['#d5d1f1', '#4a90e2'],
tooltipOptions: {
    formatTooltipX: function formatTooltipX(d) {
      return (d + '').toUpperCase();
    },
    formatTooltipY: function formatTooltipY(d) {
      return d.format(2, 3, "<?php echo e(get_option('thousands_separator')); ?>", "<?php echo e(get_option('decimal_separator')); ?>") + "<?php echo e(get_option('default_currency_symbol')); ?>";
    }
  }
});
</script>
<?php $__env->stopPush(); ?>