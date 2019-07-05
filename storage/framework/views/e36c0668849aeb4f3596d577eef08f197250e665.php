<?php $__env->startSection('content'); ?>

<section id="content">
    <section class="hbox stretch">

        <aside>
            <section class="vbox">
                <header class="header bg-white b-b b-light">

                <?php if(isAdmin() || can('events_create')): ?> 
                        <a href="<?php echo e(route('calendar.create.appointment')); ?>" data-toggle="ajaxModal"
                           class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?>">
                       <?php echo e(svg_image('solid/calendar-plus')); ?> <?php echo trans('app.'.'add_appointment'); ?></a>

                <?php endif; ?>


                </header>
                <section class="scrollable wrapper bg">

                        <div class="appointments" id="appointments"></div>

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
   <script type="text/javascript">
    $(document).ready(function () {
        $('#appointments').fullCalendar({
            googleCalendarApiKey: '<?php echo e(get_option('gcal_api_key')); ?>',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            themeSystem: 'bootstrap3',
            nowIndicator: true,
            dayClick: function(date, jsEvent, view) {
                
            },
            timezone: '<?php echo e(get_option('timezone')); ?>',
            timeFormat: 'h:mm a',
            eventAfterRender: function (event, element, view) {
                if (event.type == 'fo') {
                    $(element).attr('data-toggle', 'ajaxModal').addClass('ajaxModal');
                }
            },
            eventSources: [
                {
                    events: [
                        <?php $__currentLoopData = Auth::user()->appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        {
                            title: '<?php echo e(addslashes($event->name)); ?>',
                            start: '<?php echo e(date('Y-m-d H:i:s', strtotime($event->start_time))); ?>',
                            end: '<?php echo e(date('Y-m-d H:i:s', strtotime($event->finish_time))); ?>',
                            url: '/calendar/appointments/view/<?php echo e($event->id); ?>',
                            type: 'fo',
                            allDay: false,
                            color: '#ca7171'
                        },
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    ],
                    color: '#38354a',
                    textColor: 'white'
                },
                {
                    googleCalendarId: '<?php echo e(get_option('gcal_id')); ?>'
                }
            ]
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>