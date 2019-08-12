<?php $__env->startSection('content'); ?>
	<section id="content" class="bg">
		<section class="vbox">
			<header class="header bg-white b-b b-light">
				<div class="btn-group pull-right">
					<a href="<?php echo e(route('leads.index', ['view' => 'table'])); ?>" data-rel="tooltip" title="Table"
					   data-placement="bottom" class="btn btn-sm btn-default">
						<?php echo e(svg_image('solid/th')); ?>
					</a>
					<a href="<?php echo e(route('leads.index', ['view' => 'kanban'])); ?>" data-rel="tooltip" title="Kanban"
					   data-placement="bottom" class="btn btn-sm btn-default">
						<?php echo e(svg_image('solid/align-justify')); ?>
					</a>
					<a href="<?php echo e(route('leads.index', ['view' => 'heatmap'])); ?>" data-rel="tooltip" title="Heatmap"
					   data-placement="bottom" class="btn btn-sm btn-success">
						<?php echo e(svg_image('solid/chart-line')); ?>
					</a>
				</div>

				<?php if(!(Auth::user()->hasRole('sales agent') || Auth::user()->hasRole('sales team leader'))): ?>
					<div class="btn-group">
						<button class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm dropdown-toggle"
								data-toggle="dropdown"> <?php echo trans('app.'.'filter'); ?>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li>
								<a href="<?php echo e(route('leads.index', ['filter' => 'converted'])); ?>">
									<?php echo trans('app.'.'converted'); ?>
								</a>
							</li>
							<li>
								<a href="<?php echo e(route('leads.index', ['filter' => 'archived'])); ?>">
									<?php echo trans('app.'.'archived'); ?>
								</a>
							</li>
							<li>
								<a href="<?php echo e(route('leads.index')); ?>">
									<?php echo trans('app.'.'all'); ?>
								</a>
							</li>
						</ul>
					</div>
				<?php endif; ?>
				<?php if(!Auth::user()->hasRole('sales agent')): ?>
					<a href="<?php echo e(route('leads.create')); ?>" data-toggle="ajaxModal" data-rel="tooltip"
					   title="<?php echo trans('app.'.'create'); ?>" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?>">
						<?php echo e(svg_image('solid/plus')); ?> <?php echo trans('app.'.'create'); ?>
					</a>
				<?php endif; ?>

				<?php if (\Illuminate\Support\Facades\Blade::check('admin')): ?>
				<a href="<?php echo e(route('settings.stages.show', 'leads')); ?>" data-toggle="ajaxModal"
				   class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?> pull-right" data-rel="tooltip"
				   title="<?php echo trans('app.'.'stages'); ?>" data-placement="bottom">
					<?php echo e(svg_image('solid/cogs')); ?>
				</a>
				<?php endif; ?>

				
				<?php if (\Illuminate\Support\Facades\Blade::check('admin')): ?>
				<div class="btn-group">
					<button class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm dropdown-toggle"
							data-toggle="dropdown" aria-expanded="false"><?php echo trans('app.'.'import'); ?> <span
								class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="<?php echo e(route('leads.import', ['type' => 'leads'])); ?>" data-toggle="ajaxModal"><?php echo trans('app.'.'csv_file'); ?></a>
						</li>
						<li><a href="<?php echo e(route('leads.import', ['type' => 'google'])); ?>">Google
								<?php echo trans('app.'.'contacts'); ?></a></li>
					</ul>
				</div>


				<a href="<?php echo e(route('leads.export')); ?>" title="<?php echo trans('app.'.'export'); ?>  "
				   class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?>">
					<?php echo e(svg_image('solid/file-csv')); ?> CSV
				</a>
				<?php endif; ?>
				


			</header>
			<section class="scrollable wrapper overflow-x-auto">


				<div class="row">
					<?php if($displayType == 'table'): ?>
						<?php echo $__env->make('leads::table_view_converted', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php endif; ?>
				</div>


			</section>
		</section>
		<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
	</section>
	<?php $__env->startPush('pagescript'); ?>
		<script type="text/javascript">
			$(document).ready(function () {
				var kanbanCol = $('.scrumboard');
				draggableInit();
			});

			function draggableInit() {
				var sourceId;
				$('[draggable=true]').bind('dragstart', function (event) {
					sourceId = $(this).parent().attr('id');
					event.originalEvent.dataTransfer.setData("text/plain", event.target.getAttribute('id'));
				});
				$('.scrumboard').bind('dragover', function (event) {
					event.preventDefault();
				});
				$('.scrumboard').bind('drop', function (event) {
					var children = $(this).children();
					var targetId = children.attr('id');
					if (sourceId != targetId) {
						var elementId = event.originalEvent.dataTransfer.getData("text/plain");
						$('#processing-modal').modal('toggle');
						setTimeout(function () {
							var element = document.getElementById(elementId);
							id = element.getAttribute('id');
							axios.post('/api/v1/leads/' + id + '/movestage', {
								id: id,
								target: targetId
							})
								.then(function (response) {
									toastr.success(response.data.message, '<?php echo trans('app.'.'
									success
									'); ?> '
								)
									;
								})
								.catch(function (error) {
									var errors = error.response.data.errors;
									var errorsHtml = '';
									$.each(errors, function (key, value) {
										errorsHtml += '<li>' + value[0] + '</li>';
									});
									toastr.error(errorsHtml, '<?php echo trans('app.'.'
									response_status
									'); ?> '
								)
									;
								});
							children.prepend(element);
							$('#processing-modal').modal('toggle');
						}, 1000);
					}
					event.preventDefault();
				});
			}
		</script>
	<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>