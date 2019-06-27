@extends('layouts.app')
@section('content')
<section id="content">
    <section class="hbox stretch">

            <section class="vbox">
                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-8 m-b-xs h3">@langapp('create')  </div>
                        <div class="col-sm-4 m-b-xs">
                            <a href="{{ route('projects.default.config') }}" class="btn btn-success btn-sm pull-right" data-toggle="ajaxModal" data-rel="tooltip" title="Default Settings" data-placement="left">
                            @icon('solid/cogs')</a>
                        </div>
                    </div>
                </header>
                <section class="scrollable wrapper bg">
                    <div class="row">
                        {!! Form::open(['route' => 'projects.api.save', 'data-toggle' => 'validator', 'class' => 'ajaxifyForm']) !!}
                        <div class="col-md-7">
                            <section class="panel panel-default">
                                <header class="panel-heading">@icon('regular/clock') @langapp('information')  </header>
                                <div class="panel-body">
                                    
                                    <input type="hidden" name="auto_progress" value="1">
                                    <div class="form-group">
                                        <label>@langapp('name') @required</label>
                                        <input type="text" class="form-control" placeholder="ACME Website Redesign" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label>@langapp('client')  @required</label>
                                        <div class="input-group m-b">
                                            <select class="select2-option form-control" name="client_id" required>
                                                @if(can('menu_clients'))
                                                @foreach (classByName('clients')->select('id', 'name')->get() as $key => $client)
                                                <option value="{{  $client->id  }}" {!! $selectClient == $client->id ? 'selected="selected"' : '' !!}>{{  $client->name }}</option>
                                                @endforeach
                                                @else
                                                <option value="{{ Auth::user()->profile->company  }}">{{  optional(Auth::user()->profile->business)->name  }}</option>
                                                @endif
                                                <option value="0">-----None-----</option>
                                            </select>
                                            <span class="input-group-addon">
                                                @can('clients_create')
                                                <a href="{{  route('clients.create')  }}" data-toggle="ajaxModal"
                                                title="@langapp('new_company')  " data-placement="bottom">@icon('solid/user-tie') @langapp('new_client')  </a>
                                                @endcan
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>@langapp('progress')</label>
                                        <div class="">
                                            <div id="progress-slider" class="width100-important"></div>
                                            <input id="progress" type="hidden" value="0" name="progress"/>
                                        </div>
                                        
                                        
                                    </div>

                
                                    <!-- CAN ASSIGN TEAM -->
                                    @can('users_assign')
                                    <div class="form-group">
                                        <label>@langapp('team_members')  </label>
                                        <select name="team[]" class="form-control select2-option" multiple="multiple">
                                            @foreach (classByName('users')->select('id','username', 'name')->offHoliday()->get() as $user)
                                            <option value="{{  $user->id  }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endcan
                                    <!-- / CAN ASSIGN TEAM -->
                                    <div class="form-group">
                                        <label>@langapp('start_date') @required</label>
                                        <div class="input-group">
                                            <input class="datepicker-input form-control" size="16" type="text"
                                            value="{{  datePickerFormat(now())  }}"
                                            name="start_date"
                                            data-date-format="{{ get_option('date_picker_format') }}"
                                            required>
                                            <label class="input-group-addon btn" for="date">
                                                @icon('solid/calendar-alt', 'text-muted')
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>@langapp('due_date')  </label>
                                        <div class="input-group">
                                            <input class="datepicker-input form-control" size="16" type="text"
                                            value="{{ datePickerFormat(now()->addDays(30)) }}"
                                            name="due_date" data-date-format="{{ get_option('date_picker_format') }}" data-date-start-date="moment()" required>
                                            <label class="input-group-addon btn" for="date">
                                                @icon('solid/calendar-alt', 'text-muted')
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>@langapp('currency')  @required</label>
                                        <select name="currency" class="form-control select2-option" required>
                                            @foreach (currencies() as $cur)
                                            <option value="{{  $cur['code']  }}"{{ get_option('default_currency') == $cur['code'] ? ' selected' : '' }}>{{ $cur['title'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox-primary">
                                            <label>
                                                <input type="checkbox" name="auto_progress" value="1" checked>
                                                <span class="label-text">@langapp('auto_progress_on')   -
                                                Calculate progress through tasks</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="checkbox-primary">
                                            <label>
                                                <input type="checkbox" name="is_template" value="1">
                                                <span class="label-text">@langapp('this_is_a_project_template')</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>{{  langapp('billing_method')  }} @required</label>
                                        <select name="billing_method" class="form-control" id="project_rate" required>
                                            @foreach (config('projects.billing_methods') as $method)
                                                <option value="{{ $method }}">{{ humanize($method) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div id="hourly_rate" class="display-none">
                                        <div class="form-group">
                                            <label>@langapp('hourly_rate')   (@langapp('eg')   50.00)</label>
                                            <input type="text" class="form-control money" name="hourly_rate"
                                            value="{{  get_option('hourly_rate')  }}">
                                        </div>
                                    </div>
                                    <div id="fixed_price" class="display-none">
                                        <div class="form-group">
                                            <label>@langapp('fixed_price')  (@langapp('eg')  300.00 )</label>
                                            <input type="text" class="form-control money" placeholder="300"
                                            name="fixed_price" value="0.00">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>@langapp('estimated_hours') </label>
                                        <input type="text" class="form-control" placeholder="300" name="estimate_hours" value="100">
                                        <span class="help-block text-muted">A project time estimate helps you track progress against projections</span>
                                    </div>
                                    <div class="form-group">
                                        <label>@langapp('description') @required</label>
                                        <textarea name="description" class="form-control markdownEditor"
                                        placeholder="@langapp('description')" required></textarea>
                                    </div>
                                    
                                </div>
                            </section>
                        </div>
                        <div class="col-md-5">
                            <section class="panel panel-default">
                                <header class="panel-heading"><i
                                class="fa fa-gear"></i> @langapp('settings')  </header>
                                <div class="panel-body">
                                    @foreach (Modules\Projects\Entities\ProjectSetting::all() as $val)
                                    @php
                                    $active_settings = array();
                                    $default_settings = json_decode(get_option('default_project_settings'), true);
                                    foreach ($default_settings as $key => &$value) {
                                    if (strtolower($value) == 'on') {
                                    $active_settings[] = $key;
                                    }
                                    }
                                    @endphp
                                    <div class="checkbox-primary">
                                        <label class="checkbox-custom">
                                            <input type="checkbox" name="settings[{{  $val->setting  }}]" {{ (in_array($val->setting, $active_settings)) ? 'checked' : '' }}>
                                           <span class="label-text"> {{  $val->description  }}</span>
                                        </label>
                                    </div>
                                    <hr class="no-margin">
                                    @endforeach
                                    <div class="form-group">
                                        <label class="control-label">@langapp('tags')  </label>
                                        <select class="form-control select2-tags" name="tags[]" multiple>
                                            @foreach (App\Entities\Tag::all() as $tag)
                                            <option value="{{  $tag->name  }}">{{  $tag->name  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </section>
                        </div>
                        {!!  renderAjaxButton()  !!}
                        {!! Form::close() !!}
                    </div>
                    
                </section>
            </section>

    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a></section>
    @push('pagestyle')
    @include('stacks.css.datepicker')
    @include('stacks.css.form')
    @include('stacks.css.nouislider')
    @endpush

    @push('pagescript')
    @include('stacks.js.datepicker')
    @include('stacks.js.form')
    @include('stacks.js.nouislider')
    @include('stacks.js.markdown')

    <script type="text/javascript">
    $(document).ready(function () {
    $("#project_rate").change(function () {
        var selected_option = $('#project_rate').val();
        if (selected_option === 'hourly_project_rate') {
            $("#hourly_rate").show("fast");
            $("#fixed_price").hide("fast");
        }
        if (selected_option === 'fixed_rate') {
            $("#fixed_price").show("fast");
            $("#hourly_rate").hide("fast");
        }
        if (selected_option === 'hourly_staff_rate' || selected_option === 'hourly_task_rate') {
            $("#fixed_price").hide("fast");
            $("#hourly_rate").hide("fast");
        }
    });
    
    });
    </script>
    
    @endpush
    @endsection