<section class="comment-list block m-sm">
        <section class="scrollable">
            <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <article id="comment-id-<?php echo e($activity->id); ?>" class="comment-item small">
                <div class="pull-left thumb-sm">
                    <img src="<?php echo e($activity->user->profile->photo); ?>"
                    class="img-circle">
                </div>
                <section class="comment-body m-b-md">
                    <header class="b-b">
                        <strong class="text-muted">
                        <?php echo e($activity->user->name); ?></strong>
                        <span class="text-muted text-xs pull-right">
                            <?php echo e(dateElapsed($activity->created_at)); ?>

                        </span>
                    </header>
                    <div class="m-t-xs">
                        <?php echo trans('activity.'.$activity->action, ['value1' => '<span class="text-info">'.$activity->value1.'</span>', 'value2' => '<span class="text-success">'.$activity->value2.'</span>']); ?>
                    </div>
                </section>
            </article>
            
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </section>
    </section>