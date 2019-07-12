<?php $__env->startSection('content'); ?>
<?php
$user = Auth::user();
$channels = !is_null($user->profile->channels) ? $user->profile->channels : [];
?>
<section id="content">
    <section class="hbox stretch">
        <aside>
            <section class="vbox">
                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-12 m-b-xs">
                            <p class="h3"><strong><?php echo e($user->name); ?></strong>
                                
                                <a href="<?php echo e(route('users.gdpr.export')); ?>" class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm pull-right">
                                    <?php echo e(svg_image('solid/database')); ?> GDPR Data
                                </a>
                                <a href="<?php echo e(route('users.api')); ?>" class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm pull-right">
                                    <?php echo e(svg_image('solid/code')); ?> API Settings
                                </a>
                                <a href="<?php echo e(route('users.2fa')); ?>" class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm pull-right" data-toggle="ajaxModal">
                                    <?php echo e(svg_image('solid/fingerprint')); ?> 2FAuth
                                </a>
                            </p>
                        </div>
                    </div>
                </header>
                
                <section class="scrollable wrapper bg">
                    <?php if(Auth::user()->on_holiday): ?>
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <i class="fas fa-info-sign"></i><?php echo trans('app.'.'holiday_enabled'); ?>
                    </div>
                    <?php endif; ?>
                    
                    <div class="row">
                        <?php echo Form::open(['route' => 'users.change', 'class' => 'bs-example ajaxifyForm']); ?>

                        <div class="col-lg-6">
                            <section class="panel panel-default">
                                <header class="panel-heading"><?php echo trans('app.'.'information'); ?>
                                    <?php if($user->profile->company > 0 && $user->profile->business->primary_contact == Auth::id()): ?>
                                    <a href="<?php echo e(route('contacts.create', Auth::user()->profile->company)); ?>" class="btn btn-xs btn-success pull-right" data-toggle="ajaxModal" title="Add Contact Person" data-rel="tooltip" data-placement="bottom"><?php echo e(svg_image('regular/user-circle')); ?> <?php echo trans('app.'.'contact'); ?></a>
                                    <?php endif; ?>

                                    <?php if(!Auth::user()->hasRole('client')): ?>
                                    <?php if(Auth::user()->on_holiday): ?>
                                        <a href="<?php echo e(route('users.holiday', 'disable')); ?>" class="btn btn-xs btn-success pull-right" title="<?php echo trans('app.'.'disable_holiday_mode'); ?>" data-rel="tooltip" data-placement="bottom"><?php echo e(svg_image('solid/plane-arrival')); ?> <?php echo trans('app.'.'disable_holiday'); ?></a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('users.holiday', 'enable')); ?>" class="btn btn-xs btn-danger pull-right" title="<?php echo trans('app.'.'enable_holiday_mode'); ?>" data-rel="tooltip" data-placement="bottom"><?php echo e(svg_image('solid/plane-departure')); ?> <?php echo trans('app.'.'enable_holiday'); ?></a>
                                    <?php endif; ?>
                                    
                                    <?php endif; ?>
                                </header>
                                <div class="panel-body">
                                    
                                    <div class="form-group">
                                        <label><?php echo trans('app.'.'fullname'); ?>  <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" value="<?php echo e($user->name); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo trans('app.'.'hourly_rate'); ?> </label>
                                        <input type="text" class="form-control" name="profile[hourly_rate]" value="<?php echo e($user->profile->hourly_rate); ?>">
                                    </div>
                                    <input type="hidden" value="<?php echo e($user->profile->company); ?>" name="profile[company]">
                                    <?php if($user->profile->company > 0): ?>
                                    <div class="form-group">
                                        <label><?php echo trans('app.'.'company'); ?></label>
                                        <input type="text" class="form-control" name="company[name]"
                                        value="<?php echo e(optional($user->profile)->business->name); ?>">
                                    </div>

                                    <div class="form-group">
                                        <label data-rel="tooltip" title="Company Mobile"><?php echo trans('app.'.'company'); ?> <?php echo trans('app.'.'mobile'); ?></label>
                                        <input type="text" class="form-control" name="company[mobile]"
                                        value="<?php echo e(optional($user->profile)->business->mobile); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo trans('app.'.'company_email'); ?></label>
                                        <input type="text" class="form-control" name="company[email]"
                                        value="<?php echo e(optional($user->profile)->business->email); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo trans('app.'.'address1'); ?></label>
                                        <input type="text" class="form-control" name="company[address1]"
                                        value="<?php echo e(optional($user->profile)->business->address1); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo trans('app.'.'address2'); ?></label>
                                        <input type="text" class="form-control" name="company[address2]"
                                        value="<?php echo e(optional($user->profile)->business->address2); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo trans('app.'.'tax_number'); ?></label>
                                        <input type="text" class="form-control" name="company[tax_number]"
                                        value="<?php echo e(optional($user->profile)->business->tax_number); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Slack URL <span data-rel="tooltip" title="Your company slack webhook"><?php echo e(svg_image('brands/slack', 'text-info')); ?></span></label>
                                        <input type="text" class="form-control" name="company[slack_webhook_url]"
                                        value="<?php echo e(optional($user->profile)->business->slack_webhook_url); ?>">
                                    </div>
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <label><?php echo trans('app.'.'mobile'); ?> </label>
                                        <input type="text" class="form-control" name="profile[mobile]" value="<?php echo e($user->profile->mobile); ?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label><?php echo trans('app.'.'locale'); ?></label>
                                        <select class="select2-option form-control" name="locale">
                                            <?php $__currentLoopData = languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($language['code']); ?>" <?php echo e($user->locale == $language['code'] ? ' selected' : ''); ?>><?php echo e(ucfirst($language['name'])); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <input type="hidden" name="profile[use_gravatar]" value="0">
                                    <div class="form-group">
                                        <div class="form-check text-muted">
                                            <label>
                                                <input type="checkbox" name="profile[use_gravatar]" <?php echo e($user->profile->use_gravatar == 1 ? 'checked' : ''); ?> value="1"> <span class="label-text">Use avatar from Gravatar</span>
                                            </label>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group">
                                        <span class="thumb-sm avatar pull-right">
                                            <img src="<?php echo e($user->profile->photo); ?>" width="50" class="img-circle m-sm">
                                        </span>
                                        <label><?php echo trans('app.'.'avatar'); ?> </label>
                                        <input type="file" name="avatar">
                                        
                                        
                                        
                                    </div>
                                    <div class="form-group">
                                        <span class="pull-right">
                                            <img class="" src="<?php echo e($user->profile->sign); ?>" width="50" alt="">
                                        </span>
                                        <label><?php echo e(langapp('signature')); ?></label>
                                        <input type="file" name="signature">
                                        
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo trans('app.'.'email_signature'); ?></label>
                                        <textarea class="form-control markdownEditor" name="profile[email_signature]" data-hidden-buttons='["cmdHeading", "cmdQuote","cmdCode", "cmdList", "cmdList0"]'><?php echo e($user->profile->email_signature); ?></textarea>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-lg-6">
                            <section class="panel panel-default">
                            <header class="panel-heading"><?php echo trans('app.'.'authorization'); ?></header>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Slack Webhook URL <span data-rel="tooltip" title="Your slack webhook url"><?php echo e(svg_image('brands/slack', 'text-danger')); ?></span></label>
                                    <input type="text" class="form-control" name="slack_webhook_url" value="<?php echo e($user->slack_webhook_url); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Calendar Token <a href="<?php echo e(route('users.token')); ?>" class="btn btn-xs btn-info">
                                        <?php echo e(svg_image('solid/sync-alt')); ?>
                                    </a></label>
                                    <input type="text" class="form-control" readonly="readonly"
                                    value="<?php echo e($user->calendar_token); ?>">
                                </div>
                                <div class="form-group">
                                    <label><?php echo trans('app.'.'notification_channels'); ?> <span class="text-danger">*</span></label>
                                    <div class="form-check text-muted">
                                        <label>
                                            <input type="checkbox" name="profile[channels][slack]" <?php echo e(in_array('slack', $channels) ? 'checked' : ''); ?>> <span class="label-text"><?php echo trans('app.'.'receive_slack_notifications'); ?></span>
                                        </label>
                                    </div>
                                    
                                    <div class="form-check text-muted">
                                        <label>
                                            <input type="checkbox" name="profile[channels][mail]" <?php echo e(in_array('mail', $channels) ? 'checked' : ''); ?>> <span class="label-text"><?php echo trans('app.'.'receive_mail_notifications'); ?></span>
                                        </label>
                                    </div>
                                    <div class="form-check text-muted">
                                        <label>
                                            <input type="checkbox" name="profile[channels][database]" <?php echo e(in_array('database', $channels) ? 'checked' : ''); ?>> <span class="label-text"><?php echo trans('app.'.'receive_app_notifications'); ?></span>
                                        </label>
                                    </div>
                                    <div class="form-check text-muted">
                                        <label>
                                            <input type="checkbox" name="profile[channels][broadcast]" <?php echo e(in_array('broadcast', $channels) ? 'checked' : ''); ?>> <span class="label-text"><?php echo trans('app.'.'receive_broadcast_notification'); ?></span>
                                        </label>
                                    </div>
                                    <div class="form-check text-muted">
                                        <label>
                                            <input type="checkbox" name="profile[channels][nexmo]" <?php echo e(in_array('nexmo', $channels) ? 'checked' : ''); ?>> <span class="label-text"><?php echo trans('app.'.'receive_sms_notification'); ?></span>
                                        </label>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <label><?php echo trans('app.'.'email'); ?>  <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email"
                                    value="<?php echo e($user->email); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label><?php echo trans('app.'.'username'); ?>  <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="username"
                                    placeholder="<?php echo trans('app.'.'new_username'); ?> " value="<?php echo e($user->username); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label><?php echo trans('app.'.'password'); ?></label>
                                    <input type="password" class="form-control" name="password"
                                    placeholder="<?php echo trans('app.'.'password'); ?> ">
                                </div>
                                <div class="form-group">
                                    <label><?php echo trans('app.'.'confirm_password'); ?></label>
                                    <input type="password" class="form-control" name="confirm_password"
                                    placeholder="<?php echo trans('app.'.'confirm_password'); ?> ">
                                </div>
                                <div class="form-group">
                                    <label class="text-danger"><?php echo e(svg_image('solid/exclamation-triangle')); ?> <?php echo trans('app.'.'danger_zone'); ?></label>
                                    <div class="form-check text-danger">
                                        <label>
                                            <input type="checkbox" name="unsubscribed_at" <?php echo e(is_null(Auth::user()->unsubscribed_at) ? '' : 'checked'); ?> value="<?php echo e(now()->toDateTimeString()); ?>">
                                            <span class="label-text" data-rel="tooltip" title="The right to restrict processing"><?php echo trans('app.'.'do_not_contact_me'); ?></span>
                                        </label>
                                    </div>
                                    
                                    <div class="form-check text-danger">
                                        <label>
                                            <input type="checkbox" name="deleted_at" value="<?php echo e(now()->toDateTimeString()); ?>">
                                            <span class="label-text" data-rel="tooltip" title="The right to erasure (known as the ‘right to be forgotten’)"><?php echo trans('app.'.'delete_account_permanent'); ?></span>
                                        </label>
                                    </div>
                                    
                                </div>
                                <?php echo renderAjaxButton(); ?>

                                
                            </div>
                        </section>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </section>

        </section>

        </aside>
    </section>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
<?php $__env->startPush('pagestyle'); ?>
<?php echo $__env->make('stacks.css.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('pagescript'); ?>
<?php echo $__env->make('stacks.js.markdown', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('stacks.js.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>