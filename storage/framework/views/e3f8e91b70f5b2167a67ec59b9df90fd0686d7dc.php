<section class="panel panel-default">
  <header class="panel-heading font-bold"><?php echo trans('app.'.'deals_by_stage'); ?>
    <div class="btn-group pull-right">
      <button class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
      <?php echo trans('app.'.'pipeline'); ?> <span class="caret"></span>
      </button>
      <ul class="dropdown-menu">
        <?php $__currentLoopData = App\Entities\Category::whereModule('pipeline')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><a href="?pipeline=<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></a></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
      </ul>
    </div>
  </header>
  
  <div class="panel-body">
    <?php $metrics = app('App\Helpers\Report'); ?>
    <div id="deal-stage-chart"></div>
    
  </div>
</section>
<?php $__env->startPush('pagescript'); ?>
<?php echo $__env->make('stacks.js.chart', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
let stage_chart = new frappe.Chart( "#deal-stage-chart", {
data: {
labels: [
<?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  "<?php echo e($stage->name); ?>",
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
],
datasets: [
{
name: "Deal Value", chartType: 'line',
values: [
<?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    "<?php echo e($metrics->dealsByStage($s->id)); ?>",
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  ]
}
],
},
title: "<?php echo e(langapp('currency')); ?> - <?php echo e(get_option('default_currency')); ?>",
type: 'axis-mixed',
height: 300,
colors: ['light-green'],
isNavigable: 1,
  lineOptions: {
    dotSize: 8
  },
tooltipOptions: {
  formatTooltipX: d => (d + '').toUpperCase(),
  formatTooltipY: d => d + ' <?php echo e(get_option('default_currency')); ?>',
}
});
</script>
<?php $__env->stopPush(); ?>