<?php $__env->startSection('content'); ?>

<section id="content" class="bg">
    <section class="vbox">
        <header class="header bg-white b-b clearfix">
            <div class="row m-t-sm">
                <div class="col-sm-12 m-b-xs">
                    <p class="h3"><?php echo e($lead->name); ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('leads_delete')): ?>
                        <a href="<?php echo e(route('leads.delete', ['id' => $lead->id])); ?>"
                            class="btn btn-danger btn-sm pull-right" data-toggle="ajaxModal" data-rel="tooltip"
                        title="<?php echo trans('app.'.'delete'); ?>  "><?php echo e(svg_image('solid/trash-alt')); ?></a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reminders_create')): ?>
                        <a class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?> pull-right" data-toggle="ajaxModal" data-rel="tooltip"  data-placement="bottom" href="<?php echo e(route('calendar.reminder', ['module' => 'leads', 'id' => $lead->id])); ?>" title="<?php echo trans('app.'.'set_reminder'); ?>  ">
                            <?php echo e(svg_image('solid/clock')); ?>
                        </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('leads_update')): ?>
                        <a href="<?php echo e(route('leads.edit', ['id' => $lead->id])); ?>"
                            class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm pull-right" data-rel="tooltip"
                            data-toggle="ajaxModal" title="<?php echo trans('app.'.'edit'); ?>  " data-placement="left">
                        <?php echo e(svg_image('solid/pencil-alt')); ?> <?php echo trans('app.'.'edit'); ?>  </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deals_create')): ?>
                        <a href="<?php echo e(route('leads.convert', ['id' => $lead->id])); ?>"
                            class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm pull-right" data-rel="tooltip"
                            data-toggle="ajaxModal" title="<?php echo trans('app.'.'convert'); ?>  " data-placement="left">
                            <?php echo e(svg_image('solid/check-circle')); ?> <?php echo trans('app.'.'convert'); ?>
                        </a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('leads_update')): ?>
                        <a href="<?php echo e(route('leads.nextstage', ['id' => $lead->id])); ?>"
                            class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm pull-right" data-rel="tooltip"
                            data-toggle="ajaxModal" title="<?php echo trans('app.'.'move_stage'); ?>  " data-placement="left">
                        <?php echo e(svg_image('solid/arrow-alt-circle-right')); ?> <?php echo trans('app.'.'next_stage'); ?>  </a>
                        <?php endif; ?>
                        
                    </p>
                </div>
            </div>
        </header>
        <section class="scrollable wrapper">
            
            <div class="sub-tab m-b-10">
                <ul class="nav pro-nav-tabs nav-tabs-dashed">
                    <li class="<?php echo e(($tab == 'overview') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('leads.view', ['id' => $lead->id, 'tab' => 'overview'])); ?>"><?php echo e(svg_image('solid/home')); ?> <?php echo trans('app.'.'overview'); ?>  </a>
                    </li>

                    <li class="<?php echo e(($tab == 'calls') ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('leads.view', ['id' => $lead->id, 'tab' => 'calls'])); ?>"><?php echo e(svg_image('solid/phone')); ?> <?php echo trans('app.'.'calls'); ?>  
                                </a>
                            </li>

                    <li class="<?php echo e(($tab == 'conversations') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('leads.view', ['id' => $lead->id, 'tab' => 'conversations'])); ?>">
                            <?php echo e(svg_image('solid/envelope-open')); ?> <?php echo trans('app.'.'emails'); ?>
                            <?php echo $lead->has_email ? '<i class="fas fa-bell text-danger"></i>' : ''; ?>

                        </a>
                    </li>
                    <li class="<?php echo e(($tab == 'activity') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('leads.view', ['id' => $lead->id, 'tab' => 'activity'])); ?>">
                            <?php echo e(svg_image('solid/history')); ?> <?php echo trans('app.'.'activity'); ?>
                            <?php echo $lead->has_activity ? '<i class="fas fa-bell text-danger"></i>' : ''; ?>

                        </a>
                    </li>
                    <li class="<?php echo e(($tab == 'files') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('leads.view', ['id' => $lead->id, 'tab' => 'files'])); ?>">
                        <?php echo e(svg_image('solid/file-alt')); ?> <?php echo trans('app.'.'files'); ?>  </a>
                    </li>
                    <li class="<?php echo e(($tab == 'comments') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('leads.view', ['id' => $lead->id, 'tab' => 'comments'])); ?>">
                            <?php echo e(svg_image('solid/comments')); ?> <?php echo trans('app.'.'comments'); ?>
                        </a>
                    </li>
                    <li class="<?php echo e(($tab == 'calendar') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('leads.view', ['id' => $lead->id, 'tab' => 'calendar'])); ?>">
                            <?php echo e(svg_image('solid/calendar-alt')); ?> <?php echo trans('app.'.'calendar'); ?>
                        </a>
                    </li>
                </ul>
            </div>
            <?php echo $__env->make('leads::tab._'.$tab, \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
        </section>
    </section>
</section>
<?php $__env->startPush('pagescript'); ?>
<?php echo $__env->make('stacks.js.markdown', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>