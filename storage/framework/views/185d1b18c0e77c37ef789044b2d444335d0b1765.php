<?php $__currentLoopData = $contacts->chunk(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="row">
        <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-md-6">
              <div class="thumbnail">
                <div class="thumb thumb-rounded">
                  <a href="<?php echo e(route('contacts.view', $contact->user_id)); ?>">
                    <img src="<?php echo e($contact->photo); ?>" alt="" class="avatar-img">
                  </a>
                  
                </div>
              
                  <div class="caption text-center">
                    <h6>
                      <a href="<?php echo e(route('contacts.view', $contact->user_id)); ?>" >
                        <?php echo e($contact->name); ?> 
                      </a>
                      <span class="display-block text-muted m-xs"><?php echo e($contact->job_title); ?></span>
                      <?php if($contact->company > 0): ?>
                      <span class="display-block text-muted m-xs"><?php echo e(optional($contact->business)->name); ?></span>
                      <?php endif; ?>

                    </h6>

    <p class="m-t-sm">
      
       <?php if(!empty($contact->twitter)): ?>
       <a href="<?php echo e($contact->twitter); ?>" target="_blank" class="btn btn-rounded btn-twitter btn-icon"><?php echo e(svg_image('brands/twitter')); ?></a>
       <?php endif; ?>
       <?php if(!empty($contact->skype)): ?>
       <a href="skype:<?php echo e($contact->skype); ?>?call" class="btn btn-rounded btn-info btn-icon"><?php echo e(svg_image('brands/skype')); ?></a>
       <?php endif; ?>
    <a href="<?php echo e(route('contacts.email', $contact->user_id)); ?>" class="btn btn-rounded btn-dracula btn-icon" data-toggle="ajaxModal" data-rel="tooltip" title="<?php echo trans('app.'.'send_email'); ?>"><?php echo e(svg_image('solid/paper-plane')); ?></a>
                          
    </p>

                    
                  </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>