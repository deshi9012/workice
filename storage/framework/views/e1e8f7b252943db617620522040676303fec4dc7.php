<?php $__currentLoopData = $calls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $call): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<li class="dd-item dd3-item" data-id="<?php echo e($call->id); ?>" id="call-<?php echo e($call->id); ?>" >
  
  <span class="pull-right m-xs">
    <?php if($call->user_id === Auth::id() || isAdmin()): ?>
    <a href="<?php echo e(route('extras.call.edit', $call->id)); ?>" data-toggle="ajaxModal" data-rel="tooltip" title="<?php echo trans('app.'.'make_changes'); ?>">
      <?php echo e(svg_image('solid/pencil-alt', 'icon-muted fa-fw m-r-xs')); ?>
    </a>
    <?php endif; ?>
    
    
    <?php if($call->user_id === Auth::id() || isAdmin()): ?>
    <a href="#" class="deleteCall" data-call-id="<?php echo e($call->id); ?>" data-rel="tooltip" title="<?php echo trans('app.'.'delete'); ?>">
      <?php echo e(svg_image('solid/times', 'icon-muted fa-fw m-r-xs')); ?>
    </a>
    <?php endif; ?>
  </span>
  
  <div class="dd3-content">
    <label>
      <span class="label-text">
        <span id="call-id-<?php echo e($call->id); ?>">
          <span class="" data-rel="tooltip" title="<?php echo e(ucfirst($call->type)); ?>"><?php echo e(svg_image('solid/signal', 'text-muted')); ?></span> <?php echo e($call->subject); ?> 
          <small class="text-muted small m-l-sm"><?php echo e(svg_image('solid/phone-volume')); ?> <?php echo e(gmsec($call->duration)); ?> - <?php echo e($call->agent->name); ?></small>
          <?php if(!is_null($call->scheduled_date)): ?>
            <?php echo e(svg_image('solid/calendar-check', 'text-danger')); ?>
          <?php endif; ?>
        </span>
      </span>
    </label>
    <?php if(!empty($call->description)): ?>
    <p class="m-xs"><?php echo parsedown($call->description); ?></p>
    <?php endif; ?>
    <?php if(!empty($call->result)): ?>
    <blockquote><?php echo parsedown($call->result); ?></blockquote>
    <?php endif; ?>

    
  </div>

</li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>