@php $l = languageUsingLocale($company->locale); @endphp
<span class="inv-text text-uc">
{{ get_option('company_legal_name_'.$l) ? get_option('company_legal_name_'.$l) : get_option('company_legal_name') }}
</span><br>
    {{ get_option('company_address_'.$l) ? get_option('company_address_'.$l) : get_option('company_address') }}<br>
    {{  get_option('company_city_'.$l) ? get_option('company_city_'.$l) : get_option('company_city') }},
    @if (get_option('company_state_'.$l) != '' || get_option('company_state') != '')
    {{ get_option('company_state_'.$l) ? get_option('company_state_'.$l) : get_option('company_state')  }}
    @endif
    @if (get_option('company_zip_code_'.$l) != '' || get_option('company_zip_code') != '')
    {{ get_option('company_zip_code_'.$l) ? get_option('company_zip_code_'.$l) : get_option('company_zip_code') }}
    @endif
    <br>
    
    {{ get_option('company_country_'.$l) ? get_option('company_country_'.$l) : get_option('company_country') }}<br>
    <abbr title="Phone">P:</abbr>
    {{ get_option('company_phone_'.$l) ? get_option('company_phone_'.$l) : get_option('company_phone') }}
    <br>
@if (get_option('company_phone_2_'.$l) != '' || get_option('company_phone_2') != '')
{{ get_option('company_phone_2_'.$l) ? get_option('company_phone_2_'.$l) : get_option('company_phone_2') }}
<br>
@endif
@if (get_option('company_fax_'.$l) != '' || get_option('company_fax') != '')
@langapp('fax') : {{ get_option('company_fax_'.$l) ? get_option('company_fax_'.$l) : get_option('company_fax') }}
<br>
@endif
@if (get_option('company_registration_'.$l) != '' || get_option('company_registration') != '')
@langapp('company_registration'): {{ get_option('company_registration_'.$l) ? get_option('company_registration_'.$l) : get_option('company_registration') }}
<br>
@endif
@if (get_option('company_vat_'.$l) != '' || get_option('company_vat') != '')
@langapp('tax_number') : {{ get_option('company_vat_'.$l) ? get_option('company_vat_'.$l) : get_option('company_vat') }}<br>
@endif