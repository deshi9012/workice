<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('make_changes')</h4>
        </div>
        {!! Form::open(['route' => ['tasks.api.update', $task->id], 'class' => 'ajaxifyForm bs-example form-horizontal', 'method' => 'PUT']) !!}
        <div class="modal-body">
            <input type="hidden" name="id" value="{{  $task->id  }}">
            <input type="hidden" name="project_id" value="{{  $task->project_id  }}">
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('task_name') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{  $task->name  }}" name="name">
                </div>
            </div>
            @if ($task->AsProject->isTeam() || can('milestones_create'))
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('milestone')</label>
                <div class="col-lg-8">
                    <select name="milestone_id" class="form-control">
                        <option value="0">@langapp('none') </option>
                        @foreach ($task->AsProject->milestones as $m)
                        <option value="{{  $m->id  }}"{{  $task->milestone_id === $m->id ? ' selected="selected"' : ''  }}>{{  $m->milestone_name  }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                    <label class="col-lg-4 control-label">@langapp('stage')</label>
                    <div class="col-lg-8">
                        <select name="stage_id" class="form-control">
                            <option value="">---None---</option>
                            @foreach (App\Entities\Category::select('id', 'name')->tasks()->get() as $key => $stage)
                            <option value="{{ $stage->id }}" {{ $stage->id == $task->stage_id ? 'selected' : '' }}>{{ $stage->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            @endif
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('description') @required</label>
                <div class="col-lg-8">
                    <textarea name="description" class="form-control ta">{{  $task->description  }}</textarea>
                </div>
            </div>
            @if ($task->AsProject->isTeam() || can('tasks_update'))
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('progress') @required</label>
                <div class="col-lg-8">
                    <div id="progress-slider"></div>
                    <input id="progress" type="hidden" value="{{  $task->progress  }}" name="progress"/>
                </div>
            </div>
            @endif
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('start_date')</label>
                <div class="col-lg-8">
                    <div class="input-group">
                        <input class="datepicker-input form-control" size="16" type="text"
                        value="{{  datePickerFormat($task->start_date)  }}"
                        name="start_date"
                        data-date-format="{{ get_option('date_picker_format')  }}"
                        required>
                        <label class="input-group-addon btn" for="date">
                            @icon('solid/calendar-alt', 'text-muted')
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('due_date')</label>
                <div class="col-lg-8">
                    <div class="input-group">
                        <input class="datepicker-input form-control" size="16" type="text"
                        value="{{ datePickerFormat($task->due_date) }}"
                        name="due_date" data-date-format="{{ get_option('date_picker_format') }}" data-date-start-date="moment()" required>
                        <label class="input-group-addon btn" for="date">
                            @icon('solid/calendar-alt', 'text-muted')
                        </label>
                    </div>
                </div>
            </div>
            @if (isAdmin() || $task->AsProject->isTeam())
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('hourly_rate')</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control money" value="{{ $task->hourly_rate }}" name="hourly_rate">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('estimated_hours')</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control money" value="{{ $task->estimated_hours }}" name="estimated_hours">
                </div>
            </div>
            @endif
            @can('users_assign')
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('assigned') @required</label>
                <div class="col-lg-8">
                    <select class="select2-option form-control" multiple="multiple" name="team[]" required>
                        @foreach ($task->AsProject->assignees as $member)
                        <option value="{{  $member->user_id  }}" {{ $task->isTeam($member->user_id) ? 'selected' : '' }}>
                            {{  $member->user->name  }}
                        </option>
                        @endforeach
                        @if (optional($task->AsProject->company)->primary_contact > 0)
                            <option value="{{ $task->AsProject->company->primary_contact }}" {{ $task->isTeam($task->AsProject->company->primary_contact) ? 'selected' : ''}}>
                                {{ $task->AsProject->company->contact->name }}
                            </option>
                        @endif
                    </select>
                </div>
            </div>
            @endcan


            <div class="form-group">
                                        <label class="col-md-4 control-label">@langapp('recur_frequency')</label>
                                        <div class="col-md-8">
                                            <select name="recurring[frequency]" class="form-control" id="frequency">
                                                <option value="none" {{ $task->is_recurring ? 'selected' : '' }}>@langapp('none')  </option>
                                                <option value="1"{{ $task->is_recurring && $task->recurring->frequency == '1' ? ' selected' : ''  }}>@langapp('daily')</option>
                                                <option value="7"{{ $task->is_recurring && $task->recurring->frequency == '7' ? ' selected' : ''  }}>@langapp('week')</option>
                                                <option value="30"{{ $task->is_recurring && $task->recurring->frequency == '30' ? ' selected' : ''  }}>@langapp('month')</option>
                                                <option value="90"{{ $task->is_recurring && $task->recurring->frequency == '90' ? ' selected' : ''  }}>@langapp('quarter')</option>
                                                <option value="180"{{ $task->is_recurring && $task->recurring->frequency == '180' ? ' selected' : ''  }}>@langapp('six_months')</option>
                                                <option value="365"{{ $task->is_recurring && $task->recurring->frequency == '365' ? ' selected' : ''  }}>@langapp('year')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="recurring" class="{{ !$task->is_recurring ? 'display-none' : '' }}">
                                        @php
                                        $recurStarts = $task->is_recurring ? $task->recurring->recur_starts : today()->toDateString();
                                        $recurEnds = $task->is_recurring ? $task->recurring->recur_ends : today()->addYears(1)->toDateString();
                                        @endphp
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">@langapp('start_date')</label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input class="datepicker-input form-control" size="16" type="text"
                                                    value="{{  datePickerFormat($recurStarts) }}"
                                                    name="recurring[recur_starts]"
                                                    data-date-format="{{ get_option('date_picker_format')  }}"
                                                    required>
                                                    <label class="input-group-addon btn" for="date">
                                                        @icon('solid/calendar-alt', 'text-muted')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">@langapp('end_date')</label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input class="datepicker-input form-control" size="16" type="text"
                                                    value="{{  datePickerFormat($recurEnds) }}"
                                                    name="recurring[recur_ends]"
                                                    data-date-format="{{ get_option('date_picker_format')  }}"
                                                    required>
                                                    <label class="input-group-addon btn" for="date">
                                                        @icon('solid/calendar-alt', 'text-muted')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

            @if ($task->AsProject->isTeam() || can('tasks_update'))
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('visible_to_client') </label>
                <div class="col-lg-8">
                    <select name="visible" class="form-control">
                        <option value="1" {{ $task->visible === 1 ? ' selected' : '' }}>@langapp('yes')</option>
                        <option value="0" {{ $task->visible === 0 ? ' selected' : '' }}>@langapp('no')</option>
                    </select>
                </div>
            </div>
            @endif
            @can('tasks_update')
            <div class="form-group">
                
                <label class="col-lg-4 control-label">@langapp('tags')  </label>
                <div class="col-lg-8">
                    <select class="select2-tags form-control" name="tags[]" multiple>
                        @foreach (App\Entities\Tag::all() as $tag)
                        <option value="{{ $tag->name  }}" {{ in_array($tag->id, array_pluck($task->tags->toArray(), 'id')) ? ' selected="selected"' : '' }}>
                            {{ $tag->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            @endcan
        </div>
        <div class="modal-footer">
            {!! closeModalButton() !!}
            {!! renderAjaxButton('edit') !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
@push('pagestyle')
    @include('stacks.css.nouislider')
    @include('stacks.css.datepicker')
    @include('stacks.css.form')
@endpush
@push('pagescript')
    @include('stacks.js.nouislider')
    @include('stacks.js.datepicker')
    @include('stacks.js.form')
    @include('partial.ajaxify')
    <script>
    $('.money').maskMoney({allowZero: true, thousands: '', allowNegative: true});
    $('#frequency').change(function () {
        if ($("#frequency").val() === "none") {
            $("#recurring").hide();
        } else {
            $("#recurring").show();
        }
    });
    </script>
@endpush
@stack('pagestyle')
@stack('pagescript')