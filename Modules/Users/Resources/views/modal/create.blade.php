<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">@langapp('create')  </h4>
            </div>
    
    
            <div class="modal-body">
    
                <div class="panel-body">
    
                {!! Form::open(['route' => 'users.api.save', 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}
                   
    
                    <input class="display-none" type="hidden" name="username"/>
                    <input class="display-none" type="hidden" name="password"/>
    
    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>@langapp('username')  @required</label>
                                <input type="text" name="username" class="form-control" placeholder="johndoe" required>
                            </div>
                            <div class="col-md-6">
                                <label>@langapp('password')  </label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            
                        </div>
                    </div>
    
    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>@langapp('fullname') @required</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label>@langapp('email') @required</label>
                                <input type="email" name="email" class="form-control" placeholder="you@domain.com" required>
                            </div>
                            <div class="col-md-6">
                                <label>Desk </label>
                                <select class="select2-option form-control" name="desk">
                                    @foreach (App\Entities\Desk::all() as $desk)
                                        <option value="{{  $desk->id  }}">{{  $desk->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{--<div class="col-md-6">--}}
                                {{--<label>@langapp('job_title')  </label>--}}
                                {{--<input type="text" name="job_title" class="form-control" placeholder="Sales Manager">--}}
                            {{--</div>--}}
    {{----}}
                        </div>
                    </div>
    
    
                    {{--<div class="form-group">--}}
                        {{--<div class="row">--}}

                            {{--<div class="col-md-6">--}}
                                {{--<label>@langapp('company')</label>--}}
    {{----}}
                                {{--<select class="select2-option width100" name="company">--}}
                                        {{--<option value="-">None</option>--}}
                                        {{--@foreach (Modules\Clients\Entities\Client::select('id', 'name')->get() as $company)--}}
                                            {{--<option value="{{ $company->id }}">{{  $company->name  }}</option>--}}
                                        {{--@endforeach--}}
    {{----}}
    {{----}}
                                {{--</select>--}}
    {{----}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
    
    
                    {{--<div class="form-group">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-md-6">--}}
                                {{--<label>@langapp('address')  </label>--}}
                                {{--<input type="text" name="address" class="form-control">--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6">--}}
                                {{--<label>@langapp('country')  </label>--}}
                                {{--<select class="select2-option form-control" name="country">--}}
                                    {{--@foreach (DB::table('countries')->select('name')->get() as $country)--}}
                                        {{--<option value="{{  $country->name  }}" {{ $country->name == get_option('company_country') ? 'selected' :'' }}>{{  $country->name  }}</option>--}}
                                    {{--@endforeach--}}
    {{----}}
                                {{--</select>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
    
                    {{--<div class="form-group">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-md-4">--}}
                                {{--<label>@langapp('city')</label>--}}
                                {{--<input type="text" name="city" class="form-control">--}}
                            {{--</div>--}}
                            {{--<div class="col-md-4">--}}
                                {{--<label>@langapp('state')</label>--}}
                                {{--<input type="text" name="state" class="form-control">--}}
                            {{--</div>--}}
                            {{--<div class="col-md-4">--}}
                                {{--<label>@langapp('zipcode')</label>--}}
                                {{--<input type="text" name="zip_code" class="form-control">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
    
    
                    {{--<div class="form-group">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-md-6">--}}
                                {{--<label>@langapp('phone')</label>--}}
                                {{--<input type="text" name="phone" class="form-control">--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6">--}}
                                {{--<label>@langapp('mobile')</label>--}}
                                {{--<input type="text" name="mobile" class="form-control">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
    {{----}}
    
                    {{--<div class="form-group">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-md-6">--}}
                                {{--<label>@langapp('website')  </label>--}}
                                {{--<input type="text" name="website" class="form-control" placeholder="https://workice.com">--}}
                            {{--</div>--}}
                            {{--<div class="col-md-6">--}}
                                {{--<label>Twitter</label>--}}
                                {{--<input type="text" name="twitter" class="form-control">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
    
    
                    {{--<div class="form-group">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-md-6">--}}
                                {{--<label>@langapp('hourly_rate')  </label>--}}
    {{----}}
                                {{--<input type="text" class="form-control" name="hourly_rate" placeholder="22">--}}
                            {{--</div>--}}
    {{----}}
                            {{--<div class="col-md-6">--}}
                                {{--<label class="display-block">@langapp('department')  </label>--}}
    {{----}}
    {{----}}
                                {{--<select name="department[]" class="select2-option form-control" multiple="multiple">--}}
                                        {{--@foreach (App\Entities\Department::all() as $d)--}}
                                            {{--<option value="{{  $d->deptid  }}">--}}
                                                {{--{{  $d->deptname  }} --}}
                                            {{--</option>--}}
                                        {{--@endforeach--}}
                                {{--</select>--}}
    {{----}}
    {{----}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
    
    
                    <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>@langapp('locale')  {{ get_option('locale') }}</label>
                            <select class="select2-option form-control" name="locale">
                                @foreach (locales() as $loc)
                                    <option value="{{ $loc['code']  }}" {{ get_option('locale') == $loc['code'] ? 'selected' : ''  }}>
                                        {{  ucfirst($loc['language'])  }} - {{ $loc['code'] }}</option>
                                @endforeach
                            </select>

                        </div>

                        {{--<div class="col-md-6">--}}
                            {{--<label>Skype</label>--}}
                            {{--<input type="text" placeholder="john.doe" name="skype" class="form-control">--}}

                        {{--</div>--}}
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">

                <div class="col-md-12">

                            <label class="display-block">@langapp('roles')</label>
                            <select name="roles[]" class="select2-option form-control" multiple="multiple">
                                @foreach (Role::all() as $role)
                                    <option value="{{ $role->name }}" {{  $role->name == get_option('default_role') ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                                @endforeach
                            </select>

                        </div>
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
    
    
        </div>

    </div>
    
    
    @push('pagestyle')
    @include('stacks.css.form')
    @endpush
    @push('pagescript')
    @include('stacks.js.form')
    @include('partial/ajaxify')
    @endpush
    
    @stack('pagestyle')
    @stack('pagescript')