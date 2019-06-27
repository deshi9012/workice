<?php if (\Illuminate\Support\Facades\Blade::check('admin')): ?>
<div class="m-xs">
    <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <span class="label bg-<?php echo e(array_random(['info','success','danger','warning','primary'])); ?> tag-m"><?php echo e(svg_image('solid/tag')); ?> <?php echo e($tag->name); ?></span>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>
