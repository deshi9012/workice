<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('make_changes')  </h4>
        </div>

        {!! Form::open(['route' => ['events.api.update', $event->id], 'method' => 'PUT', 'class' => 'bs-example form-horizontal ajaxifyForm', 'data-toggle' => 'validator']) !!}


        <div class="modal-body">
            <input type="hidden" name="module" value="{{ $event->eventable_type }}">
            <input type="hidden" name="module_id" value="{{ $event->eventable_id }}">
            <input type="hidden" name="id" value="{{  $event->id  }}">
            <input type="hidden" name="user_id" value="{{ $event->user_id }}">
            <input type="hidden" name="redirect" value="{{ url()->previous() }}">

            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('title') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{  $event->event_name }}" name="event_name"
                           required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('venue') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ $event->location }}" name="location" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('description')  </label>
                <div class="col-lg-8">
                    <textarea class="form-control ta" name="description">{{  $event->description }}</textarea>
                </div>
            </div>


            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('start_date') @required</label>
                <div class="col-lg-8">

                    <div class="input-group date">
                        <input type="text" class="form-control datetimepicker-input"
                               value="{{  timePickerFormat($event->start_date) }}" name="start_date"
                               data-date-format="DD-MM-YYYY hh:mm A" data-date-start-date="0d" required>
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
                               value="{{  timePickerFormat($event->end_date) }}" name="end_date"
                               data-date-format="DD-MM-YYYY hh:mm A" data-date-start-date="0d" required>
                        <div class="input-group-addon">
                           @icon('solid/calendar-alt', 'text-muted')
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('calendar')</label>
                <div class="col-lg-8">
                    <select class="form-control" name="calendar_id">
                        @foreach (Modules\Calendar\Entities\CalendarType::get() as $calendar)
                        <option value="{{  $calendar->id  }}" {{ $calendar->id != $event->calendar_id ?? 'selected="selected"'  }}>{{  $calendar->name  }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @can('projects_view_all')
            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('project')  </label>
                <div class="col-lg-8">
                    <select class="select2-option form-control" name="project_id">
                            <option value="0">@langapp('none') </option>
                            @foreach (Modules\Projects\Entities\Project::select('id', 'name')->get() as $project) 
                                <option value="{{  $project->id  }}" {{  $project->id === $event->project_id ? 'selected' : '' }}>{{ $project->name }}</option>
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
                            <option value="{{  $user->id  }}" {{  is_array($event->attendees) ? (in_array($user->id, $event->attendees)) ? 'selected' : '' : '' }}>
                                {{ $user->name  }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('event_color') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control color-selector" value="{{ $event->color }}" name="color" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"></label>
                <div class="col-lg-8">
                        <label>
                            <input type="hidden" name="is_private" value="0">
                            <input type="checkbox" value="1" name="is_private" {{  $event->is_private ? 'checked' : '' }}> 
                            <span class="label-text">@langapp('hidden_from_users')</span>
                        </label>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('alert')  </label>
                <div class="col-lg-8">
                    <select name="alert" class="form-control">
    <option value="30" {{ $event->alert === 30 ? 'selected' : ''  }}>@langapp('30_minutes_before')</option>
    <option value="60" {{ $event->alert === 60 ? 'selected' : ''  }}>@langapp('1_hour_before')</option>
    <option value="1440" {{ $event->alert === 1440 ? 'selected' : ''  }}>@langapp('1_day_before')</option>
    <option value="10080" {{ $event->alert === 10080 ? 'selected' : ''  }}>@langapp('1_week_before')</option>
                    </select>
                </div>
            </div>

            <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="deleted" value="1">
                                        <span class="label-text text-danger">@langapp('mark_as_deleted')</span>
                                    </label>
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
        $('.datetimepicker-input').datetimepicker({showClose: true});
        $('.color-selector').colorpicker();
    </script>

@endpush



@stack('pagestyle')
@stack('pagescript')