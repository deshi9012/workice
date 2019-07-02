<?php $__env->startSection('content'); ?>


    <section id="content">
        <section class="hbox stretch">


                <section class="vbox">
                    <header class="header bg-white b-b clearfix">
                        <div class="row m-t-sm">
                            <div class="col-sm-8 m-b-xs">

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('menu_users')): ?>
                                    <a href="<?php echo e(route('users.index')); ?>" data-toggle="tooltip" data-placement="bottom"
                                       class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?>" title="Back">
                                       <?php echo e(svg_image('solid/caret-left')); ?>
                                    </a>
                                <?php endif; ?>



                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users_update')): ?>
                                    <a href="<?php echo e(route('users.edit', ['id' => $user->id])); ?>" data-toggle="ajaxModal"
                                       class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?>">
                                       <?php echo e(svg_image('solid/pencil-alt')); ?> <?php echo trans('app.'.'edit'); ?>
                                    </a>

                                    <a href="<?php echo e(route('users.permissions', ['id' => $user->id])); ?>" data-rel="tooltip"
                                       class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm" data-toggle="ajaxModal"
                                       title="<?php echo trans('app.'.'permission'); ?>" data-placement="bottom">
                                        <?php echo e(svg_image('solid/shield-alt')); ?> <?php echo trans('app.'.'permission'); ?>
                                    </a>
                                <?php endif; ?>


                                <?php if($user->id != Auth::id()): ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users_delete')): ?>
                                        <a href="<?php echo e(route('users.suspend', ['id' => $user->id])); ?>" class="btn btn-<?php echo e(($user->banned == '1') ? 'danger' : 'default'); ?> btn-sm"
                                           data-toggle="ajaxModal" data-rel="tooltip" title="<?php echo trans('app.'.'suspend'); ?>" data-placement="bottom">
                                            <?php echo e(svg_image('solid/thumbs-down')); ?>
                                        </a>

                                        <a href="<?php echo e(route('users.delete', ['id' => $user->id])); ?>"
                                           class="btn btn-danger btn-sm" data-toggle="ajaxModal" data-rel="tooltip" data-placement="bottom"
                                           title="<?php echo trans('app.'.'delete'); ?>">
                                            <?php echo e(svg_image('solid/trash-alt')); ?>
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>


                            </div>
                            <div class="col-sm-4 m-b-xs">
                                
                            </div>
                        </div>
                    </header>
                    <section class="scrollable wrapper bg">


                        <div class="sub-tab text-uc small m-b-sm">

                            <ul class="nav pro-nav-tabs nav-tabs-dashed">
                                <li class="<?php echo e(($tab == 'overview') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('users.view', ['id' => $user->id, 'tab' => 'overview'])); ?>">
                                        <?php echo e(svg_image('solid/database')); ?> <?php echo trans('app.'.'overview'); ?>
                                    </a>
                                </li>

                                <li class="<?php echo e(($tab == 'files') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('users.view', ['id' => $user->id, 'tab' => 'files'])); ?>">
                                        <?php echo e(svg_image('solid/folder-open')); ?> <?php echo trans('app.'.'files'); ?> 
                                    </a>
                                </li>
                                <li class="<?php echo e(($tab == 'tickets') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('users.view', ['id' => $user->id, 'tab' => 'tickets'])); ?>">
                                        <?php echo e(svg_image('solid/life-ring')); ?> <?php echo trans('app.'.'tickets'); ?>
                                    </a>
                                </li>
                                
                                    
                                    
                                    
                                


                                <li class="<?php echo e(($tab == 'timesheet') ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('users.view', ['id' => $user->id, 'tab' => 'timesheet'])); ?>">
                                    <?php echo e(svg_image('solid/history')); ?> <?php echo trans('app.'.'timesheets'); ?>
                                    </a>
                                </li>


                                
                                    
                                        
                                    
                                


                            </ul>

                        </div>



                            <?php echo $__env->make('users::tab.'.$tab, \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>




                    </section>


                </section>


        </section>
        <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open"
           data-target="#nav,html"></a>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>