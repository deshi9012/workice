<?php $__env->startSection('content'); ?>
<section id="content" class="bg">
    <section class="hbox stretch">
        <section class="vbox">
            <header class="header bg-white b-b clearfix">
                <div class="row m-t-sm">
                    <div class="col-sm-12 m-b-xs">
                        <p class="h3"><?php echo e($company->name); ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clients_delete')): ?>
                            <a href="<?php echo e(route('clients.delete', ['id' => $company->id])); ?>" class="btn btn-danger btn-sm pull-right" data-toggle="ajaxModal"
                            title="<?php echo trans('app.'.'delete'); ?>"><?php echo e(svg_image('solid/trash-alt')); ?></a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clients_update')): ?>
                            <a href="<?php echo e(route('clients.edit', ['id' => $company->id])); ?>" class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm pull-right"
                                data-toggle="ajaxModal" title="<?php echo trans('app.'.'edit'); ?>" data-placement="left">
                            <?php echo e(svg_image('solid/pencil-alt')); ?> <?php echo trans('app.'.'edit'); ?></a>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </header>
            <section class="scrollable wrapper scrollpane">

                <div class="row">
                    <div class="col-sm-12 m-b-xs">
                        <div class="sub-tab text-uc small m-b-10">
                            <ul class="nav pro-nav-tabs nav-tabs-dashed">
                                
                                <li class="<?php echo e(($tab == 'dashboard') ? 'active' : ''); ?>">
                                    
                                    <a href="<?php echo e(route('clients.view', ['id' => $company->id, 'tab' => 'dashboard'])); ?>">
                                        <?php echo e(svg_image('solid/tachometer-alt')); ?> <?php echo trans('app.'.'overview'); ?>
                                        <?php if($company->hasUnread()): ?>
                                        <span class="label label-dracula">
                                            <?php echo e(svg_image('solid/envelope-alt')); ?> <?php echo e($company->hasUnread()); ?>

                                        </span>
                                        <?php endif; ?>
                                    </a>
                                </li>
                                <li class="<?php echo e($tab == 'contacts' ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('clients.view', ['id' => $company->id, 'tab' => 'contacts'])); ?>">
                                    <?php echo e(svg_image('solid/users')); ?> <?php echo trans('app.'.'contacts'); ?>  </a>
                                </li>
                                <li class="<?php echo e($tab == 'projects' ? 'active' : ''); ?>">
                                    
                                    <a href="<?php echo e(route('clients.view', ['id' => $company->id, 'tab' => 'projects'])); ?>">
                                    <?php echo e(svg_image('solid/clock')); ?> <?php echo trans('app.'.'projects'); ?>  </a>
                                </li>
                                <li class="<?php echo e($tab == 'invoices' ? 'active' : ''); ?>">
                                    
                                    <a href="<?php echo e(route('clients.view', ['id' => $company->id, 'tab' => 'invoices'])); ?>">
                                        <?php echo e(svg_image('solid/file-invoice-dollar')); ?> <?php echo trans('app.'.'invoices'); ?>
                                    </a>
                                </li>
                                <li class="<?php echo e($tab == 'estimates' ? 'active' : ''); ?>">
                                    
                                    <a href="<?php echo e(route('clients.view', ['id' => $company->id, 'tab' => 'estimates'])); ?>">
                                    <?php echo e(svg_image('solid/file-alt')); ?> <?php echo trans('app.'.'estimates'); ?>  </a>
                                </li>
                                <li class="<?php echo e($tab == 'payments' ? 'active' : ''); ?>">
                                    
                                    <a href="<?php echo e(route('clients.view', ['id' => $company->id, 'tab' => 'payments'])); ?>">
                                    <?php echo e(svg_image('solid/credit-card')); ?> <?php echo trans('app.'.'payments'); ?>  </a>
                                </li>
                                <li class="<?php echo e($tab == 'expenses' ? 'active' : ''); ?>">
                                    
                                    <a href="<?php echo e(route('clients.view', ['id' => $company->id, 'tab' => 'expenses'])); ?>">
                                    <?php echo e(svg_image('solid/shopping-basket')); ?> <?php echo trans('app.'.'expenses'); ?>  </a>
                                </li>
                                <li class="<?php echo e($tab == 'deals' ? 'active' : ''); ?>">
                                    
                                    <a href="<?php echo e(route('clients.view', ['id' => $company->id, 'tab' => 'deals'])); ?>">
                                    <?php echo e(svg_image('solid/euro-sign')); ?> <?php echo trans('app.'.'deals'); ?>  </a>
                                </li>
                                <li class="<?php echo e($tab == 'files' ? 'active' : ''); ?>">
                                    
                                    <a href="<?php echo e(route('clients.view', ['id' => $company->id, 'tab' => 'files'])); ?>">
                                    <?php echo e(svg_image('solid/hdd')); ?> <?php echo trans('app.'.'files'); ?>  </a>
                                </li>
                                <li class="<?php echo e($tab == 'subscriptions' ? 'active' : ''); ?>">
                                    
                                    <a href="<?php echo e(route('clients.view', ['id' => $company->id, 'tab' => 'subscriptions'])); ?>">
                                    <?php echo e(svg_image('regular/calendar-alt')); ?> <?php echo trans('app.'.'subscriptions'); ?>  </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php if($company->balance > 0): ?>
                <div class="alert alert-primary alert-bordered m-b-2">
                    <strong class="text-info">Note! </strong><?php echo trans('app.'.'client_has_balance', ['balance' => formatCurrency($company->currency, $company->balance)]); ?>
                </div>
                <?php endif; ?>
                <div class="row">
                    
                    <?php echo $__env->make('clients::tab._'.$tab, \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
            </section>
        </section>
    </section>
</section>
<?php $__env->startPush('pagescript'); ?>
<?php echo $__env->make('stacks.js.markdown', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>