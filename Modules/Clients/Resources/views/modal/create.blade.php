<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('new_client') </h4>
        </div>
        {!! Form::open(['route' => 'clients.api.save', 'class' => 'ajaxifyForm validator', 'novalidate' => '', 'files' => true]) !!}

        <div class="modal-body">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#tab-client-general" data-toggle="tab">@langapp('general') </a></li>
                <li><a href="#tab-client-contact" data-toggle="tab">@langapp('contact') </a></li>
                <li><a href="#tab-client-web" data-toggle="tab">@langapp('web') </a></li>
                <li><a href="#tab-client-custom" data-toggle="tab">@langapp('custom_fields') </a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab-client-general">

                    <div class="form-group">
                        <label>@langapp('company_name')  / @langapp('fullname') @required</label>
                        <input type="text" name="name" value="" class="input-sm form-control" required>
                    </div>
                    <div class="form-group">
                        <label>@langapp('email')  @required</label>
                        <input type="email" name="email" value="" class="input-sm form-control" required>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                        <label>@langapp('contact_person') </label>
                        <input type="text" name="contact_name" class="input-sm form-control">
                        </div>

                        <div class="form-group col-md-6">
                        <label>@langapp('contact_email')</label>
                        <input type="text" name="contact_email" class="input-sm form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>@langapp('tax_number')  </label>
                        <input type="text" value="" name="tax_number" class="input-sm form-control">
                    </div>
                    

                    <div class="form-group">
                        <label>@langapp('notes') </label>
                        <textarea name="notes" class="form-control ta" placeholder="@langapp('notes') "></textarea>
                    </div>

                    <div class="form-group">
                <label>@langapp('tags')  </label>
                    <select class="select2-tags form-control" name="tags[]" multiple="multiple">
                        @foreach (App\Entities\Tag::all() as $tag)
                        <option value="{{  $tag->name  }}">{{  $tag->name }}</option>
                        @endforeach
                    </select>
            </div>

                </div>
                <div class="tab-pane fade in" id="tab-client-contact">
                    <div class="form-group col-md-4 no-gutter-left">
                        <label>@langapp('phone')  </label>
                        <input type="text" value="" name="phone" class="input-sm form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label>@langapp('mobile')  </label>
                        <input type="text" value="" name="mobile" class="input-sm form-control">
                    </div>
                    <div class="form-group col-md-4 no-gutter-right">
                        <label>@langapp('fax')  </label>
                        <input type="text" value="" name="fax" class="input-sm form-control">
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group col-md-6 no-gutter-left">
                        <label>@langapp('address') 1</label>
                        <textarea name="address1" class="form-control"></textarea>
                    </div>
                    <div class="form-group col-md-6 no-gutter-right">
                        <label>@langapp('address') 2</label>
                        <textarea name="address2" class="form-control"></textarea>
                    </div>

                    

                    <div class="form-group col-md-6 no-gutter-left">
                        <label>@langapp('city')  </label>
                        <input type="text" value="" name="city" class="input-sm form-control">
                    </div>
                    <div class="form-group col-md-6 no-gutter-right">
                        <label>@langapp('zipcode')  </label>
                        <input type="text" value="" name="zip_code" class="input-sm form-control">
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                        <label>@langapp('locale') </label>
                        <select name="locale" class="form-control">
                            @foreach (languages() as $language)
                            <option value="{{ $language['code'] }}" {{ get_option('locale') == $language['code'] ? ' selected' : '' }}>{{ ucfirst($language['name']) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>@langapp('currency') </label>
                        <select name="currency" class="form-control select2-option">
                            @foreach (currencies() as $cur)
                                <option value="{{ $cur['code'] }}" {{ get_option('default_currency') == $cur['code'] ? ' selected' : '' }}>{{ $cur['title'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>@langapp('state')  </label>
                            <input type="text" value="" name="state" class="input-sm form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>@langapp('country')  </label>
                            <select class="form-control select2-option" name="country">
                                    @foreach (countries() as $country)
                                        <option value="{{ $country['name'] }}" {{ $country['name'] == get_option('company_country') ? 'selected' : '' }}>{{ $country['name'] }}</option>
                                    @endforeach
                            </select>
                        </div>

                        

                    </div>

                    <div class="form-group">
                                
                                    <label>@langapp('logo') </label>
                                        <input type="file" name="logo">
                                    
                                </div>
                                
                </div>
                <div class="tab-pane fade in" id="tab-client-web">
                    <div class="form-group">
                        <label>@langapp('website')  </label>
                        <input type="text" value="" name="website" class="input-sm form-control">
                    </div>
                    <div class="form-group">
                        <label>Skype</label>
                        <input type="text" value="" name="skype" class="input-sm form-control">
                    </div>
                    <div class="form-group">
                        <label>LinkedIn</label>
                        <input type="text" value="https://linkedin.com/in/" name="linkedin" class="input-sm form-control">
                    </div>
                    <div class="form-group">
                        <label>Facebook</label>
                        <input type="text" value="https://facebook.com/" name="facebook" class="input-sm form-control">
                    </div>
                    <div class="form-group">
                        <label>Twitter</label>
                        <input type="text" value="https://twitter.com/" name="twitter" class="input-sm form-control">
                    </div>
                </div>

                

                <div class="tab-pane fade in" id="tab-client-custom">

                @php 
                $data['fields'] = App\Entities\CustomField::whereModule('clients')->orderBy('order', 'desc')->get();
                @endphp
                @include('partial.customfields.createNoCol', $data)

                </div>
        </div>

        @include('partial.privacy_consent')
        
        <div class="modal-footer">
            {!! closeModalButton() !!}
            {!! renderAjaxButton() !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
@push('pagestyle')
@include('stacks.css.form')
@endpush
@push('pagescript')
@include('stacks.js.form')
@include('partial.ajaxify')
@endpush

@stack('pagestyle')
@stack('pagescript')