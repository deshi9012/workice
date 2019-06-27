<script type="text/javascript">
    $(document).ready(function () {
        $('#calendar').fullCalendar({
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
                        <?php $__currentLoopData = Auth::user()->schedules->where('calendar_id', activeCalendar()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        {
                            title: '<?php echo e(addslashes($event->event_name)); ?>',
                            start: '<?php echo e(date('Y-m-d H:i:s', strtotime($event->start_date))); ?>',
                            end: '<?php echo e(date('Y-m-d H:i:s', strtotime($event->end_date))); ?>',
                            url: '<?php echo e($event->url); ?>',
                            type: 'fo',
                            allDay: false,
                            color: '<?php echo e($event->color); ?>'
                        },
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!isAdmin() && Auth::user()->profile->company > 0): ?>

                        <?php $__currentLoopData = Auth::user()->profile->business->invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        {
                            title: '<?php echo e(addslashes($inv->name)); ?>',
                            start: '<?php echo e(date('Y-m-d H:i:s', strtotime($inv->due_date))); ?>',
                            end: '<?php echo e(date('Y-m-d H:i:s', strtotime($inv->due_date))); ?>',
                            url: '<?php echo e(route('invoices.view', $inv->id)); ?>',
                            type: 'fo',
                            allDay: false,
                            color: '#545caf'
                        },
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php $__currentLoopData = Auth::user()->profile->business->estimates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $est): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        {
                            title: '<?php echo e(addslashes($est->name)); ?>',
                            start: '<?php echo e(date('Y-m-d H:i:s', strtotime($est->due_date))); ?>',
                            end: '<?php echo e(date('Y-m-d H:i:s', strtotime($est->due_date))); ?>',
                            url: '<?php echo e(route('estimates.view', $est->id)); ?>',
                            type: 'fo',
                            allDay: false,
                            color: '#4a68f8'
                        },
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php $__currentLoopData = Auth::user()->profile->business->contracts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contract): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        {
                            title: '<?php echo e(addslashes($contract->contract_title)); ?>',
                            start: '<?php echo e(date('Y-m-d H:i:s', strtotime($contract->expiry_date))); ?>',
                            end: '<?php echo e(date('Y-m-d H:i:s', strtotime($contract->expiry_date))); ?>',
                            url: '<?php echo e(route('contracts.view', $contract->id)); ?>',
                            type: 'fo',
                            allDay: false,
                            color: '#00d65f'
                        },
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php $__currentLoopData = Auth::user()->profile->business->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        {
                            title: '<?php echo e(addslashes($payment->code)); ?>',
                            start: '<?php echo e(date('Y-m-d H:i:s', strtotime($payment->payment_date))); ?>',
                            end: '<?php echo e(date('Y-m-d H:i:s', strtotime($payment->payment_date))); ?>',
                            url: '<?php echo e(route('invoices.view', $payment->invoice_id)); ?>',
                            type: 'fo',
                            allDay: false,
                            color: '#f43445'
                        },
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php $__currentLoopData = Auth::user()->profile->business->projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        {
                            title: '<?php echo e(addslashes($project->name)); ?>',
                            start: '<?php echo e(date('Y-m-d H:i:s', strtotime($project->due_date))); ?>',
                            end: '<?php echo e(date('Y-m-d H:i:s', strtotime($project->due_date))); ?>',
                            url: '<?php echo e(route('projects.view', $project->id)); ?>',
                            type: 'fo',
                            allDay: false,
                            color: '#0772d1'
                        },
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php endif; ?>
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