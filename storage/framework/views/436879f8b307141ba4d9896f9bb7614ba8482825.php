
<aside class="aside aside-md b-r">
            <section class="vbox">
                <header class="dk header b-b">
                    <a class="btn btn-icon btn-default btn-sm pull-right visible-xs m-r-xs" data-toggle="class:show"
                       data-target="#setting-nav"><?php echo e(svg_image('solid/bars')); ?></a>
                    <p class="h3"><?php echo trans('app.'.'settings'); ?>  </p>
                </header>
                <section class="scrollable">
                    <div class="slim-scroll" data-color="#333333" data-disable-fade-out="true" data-distance="0" data-height="auto" data-size="3px"> 
                    <section id="setting-nav" class="hidden-xs">
                        <ul class="nav nav-pills nav-stacked no-radius">
                            <?php $__currentLoopData = settingsMenu(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="<?php echo e($section == $menu->route ? 'active' : ''); ?>">

                                    <a href="<?php echo e(route('settings.edit', ['section' => $menu->route])); ?>">
                                        <?php echo e(svg_image('solid/angle-right', 'text-white')); ?>
                                        <?php echo trans('app.'.$menu->name); ?>  
                                        
                                    </a>

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </section>
                </div>
                </section>
            </section>
        </aside>