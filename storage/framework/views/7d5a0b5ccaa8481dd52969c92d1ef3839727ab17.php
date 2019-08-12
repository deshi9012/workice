<?php $__env->startSection('content'); ?>

<section id="content" class="bg">

            <section class="vbox">
                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-12 m-b-xs">

                            <p class="h3"><?php echo e($deal->title); ?>


                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deals_delete')): ?>

                                    <a href="<?php echo e(route('deals.delete', ['id' => $deal->id])); ?>"
                                       class="btn btn-danger btn-sm pull-right" data-toggle="ajaxModal"
                                       data-rel="tooltip" data-placement="bottom" title="<?php echo trans('app.'.'delete'); ?>  "><?php echo e(svg_image('solid/trash-alt')); ?></a>

                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reminders_create')): ?>
                    <a class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?> pull-right" data-toggle="ajaxModal" data-rel="tooltip"  data-placement="bottom" href="<?php echo e(route('calendar.reminder', ['module' => 'deals', 'id' => $deal->id])); ?>" title="<?php echo trans('app.'.'set_reminder'); ?>  ">
                        <?php echo e(svg_image('solid/clock')); ?>
                    </a>
                    <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deals_update')): ?>

                                    <a href="<?php echo e(route('deals.edit', ['id' => $deal->id])); ?>"
                                       class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm pull-right"
                                       data-toggle="ajaxModal" data-rel="tooltip" title="<?php echo trans('app.'.'edit'); ?>  " data-placement="bottom">
                                       <?php echo e(svg_image('solid/pencil-alt')); ?> <?php echo trans('app.'.'edit'); ?>  </a>

                                <?php endif; ?>


                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deals_update')): ?>

                                <?php if($deal->status == 'open'): ?> 
                                        <a href="<?php echo e(route('deals.lost', ['id' => $deal->id])); ?>"
                                           class="btn btn-danger btn-sm pull-right"
                                           data-toggle="ajaxModal" data-rel="tooltip" title="<?php echo trans('app.'.'lost'); ?>  " data-placement="bottom">
                                           <?php echo e(svg_image('solid/times')); ?> <?php echo trans('app.'.'lost'); ?>  </a>

                                        <a href="<?php echo e(route('deals.win', $deal->id)); ?>" class="btn btn-success btn-sm pull-right" 
                                           data-rel="tooltip" data-toggle="ajaxModal" title="<?php echo trans('app.'.'close_deal'); ?>" data-placement="bottom">
                                           <?php echo e(svg_image('solid/check-circle')); ?> <?php echo trans('app.'.'won'); ?>  </a>

                                <?php endif; ?>

                                <?php if($deal->status != 'open'): ?> 
                                        <a href="<?php echo e(route('deals.open', ['id' => $deal->id])); ?>"
                                           class="btn btn-danger btn-sm pull-right"
                                           data-toggle="tooltip" title="<?php echo trans('app.'.'reopen'); ?>  "
                                           data-placement="bottom"><?php echo e(svg_image('solid/level-down-alt')); ?> <?php echo trans('app.'.'reopen'); ?>  </a>
                                <?php endif; ?>


                                    <?php endif; ?>

                            </p>

    </div>
                    </div>
                </header>
                <section class="scrollable wrapper">


                    <div class="sub-tab m-b-10">
                        <ul class="nav pro-nav-tabs nav-tabs-dashed">


                            <li class="<?php echo e(($tab == 'overview') ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('deals.view', ['id' => $deal->id, 'tab' => 'overview'])); ?>"><?php echo e(svg_image('solid/home')); ?> <?php echo trans('app.'.'overview'); ?>  </a>
                            </li>

                            <li class="<?php echo e(($tab == 'calls') ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('deals.view', ['id' => $deal->id, 'tab' => 'calls'])); ?>"><?php echo e(svg_image('solid/phone')); ?> <?php echo trans('app.'.'calls'); ?>  
                                </a>
                            </li>

                            <li class="<?php echo e(($tab == 'emails') ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('deals.view', ['id' => $deal->id, 'tab' => 'emails'])); ?>"><?php echo e(svg_image('solid/envelope-open')); ?> <?php echo trans('app.'.'emails'); ?>  
                                <span class="label bg-danger"><?php echo e($deal->unreadMessages() ? $deal->unreadMessages() : ''); ?></span>
                                </a>
                            </li>

                            <li class="<?php echo e(($tab == 'activity') ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('deals.view', ['id' => $deal->id, 'tab' => 'activity'])); ?>">
                                <?php echo e(svg_image('solid/history')); ?> <?php echo trans('app.'.'activity'); ?>
                                    <?php echo $deal->has_activity ? '<i class="fas fa-bell text-danger"></i>' : ''; ?>

                                </a>
                            </li>

                            <li class="<?php echo e(($tab == 'products') ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('deals.view', ['id' => $deal->id, 'tab' => 'products'])); ?>"><?php echo e(svg_image('solid/shopping-cart')); ?> <?php echo trans('app.'.'products'); ?></a>
                            </li>


                            <li class="<?php echo e(($tab == 'files') ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('deals.view', ['id' => $deal->id, 'tab' => 'files'])); ?>"><?php echo e(svg_image('solid/cloud-upload-alt')); ?> <?php echo trans('app.'.'files'); ?>  </a>
                            </li>
                            <li class="<?php echo e(($tab == 'comments') ? 'active' : ''); ?>">
                                <?php $count = $deal->comments()->where('unread', 1)->count();  ?>
                                <a href="<?php echo e(route('deals.view', ['id' => $deal->id, 'tab' => 'comments'])); ?>">
                                    <?php echo e(svg_image('solid/comments')); ?> <?php echo trans('app.'.'comments'); ?>  
                                    <?php echo ($count > 0) ? '<label class="label bg-success">'.$count.'</label>' : ''; ?>

                                </a>
                            </li>

                            <li class="<?php echo e(($tab == 'calendar') ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('deals.view', ['id' => $deal->id, 'tab' => 'calendar'])); ?>"><?php echo e(svg_image('solid/calendar-alt')); ?> <?php echo trans('app.'.'calendar'); ?>  </a>
                            </li>

                        </ul>
                    </div>


                        <?php echo $__env->make('deals::tab._'.$tab, \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>




                </section>

    </section>
</section>

<?php $__env->startPush('pagescript'); ?>
    <?php echo $__env->make('stacks.js.markdown', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>