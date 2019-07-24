<div class="col-md-12">
	<section class="panel panel-default b-top">
		<header class="panel-heading h3">

			<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('events_create')): ?>

				
				   
					


				<a href="/calendar/appointments/create/<?php echo e($lead->id); ?>" data-toggle="ajaxModal"
				   class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?>">
					<?php echo e(svg_image('solid/calendar-plus')); ?> <?php echo trans('app.'.'add_appointment'); ?></a>

				
				   

			<?php endif; ?>

			
		</header>

		<section class="panel panel-body">

			<div class="calendar" id="appointments"></div>
		</section>


	</section>
</div>

<?php $__env->startPush('pagestyle'); ?>
	<?php echo $__env->make('stacks.css.fullcalendar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('pagescript'); ?>
	<?php echo $__env->make('stacks.js.fullcalendar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
	<script type="text/javascript">
		$(document).ready(function () {
			$('#appointments').fullCalendar({
				eventAfterRender: function (event, element, view) {
					$(element).attr('data-toggle', 'ajaxModal').addClass('ajaxModal');
				},
				themeSystem: 'bootstrap3',
				nowIndicator: true,
				timezone: '<?php echo e(get_option('timezone')); ?>',
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				},
				eventSources: [
					{
						events: [
								
							
								
								
								
								
								
							
								
								<?php $__currentLoopData = $lead->appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							{
								title: '<?php echo e(addslashes($event->name)); ?>',
								start: '<?php echo e(date('Y-m-d H:i', strtotime($event->start_time))); ?>',
								end: '<?php echo e(date('Y-m-d H:i', strtotime($event->finish_time))); ?>',
								url: '<?php echo e(route('calendar.view.appointment', ['id' => $event->id, 'module' => 'appointments'])); ?>',
								color: '<?php echo e($event->color); ?>'
							},
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						],
						color: '#7266BA',
						textColor: 'white'
					},
					{
						events: [
								<?php $__currentLoopData = $lead->todos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							{
								title: '<?php echo e(addslashes($activity->subject)); ?>',
								start: '<?php echo e(date('Y-m-d H:i:s', strtotime($activity->due_date))); ?>',
								end: '<?php echo e(date('Y-m-d H:i:s', strtotime($activity->due_date))); ?>',
								url: '<?php echo e(route('todo.edit', ['id' => $activity->id])); ?>',
								color: '#<?php echo e($activity->completed === 1 ? 'ea2e49' : '22b66e'); ?>',
							},
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						],
						textColor: 'white'
					}
				]
			});
		});
	</script>
<?php $__env->stopPush(); ?>

