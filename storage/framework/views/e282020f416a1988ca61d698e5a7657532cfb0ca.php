<div class="line"></div>
<small class="text-uc text-xs text-muted"><?php echo trans('app.'.'custom_fields'); ?></small>
<ul class="no-style p-l-5">
<?php $__currentLoopData = $custom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(App\Entities\CustomField::where(['name' => $f->meta_key])->count() > 0): ?>
<li class="m-xs">
    <span class="text-muted"><?php echo e(svg_image('solid/dot-circle')); ?>
    <?php echo e(ucfirst(humanize($f->meta_key, '-'))); ?>:</span> <?php echo e(isJson($f->meta_value) ? implode(', ', json_decode($f->meta_value)) : $f->meta_value); ?>

</li>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>