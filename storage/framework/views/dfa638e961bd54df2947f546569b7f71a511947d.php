<div class="row">
    
    <div class="col-lg-12">
                
<?php echo Form::open(['route' => ['settings.edit', $section], 'class' => 'bs-example form-horizontal ajaxifyForm']); ?>

       
                <section class="panel panel-default">
                    <header class="panel-heading">
                        <?php echo e(svg_image('solid/cogs')); ?> <?php echo trans('app.'.'payment_settings'); ?>  
                    </header>
                    <div class="panel-body">

                        <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'payment_prefix'); ?>   </label>
                    <div class="col-lg-6">
                        <input type="text" name="payment_prefix" class="form-control"
                               value="<?php echo e(get_option('payment_prefix')); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'payment_number_format'); ?></label>
                    <div class="col-lg-6">
                        <input type="text" name="payment_number_format" class="form-control"
                               value="<?php echo e(get_option('payment_number_format')); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Payment Gateways
                    <span class="" data-rel="tooltip" title="Comma separated list of supported payment gateways"><?php echo e(svg_image('solid/question-circle')); ?></span>
                </label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" value="<?php echo e(get_option('enabled_gateways')); ?>" name="enabled_gateways">
                    </div>
                </div>

                        <img class="pull-right" src="<?php echo e(getStorageUrl(config('system.media_dir').'/paypal.svg')); ?>" width="50"
                             alt="PayPal">

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo trans('app.'.'paypal_live'); ?>  </label>
                            <div class="col-md-6">
                                <label class="switch">
                                    <input type="hidden" value="FALSE" name="paypal_live"/>
                                    <input type="checkbox" <?php echo e(settingEnabled('paypal_live') ? 'checked' : ''); ?> name="paypal_live" value="TRUE">
                                    <span></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo trans('app.'.'paypal_email'); ?>  </label>
                            <div class="col-md-6">
                                <input type="email" name="paypal_email" class="form-control"
                                       value="<?php echo e(get_option('paypal_email')); ?>">
                            </div>
                        </div>


                        <img class="pull-right" src="<?php echo e(getStorageUrl(config('system.media_dir').'/pagseguro.png')); ?>" width="50"
                             alt="Pagseguro">


                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo trans('app.'.'pagseguro_live'); ?>  </label>
                            <div class="col-md-6">
                                <label class="switch">
                                    <input type="hidden" value="FALSE" name="pagseguro_live"/>
                                    <input type="checkbox" <?php echo e(settingEnabled('pagseguro_live') ? 'checked' : ''); ?> name="pagseguro_live" value="TRUE">
                                    <span></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo trans('app.'.'pagseguro_email'); ?></label>
                            <div class="col-md-6">
                                <input type="email" name="pagseguro_email" class="form-control" value="<?php echo e(get_option('pagseguro_email')); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo trans('app.'.'pagseguro_token'); ?></label>
                            <div class="col-md-6">
                                <input type="text" name="pagseguro_token" class="form-control" value="<?php echo e(get_option('pagseguro_token')); ?>">
                            </div>
                        </div>


                       


                        <!-- 2Checkout Config -->
                        <img class="pull-right" src="<?php echo e(getStorageUrl(config('system.media_dir').'/2co.svg')); ?>" width="50"
                             alt="2Checkout">
                        <div class="line line-dashed line-lg pull-in"></div>


                        <div class="form-group">
                            <label class="col-md-3 control-label">2Checkout Live</label>
                            <div class="col-md-6">
                                <label class="switch">
                                    <input type="hidden" value="FALSE" name="2checkout_live"/>
                                    <input type="checkbox" <?php echo e(settingEnabled('2checkout_live') ? 'checked' : ''); ?> name="2checkout_live" value="TRUE">
                                    <span></span>
                                </label>
                            </div>
                        </div>

                        

                        

                        <!-- Braintree Config -->
                        <img class="pull-right" src="<?php echo e(getStorageUrl(config('system.media_dir').'/braintree.png')); ?>" width="50"
                             alt="Braintree">
                        <div class="line line-dashed line-lg pull-in"></div>


                        <div class="form-group">
                            <label class="col-md-3 control-label">Braintree Live</label>
                            <div class="col-md-6">
                                <label class="switch">
                                    <input type="hidden" value="FALSE" name="braintree_live"/>
                                    <input type="checkbox" <?php echo e(settingEnabled('braintree_live') ? 'checked' : ''); ?> name="braintree_live" value="TRUE">
                                    <span></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Braintree Merchant Account</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="<?php echo e(get_option('braintree_merchant_account')); ?>" name="braintree_merchant_account">
                            </div>
                        </div>

                        

                        

                        <!-- Wepay Config -->
                        <img class="pull-right" src="<?php echo e(getStorageUrl(config('system.media_dir').'/wepay-logo.svg')); ?>" width="50"
                             alt="WePay">
                        <div class="line line-dashed line-lg pull-in"></div>


                        <div class="form-group">
                            <label class="col-md-3 control-label">Wepay Live</label>
                            <div class="col-md-6">
                                <label class="switch">
                                    <input type="hidden" value="FALSE" name="wepay_live"/>
                                    <input type="checkbox" <?php echo e(settingEnabled('wepay_live') ? 'checked' : ''); ?> name="wepay_live" value="TRUE">
                                    <span></span>
                                </label>
                            </div>
                        </div>


                        

        <div class="line line-dashed line-lg pull-in"></div>
        
                    <div class="form-group terms">
                        <label class="col-lg-3 control-label"><?php echo e(langapp('bank_details')); ?></label>
                        <div class="col-lg-6">
                            <textarea class="form-control markdownEditor" name="bank_details" data-hidden-buttons='["cmdHeading", "cmdQuote","cmdCode", "cmdList", "cmdList0"]'><?php echo e(get_option('bank_details')); ?></textarea>
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
<?php $__env->startPush('pagescript'); ?>
<?php echo $__env->make('stacks.js.markdown', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>

