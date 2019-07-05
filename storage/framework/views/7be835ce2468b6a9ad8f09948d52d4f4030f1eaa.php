<div class="row">
    <div class="col-lg-12">
        
        <section class="panel panel-default">
            <header class="panel-heading"><?php echo trans('app.'.'lead_settings'); ?></header>
            
                <?php echo Form::open(['route' => ['settings.edit', $section], 'class' => 'bs-example form-horizontal ajaxifyForm', 'files' => true, 'data-toggle' => 'validator']); ?>

            
            <div class="panel-body">

                <fieldset>
                    <input class="display-none" type="text" name="lead_imap_username"/>
                    <input class="display-none" type="password" name="lead_imap_password"/>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'default_stage'); ?></label>
                        <div class="col-lg-7">
                            <select class="select2-option form-control" name="default_lead_stage" required>
                                
                                <?php $__currentLoopData = App\Entities\Category::whereModule('leads')->orderBy('order', 'desc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($stage->id); ?>" <?php echo e($stage->id == get_option('default_lead_stage') ? 'selected="selected"' : ''); ?>>
                                    <?php echo e($stage->name); ?>

                                </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'default_sales_agent'); ?></label>
                        <div class="col-lg-7">
                            <select class="select2-option form-control" name="default_sales_rep" required>
                                
                                <?php $__currentLoopData = Modules\Users\Entities\User::permission('leads_create')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>" <?php echo e($user->id == get_option('default_sales_rep') ? 'selected="selected"' : ''); ?>><?php echo e($user->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'next_followup'); ?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control" value="<?php echo e(get_option('lead_followup_days')); ?>" name="lead_followup_days">
                        <span class="help-block m-b-none small text-danger">Number of days to follow-up on a lead</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'expiry_date'); ?></label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control" value="<?php echo e(get_option('lead_expire_days')); ?>" name="lead_expire_days">
                        <span class="help-block m-b-none small text-danger">Number of days before a lead is marked as expired</span>
                    </div>
                </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'enable_double_optin'); ?> <span data-rel="tooltip" title="A confirmation email with a unique URL will be sent to leads."><?php echo e(svg_image('solid/info-circle')); ?></span></label>
                        <div class="col-lg-7">
                            <label class="switch">
                                <input type="hidden" value="FALSE" name="leads_opt_in"/>
                                <input type="checkbox" <?php echo e(settingEnabled('leads_opt_in') ? 'checked="checked"' : ''); ?> name="leads_opt_in" value="TRUE"><span></span>
                            </label>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'weblead_recaptcha'); ?> <span data-rel="tooltip" title="Add reCaptcha to lead web form to prevent spammers"><?php echo e(svg_image('solid/info-circle')); ?></span></label>
                        <div class="col-lg-7">
                            <label class="switch">
                                <input type="hidden" value="FALSE" name="lead_recaptcha"/>
                                <input type="checkbox" <?php echo e(settingEnabled('lead_recaptcha') ? 'checked="checked"' : ''); ?> name="lead_recaptcha" value="TRUE"><span></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'auto_delete'); ?> <span data-rel="tooltip" title="When a lead is converted to a customer, delete it"><?php echo e(svg_image('solid/info-circle')); ?></span></label>
                        <div class="col-lg-7">
                            <label class="switch">
                                <input type="hidden" value="FALSE" name="leads_delete_converted"/>
                                <input type="checkbox" <?php echo e(settingEnabled('leads_delete_converted') ? 'checked' : ''); ?> name="leads_delete_converted" value="TRUE"><span></span>
                            </label>
                        </div>
                    </div>

                <div class="form-group">
                <label class="col-lg-3 control-label">IMAP</label>
                <div class="col-lg-3">
                    <label class="switch">
                        <input type="hidden" value="FALSE" name="lead_mail_imap" />
                        <input type="checkbox" <?php echo e(settingEnabled('lead_mail_imap') ? 'checked' : ''); ?> name="lead_mail_imap" value="TRUE">
                        <span ></span>
                    </label>
                </div>
                </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">IMAP Host</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" value="<?php echo e(get_option('lead_mail_host')); ?>" name="lead_mail_host">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">IMAP Username</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" value="<?php echo e(get_option('lead_mail_username')); ?>" name="lead_mail_username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">IMAP Password</label>
                        <div class="col-lg-7">
                            <input type="password" class="form-control" value="<?php echo e(get_option('lead_mail_password')); ?>" name="lead_mail_password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Mail Port</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" value="<?php echo e(get_option('lead_mail_port')); ?>" name="lead_mail_port">
                            <span class="help-block m-b-none small text-danger">Port (143 or 110) (Gmail: 993)</span>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Mail Flags</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" value="<?php echo e(get_option('lead_mail_flags')); ?>" name="lead_mail_flags">
                            <span class="help-block m-b-none small text-danger">/imap/ssl/validate-cert or /imap/ssl/novalidate-cert</span>
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Mailbox</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" value="<?php echo e(get_option('lead_mailbox')); ?>" name="lead_mailbox">
                        </div>
                    </div>
                    
                </fieldset>
            </div>
            <div class="panel-footer">
                <?php echo renderAjaxButton(); ?>

            </div>


            <?php echo Form::close(); ?>


        </section>
        
        
        
    </div>
    
</div>
<?php $__env->startPush('pagestyle'); ?>
<?php echo $__env->make('stacks.css.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('pagescript'); ?>
<?php echo $__env->make('stacks.js.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>