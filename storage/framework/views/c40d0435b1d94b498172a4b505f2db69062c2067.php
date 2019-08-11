<?php $__env->startSection('content'); ?>
<section id="content" class="wrapper-md content">
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
        <section class="panel panel-default bg-white m-t-sm b-r-xs">
            <header class="panel-heading text-center login-heading"><?php echo e(get_option('login_title')); ?></header>

            <?php if(settingEnabled('enable_languages')): ?>
            <div class="panel-body text-right clearfix">

                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-sm dropdown-toggle btn-<?php echo e(get_option('theme_color')); ?>" data-toggle="dropdown" btn-icon="" title="<?php echo trans('app.'.'languages'); ?>  ">
                    <?php echo e(svg_image('solid/globe')); ?>
                    </button>
                    <button type="button" class="btn btn-sm btn-default dropdown-toggle  hidden-nav-xs"
                    data-toggle="dropdown"><?php echo trans('app.'.'languages'); ?>   <span class="caret"></span></button>
                    <!-- Load Languages -->
                    <ul class="dropdown-menu text-left">
                        <?php $__currentLoopData = languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($lang['active'] == 1): ?>
                        <li>
                            <a href="<?php echo e(route('setLanguage', ['lang' => $lang['code']])); ?>"
                                title="<?php echo e(ucwords(str_replace('_', ' ', $lang['name']))); ?>">
                                <?php echo e(ucwords(str_replace('_', ' ', $lang['name']))); ?>

                            </a>
                        </li>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            <?php endif; ?>
            
            <?php echo Form::open(['route' => 'login', 'class' => 'panel-body wrapper-lg']); ?>


            <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                <label for="email"><?php echo trans('app.'.'email'); ?></label>
                
                <input id="email" type="email" class="form-control" placeholder="johndoe@example.com" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
                <?php if($errors->has('email')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('email')); ?></strong>
                </span>
                <?php endif; ?>
                
            </div>
            <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                <label for="password"><?php echo trans('app.'.'password'); ?></label>
                <input id="password" type="password" class="form-control" placeholder="<?php echo trans('app.'.'password'); ?>" name="password" required>
                <?php if($errors->has('password')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('password')); ?></strong>
                </span>
                <?php endif; ?>
                
            </div>
            <?php if(settingEnabled('use_recaptcha')): ?>
            <?php echo NoCaptcha::display(); ?>

            <?php if($errors->has('g-recaptcha-response')): ?>
            <span class="help-block text-danger">
                <strong><?php echo e($errors->first('g-recaptcha-response')); ?></strong>
            </span>
            <?php endif; ?>
            <?php endif; ?>
            
            <div class="form-group">
                
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> <?php echo trans('app.'.'remember_me'); ?>
                    </label>
                </div>
                
            </div>
            <div class="form-group">
                <?php echo renderButton(langapp('sign_in')); ?>

                
                
                    
                
                
            </div>
            <?php if(settingEnabled('social_login')): ?>
                <div class="line line-dashed"></div>
                <p id="social-buttons">
                    <?php if(!empty(config('services.twitter.client_id'))): ?>
                        <a href="<?php echo e(url('/redirect/twitter')); ?>" class="btn btn-sm btn-icon btn-<?php echo e(get_option('theme_color')); ?> m-xs" data-rel="tooltip" title="Login using Twitter"><?php echo e(svg_image('brands/twitter')); ?></a>
                    <?php endif; ?>
                    <?php if(!empty(config('services.facebook.client_id'))): ?>
                        <a href="<?php echo e(url('/redirect/facebook')); ?>" class="btn btn-sm btn-icon btn-<?php echo e(get_option('theme_color')); ?> m-xs" data-rel="tooltip" title="Login using Facebook"><?php echo e(svg_image('brands/facebook')); ?></a>
                    <?php endif; ?>
                    <?php if(!empty(config('services.google.client_id'))): ?>
                        <a href="<?php echo e(url('/redirect/google')); ?>" class="btn btn-sm btn-icon btn-<?php echo e(get_option('theme_color')); ?> m-xs" data-rel="tooltip" title="Login using Google"><?php echo e(svg_image('brands/google')); ?></a>
                    <?php endif; ?>

                    <?php if(!empty(config('services.github.client_id'))): ?>
                        <a href="<?php echo e(url('/redirect/github')); ?>" class="btn btn-sm btn-icon btn-<?php echo e(get_option('theme_color')); ?> m-xs" data-rel="tooltip" title="Login using Github"><?php echo e(svg_image('brands/github')); ?></a>
                    <?php endif; ?>

                    <?php if(!empty(config('services.linkedin.client_id'))): ?>
                        <a href="<?php echo e(url('/redirect/linkedin')); ?>" class="btn btn-sm btn-icon btn-<?php echo e(get_option('theme_color')); ?> m-xs" data-rel="tooltip" title="Login using LinkedIn"><?php echo e(svg_image('brands/linkedin')); ?></a>
                    <?php endif; ?>

                    <?php if(!empty(config('services.gitlab.client_id'))): ?>
                        <a href="<?php echo e(url('/redirect/gitlab')); ?>" class="btn btn-sm btn-icon btn-<?php echo e(get_option('theme_color')); ?> m-xs" data-rel="tooltip" title="Login using Gitlab"><?php echo e(svg_image('brands/gitlab')); ?></a>
                    <?php endif; ?>
                              
                        
                </p>
            <?php endif; ?>
            
            <div class="line line-dashed"></div>

            <?php if(settingEnabled('allow_client_registration')): ?>
            <p class="text-muted text-center">
                <small><?php echo trans('app.'.'do_not_have_an_account'); ?> </small>
            </p>
            <a href="<?php echo e(url('/register')); ?>"
            class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-block"><?php echo trans('app.'.'get_your_account'); ?> </a>
            <?php endif; ?>
            
            
            <?php echo Form::close(); ?>

            
            
            <?php if(!settingEnabled('hide_branding')): ?>
            <?php echo $__env->make('partial.branding', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            
        </section>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>