@php $l = languageUsingLocale($company->locale); @endphp

<div class="pmd-card-body">

                            <address>
                            <strong class="inv-text text-uc">
                            {{  (get_option('company_legal_name_'.$l)
                                                ? get_option('company_legal_name_'.$l)
                                                : get_option('company_legal_name'))
                                             }}
                            </strong>
                                        <p>

                            {{  (get_option('company_address_'.$l)
                                    ? get_option('company_address_'.$l)
                                    : get_option('company_address'))
                                 }}<br>
                            {{  (get_option('company_city_'.$l)
                                                    ? get_option('company_city_'.$l)
                                                    : get_option('company_city'))
                                                 }},
                            @if (get_option('company_state_'.$l) != '' || get_option('company_state') != '')

                                                    {{  (get_option('company_state_'.$l)
                                                        ? get_option('company_state_'.$l)
                                                        : get_option('company_state'))  }}
                            @endif

                            @if (get_option('company_zip_code_'.$l) != '' || get_option('company_zip_code') != '')
                                                    {{  (get_option('company_zip_code_'.$l)
                                                        ? get_option('company_zip_code_'.$l)
                                                        : get_option('company_zip_code'))
                            }}
                            @endif
                            <br>

                            
                            {{  (get_option('company_country_'.$l)
                                                    ? get_option('company_country_'.$l)
                                                    : get_option('company_country'))  }}<br>
                            <abbr title="Phone">P:</abbr> <a href="tel:{{  (get_option('company_phone_'.$l)
                                    ? get_option('company_phone_'.$l)
                                    : get_option('company_phone'))  }}">

                                    {{  (get_option('company_phone_'.$l)
                                        ? get_option('company_phone_'.$l)
                                        : get_option('company_phone'))  }}
                                </a><br>

                        @if (get_option('company_phone_2_'.$l) != '' || get_option('company_phone_2') != '')
                                                    <a href="tel:{{  (get_option('company_phone_2_'.$l)
                                                        ? get_option('company_phone_2_'.$l)
                                                        : get_option('company_phone_2'))  }}">

                                            {{  (get_option('company_phone_2_'.$l)
                                                ? get_option('company_phone_2_'.$l)
                                                : get_option('company_phone_2'))  }}
                                        </a>
                                        <br>
                        @endif

                    @if (get_option('company_fax_'.$l) != '' || get_option('company_fax') != '')
                            @langapp('fax')  : <a href="tel:{{  (get_option('company_fax_'.$l) ? get_option('company_fax_'.$l) : get_option('company_fax'))  }}">
                                    {{  (get_option('company_fax_'.$l)
                                        ? get_option('company_fax_'.$l)
                                        : get_option('company_fax'))  }}
                                </a>
                            <br>
                    @endif
                    @if (get_option('company_registration_'.$l) != '' || get_option('company_registration') != '')
                        @langapp('company_registration')   : <a href="tel:{{  (get_option('company_registration_'.$l) ? get_option('company_registration_'.$l) : get_option('company_registration'))  }}">
                                    {{  (get_option('company_registration_'.$l)
                                        ? get_option('company_registration_'.$l)
                                        : get_option('company_registration'))  }}
                                </a>
                            <br>
                    @endif
                    @if (get_option('company_vat_'.$l) != '' || get_option('company_vat') != '')

                        @langapp('tax_number')  : {{  (get_option('company_vat_'.$l)
                                ? get_option('company_vat_'.$l)
                                : get_option('company_vat'))  }}<br>
                    @endif
                                        </p>

    </address>
                            @if(get_option('contact_person'))
                            <address>
                            <strong>@langapp('contact_person') </strong><br>
                            <a href="mailto:{{ get_option('company_email') }}">{{ get_option('contact_person') }}</a>
                            </address>
                            @endif

</div>