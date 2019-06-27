<div class="modal-dialog" id="eventModal">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('add_event')  </h4>
        </div>
        {!! Form::open(['route' => 'events.api.save', 'class' => 'bs-example form-horizontal ajaxifyForm', 'data-toggle' => 'validator']) !!}
        
        <div class="modal-body">
            <input type="hidden" name="module" value="{{ $module }}">
            <input type="hidden" name="module_id" value="{{ $module_id ?? 0 }}">
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="redirect" value="{{ url()->previous() }}">
            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('title') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="@langapp('event_name')  " name="event_name" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('venue') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="@langapp('venue')  " name="location" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('description')  </label>
                <div class="col-lg-8">
                    <textarea class="form-control ta" name="description" placeholder="Type here.."></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('start_date') @required</label>
                <div class="col-lg-8">
                    <div class="input-group date">
                        <input type="text" class="form-control datetimepicker-input"
                        value="{{  timePickerFormat(now()->addHours(1)) }}" name="start_date"
                        data-date-format="DD-MM-YYYY hh:mm A" data-date-start-date="moment()" required>
                        <div class="input-group-addon">
                            @icon('solid/calendar-alt', 'text-muted')
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('end_date') @required</label>
                <div class="col-lg-8">
                    <div class="input-group date">
                        <input type="text" class="form-control datetimepicker-input"
                        value="{{  timePickerFormat(now()->addDays(1)) }}" name="end_date"
                        data-date-format="DD-MM-YYYY hh:mm A" data-date-start-date="moment()" required>
                        <div class="input-group-addon">
                            @icon('solid/calendar-alt', 'text-muted')
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('calendar')  </label>
                <div class="col-lg-8">
                    <select class="form-control" name="calendar_id">
                        @foreach (Modules\Calendar\Entities\CalendarType::get() as $calendar)
                        <option value="{{  $calendar->id  }}" {{ $calendar->id != get_option('default_calendar') ?? 'selected="selected"'  }}>{{  $calendar->name  }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            @can('projects_view_all')
            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('project')  </label>
                <div class="col-lg-8">
                    <select class="select2-option form-control" name="project_id">
                        <option value="0" selected>@langapp('none')  </option>
                        @foreach (Modules\Projects\Entities\Project::select('id', 'name')->get() as $project)
                        <option value="{{  $project->id  }}">{{  $project->name  }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endcan
            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('attendees')  </label>
                <div class="col-lg-8">
                    <select class="select2-option form-control" name="attendees[]" multiple="">
                        @foreach (Modules\Users\Entities\User::select('id', 'username', 'name')->get() as $user)
                        <option value="{{ $user->id }}" {{ $user->id === Auth::id() ? 'selected' : '' }}>{{  $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('event_color') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control color-selector" value="#FE528C" name="color" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('alert')</label>
                <div class="col-lg-8">
                    <select name="alert" class="form-control">
                        <option value="30">@langapp('30_minutes_before')</option>
                        <option value="60">@langapp('1_hour_before')</option>
                        <option value="1440" selected>@langapp('1_day_before')</option>
                        <option value="10080">@langapp('1_week_before')</option>
                    </select>
                </div>
            </div>
            <input type="hidden" name="is_private" value="0">
            <div class="form-group">
                
                <label class="col-lg-3 control-label"></label>
                <div class="col-lg-8">
                    <div class="form-check text-muted m-t-xs">
                        <label>
                            <input type="checkbox" name="is_private" checked value="1">
                            <span class="label-text">@langapp('hidden_from_users')</span>
                        </label>
                    </div>
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
@push('pagestyle')
    @include('stacks.css.datepicker')
    @include('stacks.css.form')
    @include('stacks.css.colorpicker')
@endpush
@push('pagescript')
    @include('stacks.js.datepicker')
    @include('stacks.js.form')
    @include('stacks.js.colorpicker')
    @include('partial.ajaxify')
<script type="text/javascript">
    $('.datetimepicker-input').datetimepicker({showClose: true, showClear: true, minDate: moment().add(-1, 'days') });
    $('.color-selector').colorpicker();
</script>
@endpush
@stack('pagestyle')
@stack('pagescript')