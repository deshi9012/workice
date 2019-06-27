<ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border list">
    
        <?php $__currentLoopData = $threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inbox): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php if(!is_null($inbox->thread)): ?>
        <li class="list-group-item p-lr">
            
        <a href="<?php echo e(route('users.view', ['id' => $inbox->withUser->id])); ?>" class="thumb-sm pull-left m-r-sm">
                                <img src="<?php echo e($inbox->withUser->profile->photo); ?>" class="img-circle">
                              </a>

                               <span class="clear">
                                <small class="pull-right"><?php echo $inbox->thread->is_seen == 0 && $inbox->thread->sender->id != Auth::id() ? '<i class="far fa-bell text-success"></i>' : ''; ?></small>
                                <a href="<?php echo e(route('message.read', ['id' => $inbox->withUser->id])); ?>">
                                <span class="block sender-name"><?php echo e($inbox->withUser->name); ?></span>
                                </a>

                                <small class="text-ellipsis">
                    <?php if(Auth::id() == $inbox->thread->sender->id): ?>
                        <?php echo e(svg_image('solid/reply')); ?>
                    <?php endif; ?> <?php echo e(str_limit(strip_tags($inbox->thread->message), 200)); ?></small>
                              </span>
            
        </li>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </ul>