<div class="panel-group m-b" id="accordion2">
  <?php $__currentLoopData = $vaults; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vault): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo e($vault->id); ?>" aria-expanded="false">
       <?php echo e(svg_image('solid/lock', 'text-success')); ?>  <?php echo e($vault->key); ?>

      </a>
    </div>
    <div id="collapse<?php echo e($vault->id); ?>" class="panel-collapse collapse no-height" aria-expanded="false">
      <div class="panel-body text-sm">
        <?php echo parsedown($vault->key_value); ?>

        <?php if($vault->user_id == Auth::id()): ?>
        <a href="<?php echo e(route('extras.vaults.delete', ['id' => $vault->id])); ?>" class="btn btn-xs btn-danger pull-right" data-toggle="ajaxModal"><?php echo e(svg_image('solid/trash-alt')); ?></a>
        <a href="<?php echo e(route('extras.vaults.edit', ['id' => $vault->id])); ?>" class="btn btn-xs btn-default" data-toggle="ajaxModal"><?php echo e(svg_image('solid/pencil-alt')); ?></a>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  
  
</div>