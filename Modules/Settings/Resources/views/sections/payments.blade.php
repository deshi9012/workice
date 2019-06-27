<div class="row">
    
    <div class="col-lg-12">
                
{!! Form::open(['route' => ['settings.edit', $section], 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}
       
                <section class="panel panel-default">
                    <header class="panel-heading">
                        @icon('solid/cogs') @langapp('payment_settings')  
                    </header>
                    <div class="panel-body">

                        <div class="form-group">
                    <label class="col-lg-3 control-label">@langapp('payment_prefix')   </label>
                    <div class="col-lg-6">
                        <input type="text" name="payment_prefix" class="form-control"
                               value="{{  get_option('payment_prefix')  }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">@langapp('payment_number_format')</label>
                    <div class="col-lg-6">
                        <input type="text" name="payment_number_format" class="form-control"
                               value="{{  get_option('payment_number_format')  }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Payment Gateways
                    <span class="" data-rel="tooltip" title="Comma separated list of supported payment gateways">@icon('solid/question-circle')</span>
                </label>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" value="{{ get_option('enabled_gateways') }}" name="enabled_gateways">
                    </div>
                </div>

                        <img class="pull-right" src="{{ getStorageUrl(config('system.media_dir').'/paypal.svg') }}" width="50"
                             alt="PayPal">

                        <div class="form-group">
                            <label class="col-md-3 control-label">@langapp('paypal_live')  </label>
                            <div class="col-md-6">
                                <label class="switch">
                                    <input type="hidden" value="FALSE" name="paypal_live"/>
                                    <input type="checkbox" {{ settingEnabled('paypal_live') ? 'checked' : '' }} name="paypal_live" value="TRUE">
                                    <span></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">@langapp('paypal_email')  </label>
                            <div class="col-md-6">
                                <input type="email" name="paypal_email" class="form-control"
                                       value="{{ get_option('paypal_email') }}">
                            </div>
                        </div>


                        <img class="pull-right" src="{{ getStorageUrl(config('system.media_dir').'/pagseguro.png') }}" width="50"
                             alt="Pagseguro">


                        <div class="form-group">
                            <label class="col-md-3 control-label">@langapp('pagseguro_live')  </label>
                            <div class="col-md-6">
                                <label class="switch">
                                    <input type="hidden" value="FALSE" name="pagseguro_live"/>
                                    <input type="checkbox" {{ settingEnabled('pagseguro_live') ? 'checked' : '' }} name="pagseguro_live" value="TRUE">
                                    <span></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">@langapp('pagseguro_email')</label>
                            <div class="col-md-6">
                                <input type="email" name="pagseguro_email" class="form-control" value="{{ get_option('pagseguro_email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">@langapp('pagseguro_token')</label>
                            <div class="col-md-6">
                                <input type="text" name="pagseguro_token" class="form-control" value="{{ get_option('pagseguro_token') }}">
                            </div>
                        </div>


                       


                        <!-- 2Checkout Config -->
                        <img class="pull-right" src="{{ getStorageUrl(config('system.media_dir').'/2co.svg') }}" width="50"
                             alt="2Checkout">
                        <div class="line line-dashed line-lg pull-in"></div>


                        <div class="form-group">
                            <label class="col-md-3 control-label">2Checkout Live</label>
                            <div class="col-md-6">
                                <label class="switch">
                                    <input type="hidden" value="FALSE" name="2checkout_live"/>
                                    <input type="checkbox" {{ settingEnabled('2checkout_live') ? 'checked' : '' }} name="2checkout_live" value="TRUE">
                                    <span></span>
                                </label>
                            </div>
                        </div>

                        

                        

                        <!-- Braintree Config -->
                        <img class="pull-right" src="{{ getStorageUrl(config('system.media_dir').'/braintree.png') }}" width="50"
                             alt="Braintree">
                        <div class="line line-dashed line-lg pull-in"></div>


                        <div class="form-group">
                            <label class="col-md-3 control-label">Braintree Live</label>
                            <div class="col-md-6">
                                <label class="switch">
                                    <input type="hidden" value="FALSE" name="braintree_live"/>
                                    <input type="checkbox" {{ settingEnabled('braintree_live') ? 'checked' : '' }} name="braintree_live" value="TRUE">
                                    <span></span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Braintree Merchant Account</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ get_option('braintree_merchant_account') }}" name="braintree_merchant_account">
                            </div>
                        </div>

                        

                        

                        <!-- Wepay Config -->
                        <img class="pull-right" src="{{ getStorageUrl(config('system.media_dir').'/wepay-logo.svg') }}" width="50"
                             alt="WePay">
                        <div class="line line-dashed line-lg pull-in"></div>


                        <div class="form-group">
                            <label class="col-md-3 control-label">Wepay Live</label>
                            <div class="col-md-6">
                                <label class="switch">
                                    <input type="hidden" value="FALSE" name="wepay_live"/>
                                    <input type="checkbox" {{ settingEnabled('wepay_live') ? 'checked' : '' }} name="wepay_live" value="TRUE">
                                    <span></span>
                                </label>
                            </div>
                        </div>


                        

        <div class="line line-dashed line-lg pull-in"></div>
        
                    <div class="form-group terms">
                        <label class="col-lg-3 control-label">{{ langapp('bank_details') }}</label>
                        <div class="col-lg-6">
                            <textarea class="form-control markdownEditor" name="bank_details" data-hidden-buttons='["cmdHeading", "cmdQuote","cmdCode", "cmdList", "cmdList0"]'>{{ get_option('bank_details') }}</textarea>
                        </div>
                    </div>

                        


                    </div>
                    <div class="panel-footer">

                        {!! renderAjaxButton() !!}

                    </div>
                </section>
                
                {!! Form::close() !!}

               

    </div>
    
</div>
@push('pagescript')
@include('stacks.js.markdown')
@endpush

