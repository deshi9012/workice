<aside class="b-l bg" id="">
            <ul class="dashmenu text-uc text-muted no-border no-radius">

                <?php if (moduleActive('invoices')) { ?>
                <li class="<?php echo e($dashboard == 'invoices' ? 'active' : ''); ?>"><a href="<?php echo e(route('dashboard.index', ['dashboard' => 'invoices'])); ?>"><?php echo e(svg_image('solid/file-invoice-dollar')); ?> <?php echo trans('app.'.'invoicing'); ?></a></li>
                <?php } ?>
                <?php if (moduleActive('deals')) { ?>
                <li class="<?php echo e($dashboard == 'deals' ? 'active' : ''); ?>"><a href="<?php echo e(route('dashboard.index', ['dashboard' => 'deals'])); ?>"><?php echo e(svg_image('solid/chart-line')); ?> <?php echo trans('app.'.'sales'); ?></a></li>
                <?php } ?>
                <?php if (moduleActive('expenses')) { ?>
                <li class="<?php echo e($dashboard == 'expenses' ? 'active' : ''); ?>"><a href="<?php echo e(route('dashboard.index', ['dashboard' => 'expenses'])); ?>"><?php echo e(svg_image('solid/shopping-basket')); ?> <?php echo trans('app.'.'expenses'); ?></a></li>
                <?php } ?>
                <?php if (moduleActive('payments')) { ?>
                <li class="<?php echo e($dashboard == 'payments' ? 'active' : ''); ?>"><a href="<?php echo e(route('dashboard.index', ['dashboard' => 'payments'])); ?>"><?php echo e(svg_image('solid/credit-card')); ?> <?php echo trans('app.'.'payments'); ?></a></li>
                <?php } ?>
                
                
                
                <?php if (moduleActive('tickets')) { ?>
                <li class="<?php echo e($dashboard == 'tickets' ? 'active' : ''); ?>"><a href="<?php echo e(route('dashboard.index', ['dashboard' => 'tickets'])); ?>"><?php echo e(svg_image('solid/life-ring')); ?> <?php echo trans('app.'.'ticketing'); ?></a></li>
                <?php } ?>
            </ul>
            
                <section class="scrollable">
                    <div class="slim-scroll" data-color="#333333" data-disable-fade-out="true" data-distance="0" data-height="auto" data-size="3px">
                        <section class="padder">

                            <?php if(get_option('valid_license') != 'TRUE' && get_option('demo_mode') != 'TRUE'): ?>
                            <div class="alert alert-danger" role="alert">
                                <strong><?php echo trans('app.'.'fo_not_validated'); ?></strong><br/>
                                To validate your purchase enter your purchase code in Settings or buy Workice CRM at <a href="<?php echo e(config('system.saleurl')); ?>">Envato Market</a>
                            </div>
                            
                            <?php endif; ?>

                            
                            <?php echo $__env->make('dashboard::_includes.'.$dashboard, \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            
                            
                        </section>
                    </div>
                </section>
                
            </aside>

            <aside class="aside-lg b-l">
                <section class="vbox">

                    <section class="scrollable" id="feeds">

                    <div class="slim-scroll padder" data-color="#333333" data-disable-fade-out="true" data-distance="0" data-height="auto" data-size="3px">
                    
                        <?php echo $__env->make('dashboard::_sidebar.'.$dashboard, \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    </div>

                </section>
                    
                </section>
            </aside>