<div class="row">
    <div class="col-lg-12">
        {!! Form::open(['route' => ['settings.edit', $section], 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}
        <section class="panel panel-default">
        <header class="panel-heading">@icon('solid/cogs') @langapp('company_details')  </header>
        @php 
        $translations = Modules\Settings\Entities\Options::translations();
        $default_country = get_option('company_country');
        @endphp
        <div class="panel-body">
            <input type="hidden" name="languages" value="{{  implode(',', $translations)  }}">
            @if (count($translations) > 0)
            <ul class="nav nav-tabs" role="tablist">
                <li><a class="active" data-toggle="tab" href="#tab-english">en</a></li>
                @foreach ($translations as $lang)
                <li><a data-toggle="tab" href="#tab-{{  $lang  }}">{{ $lang }}</a></li>
                @endforeach
            </ul>
            <div class="tab-content tab-content-fix">
                <div class="tab-pane fade in active" id="tab-english">
                    @endif
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('company_name') @required</label>
                        <div class="col-lg-6">
                            <input type="text" name="company_name" class="form-control"
                            value="{{  get_option('company_name')  }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('company_legal_name') @required</label>
                        <div class="col-lg-6">
                            <input type="text" name="company_legal_name" class="form-control"
                            value="{{  get_option('company_legal_name')  }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('contact_person')   </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="{{  get_option('contact_person')  }}"
                            name="contact_person">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('company_address') @required</label>
                        <div class="col-lg-6">
                            <textarea class="form-control ta" name="company_address"
                            required>{{  get_option('company_address')  }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('zipcode')</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="{{  get_option('company_zip_code')  }}"
                            name="company_zip_code">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('city')  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="{{  get_option('company_city')  }}"
                            name="company_city">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('state')  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="{{  get_option('company_state')  }}"
                            name="company_state">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('country')</label>
                        <div class="col-lg-6">
                            <select class="select2-option form-control" name="company_country">
                                @foreach(countries() as $country)
                                <option value="{{ $country['name'] }}" {{ $country['name'] == $default_country ? 'selected' : '' }}>{{ $country['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('company_email')  </label>
                        <div class="col-lg-6">
                            <input type="email" class="form-control" value="{{  get_option('company_email')  }}"
                            name="company_email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('company_phone')  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="{{  get_option('company_phone')  }}"
                            name="company_phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('company_phone')   2</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="{{  get_option('company_phone_2')  }}"
                            name="company_phone_2">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('mobile')  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="{{  get_option('company_mobile')  }}"
                            name="company_mobile">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('fax')   </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="{{  get_option('company_fax')  }}"
                            name="company_fax">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('company_domain')  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="{{  get_option('company_domain')  }}"
                            name="company_domain">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('company_registration')  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="{{  get_option('company_registration')  }}" name="company_registration">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('tax_number')  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="{{  get_option('company_vat')  }}"
                            name="company_vat">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('email_signature')  </label>
                        <div class="col-lg-6">
                            <textarea class="form-control ta" name="email_signature">{{ get_option('email_signature') }}</textarea>
                        </div>
                    </div>
                    @if (count($translations) > 0)
                </div>
                @foreach ($translations as $lang)
                <div class="tab-pane fade" id="tab-{{  $lang  }}">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('company_name')   </label>
                        <div class="col-lg-6">
                            <input type="text" name="company_name_{{  $lang  }}" class="form-control"
                            value="{{  get_option('company_name_' . $lang)  }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('company_legal_name')  </label>
                        <div class="col-lg-6">
                            <input type="text" name="company_legal_name_{{  $lang  }}" class="form-control"
                            value="{{  get_option('company_legal_name_' . $lang)  }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('contact_person')   </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="{{  get_option('contact_person_' . $lang)  }}"
                            name="contact_person_{{  $lang  }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('company_address')</label>
                        <div class="col-lg-6">
                            <textarea class="form-control ta"
                            name="company_address_{{  $lang  }}">{{  get_option('company_address_' . $lang)  }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('zipcode')</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="{{  get_option('company_zip_code_' . $lang)  }}"
                            name="company_zip_code_{{  $lang  }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('city')  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="{{  get_option('company_city_' . $lang)  }}"
                            name="company_city_{{  $lang  }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('state')  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="{{  get_option('company_state_' . $lang)  }}"
                            name="company_state_{{  $lang  }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('country')  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="{{  get_option('company_country_' . $lang)  }}"
                            name="company_country_{{  $lang  }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('company_email')  </label>
                        <div class="col-lg-6">
                            <input type="email" class="form-control"
                            value="{{  get_option('company_email_' . $lang)  }}"
                            name="company_email_{{  $lang  }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('company_phone')  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="{{  get_option('company_phone_' . $lang)  }}"
                            name="company_phone_{{  $lang  }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('company_phone')   2</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="{{  get_option('company_phone_2_' . $lang)  }}"
                            name="company_phone_2_{{  $lang  }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('mobile')  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="{{  get_option('company_mobile_' . $lang)  }}"
                            name="company_mobile_{{  $lang  }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('fax')   </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="{{  get_option('company_fax_' . $lang)  }}"
                            name="company_fax_{{  $lang  }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('company_domain')  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="{{  get_option('company_domain_' . $lang)  }}"
                            name="company_domain_{{  $lang  }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('company_registration')  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="{{  get_option('company_registration_' . $lang)  }}"
                            name="company_registration_{{  $lang  }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('tax_number')  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="{{  get_option('company_vat_' . $lang)  }}"
                            name="company_vat_{{  $lang  }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">@langapp('email_signature')</label>
                        <div class="col-lg-6">
                            <textarea class="form-control ta" name="email_signature_{{ $lang }}">{{ get_option('email_signature') }}</textarea>
                        </div>
                    </div>
                    
                </div>
                @endforeach
            </div>
            @endif
        </div>
        <div class="panel-footer">
            {!!  renderAjaxButton('save')  !!}
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