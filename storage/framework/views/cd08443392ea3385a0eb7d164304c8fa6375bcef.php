 
<?php $__env->startSection('content'); ?>
<section id="content" class="">
	
	<section class="vbox">
		<header class="header panel-heading bg-white b-b b-light">
			<div class="btn-group">
				<button class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm dropdown-toggle" data-toggle="dropdown"> <?php echo trans('app.'.'filter'); ?>
				<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo e(route('contracts.index', ['filter' => 'viewed'])); ?>">
							<?php echo trans('app.'.'viewed'); ?>
						</a>
					</li>
					<li>
						<a href="<?php echo e(route('contracts.index', ['filter' => 'draft'])); ?>">
							<?php echo trans('app.'.'draft'); ?>
						</a>
					</li>
					<li>
						<a href="<?php echo e(route('contracts.index', ['filter' => 'signed'])); ?>">
							<?php echo trans('app.'.'signed'); ?>
						</a>
					</li>
					<li>
						<a href="<?php echo e(route('contracts.index', ['filter' => 'sent'])); ?>">
							<?php echo trans('app.'.'sent'); ?>
						</a>
					</li>
					<li>
						<a href="<?php echo e(route('contracts.index', ['filter' => 'expired'])); ?>">
							<?php echo trans('app.'.'expired'); ?>
						</a>
					</li>
					<li>
						<a href="<?php echo e(route('contracts.index', ['filter' => 'rejected'])); ?>">
							<?php echo trans('app.'.'rejected'); ?>
						</a>
					</li>
					<li>
						<a href="<?php echo e(route('contracts.index')); ?>"><?php echo trans('app.'.'contracts'); ?> </a>
					</li>
				</ul>
			</div>
			<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contracts_create')): ?>
			<a href="<?php echo e(route('contracts.create')); ?>" class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm pull-right" title="<?php echo trans('app.'.'create'); ?>  ">
			<?php echo e(svg_image('solid/plus')); ?> <?php echo trans('app.'.'create'); ?> </a>
			<?php endif; ?>
		</header>
		<section class="scrollable wrapper scrollpane bg">

			<div id="ajaxData"></div>
				
			
		</section>
	</section>
	<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>

<?php $__env->startPush('pagescript'); ?>
  <?php echo $__env->make('contracts::_scripts._contracts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>