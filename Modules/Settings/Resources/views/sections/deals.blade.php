<div class="row">

    <div class="col-lg-12">
    {!! Form::open(['route' => ['settings.edit', $section], 'class' => 'bs-example form-horizontal ajaxifyForm', 'files' => true, 'data-toggle' => 'validator']) !!}


        <section class="panel panel-default">
            <header class="panel-heading">
            @icon('solid/envelope-open') @langapp('deal_settings')  
            </header>

            <input class="display-none" type="text" name="deal_imap_username"/>
            <input class="display-none" type="password" name="deal_imap_password"/>

            <div class="panel-body">

                <div class="form-group">
                    <label class="col-lg-3 control-label">@langapp('deal_rotting')</label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control" value="{{ get_option('deal_rotting') }}" name="deal_rotting">
                        <span class="help-block m-b-none small text-danger">Number of days before a deal is marked as idle</span>
                    </div>
                </div>

                <div class="form-group">
                        <label class="col-lg-3 control-label" data-rel="tooltip" title="Create an invoice automatically when a deal is won">@langapp('auto_invoice') @icon('solid/question-circle')</label>
                        <div class="col-lg-7">
                            <label class="switch">
                                <input type="hidden" value="FALSE" name="deals_invoice_won"/>
                                <input type="checkbox" {{ settingEnabled('deals_invoice_won') ? 'checked' : '' }} name="deals_invoice_won" value="TRUE"><span></span>
                            </label>
                        </div>
                    </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">@langapp('default_pipeline')</label>
                    <div class="col-lg-7">
                    <select class="select2-option form-control" name="default_deal_pipeline" required>
                            
                @php 
                $pipelines = App\Entities\Category::select('id', 'name')->whereModule('pipeline')->get(); 
                @endphp
                                @foreach ($pipelines as $pipeline)
                                <option value="{{  $pipeline->id  }}" {{ $pipeline->id == get_option('default_deal_pipeline') ? 'selected="selected"' : '' }}>
                                    {{  $pipeline->name }}
                                </option>
                                @endforeach
                                            
                                </select>
                    
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">@langapp('default_stage')</label>
                    <div class="col-lg-7">

                    <select class="select2-option form-control" name="default_deal_stage" required>
                                            
                                @foreach (App\Entities\Category::whereModule('deals')->select('id', 'name', 'pipeline')->get() as $stage)
                                <option value="{{  $stage->id  }}" {{ $stage->id == get_option('default_deal_stage') ? 'selected="selected"' : '' }}>
                                    {{  $stage->name }} - {{ optional($stage->AsPipeline())->name }}
                                </option>
                                @endforeach
                                            
                                </select>

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">@langapp('default_deal_owner')</label>
                    <div class="col-lg-7">

                    <select class="select2-option form-control" name="default_deal_owner" required>
                                            
                                @foreach (app('user')->permission('deals_create')->get() as $user)
                                <option value="{{  $user->id  }}" {{ $user->id == get_option('default_deal_owner') ? 'selected="selected"' : '' }}>{{  $user->name }}</option>
                                @endforeach
                                            
                                </select>

                    </div>
                </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"> IMAP</label>
                <div class="col-lg-3">
                    <label class="switch">
                        <input type="hidden" value="FALSE" name="contact_mail_imap" />
                        <input type="checkbox" {{ settingEnabled('contact_mail_imap') ? 'checked' : '' }} name="contact_mail_imap" value="TRUE">
                        <span ></span>
                    </label>
                </div>
            </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">IMAP Host</label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control" value="{{  get_option('contact_mail_host')  }}"
                               name="contact_mail_host">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">IMAP Username</label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control" value="{{ get_option('contact_mail_username') }}" name="contact_mail_username">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">IMAP Password</label>
                    <div class="col-lg-7">
                        <input type="password" class="form-control" value="{{ get_option('contact_mail_password') }}" name="contact_mail_password">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Mail Port</label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control" value="{{ get_option('contact_mail_port') }}" name="contact_mail_port">

                        <span class="help-block m-b-none small text-danger">Port (143 or 110) (Gmail: 993)</span>
                    </div>

                    
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Mail Flags</label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control" value="{{ get_option('contact_mail_flags') }}" name="contact_mail_flags">
                    <span class="help-block m-b-none small text-danger">/imap/ssl/validate-cert or /imap/ssl/novalidate-cert</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Mailbox</label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control" value="{{ get_option('contact_mailbox')  }}" name="contact_mailbox">
                    </div>

                </div>
                


            </div>

            <div class="panel-footer">

                {!!  renderAjaxButton() !!}

            </div>
        </section>
        
        {!! Form::close() !!}

       
    </div>
    
</div>

@push('pagestyle')
    @include('stacks.css.form')
@endpush

@push('pagescript')
    @include('stacks.js.form')
@endpush
