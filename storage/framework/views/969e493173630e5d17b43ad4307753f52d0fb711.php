<?php $__currentLoopData = $emails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="padder m-t">
  <div class="block clearfix m-b">
    <div class="m-t-xs <?php echo e($email->opened > 0 ? 'text-success' : 'text-dracula'); ?>"><?php echo e(svg_image('regular/envelope-open')); ?> <?php echo e($email->subject); ?>

      <span class="pull-right small"><?php echo e(svg_image('solid/clock')); ?> <?php echo e(dateElapsed($email->created_at)); ?> <a href="<?php echo e(route('email.delete', ['id' => $email->id])); ?>" data-toggle="ajaxModal"><?php echo e(svg_image('solid/trash-alt')); ?></a></span>
    </div>
    <div class="line pull-in"></div>
    
  </div>
  
  <?php echo parsedown($email->message); ?>
  <?php echo $__env->make('partial._show_files', ['files' => $email->files], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>