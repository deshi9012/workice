<?php $__env->startSection('content'); ?>
	<section id="content">
		<section class="vbox">
			<section class="scrollable">
				<section class="hbox stretch">


					<?php if(isAdmin()): ?>
						<?php echo $__env->make('dashboard::_users.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php elseif(Auth::user()->hasRole('staff')): ?>

						<?php echo $__env->make('dashboard::_users.staff', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php else: ?>
						<?php echo $__env->make('dashboard::_users.clients', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

					<?php endif; ?>
				</section>

			</section>

		</section>

		<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
	</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>