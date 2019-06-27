<?php $__env->startSection('content'); ?>
<section id="content">
    <section class="hbox stretch">
        <aside class="aside-lg" id="subNav">
            <header class="dk header b-b">
                <div class="padder-v">
                    <?php echo trans('app.'.'messages'); ?>
                    <a href="<?php echo e(route('messages.new')); ?>" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?> pull-right">
                        <?php echo e(svg_image('solid/paper-plane')); ?> <?php echo trans('app.'.'send'); ?>
                    </a>
                </div>
                
            </header>
                <section class="scrollable">
                    <section class="slim-scroll msg-thread" data-height="500px" id="sender-list">
                        <?php echo $__env->make('messages::partials.search', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php echo $__env->make('messages::threads', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </section>
                </section>
        </aside>
        <aside class="bg-light lter b-l" id="email-list">
            <section class="vbox">
                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-4 col-sm-offset-8 m-b-xs">
                            
                            
                        </div>
                    </div>
                </header>
                <section class="scrollable wrapper bg">
                    
                </section>
            </section>
        </aside>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('pagescript'); ?>
<?php echo $__env->make('stacks.js.list', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script>
    var options = {
        valueNames: [ 'sender-name' ]
    };
    var senderList = new List('sender-list', options);
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>