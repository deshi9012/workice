<div class="row">
    <div class="col-lg-12">
        <section class="panel panel-default">
            <header class="panel-heading">
                <?php echo e(svg_image('solid/cogs')); ?> <?php echo trans('app.'.'system_settings'); ?>
            </header>

<?php 
$currencies = currencies(); 
$current_language = get_option('default_language');
$current_timezone = get_option('timezone');
$current_symbol = get_option('default_currency_symbol');
$current_currency = get_option('default_currency');
$current_locale = get_option('locale');
?>

            <?php echo Form::open(['route' => ['settings.edit', $section], 'class' => 'bs-example form-horizontal ajaxifyForm']); ?>

            
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-lg-3 control-label">Purchase Code <span data-toggle="tooltip" title="Get your code from Envato"><?php echo e(svg_image('regular/question-circle')); ?></span> <span class="text-danger">*</span></label>
                    <div class="col-lg-6">
                        <input type="text" name="purchase_code" class="form-control"
                        value="<?php echo e(get_option('purchase_code')); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'default_language'); ?>  </label>
                    <div class="col-lg-6">
                        <select name="default_language" class="form-control select2-option">
                            <?php $__currentLoopData = languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($lang['name']); ?>" <?php echo e($current_language == $lang['name'] ? ' selected' : ''); ?>><?php echo e(ucfirst($lang['name'])); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'locale'); ?>  </label>
                    <div class="col-lg-6">
                        <select class="form-control select2-option" name="locale" required>
                            <?php $__currentLoopData = locales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($loc['code']); ?>" <?php echo e($current_locale == $loc['code'] ? ' selected' : ''); ?>><?php echo e(ucfirst($loc['language'])); ?> - <?php echo e($loc['code']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'timezone'); ?></label>
                    <div class="col-lg-6">
                        <select class="form-control select2-option" name="timezone" required>
                            <?php $__currentLoopData = timezones(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timezone => $description): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($timezone); ?>" <?php echo e($current_timezone == $timezone ? ' selected' : ''); ?>><?php echo e($description); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'default_currency'); ?>  </label>
                    <div class="col-lg-6">
                        <select name="default_currency" class="form-control select2-option">
                            <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cur['code']); ?>" <?php echo e($current_currency == $cur['code'] ? ' selected' : ''); ?>><?php echo e($cur['title']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'default_currency_symbol'); ?>  </label>
                    <div class="col-lg-6">
                        <select name="default_currency_symbol" class="form-control select2-option">
                            <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cur['symbol']); ?>" <?php echo e($current_symbol == $cur['symbol'] ? ' selected' : ''); ?>><?php echo e($cur['native']); ?>

                            - <?php echo e($cur['title']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <span class="help-block m-b-none small text-danger">Overwritten by Client's Currency</span>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'thousand_separator'); ?></label>
                    <div class="col-lg-6">
                        <select name="thousand_separator" class="form-control">
                            <option value="," <?php echo e(get_option('thousand_separator') == ',' ? 'selected' : ''); ?>>,</option>
                            <option value="." <?php echo e(get_option('thousand_separator') == '.' ? 'selected' : ''); ?>>.</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'decimal_separator'); ?></label>
                    <div class="col-lg-6">
                        <select name="decimal_separator" class="form-control">
                            <option value="." <?php echo e(get_option('decimal_separator') == '.' ? 'selected' : ''); ?>>.</option>
                            <option value="," <?php echo e(get_option('decimal_separator') == ',' ? 'selected' : ''); ?>>,</option>
                        </select>
                    </div>
                </div>  

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'default_calendar'); ?></label>
                    <div class="col-lg-6">
                        <select class="form-control select2-option" name="default_calendar" required>
                            <?php $__currentLoopData = Modules\Calendar\Entities\CalendarType::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cal->id); ?>"<?php echo e(get_option('default_calendar') === $cal->id ? ' selected="selected"' : ''); ?>><?php echo e($cal->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                
                
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'tax'); ?> 1</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control money" value="<?php echo e(get_option('default_tax')); ?>"
                        name="default_tax">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Default Subscription</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" value="<?php echo e(get_option('default_subscription')); ?>"
                        name="default_subscription">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Tax1 Label</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" value="<?php echo e(get_option('tax1Label')); ?>"
                        name="tax1Label">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'tax'); ?> 2</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control money" value="<?php echo e(get_option('default_tax2')); ?>"
                        name="default_tax2">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Tax2 Label</label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" value="<?php echo e(get_option('tax2Label')); ?>"
                        name="tax2Label">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'tax_decimals'); ?></label>
                    <div class="col-lg-6">
                        <select name="tax_decimals" class="form-control">
                            <option value="0"<?php echo e(get_option('tax_decimals') == 0 ? ' selected' : ''); ?>>0</option>
                            <option value="1"<?php echo e(get_option('tax_decimals') == 1 ? ' selected' : ''); ?>>1</option>
                            <option value="2"<?php echo e(get_option('tax_decimals') == 2 ? ' selected' : ''); ?>>2</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'quantity_decimals'); ?></label>
                    <div class="col-lg-6">
                        <select name="quantity_decimals" class="form-control">
                            <option value="0"<?php echo e(get_option('quantity_decimals') == 0 ? ' selected' : ''); ?>>0</option>
                            <option value="1"<?php echo e(get_option('quantity_decimals') == 1 ? ' selected' : ''); ?>>1</option>
                            <option value="2"<?php echo e(get_option('quantity_decimals') == 2 ? ' selected' : ''); ?>>2</option>
                        </select>
                    </div>
                </div>
                <?php $date_format = get_option('date_format') ?>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'date_format'); ?>  </label>
                    <div class="col-lg-6">
                        <select name="date_format" class="form-control">
                            <option value="%d-%m-%Y"<?php echo e($date_format == '%d-%m-%Y' ? ' selected="selected"' : ''); ?>><?php echo e(strftime('%d-%m-%Y', time())); ?></option>
                            <option value="%m-%d-%Y"<?php echo e($date_format == '%m-%d-%Y' ? ' selected="selected"' : ''); ?>><?php echo e(strftime('%m-%d-%Y', time())); ?></option>
                            <option value="%Y-%m-%d"<?php echo e($date_format == '%Y-%m-%d' ? ' selected="selected"' : ''); ?>><?php echo e(strftime('%Y-%m-%d', time())); ?></option>
                            <option value="%Y.%m.%d"<?php echo e($date_format == '%Y.%m.%d' ? ' selected="selected"' : ''); ?>><?php echo e(strftime('%Y.%m.%d', time())); ?></option>
                            <option value="%d.%m.%Y"<?php echo e($date_format == '%d.%m.%Y' ? ' selected="selected"' : ''); ?>><?php echo e(strftime('%d.%m.%Y', time())); ?></option>
                            <option value="%m.%d.%Y"<?php echo e($date_format == '%m.%d.%Y' ? ' selected="selected"' : ''); ?>><?php echo e(strftime('%m.%d.%Y', time())); ?></option>
                            <option value="%d/%m/%Y"<?php echo e($date_format == '%d/%m/%Y' ? ' selected="selected"' : ''); ?>><?php echo e(strftime('%d/%m/%Y', time())); ?></option>
                            <option value="%d %b, %Y"<?php echo e($date_format == '%d %b, %Y' ? ' selected="selected"' : ''); ?>><?php echo e(strftime('%d %b, %Y', time())); ?></option>
                            <option value="%b %d, %Y"<?php echo e($date_format == '%b %d, %Y' ? ' selected="selected"' : ''); ?>><?php echo e(strftime('%b %d, %Y', time())); ?></option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'file_max_size'); ?> <span class="text-danger">*</span> </label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" value="<?php echo e(get_option('file_max_size')); ?>" name="file_max_size">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'allowed_files'); ?>  </label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" value="<?php echo e(get_option('allowed_files')); ?>" name="allowed_files">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Privacy Policy URL </label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" value="<?php echo e(get_option('privacy_policy_url')); ?>" name="privacy_policy_url">
                    </div>
                </div>

                
                <div class="form-group">
                    <label class="col-lg-3 control-label">Slack Webhook URL <span data-toggle="tooltip" title="Receives system alerts"><?php echo e(svg_image('regular/question-circle')); ?></span></label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" value="<?php echo e(get_option('slack_webhook')); ?>" name="slack_webhook">
                    </div>
                </div>
                

                <div class="form-group">
                    <label class="col-lg-3 control-label">Open Exchange API</label>
                    <div class="col-lg-6">
                        <input type="text" name="xrates_app_id" class="form-control" placeholder="Leave blank" value="<?php echo e(get_option('xrates_app_id')); ?>">
                        <span class="help-block text-danger">Leave blank to use the default <a href="https://openexchangerates.org/" target="_blank">open exchange rates</a> API</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Google Calendar API Key</label>
                    <div class="col-lg-6">
                        <input type="text" name="gcal_api_key" class="form-control" placeholder="API Key" value="<?php echo e(get_option('gcal_api_key')); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Google Calendar ID</label>
                    <div class="col-lg-6">
                        <input type="text" name="gcal_id" class="form-control" placeholder="Calendar ID" value="<?php echo e(get_option('gcal_id')); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'default_role'); ?>  </label>
                    <div class="col-lg-6">
                        <select name="default_role" class="form-control">
                            <?php $__currentLoopData = Role::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($role->name); ?>" <?php echo e($role->name === 'client' ? 'selected="selected"' : ''); ?>><?php echo e(ucfirst($role->name)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>


                <div class="line line-dashed line-lg pull-in"></div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Options</label>
                    <div class="col-sm-9">
                        
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" value="FALSE" name="automatic_reminders"/>
                                        <input type="checkbox" name="automatic_reminders" <?php echo e(settingEnabled('automatic_reminders') ? 'checked' : ''); ?> value="TRUE">
                                        <span class="label-text" data-rel="tooltip" title="Send email reminders for estimates, contracts, tasks or todos when almost overdue"><?php echo trans('app.'.'automatic_reminders'); ?></span>
                                    </label>
                                </div>
                                
                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" value="FALSE" name="enable_languages"/>
                                        <input type="checkbox" name="enable_languages" <?php echo e(settingEnabled('enable_languages') ? 'checked' : ''); ?> value="TRUE">
                                        <span class="label-text"><?php echo trans('app.'.'enable_languages'); ?></span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" value="FALSE" name="use_gravatar"/>
                                        <input type="checkbox" name="use_gravatar" <?php echo e(settingEnabled('use_gravatar') ? 'checked' : ''); ?> value="TRUE">
                                        <span class="label-text"><?php echo trans('app.'.'use_gravatar'); ?></span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" value="FALSE" name="allow_client_registration"/>
                                        <input type="checkbox" name="allow_client_registration" <?php echo e(settingEnabled('allow_client_registration') ? 'checked' : ''); ?> value="TRUE">
                                        <span class="label-text"><?php echo trans('app.'.'allow_client_registration'); ?>  </span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" value="FALSE" name="amount_in_words"/>
                                        <input type="checkbox" name="amount_in_words" <?php echo e(settingEnabled('amount_in_words') ? 'checked' : ''); ?> value="TRUE">
                                        <span class="label-text"><?php echo trans('app.'.'amount_in_words'); ?></span>
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" value="FALSE" name="social_login"/>
                                        <input type="checkbox"
                                        name="social_login" <?php echo e(settingEnabled('social_login') ? 'checked' : ''); ?> value="TRUE">
                                        <span class="label-text" data-rel="tooltip" title="Use Facebook, Twitter, LinkedIn, Google, GitHub and GitLab to login"><?php echo trans('app.'.'social_login'); ?>  </span>
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" value="FALSE" name="update_xrates"/>
                                        <input type="checkbox" name="update_xrates" value="TRUE" <?php echo e(settingEnabled('update_xrates') ? 'checked' : ''); ?>>
                                        <span class="label-text" data-rel="tooltip" title="This action will automatically fetch exchange rates for foreign currencies."><?php echo trans('app.'.'update_xrates'); ?>  </span>
                                    </label>
                                </div>


                                
                            </div>
                            <div class="col-sm-6">
                                

                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" value="FALSE" name="use_recaptcha"/>
                                        <input type="checkbox"
                                        name="use_recaptcha" <?php echo e(settingEnabled('use_recaptcha') ? 'checked' : ''); ?> value="TRUE">
                                        <span class="label-text"><?php echo trans('app.'.'use_recaptcha'); ?> </span>
                                    </label>
                                </div>
                                
                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" value="FALSE" name="client_create_project"/>
                                        <input type="checkbox" name="client_create_project" <?php echo e(settingEnabled('client_create_project') ? 'checked' : ''); ?> value="TRUE">
                                        <span class="label-text"><?php echo trans('app.'.'client_create_project'); ?> </span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" value="FALSE" name="stop_timer_logout"/>
                                        <input type="checkbox" name="stop_timer_logout" <?php echo e(settingEnabled('stop_timer_logout') ? 'checked' : ''); ?> value="TRUE">
                                        <span class="label-text"><?php echo trans('app.'.'stop_timer_logout'); ?>  </span>
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" value="FALSE" name="contract_to_project"/>
                                        <input type="checkbox" name="contract_to_project" <?php echo e(settingEnabled('contract_to_project') ? 'checked' : ''); ?> value="TRUE">
                                        <span class="label-text" data-rel="tooltip" title="Automatically create project when contract signed"><?php echo trans('app.'.'contract_to_project'); ?></span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" value="FALSE" name="updates_alert"/>
                                        <input type="checkbox" name="updates_alert" <?php echo e(settingEnabled('updates_alert') ? 'checked' : ''); ?> value="TRUE">
                                        <span class="label-text" data-rel="tooltip" title="Notify me when there is an update available"><?php echo trans('app.'.'updates_alert'); ?></span>
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" value="FALSE" name="cookie_consent"/>
                                        <input type="checkbox" name="cookie_consent" <?php echo e(settingEnabled('cookie_consent') ? 'checked' : ''); ?> value="TRUE">
                                        <span class="label-text" data-rel="tooltip" title="Show cookie consent"><?php echo trans('app.'.'cookie_consent'); ?></span>
                                    </label>
                                </div>

                                

                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" value="FALSE" name="demo_mode"/>
                                        <input type="checkbox" name="demo_mode" value="TRUE" <?php echo e(settingEnabled('demo_mode') ? 'checked' : ''); ?>>
                                        <span class="label-text text-danger" data-rel="tooltip" title="Enable only if you know what you are doing">Demo mode</span>
                                    </label>
                                </div>

                                

                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="panel-footer">
                <?php echo renderAjaxButton('save'); ?>

            </div>
            <?php echo Form::close(); ?>


            <?php unset($currencies) ?>
        </section>
        
    </div>
    
</div>
<?php $__env->startPush('pagestyle'); ?>
<?php echo $__env->make('stacks.css.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('pagescript'); ?>
<?php echo $__env->make('stacks.js.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>