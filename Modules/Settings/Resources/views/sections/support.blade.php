<div class="row">
    <div class="col-lg-12">
        {!! Form::open(['route' => ['settings.edit', $section], 'class' => 'bs-example form-horizontal ajaxifyForm', 'files' => true]) !!}
        <section class="panel panel-default">
        <header class="panel-heading">@icon('solid/cogs') @langapp('settings')  </header>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('ticket') Prefix</label>
                <div class="col-lg-5">
                    <input type="text" name="ticket_prefix" class="form-control"
                    value="{{  get_option('ticket_prefix')  }}">
                </div>
            </div>

            <div class="form-group">
                    <label class="col-lg-3 control-label">@langapp('ticket_number_format')</label>
                    <div class="col-lg-5">
                        <input type="text" name="ticket_number_format" class="form-control"
                               value="{{  get_option('ticket_number_format')  }}">
                    </div>
                </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('ticket_start_number')  </label>
                <div class="col-lg-5">
                    <input type="text" name="ticket_start_no" class="form-control"
                    value="{{  get_option('ticket_start_no')  }}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('default_department')  </label>
                <div class="col-lg-5">
                    <select name="ticket_default_department" class="form-control">
                        @foreach (App\Entities\Department::all() as $key => $d)
                        <option value="{{  $d->deptid  }}"{{  get_option('ticket_default_department') == $d->deptid ? ' selected="selected"' : ''  }}>{{  $d->deptname  }}</option>
                        @endforeach
                    </select>
                </div>
                <span class="help-block m-b-none small text-danger">@langapp('default_ticket_department')</span>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('auto_close_ticket') 
                <span class="" data-rel="tooltip" title="@langapp('auto_close_ticket_after')">@icon('solid/question-circle')</span>
            </label>
                
                <div class="col-lg-5">
                    <input type="text" class="form-control" value="{{ get_option('auto_close_ticket') }}"
                    name="auto_close_ticket">
                </div>
            </div>
            <div class="form-group">
                    <label class="col-lg-3 control-label">@langapp('ticket_due_after') @required</label>
                    <div class="col-lg-5">
                        <input type="text" name="ticket_due_after" class="form-control" data-toggle="tooltip"
                               data-placement="top" data-original-title="Maximum number of days a ticket can remain open"
                               value="{{ get_option('ticket_due_after') }}" required>
                    </div>
                </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('feedback_request') 
                <span class="" data-rel="tooltip" title="@langapp('feedback_request_help')">@icon('solid/question-circle')</span>
            </label>
                
                <div class="col-lg-5">
                    <input type="text" class="form-control" value="{{ get_option('ticket_feedback_after') }}"
                    name="ticket_feedback_after">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Enable Answer Bot</label>
                <div class="col-lg-5">
                    <label class="switch">
                        <input type="hidden" value="FALSE" name="answerbot_active"/>
                        <input type="checkbox"
                        {{ settingEnabled('answerbot_active') ? 'checked="checked"' : '' }} name="answerbot_active" value="TRUE">
                        <span></span>
                    </label>
                </div>
            </div>


        <div class="form-group">
                <label class="col-lg-3 control-label"> IMAP</label>
                <div class="col-lg-3">
                    <label class="switch">
                        <input type="hidden" value="FALSE" name="ticket_mail_imap" />
                        <input type="checkbox" {{ settingEnabled('ticket_mail_imap') ? 'checked' : '' }} name="ticket_mail_imap" value="TRUE">
                        <span ></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label"> IMAP Host </label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" value="{{ get_option('ticket_mail_host') }}" name="ticket_mail_host">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label"> IMAP Username </label>
                <div class="col-lg-5">
                    <input type="text" autocomplete="off" class="form-control" value="{{ get_option('ticket_mail_username') }}" name="ticket_mail_username">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label"> IMAP Password </label>
                <div class="col-lg-5">
                    <input type="password" autocomplete="off" class="form-control"
                    value="{{ get_option('ticket_mail_password')  }}"
                    name="ticket_mail_password">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label"> Mail Port </label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" value="{{ get_option('ticket_mail_port') }}" name="ticket_mail_port">
                </div>
                <span class="help-block m-b-none small text-danger"> Port(143 or 110) (Gmail: 993)</span>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label"> Mail Flags </label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" value="{{ get_option('ticket_mail_flags') }}"
                    name="ticket_mail_flags">
                </div>
                <span class="help-block m-b-none small text-danger">/imap/ssl/validate-cert or /imap/ssl/novalidate-cert</span>
            </div>
            
            <div class="form-group">
                <label class="col-lg-3 control-label"> Mailbox</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" value="{{  get_option('ticket_mailbox')  }}" name="ticket_mailbox">
                </div>
            </div>
            

            
            
        </div>
        <div class="panel-footer">
            {!!  renderAjaxButton()  !!}
        </div>
    </section>
    {!! Form::close() !!}
    
</div>
</div>
@push('pagestyle')
<link rel="stylesheet" href="{{ getAsset('plugins/iconpicker/fontawesome-iconpicker.min.css') }}" type="text/css"/>
@endpush
@push('pagescript')
@include('stacks.js.iconpicker')
@endpush