<section class="panel panel-default">
  <header class="panel-heading font-bold">
    <?php echo e($year); ?> - <?php echo trans('app.'.'yearly_overview'); ?>
    <div class="m-b-sm pull-right">
      <div class="btn-group">
        <button class="btn btn-dark btn-xs dropdown-toggle" data-toggle="dropdown"><?php echo trans('app.'.'year'); ?> <span
        class="caret"></span></button>
        <ul class="dropdown-menu">
          <?php $min = date('Y') - 3; ?>
          <?php $__currentLoopData = range($min, date('Y')); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li><a href="?m=deals&setyear=<?php echo e($y); ?>"><?php echo e($y); ?></a></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    </div>
  </header>
  <div class="panel-body">
    <div id="won-lost-chart"></div>
  </div>
  
</section>
<?php $__env->startPush('pagescript'); ?>
<?php echo $__env->make('stacks.js.chart', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
let chart = new frappe.Chart( "#won-lost-chart", {
data: {
labels: ["<?php echo e(langdate('cal_jan')); ?>", "<?php echo e(langdate('cal_feb')); ?>", "<?php echo e(langdate('cal_mar')); ?>", "<?php echo e(langdate('cal_apr')); ?>", "<?php echo e(langdate('cal_may')); ?>", "<?php echo e(langdate('cal_jun')); ?>",
"<?php echo e(langdate('cal_jul')); ?>", "<?php echo e(langdate('cal_aug')); ?>", "<?php echo e(langdate('cal_sep')); ?>", "<?php echo e(langdate('cal_oct')); ?>", "<?php echo e(langdate('cal_nov')); ?>", "<?php echo e(langdate('cal_dec')); ?>"],
datasets: [
{
  name: "<?php echo e(langapp('won')); ?>", chartType: 'line',
  values: [<?php echo e($won['jan']); ?>, <?php echo e($won['feb']); ?>, <?php echo e($won['mar']); ?>, <?php echo e($won['apr']); ?>, <?php echo e($won['may']); ?>, <?php echo e($won['jun']); ?>, <?php echo e($won['jul']); ?>,
  <?php echo e($won['aug']); ?>, <?php echo e($won['sep']); ?>, <?php echo e($won['oct']); ?>, <?php echo e($won['nov']); ?>, <?php echo e($won['dec']); ?>]
},
{
  name: "<?php echo e(langapp('lost')); ?>", chartType: 'line',
  values: [<?php echo e($lost['jan']); ?>, <?php echo e($lost['feb']); ?>, <?php echo e($lost['mar']); ?>, <?php echo e($lost['apr']); ?>, <?php echo e($lost['may']); ?>, <?php echo e($lost['jun']); ?>, <?php echo e($lost['jul']); ?>,
  <?php echo e($lost['aug']); ?>, <?php echo e($lost['sep']); ?>, <?php echo e($lost['oct']); ?>, <?php echo e($lost['nov']); ?>, <?php echo e($lost['dec']); ?>]
}
],

},
title: "<?php echo e(langapp('won_lost_deals')); ?>",
type: 'axis-mixed',
height: 300,
colors: ['#3ac451', '#d5d1f1'],
tooltipOptions: {
  formatTooltipX: d => (d + '').toUpperCase(),
  formatTooltipY: function formatTooltipY(d) {
      return d.format(2, 3, "<?php echo e(get_option('thousands_separator')); ?>", "<?php echo e(get_option('decimal_separator')); ?>") + "<?php echo e(get_option('default_currency_symbol')); ?>";
    }
}
});
</script>
<?php $__env->stopPush(); ?>