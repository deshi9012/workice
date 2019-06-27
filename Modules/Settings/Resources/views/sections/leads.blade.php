<div class="row">
    <div class="col-lg-12">
        
        <section class="panel panel-default">
            <header class="panel-heading">@langapp('lead_settings')</header>
            
                {!! Form::open(['route' => ['settings.edit', $section], 'class' => 'bs-example form-horizontal ajaxifyForm', 'files' => true, 'data-toggle' => 'validator']) !!}
            
            <div class="panel-body">

                <fieldset>
                    <input class="display-none" type="text" name="lead_imap_username"/>
                    <input class="display-none" type="password" name="lead_imap_password"/>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('default_stage')</label>
                        <div class="col-lg-7">
                            <select class="select2-option form-control" name="default_lead_stage" required>
                                
                                @foreach (App\Entities\Category::whereModule('leads')->orderBy('order', 'desc')->get() as $stage)
                                <option value="{{  $stage->id  }}" {{ $stage->id == get_option('default_lead_stage') ? 'selected="selected"' : '' }}>
                                    {{  $stage->name }}
                                </option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('default_sales_agent')</label>
                        <div class="col-lg-7">
                            <select class="select2-option form-control" name="default_sales_rep" required>
                                
                                @foreach (Modules\Users\Entities\User::permission('leads_create')->get() as $user)
                                <option value="{{  $user->id  }}" {{ $user->id == get_option('default_sales_rep') ? 'selected="selected"' : '' }}>{{  $user->name }}</option>
                                @endforeach
                                
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="col-lg-3 control-label">@langapp('next_followup')</label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control" value="{{ get_option('lead_followup_days') }}" name="lead_followup_days">
                        <span class="help-block m-b-none small text-danger">Number of days to follow-up on a lead</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">@langapp('expiry_date')</label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control" value="{{ get_option('lead_expire_days') }}" name="lead_expire_days">
                        <span class="help-block m-b-none small text-danger">Number of days before a lead is marked as expired</span>
                    </div>
                </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('enable_double_optin') <span data-rel="tooltip" title="A confirmation email with a unique URL will be sent to leads.">@icon('solid/info-circle')</span></label>
                        <div class="col-lg-7">
                            <label class="switch">
                                <input type="hidden" value="FALSE" name="leads_opt_in"/>
                                <input type="checkbox" {{ settingEnabled('leads_opt_in') ? 'checked="checked"' : '' }} name="leads_opt_in" value="TRUE"><span></span>
                            </label>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('weblead_recaptcha') <span data-rel="tooltip" title="Add reCaptcha to lead web form to prevent spammers">@icon('solid/info-circle')</span></label>
                        <div class="col-lg-7">
                            <label class="switch">
                                <input type="hidden" value="FALSE" name="lead_recaptcha"/>
                                <input type="checkbox" {{ settingEnabled('lead_recaptcha') ? 'checked="checked"' : '' }} name="lead_recaptcha" value="TRUE"><span></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('auto_delete') <span data-rel="tooltip" title="When a lead is converted to a customer, delete it">@icon('solid/info-circle')</span></label>
                        <div class="col-lg-7">
                            <label class="switch">
                                <input type="hidden" value="FALSE" name="leads_delete_converted"/>
                                <input type="checkbox" {{ settingEnabled('leads_delete_converted') ? 'checked' : '' }} name="leads_delete_converted" value="TRUE"><span></span>
                            </label>
                        </div>
                    </div>

                <div class="form-group">
                <label class="col-lg-3 control-label">IMAP</label>
                <div class="col-lg-3">
                    <label class="switch">
                        <input type="hidden" value="FALSE" name="lead_mail_imap" />
                        <input type="checkbox" {{ settingEnabled('lead_mail_imap') ? 'checked' : '' }} name="lead_mail_imap" value="TRUE">
                        <span ></span>
                    </label>
                </div>
                </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">IMAP Host</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" value="{{ get_option('lead_mail_host') }}" name="lead_mail_host">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">IMAP Username</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" value="{{ get_option('lead_mail_username') }}" name="lead_mail_username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">IMAP Password</label>
                        <div class="col-lg-7">
                            <input type="password" class="form-control" value="{{ get_option('lead_mail_password') }}" name="lead_mail_password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Mail Port</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" value="{{ get_option('lead_mail_port') }}" name="lead_mail_port">
                            <span class="help-block m-b-none small text-danger">Port (143 or 110) (Gmail: 993)</span>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Mail Flags</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" value="{{ get_option('lead_mail_flags') }}" name="lead_mail_flags">
                            <span class="help-block m-b-none small text-danger">/imap/ssl/validate-cert or /imap/ssl/novalidate-cert</span>
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Mailbox</label>
                        <div class="col-lg-7">
                            <input type="text" class="form-control" value="{{ get_option('lead_mailbox') }}" name="lead_mailbox">
                        </div>
                    </div>
                    
                </fieldset>
            </div>
            <div class="panel-footer">
                {!!  renderAjaxButton() !!}
            </div>


            {!! Form::close() !!}

        </section>
        
        
        
    </div>
    
</div>
@push('pagestyle')
@include('stacks.css.form')
@endpush
@push('pagescript')
@include('stacks.js.form')
@endpush