<aside class="bg-light lter b-l aside-md hide animated fadeInRight scrollable notifier" id="topAlerts">
    <header class="header bg-white b-b b-light">
        <a class="pull-right btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm" id="clear-alerts" data-placement="left" data-rel="tooltip" title="Mark as Read">
            <?php echo e(svg_image('solid/bell-slash')); ?>
        </a>
        <p><?php echo trans('app.'.'notifications'); ?></p>
    </header>
    <div class="slim-scroll" data-disable-fade-out="true" data-distance="0" data-height="500" data-size="5px">
        <div class="m-xs">
            <div class="list-group list-group-alt animated fadeInRight notifier-list">
                <?php $__currentLoopData = Auth::user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="list-group-item">
                    <span data-rel="tooltip" title="<?php echo e(dateElapsed($notification->created_at)); ?>" data-placement="bottom"><i class="fas fa-<?php echo e($notification->data['icon']); ?> text-success"></i> <?php echo e($notification->data['subject']); ?></span>
                    <small class="media-body m-sm text-muted">
                    <?php echo parsedown($notification->data['activity']); ?>
                    </small>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</aside>