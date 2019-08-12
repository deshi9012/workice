<?php $__currentLoopData = $contacts->chunk(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="row">
        <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-md-6">
              <div class="thumbnail">
                <div class="thumb thumb-rounded">
                  <a href="<?php echo e(route('contacts.view', $contact->user_id)); ?>"><img src="<?php echo e($contact->photo); ?>" alt=""></a>
                  
                </div>
              
                  <div class="caption text-center">
                    <h6 class="text-semibold">
                      <a href="<?php echo e(route('contacts.view', $contact->user_id)); ?>">
                        <?php echo e($contact->user->name); ?> 
                      </a>
                      <span class="display-block text-muted m-xs"><?php echo e($contact->job_title); ?></span>
                      <?php if($contact->company > 0): ?>
                      <span class="display-block text-muted m-xs"><?php echo e(optional($contact->business)->name); ?></span>
                      <?php endif; ?>

                    </h6>

    <p class="m-t-sm">

     

      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clients_update')): ?>
                        <a href="<?php echo e(route('contacts.primary', ['id' => $contact->company, 'user' => $contact->user_id])); ?>"
                                   class="btn btn-<?php echo e(optional($contact->business)->primary_contact === $contact->user_id ? 'success' : 'default'); ?> btn-rounded btn-icon" data-rel="tooltip" title="<?php echo trans('app.'.'contact_person'); ?>">
                                   <?php echo e(svg_image('regular/user-circle')); ?>
                        </a>

                        <a href="<?php echo e(route('contacts.edit', ['id' => $contact->user_id])); ?>"
                                   class="btn btn-default btn-rounded btn-icon" data-rel="tooltip" title="<?php echo trans('app.'.'edit'); ?>" data-toggle="ajaxModal">
                                    <?php echo e(svg_image('solid/pencil-alt')); ?> 
                        </a>

      <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users_delete')): ?>
                                <a href="<?php echo e(route('users.delete', ['id' => $contact->user_id])); ?>"
                                   class="btn btn-default btn-rounded btn-danger btn-icon" data-rel="tooltip" title="<?php echo trans('app.'.'delete'); ?>" data-toggle="ajaxModal">
                                    <?php echo e(svg_image('solid/trash-alt')); ?> </a>
                        <?php endif; ?>
      
       
                          
    </p>

                    
                  </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>