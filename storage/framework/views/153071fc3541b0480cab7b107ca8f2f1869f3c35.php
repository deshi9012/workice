<div class="row">
    <!-- Start Form -->
    <div class="col-lg-12">
    <?php echo Form::open(['route' => ['settings.edit', $section], 'class' => 'bs-example form-horizontal ajaxifyForm', 'files' => true]); ?>


        <section class="panel panel-default">
            <header class="panel-heading"><?php echo e(svg_image('solid/cogs')); ?> <?php echo trans('app.'.'theme_settings'); ?>  </header>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'site_name'); ?>  </label>
                    <div class="col-lg-6">
                        <input type="text" name="website_name" class="form-control"
                               value="<?php echo e(get_option('website_name')); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'logo_or_icon'); ?></label>
                    <div class="col-lg-6">
                        <select name="logo_or_icon" class="form-control">
                            <option value="icon_title"<?php echo e(get_option('logo_or_icon') == 'icon_title' ? ' selected="selected"' : ''); ?>><?php echo trans('app.'.'icon'); ?>  
                                & <?php echo trans('app.'.'site_name'); ?>  </option>
                            <option value="icon"<?php echo e(get_option('logo_or_icon') == 'icon' ? ' selected="selected"' : ''); ?>><?php echo trans('app.'.'icon'); ?>  </option>
                            <option value="logo_title"<?php echo e(get_option('logo_or_icon') == 'logo_title' ? ' selected="selected"' : ''); ?>><?php echo trans('app.'.'logo'); ?>  
                                & <?php echo trans('app.'.'site_name'); ?>  </option>
                            <option value="logo"<?php echo e(get_option('logo_or_icon') == 'logo' ? ' selected="selected"' : ''); ?>><?php echo trans('app.'.'logo'); ?>  </option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'login_title'); ?></label>
                    <div class="col-lg-6">
                        <input type="text" name="login_title" class="form-control"
                               value="<?php echo e(get_option('login_title')); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'site_icon'); ?></label>
                    <div class="input-group iconpicker-container col-lg-6">
                        <span class="input-group-addon"><i class="<?php echo e(get_option('site_icon')); ?>"></i></span>
                        <input id="site-icon" name="site_icon" type="text" value="<?php echo e(get_option('site_icon')); ?>"
                               class="form-control icp icp-auto iconpicker-element iconpicker-input"
                               data-placement="bottomRight">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'company_logo'); ?>  </label>
                    <div class="col-lg-6">
                        <input type="file" name="company_logo">
                    </div>
                    <div class="col-lg-2">
                        <?php if(get_option('company_logo') != ''): ?> 
                            <div class="settings-image">
                                <img src="<?php echo e(getStorageUrl(config('system.media_dir').'/'.get_option('company_logo'))); ?>"/>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'login_background'); ?>  </label>
                    <div class="col-lg-6">
                        <input type="file" name="login_bg">
                    </div>
                    <div class="col-lg-2">
                        <?php if(get_option('login_bg') != ''): ?> 
                            <div class="settings-image">
                                <img src="<?php echo e(getStorageUrl(config('system.media_dir').'/'.get_option('login_bg'))); ?>"/>
                                </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'favicon'); ?>  </label>
                    <div class="col-lg-6">
                        <input type="file" name="site_favicon">
                    </div>
                    <div class="col-lg-2">
                        <?php if(get_option('site_favicon') != ''): ?> 
                            <div class="settings-image">
                                <img src="<?php echo e(getStorageUrl(config('system.media_dir').'/'.get_option('site_favicon'))); ?>"/>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'apple_icon'); ?></label>
                    <div class="col-lg-6">
                        <input type="file" name="site_appleicon">
                    </div>
                    <div class="col-lg-2">
                        <?php if(get_option('site_appleicon') != ''): ?> 
                            <div class="settings-image">
                                <img src="<?php echo e(getStorageUrl(config('system.media_dir').'/'.get_option('site_appleicon'))); ?>"/>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'system_font'); ?></label>
                    <div class="col-lg-6">
                        <?php $font = get_option('system_font');  ?>
                        <select name="system_font" class="form-control">
                            <option value="Default">None</option>
                            <option value="open_sans"<?php echo e($font == 'open_sans' ? ' selected="selected"' : ''); ?>>
                                Open Sans
                            </option>
                            <option value="open_sans_condensed"<?php echo e($font == 'open_sans_condensed' ? ' selected="selected"' : ''); ?>>
                                Open Sans Condensed
                            </option>
                            <option value="roboto"<?php echo e($font == 'roboto' ? ' selected="selected"' : ''); ?>>
                                Roboto
                            </option>
                            <option value="roboto_condensed"<?php echo e($font == 'roboto_condensed' ? ' selected="selected"' : ''); ?>>
                                Roboto Condensed
                            </option>
                            <option value="ubuntu"<?php echo e($font == 'ubuntu' ? ' selected="selected"' : ''); ?>>
                                Ubuntu
                            </option>
                            <option value="lato"<?php echo e($font == 'lato' ? ' selected="selected"' : ''); ?>>
                                Lato
                            </option>
                            <option value="oxygen"<?php echo e($font == 'oxygen' ? ' selected="selected"' : ''); ?>>
                                Oxygen
                            </option>
                            <option value="pt_sans"<?php echo e($font == 'pt_sans' ? ' selected="selected"' : ''); ?>>
                                PT Sans
                            </option>
                            <option value="source_sans"<?php echo e($font == 'source_sans' ? ' selected="selected"' : ''); ?>>
                                Source Sans Pro
                            </option>
                            <option value="muli"<?php echo e($font == 'muli' ? ' selected="selected"' : ''); ?>>
                                Muli
                            </option>

                            <option value="miriam"<?php echo e($font == 'miriam' ? ' selected="selected"' : ''); ?>>
                                Miriam Libre
                            </option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Text Direction</label>
                    <div class="col-lg-6">
                        <select name="rtl" class="form-control">
                           
                            <option value="TRUE" <?php echo e(settingEnabled('rtl') ? ' selected="selected"' : ''); ?>>RTL</option>
                            <option value="FALSE" <?php echo e(!settingEnabled('rtl') ? ' selected="selected"' : ''); ?>>LTR</option>
                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'sidebar_theme'); ?>  </label>
                    <div class="col-lg-6">
                        <?php $theme = get_option('sidebar_theme'); ?>
                        <select name="sidebar_theme" class="form-control">
                            <option value="light lter"<?php echo e($theme == 'light lter' ? ' selected="selected"' : ''); ?>>
                                Light
                            </option>
                            <option value="dark"<?php echo e($theme == 'dark' ? ' selected="selected"' : ''); ?>>Dark</option>
                            <option value="black"<?php echo e($theme == 'black' ? ' selected="selected"' : ''); ?>>Black</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'theme_color'); ?>  </label>
                    <div class="col-lg-6">
                        <?php $theme = get_option('theme_color'); ?>
                        <select name="theme_color" class="form-control">
                            <option value="success" <?php echo e($theme == 'success' ? ' selected="selected"' : ''); ?>>Success
                            </option>
                            <option value="info" <?php echo e($theme == 'info' ? ' selected="selected"' : ''); ?>>Info</option>
                            <option value="danger" <?php echo e($theme == 'danger' ? ' selected="selected"' : ''); ?>>Danger
                            </option>
                            <option value="warning" <?php echo e($theme == 'warning' ? ' selected="selected"' : ''); ?>>Warning
                            </option>
                            <option value="dark" <?php echo e($theme == 'dark' ? ' selected="selected"' : ''); ?>>Dark</option>
                            <option value="primary" <?php echo e($theme == 'primary' ? ' selected="selected"' : ''); ?>>Primary
                            </option>
                            <option value="dracula" <?php echo e($theme == 'dracula' ? ' selected="selected"' : ''); ?>>Dracula
                            </option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'top_bar_color'); ?>  </label>
                    <div class="col-lg-6">
        
        <?php $theme = get_option('top_bar_color'); ?>
        <select name="top_bar_color" class="form-control">
            <option value="success" <?php echo e($theme == 'success' ? ' selected="selected"' : ''); ?>>Success</option>
            <option value="info" <?php echo e($theme == 'info' ? ' selected="selected"' : ''); ?>>Info</option>
            <option value="danger" <?php echo e($theme == 'danger' ? ' selected="selected"' : ''); ?>>Danger</option>
            <option value="warning" <?php echo e($theme == 'warning' ? ' selected="selected"' : ''); ?>>Warning</option>
            <option value="dark" <?php echo e($theme == 'dark' ? ' selected="selected"' : ''); ?>>Dark</option>
            <option value="primary" <?php echo e($theme == 'primary' ? ' selected="selected"' : ''); ?>>Primary</option>
            <option value="dracula" <?php echo e($theme == 'dracula' ? ' selected="selected"' : ''); ?>>Dracula</option>
        </select>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'hide_sidebar'); ?>  </label>
                    <div class="col-lg-6">
                        <label class="switch">
                            <input type="hidden" value="FALSE" name="hide_sidebar"/>
                            <input type="checkbox" <?php echo e(settingEnabled('hide_sidebar') ? 'checked="checked"' : ''); ?> name="hide_sidebar" value="TRUE" />
                            <span></span>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Blur Login</label>
                    <div class="col-lg-6">
                        <label class="switch">
                            <input type="hidden" value="FALSE" name="blur_login"/>
                            <input type="checkbox" <?php echo e(settingEnabled('blur_login') ? 'checked="checked"' : ''); ?> name="blur_login" value="TRUE" />
                            <span></span>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'hide_branding'); ?></label>
                    <div class="col-lg-6">
                        <label class="switch">
                            <input type="hidden" value="FALSE" name="hide_branding"/>
                    <input type="checkbox" <?php echo e(settingEnabled('hide_branding') ? 'checked' : ''); ?> value="TRUE" name="hide_branding"/>
                            <span></span>
                        </label>
                    </div>
                </div>


            </div>
            <div class="panel-footer">
                <?php echo renderAjaxButton(); ?>

            </div>
        </section>
        <?php echo Form::close(); ?>

    </div>
</div>

<?php $__env->startPush('pagestyle'); ?>
<link rel="stylesheet" href="<?php echo e(getAsset('plugins/iconpicker/fontawesome-iconpicker.min.css')); ?>" type="text/css"/>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('pagescript'); ?>
    <?php echo $__env->make('stacks.js.iconpicker', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>
