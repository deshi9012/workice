<div class="row">
<?php $counter = 0; ?>
<?php $__currentLoopData = $contracts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $contract): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(!(($counter++) % 2)): ?>
</div>
					<div class="row">
						<?php endif; ?>
						<div class="col-md-6">
							<div class="panel invoice-grid widget-b">
								<div class="panel-body">
									<div class="row">
										<div class="col-sm-6">
											<h3 class="h3 text-ellipsis">
											<a href="<?php echo e(route('contracts.view', ['id' => $contract->id])); ?>">
											<?php echo e($contract->contract_title); ?></a>
											</h3>
											<ul class="list list-unstyled">
												<li>
													<a href="<?php echo e(route('clients.view', ['id' => $contract->client_id])); ?>">
														<?php echo e($contract->company->name); ?>

													</a>
												</li>
												<li><?php echo trans('app.'.'start_date'); ?> :
													<span class="">
														<?php echo e(dateFormatted($contract->start_date)); ?>

													</span>
												</li>
											</ul>
										</div>
										<div class="col-sm-6">
											<?php if($contract->rate_is_fixed == '1'): ?>
											<?php
											$rate = formatCurrency($contract->currency, $contract->fixed_rate);
											?>
											<?php else: ?>
											<?php
											$rate = formatCurrency($contract->currency, $contract->hourly_rate).'/hr';
											?>
											<?php endif; ?>
											<h4 class="text-right h3"><?php echo e($rate); ?></h4>
											<ul class="list list-unstyled text-right">
												<li><?php echo trans('app.'.'signed'); ?>:
													<span class="text-success">
													<?php echo e(($contract->signed == '1') ? langapp('yes') : langapp('no')); ?></span>
												</li>
												<li><?php echo trans('app.'.'status'); ?>:
													<span class="label label-danger"><?php echo e($contract->status); ?></span>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="panel-footer panel-footer-condensed">
									<a class="heading-elements-toggle"></a>
									<div class="heading-elements">
										<span class="heading-text">
											<span class="status-mark border-danger position-left"></span> <?php echo trans('app.'.'due_date'); ?> :
											<span class=""><?php echo e(dateFormatted($contract->expiry_date)); ?></span>
										</span>
										<div class="btn-group btn-group-animated pull-right">
											<button type="button" class="btn btn-xs btn-<?php echo e(get_option('theme_color')); ?> dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<?php echo e(svg_image('solid/ellipsis-h')); ?>
											</button>
											<ul class="dropdown-menu">
												<li>
													<a href="<?php echo e(route('contracts.download', ['id' => $contract->id])); ?>">
														<?php echo e(svg_image('solid/file-pdf')); ?> PDF
													</a>
												</li>

												<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contracts_sign')): ?>
                                				<?php if($contract->signed == '0'): ?>
												<li>
													<a href="<?php echo e(route('contracts.send', ['id' =>$contract->id])); ?>" data-toggle="ajaxModal">
														<?php echo e(svg_image('solid/paper-plane')); ?> <?php echo trans('app.'.'sign_send'); ?>
													</a>
												</li>
												<?php endif; ?>
												<li><a href="<?php echo e(route('contracts.share', $contract->id)); ?>" data-toggle="ajaxModal"><?php echo e(svg_image('solid/link')); ?> <?php echo trans('app.'.'share'); ?></a></li>
												<?php endif; ?>

												<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contracts_create')): ?>
												<li>
													<a href="<?php echo e(route('contracts.copy', $contract->id)); ?>" data-toggle="ajaxModal">
														<?php echo e(svg_image('solid/copy')); ?> <?php echo trans('app.'.'copy'); ?>
													</a>
												</li>
												<?php endif; ?>

												<?php if(!is_null($contract->sent_at)): ?>
												<li>
													<a href="<?php echo e(route('contracts.remind', ['id' => $contract->id])); ?>" data-toggle="ajaxModal">
														<?php echo e(svg_image('solid/history')); ?> <?php echo trans('app.'.'reminder'); ?>
													</a>
												</li>
												<?php endif; ?>

												<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contracts_update')): ?>
												<li>
													<a href="<?php echo e(route('contracts.edit', ['id' => $contract->id])); ?>">
														<?php echo e(svg_image('solid/pencil-alt')); ?> <?php echo trans('app.'.'make_changes'); ?>
													</a>
												</li>
												<?php endif; ?>
												<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contracts_delete')): ?>
												<li>
													<a href="<?php echo e(route('contracts.delete', ['id' => $contract->id])); ?>" data-toggle="ajaxModal">
														<?php echo e(svg_image('solid/trash-alt')); ?> <?php echo trans('app.'.'delete'); ?>
													</a>
												</li>
												<?php endif; ?>
												
											</ul>
										</div>
										
										
									</div>
								</div>
							</div>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>