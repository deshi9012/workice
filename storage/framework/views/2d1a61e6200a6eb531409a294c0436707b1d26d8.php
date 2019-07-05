<?php $__env->startSection('content'); ?>

<section id="content" class="bg">
    <section class="hbox stretch">
        
        <?php echo $__env->make('partial.settings_menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <aside>
            <section class="vbox">

                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-12 m-b-xs">

                        <?php if($section == 'general'): ?>
                        <a href="<?php echo e(route('settings.index', 'clauses')); ?>" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?>"><?php echo e(svg_image('solid/file-contract')); ?> <?php echo trans('app.'.'clauses'); ?></a>
                        <?php endif; ?>

                        <?php if($section == 'payments'): ?>
                        <a href="<?php echo e(route('settings.index', 'currencies')); ?>" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?>"><?php echo trans('app.'.'currencies'); ?></a>
                        <?php endif; ?>

                        <?php if($section == 'theme'): ?>
                        <a href="<?php echo e(route('settings.index', 'css')); ?>" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?>"><?php echo trans('app.'.'custom_css'); ?></a>
                        <?php endif; ?>

                        <?php if($section == 'info'): ?>
                        <?php if (\Illuminate\Support\Facades\Blade::check('admin')): ?>
                        <a href="<?php echo e(route('settings.test.mail')); ?>" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?>" data-toggle="ajaxModal"><?php echo e(svg_image('solid/at')); ?> <?php echo trans('app.'.'test_email'); ?></a>
                        <div class="btn-group">
                          <button class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php echo trans('app.'.'import'); ?> <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="<?php echo e(route('settings.import', ['type' => 'fo'])); ?>" data-toggle="ajaxModal">Freelancer Office</a></li>
                          </ul>
                        </div>
                        <a href="<?php echo e(route('settings.index', 'commands')); ?>" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?>"><?php echo e(svg_image('solid/terminal')); ?> Commands</a>
                        <a href="<?php echo e(route('updates.schedule')); ?>" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?> pull-right" data-toggle="ajaxModal"><?php echo e(svg_image('solid/laptop-code')); ?> <?php echo trans('app.'.'schedule_update'); ?></a>
                        
                        <?php endif; ?>
                        <?php endif; ?>

                        <?php if($section == 'support'): ?>
                        <a href="<?php echo e(route('settings.statuses.show')); ?>" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?>" data-toggle="ajaxModal" data-rel="tooltip" title="<?php echo trans('app.'.'statuses'); ?>" data-placement="bottom">
                            <?php echo e(svg_image('solid/ellipsis-v')); ?> <?php echo trans('app.'.'statuses'); ?>
                        </a>
                        <?php endif; ?>

                        <?php if($section == 'translations'): ?>
                        <a href="<?php echo e(route('translations.mail')); ?>" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?>" data-rel="tooltip" title="Modify email templates" data-placement="bottom">
                            <?php echo e(svg_image('solid/envelope-open')); ?> <?php echo trans('app.'.'emails'); ?>
                        </a>
                        <?php endif; ?>

                        

                        <?php if($section == 'leads'): ?>
                        <a href="<?php echo e(route('settings.stages.show', 'leads')); ?>" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?>" data-toggle="ajaxModal" data-rel="tooltip" title="<?php echo trans('app.'.'preview'); ?> " data-placement="bottom">
                            <?php echo e(svg_image('solid/shoe-prints')); ?> <?php echo trans('app.'.'stages'); ?>
                        </a>

                        <a href="<?php echo e(route('settings.sources.show')); ?>" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?>" data-toggle="ajaxModal" data-rel="tooltip" title="<?php echo trans('app.'.'source'); ?> " data-placement="bottom">
                            <?php echo e(svg_image('solid/globe')); ?> <?php echo trans('app.'.'source'); ?>
                        </a>

                        <a href="<?php echo e(route('web.lead')); ?>" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?> pull-right" data-rel="tooltip" title="Web to Lead form" data-placement="bottom" target="_blank">
                            <?php echo e(svg_image('solid/phone-volume')); ?> <?php echo trans('app.'.'lead_form'); ?>
                        </a>

                        <?php endif; ?>

                        <?php if($section == 'deals'): ?>
                        <a href="<?php echo e(route('settings.stages.show', 'deals')); ?>" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?>" data-toggle="ajaxModal" data-rel="tooltip" title="<?php echo trans('app.'.'stages'); ?> " data-placement="bottom">
                            <?php echo e(svg_image('solid/shoe-prints')); ?> <?php echo trans('app.'.'stages'); ?>
                        </a> 
                        <a href="<?php echo e(route('settings.pipelines.show')); ?>" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?>" data-toggle="ajaxModal" data-rel="tooltip" title="<?php echo trans('app.'.'deal_pipelines'); ?>" data-placement="bottom">
                            <?php echo e(svg_image('solid/chart-line')); ?> <?php echo trans('app.'.'deal_pipelines'); ?>
                        </a> 
                        <?php endif; ?>


                        </div>
                    </div>
                </header>
                <section class="scrollable wrapper">
                    <?php echo $__env->make('settings::sections.'.$section, \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </section>
            </section>
        </aside>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html">

    </a>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>