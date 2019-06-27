<?php $__env->startSection('content'); ?>

<section id="content">
    <section class="hbox stretch">

        <aside>
            <section class="vbox">
                <header class="header bg-white b-b b-light">

                <?php if(isAdmin() || can('events_create')): ?> 
                        <a href="<?php echo e(route('calendar.create', ['module' => 'events'])); ?>" data-toggle="ajaxModal"
                           class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?>">
                       <?php echo e(svg_image('solid/calendar-plus')); ?> <?php echo trans('app.'.'add_event'); ?>  </a>
                                    
                        <a href="<?php echo e(route('calendar.appointments')); ?>" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?>">
                        <?php echo e(svg_image('solid/calendar-check')); ?> <?php echo trans('app.'.'appointments'); ?></a>

                <?php endif; ?>

                <?php if (\Illuminate\Support\Facades\Blade::check('admin')): ?>
                <a href="<?php echo e(route('settings.calendars.show')); ?>" data-toggle="ajaxModal" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?> pull-right" data-rel="tooltip" title="<?php echo trans('app.'.'calendars'); ?>" data-placement="bottom">
                    <?php echo e(svg_image('solid/cogs')); ?>
                </a>
                <?php endif; ?>

                <div class="btn-group pull-right">
                        <button class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm dropdown-toggle btn-responsive"
                        data-toggle="dropdown"> <?php echo trans('app.'.'calendars'); ?> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <?php $__currentLoopData = Modules\Calendar\Entities\CalendarType::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                            <a href="<?php echo e(route('set.calendar.type', ['view' => $cal->id])); ?>">
                                <?php echo e($cal->name); ?>

                            </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                <a href="<?php echo e(route('calendar.ical')); ?>" data-toggle="ajaxModal" title="<?php echo trans('app.'.'download'); ?> " data-placement="bottom" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?> pull-right">
                    <?php echo e(svg_image('solid/calendar-alt')); ?> iCal</a>

                </header>
                <section class="scrollable wrapper bg">

                        <div class="calendar" id="calendar"></div>

                </section>

            </section>
        </aside>

    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>

<?php $__env->startPush('pagestyle'); ?>
    <?php echo $__env->make('stacks.css.fullcalendar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('pagescript'); ?>
    <?php echo $__env->make('stacks.js.fullcalendar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('partial.calendar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>