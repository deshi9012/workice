<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('make_changes')  </h4>
        </div>


        <div class="modal-body">

            <div class="panel-body">

            {!! Form::open(['route' => ['users.api.update', $user->id], 'class' => 'bs-example form-horizontal ajaxifyForm', 'method' => 'PUT']) !!}
                <input type="hidden" name="id" value="{{ $user->id }}">

                <input class="display-none" type="hidden" name="username"/>
                <input class="display-none" type="hidden" name="password"/>
                <input class="display-none" type="hidden" value="0" name="department"/>


                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>@langapp('username') @required</label>
                            <input type="text" value="{{  $user->username  }}" name="username" class="form-control"
                                   required>
                        </div>
                        <div class="col-md-6">
                            <label>@langapp('password') </label>
                            <input type="password" value="" name="password" class="form-control" placeholder="Leave Blank">
                        </div>
                        
                    </div>
                </div>


                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>@langapp('fullname')  @required</label>
                            <input type="text" value="{{ $user->name }}" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>@langapp('job_title')  </label>
                            <input type="text" value="{{ $user->profile->job_title }}" name="job_title" class="form-control">
                        </div>

                    </div>
                </div>


                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>@langapp('email') @required</label>
                            <input type="email" value="{{  $user->email  }}" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>@langapp('company')</label>

                            <select class="select2-option form-control" name="company">
                                <option value="0" selected>{{ get_option('company_name') }}</option>
                                    @foreach (Modules\Clients\Entities\Client::select('id', 'name')->get() as $company)
                                        <option value="{{  $company->id  }}" {{ $user->profile->company == $company->id ? ' selected' : '' }}>
                                            {{ $company->name }}
                                        </option>
                                    @endforeach


                            </select>

                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>@langapp('address')  </label>
                            <input type="text" value="{{  $user->profile->address  }}" name="address"
                                   class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>@langapp('country')  </label>
                            <select class="select2-option form-control" name="country">
                                @foreach (countries() as $country)
                                    <option value="{{  $country['name']  }}" {{ $country['name'] == $user->profile->country ? 'selected' : '' }}>
                                        {{  $country['name']  }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>@langapp('city')  </label>
                            <input type="text" value="{{  $user->profile->city  }}" name="city" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>@langapp('state')  </label>
                            <input type="text" value="{{  $user->profile->state  }}" name="state" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>@langapp('zipcode')  </label>
                            <input type="text" value="{{  $user->profile->zip_code  }}" name="zip_code" class="form-control">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>@langapp('phone')</label>
                            <input type="text" value="{{  $user->profile->phone  }}" name="phone" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>@langapp('mobile')</label>
                            <input type="text" value="{{  $user->profile->mobile  }}" name="mobile" class="form-control">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>@langapp('website')  </label>
                            <input type="text" value="{{ $user->profile->website }}" name="website"
                                   class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Twitter</label>
                            <input type="text" value="{{ $user->profile->twitter }}" name="twitter"
                                   class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>@langapp('locale')  </label>
                            <select class="select2-option form-control" name="locale">
                                @foreach (locales() as $loc)
                                    <option value="{{ $loc['code']  }}" {{ $user->locale == $loc['code'] ? ' selected' : ''  }}>
                                        {{  ucfirst($loc['language'])  }} - {{ $loc['code'] }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="col-md-6">
                            <label>Skype</label>
                            <input type="text" value="{{  $user->profile->skype  }}" name="skype" class="form-control">

                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>@langapp('hourly_rate')</label>

                            <input type="text" class="form-control" value="{{ $user->profile->hourly_rate }}" name="hourly_rate">
                        </div>

                        <div class="col-md-6">
                            <label class="display-block">@langapp('department')</label>
                            <select name="department[]" class="select2-option form-control" multiple="multiple">
                                @foreach (App\Entities\Department::all() as $d)
                                    <option value="{{ $d->deptid  }}" {{ in_array($d->deptid, array_pluck($user->departments->toArray(), 'department_id')) ? ' selected' : '' }}>
                                        {{ $d->deptname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <div class="row">

                <div class="col-md-12">

                            <label class="display-block">@langapp('roles')</label>
                            <select name="roles[]" class="select2-option form-control" multiple="multiple">
                                @foreach (Role::all() as $role)
                                    <option value="{{  $role->name  }}" {{  $user->hasRole($role->name) ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                                @endforeach
                            </select>

                        </div>
                </div>
            </div>


                

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