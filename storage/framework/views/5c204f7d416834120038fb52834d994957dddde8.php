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
						<?php echo $__env->make('leads::table_view', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php endif; ?>
					<?php if($displayType == 'kanban'): ?>
						<div class="col-lg-12">
							<div class="card">
								<div class="card-body collapse in">
									<div class="card-block">
										<div class="overflow-hidden">
											<div id="todo-lists-basic-demo"
												 class="lobilists-wrapper lobilists single-line sortable ps-container ps-theme-dark ps-active-x">
												<?php
													$cards = App\Entities\Category::whereModule('leads')->orderBy('order', 'asc')->get();
												?>
												<?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<div class="lobilist-wrapper ps-container ps-theme-dark ps-active-y kanban-col">
														<div id="lobilist-list-0"
															 class="lobilist lobilist-default">
															<div class="lobilist-header ui-sortable-handle">
																<div class="lobilist-title text-ellipsis text-uc text-muted">
																	<span class="arrow right"></span> <?php echo e(ucfirst($card->name)); ?>

																</div>
															</div>
															<div class="lobilist-body scrumboard slim-scroll"
																 data-disable-fade-out="true"
																 data-distance="0" data-size="3px" data-height="550"
																 data-color="#333333">
																<ul class="lobilist-items ui-sortable list"
																	id="<?php echo e(snake_case($card->name)); ?>">
																	<?php $leadCounter = 0; ?>
																	<?php $__currentLoopData = Modules\Leads\Entities\Lead::whereNull('archived_at')->where('stage_id', $card->id)->with(['agent:id,username,name'])->orderBy('id', 'desc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
																		<li id="<?php echo e($lead->id); ?>" draggable="true"
																			class="lobilist-item kanban-entry grab <?php echo e(!is_null($lead->unsubscribed_at) ? 'subscribe-bg' : ''); ?>">
																			<div class="lobilist-item-title text-ellipsis m-l-xs font14">
																				<a href="<?php echo e(route('leads.view', ['id' => $lead->id])); ?>"
																				   class=""><?php echo e($lead->name); ?></a>
																				<?php if($lead->has_email): ?>
																					<?php echo e(svg_image('regular/envelope',
																					'text-success')); ?>
																				<?php endif; ?>
																			</div>
																			<div class="lobilist-item-description text-muted">
																				<small class="pull-right xs">
																					<?php echo e(svg_image('regular/user')); ?>
																					<?php echo e(optional($lead->agent)->name); ?>

																				</small>

																				<span class="text-bold">
                                                                    <?php echo e($lead->computed_value); ?>

                                                                    
                                                                </span>
																			</div>
																			<small class="text-muted">
																				<?php echo e(!empty($lead->due_date) ? dateElapsed($lead->due_date) : ''); ?>

																			</small>
																			<div class="lobilist-item-duedate">
																				<?php echo e(dateFormatted($lead->due_date)); ?>

																			</div>
																			<?php if($lead->sales_rep > 0): ?>
																				<span class="thumb-xs avatar lobilist-check">
                                                                <img src="<?php echo e($lead->agent->profile->photo); ?>"
																	 class="img-circle">
                                                            </span>
																			<?php endif; ?>
																			<div class="todo-actions">
																				<?php if($lead->has_activity): ?>
																					<div class="edit-todo todo-action">
																						<a href="<?php echo e(route('leads.view', ['id' => $lead->id, 'tab' => 'activity'])); ?>">
																							<?php echo e(svg_image('solid/tasks',
																							'text-warning')); ?>
																						</a>
																					</div>
																				<?php endif; ?>
																			</div>
																			<div class="drag-handler"></div>
																		</li>
																		<?php $leadCounter++; ?>
																	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
																</ul>
															</div>
															<div class="lobilist-footer">
																<strong><?php echo metrics('leads_stage_'.$card->id); ?></strong>
																<strong class="pull-right"><?php echo e($leadCounter); ?>

																	Lead(s)</strong>
															</div>
														</div>
													</div>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												<div class="modal modal-static fade" id="processing-modal"
													 role="dialog" aria-hidden="true">
													<div class="modal-dialog processing-modal">
														<div class="modal-content">
															<div class="modal-body">
																<div class="text-center">
																	<?php echo e(svg_image('solid/sync-alt', 'fa-4x fa-spin')); ?>
																	<h4>Processing...</h4>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endif; ?>
					<?php if($displayType == 'heatmap'): ?>
						<?php echo $__env->make('leads::heatmap_view', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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