<div class="row">
    
    <div class="col-lg-12">
    {!! Form::open(['route' => ['settings.edit', $section], 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}
        <section class="panel panel-default">
            <header class="panel-heading">@icon('solid/cogs') @langapp('estimate_settings')  </header>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-lg-3 control-label">@langapp('estimate_color') @required</label>
                    <div class="col-lg-6">
                        <input type="text" name="estimate_color" class="form-control"
                               value="{{  get_option('estimate_color')  }}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">@langapp('estimate_prefix')   @required</label>
                    <div class="col-lg-6">
                        <input type="text" name="estimate_prefix" class="form-control"
                               value="{{  get_option('estimate_prefix')  }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">@langapp('estimate_number_format')</label>
                    <div class="col-lg-6">
                        <input type="text" name="estimate_number_format" class="form-control"
                               value="{{ get_option('estimate_number_format') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">@langapp('estimate_start_number')  </label>
                    <div class="col-lg-6">
                        <input type="text" name="estimate_start_no" class="form-control"
                               value="{{ get_option('estimate_start_no') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">@langapp('remind_estimates_before') @required</label>
                    <div class="col-lg-6">
                        <input type="text" name="remind_estimates_before" class="form-control" data-toggle="tooltip"
                               data-placement="top" data-original-title="Default number of days to remind clients before an estimate expires"
                               value="{{ get_option('remind_estimates_before') }}" required>
                    </div>
                </div>
                

                <div class="form-group terms">
                    <label class="col-lg-3 control-label">@langapp('estimate_footer')  </label>
                    <div class="col-lg-9">
                        <textarea class="form-control markdownEditor"
                                  name="estimate_footer">{{  get_option('estimate_footer')  }}</textarea>
                    </div>
                </div>
                <div class="form-group terms">
                    <label class="col-lg-3 control-label">@langapp('estimate_terms')  </label>
                    <div class="col-lg-9">
                        <textarea class="form-control markdownEditor" name="estimate_terms">{{  get_option('estimate_terms')  }}</textarea>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-lg-3 control-label"></label>
                    <div class="col-sm-9">
                        
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" value="FALSE" name="autoremind_estimates"/>
                                        <input type="checkbox" name="autoremind_estimates" {{ settingEnabled('autoremind_estimates')  ? 'checked' : ''  }} value="TRUE">
                                        <span class="label-text" data-rel="tooltip" title="Automatically send reminder email to clients when estimate are almost expiring">@langapp('autoremind_estimates')</span>
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" value="FALSE" name="display_estimate_badge"/>
                                        <input type="checkbox" name="display_estimate_badge" {{ settingEnabled('display_estimate_badge')  ? 'checked' : ''  }} value="TRUE">
                                        <span class="label-text">@langapp('display_estimate_badge')</span>
                                    </label>
                                </div>
                                

                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" value="FALSE" name="show_estimate_tax"/>
                                        <input type="checkbox" name="show_estimate_tax" {{  settingEnabled('show_estimate_tax') ? 'checked' : ''  }} value="TRUE">
                                        <span class="label-text">@langapp('show_item_tax')</span>
                                    </label>
                                </div>

                                

                                
                                

                                
                                
                                
                            </div>
                            <div class="col-sm-6">

                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" value="FALSE" name="estimate_to_project"/>
                                        <input type="checkbox" name="estimate_to_project" {{  settingEnabled('estimate_to_project') ? 'checked' : ''  }} value="TRUE">
                                        <span class="label-text" data-rel="tooltip" title="Convert accepted estimate to project.">@langapp('estimate_to_project')</span>
                                    </label>
                                </div>
                                

                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" value="FALSE" name="estimate_to_invoice"/>
                                        <input type="checkbox" name="estimate_to_invoice" {{ settingEnabled('estimate_to_invoice') ? 'checked' : '' }} value="TRUE">
                                        <span class="label-text" data-rel="tooltip" title="Automatically convert a quote to an invoice when approved by a client.">@langapp('estimate_to_invoice') </span>
                                    </label>
                                </div>

                                

                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" value="FALSE" name="archive_estimate"/>
                                        <input type="checkbox" name="archive_estimate" {{ settingEnabled('archive_estimate') ? 'checked="checked"' : '' }} value="TRUE">
                                        <span class="label-text" data-rel="tooltip" title="Automatically archive quotes when they are converted.">@langapp('archive_estimate')</span>
                                    </label>
                                </div>

                                
                                
                                
                            </div>

                        </div>
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

@push('pagescript')
    @include('stacks.js.markdown')
@endpush