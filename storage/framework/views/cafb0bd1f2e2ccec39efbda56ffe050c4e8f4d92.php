<?php $__env->startSection('content'); ?>


    <section id="content" class="m-t-lg wrapper-md content">

        <div id="login-darken"></div>
        <div id="login-form" class="container aside-xxl animated fadeInUp">


        <span class="navbar-brand block <?php echo e(settingEnabled('blur_login') ? 'text-white' : ''); ?>">
                <?php $display = get_option('logo_or_icon'); ?>
                <?php if($display == 'logo' || $display == 'logo_title'): ?> 
                <img src="<?php echo e(getStorageUrl(config('system.media_dir').'/'.get_option('company_logo'))); ?>"
                     class="img-responsive <?php echo e(($display == 'logo' ? '' : 'thumb-sm m-r-sm')); ?>">
                <?php elseif($display == 'icon' || $display == 'icon_title'): ?>
                <i class="<?php echo e(get_option('site_icon')); ?>"></i>
                <?php endif; ?>

            <?php if($display == 'logo_title' || $display == 'icon_title'): ?>
                <?php if(get_option('website_name') == ''): ?>
                    <?php echo e(get_option('company_name')); ?>

                    <?php else: ?> 
                    <?php echo e(get_option('website_name')); ?>

                <?php endif; ?>
            <?php endif; ?>

            </span>

            <section class="panel panel-default bg-white m-t-lg b-r-cust">
                <header class="panel-heading text-center"><strong><?php echo trans('app.'.'confirm_password_to_continue'); ?></strong>
                </header>
                

                <form class="panel-body wrapper-lg" method="POST" action="<?php echo e(route('users.reauthenticate.process')); ?>">
                        <?php echo e(csrf_field()); ?>



                <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password"><?php echo trans('app.'.'password'); ?></label>

                            <input id="password" type="password" class="form-control" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            
                        </div>

            

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-block">
                    <?php echo e(svg_image('solid/unlock-alt')); ?> <?php echo trans('app.'.'confirm_password'); ?></button>

                <p class="text-muted m-t-sm"><strong>Tip:</strong> You are entering sudo mode. You will not be asked for your password for a few hours.</p>
                                    
                                

                            
                        </div>


                        <div class="line line-dashed">
                </div>

                </form>

                <?php if(!settingEnabled('hide_branding')): ?> 
                    <footer id="footer" class="copyright-footer">
                        <div class="text-center text-muted padder">
                            <p>
                                <?php echo $__env->make('partial.copyright', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </p>
                        </div>
                    </footer>
                <?php endif; ?>

            </section>

        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>