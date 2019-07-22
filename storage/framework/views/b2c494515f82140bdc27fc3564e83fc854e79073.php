<aside class="bg-<?php echo e(get_option('sidebar_theme')); ?> aside-md b-r <?php echo e(settingEnabled('hide_sidebar') ? 'nav-xs' : ''); ?> hidden-print hidden-xs"
	   id="nav">
	<section class="vbox">

		<header class="header bg-dark text-center clearfix">

			<div class="btn-group">
				<button type="button" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?>" title="Language">
					<?php echo e(svg_image('solid/lightbulb')); ?>
				</button>
				<div class="btn-group hidden-nav-xs">
					<button type="button" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?> dropdown-toggle"
							data-toggle="dropdown">
						<?php echo trans('app.'.'quick_links'); ?>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu text-left">
						<li>
							<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users_create')): ?>
								<a href="<?php echo e(route('invite')); ?>" data-toggle="ajaxModal"><?php echo e(svg_image('solid/envelope-open',
									'text-muted')); ?> <?php echo trans('app.'.'send_invite'); ?></a>
							<?php endif; ?>
							<?php if (moduleActive('projects')) { ?>
							<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('projects_create')): ?>
								<a href="<?php echo e(route('projects.create')); ?>"><?php echo e(svg_image('solid/play', 'text-muted')); ?>
									<?php echo trans('app.'.'start_project'); ?></a>
							<?php endif; ?>
							<?php } ?>
							<?php if (moduleActive('contracts')) { ?>
							<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contracts_create')): ?>
								<a href="<?php echo e(route('contracts.create')); ?>"><?php echo e(svg_image('solid/file-contract', 'text-muted')); ?>
									<?php echo trans('app.'.'start_contract'); ?></a>
							<?php endif; ?>
							<?php } ?>
							<?php if (moduleActive('tickets')) { ?>
							<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tickets_create')): ?>
								<a href="<?php echo e(route('tickets.create')); ?>"><?php echo e(svg_image('solid/life-ring', 'text-muted')); ?>
									<?php echo trans('app.'.'new_ticket'); ?></a>
							<?php endif; ?>
							<?php } ?>

						</li>

					</ul>
				</div>
			</div>


		</header>
		<section class="w-f scrollable">
			<div class="slim-scroll" data-color="#333333" data-disable-fade-out="true" data-distance="0"
				 data-height="auto" data-size="5px">

				<nav class="nav-primary hidden-xs">
					<ul class="nav">

						<?php $__currentLoopData = mainMenu(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

							<?php if(count($menu['children']) > 0): ?>

								<li class="nav-w-children <?php echo e($page == langapp($menu['name']) && (in_array($menu['module'], array_pluck($menu['children'], 'parent'))) ? 'active'  : ''); ?>"
									id="<?php echo e($menu['module']); ?>">

									<a href="<?php echo e(site_url($menu['route'])); ?>">
										<i class="<?php echo e($menu['icon']); ?> icon">
											<b class="bg-<?php echo e(get_option('theme_color')); ?>"></b>
										</i>
										<span class="pull-right">
                                    <i class="fas fa-angle-down text"></i>
                                    <i class="fas fa-angle-up text-active"></i>
                                </span>
										<span>
                                    <?php echo trans('app.'.$menu['name']); ?>
                                </span>
									</a>
									<ul class="nav lt">
										<?php $__currentLoopData = $menu['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if(Auth::user()->can($submenu['module'])): ?>
												<li class="<?php echo e($page == langapp($submenu['name']) ? 'active' : ''); ?>">
													<a href="<?php echo e(site_url($submenu['route'])); ?>">
														<i class="<?php echo e($submenu['icon']); ?> icon">
															<b class="bg-<?php echo e(get_option('theme_color')); ?>"></b>
														</i>
														<span>
                                            <?php echo trans('app.'.$submenu['name']); ?> 
                                        </span>
													</a>
												</li>
											<?php endif; ?>

										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</ul>
								</li>
							<?php else: ?>
								<li class="<?php echo e($page === langapp($menu['name']) ? 'active' : ''); ?>">
									<?php if($menu['name'] == 'calendar'): ?>
										<a href="calendar/appointments">
											<i class="<?php echo e($menu['icon']); ?> icon">
												<b class="bg-<?php echo e(get_option('theme_color')); ?>"></b>
											</i>
											<span>
											<?php if($menu['name'] == 'users'): ?>
													Operators
												<?php else: ?>
													<?php echo trans('app.'.$menu['name']); ?>
												<?php endif; ?>
                                </span>
										</a>
									<?php else: ?>
										<a href="<?php echo e(site_url($menu['route'])); ?>">
											<i class="<?php echo e($menu['icon']); ?> icon">
												<b class="bg-<?php echo e(get_option('theme_color')); ?>"></b>
											</i>
											<span>
											<?php if($menu['name'] == 'users'): ?>
													Operators
												<?php else: ?>
													<?php echo trans('app.'.$menu['name']); ?>
												<?php endif; ?>
                                </span>
										</a>
									<?php endif; ?>
								</li>
							<?php endif; ?>


						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
				</nav>
				<div class="wrapper clearfix small p-10">
					<?php $__currentLoopData = quickAccess(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $entity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="text-center-folded">
                        <span class="hidden-folded">
                            <a class="text-ellipsis" href="<?php echo e($entity['url']); ?>">
                                <?php echo e(str_limit($entity['name'], 25)); ?>

                            </a>
                        </span>
						</div>
						<div class="progress progress-xxs m-t-xs dk">
							<div class="progress-bar progress-bar-success" data-placement="top" data-rel="tooltip"
								 style="width: <?php echo e($entity['progress']); ?>%;" title="<?php echo e($entity['progress']); ?>%">
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
		</section>
		<footer class="footer lt hidden-xs b-t b-dark" id="changeLanguages">
			
			<?php if(settingEnabled('enable_languages')): ?>
				<div class="btn-group dropup pull-right">
					<button class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-xs dropdown-toggle"
							data-toggle="dropdown" aria-expanded="false">
						<?php echo e(svg_image('solid/chevron-up')); ?>
					</button>
					<ul class="dropdown-menu">
						<?php $__currentLoopData = languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li class="">
								<a href="<?php echo e(route('setLanguage', ['lang' => $lang['code']])); ?>"
								   title="<?php echo e(ucwords(str_replace('_', ' ', $lang['name']))); ?>">
									<?php echo e(ucwords(str_replace('_', ' ', $lang['name']))); ?>

								</a>
							</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
				</div>
			<?php endif; ?>
			<div class="btn-group hidden-nav-xs">
			</div>
		</footer>
	</section>
</aside>
