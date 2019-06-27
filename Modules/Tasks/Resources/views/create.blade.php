<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('create')  </h4>
        </div>

        {!! Form::open(['route' => 'tasks.api.save', 'class' => 'ajaxifyForm bs-example form-horizontal']) !!}
        
        <input type="hidden" name="project_id" value="{{ $project->id }}">
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <input type="hidden" name="team[]" value="{{ Auth::id() }}">
        <div class="modal-body">

            <div class="form-group">
                <label class="col-md-4 control-label">@langapp('task_name')  @required</label>
                <div class="col-md-8">
                    <input id="hidden-task-name" type="hidden" name="name">
                    <input id="auto-task-name" type="text" class="typeahead form-control" placeholder="Task Name"
                           name="name">
                </div>
            </div>

            @if ($project->isTeam() || can('milestones_create'))
                <div class="form-group">
                    <label class="col-lg-4 control-label">@langapp('milestone')  </label>
                    <div class="col-lg-8">
                        <select name="milestone_id" class="form-control">
                            <option value="0">@langapp('none')  </option>
                            @foreach ($project->milestones as $m)
                                <option value="{{  $m->id  }}" {{ isset($milestone_id) ? $m->id == $milestone_id ? 'selected="selected"' : '' : '' }}>
                                    {{  $m->milestone_name  }}
                                </option>
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
                            <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            @endif

            @can('users_assign')
                <div class="form-group">
                    <label class="col-lg-4 control-label">@langapp('team_members') @required</label>
                    <div class="col-lg-8">
                        <select class="select2-option form-control" name="team[]" multiple required>
                        @foreach ($project->assignees as $member)
                            <option value="{{ $member->user_id }}" {!! $member->user_id === Auth::id() ? 'selected' : '' !!}>{{ $member->user->name }}</option>
                        @endforeach
                        @if (optional($project->company)->primary_contact > 0)
                            <option value="{{ $project->company->primary_contact }}">{{ $project->company->contact->name }}</option>
                        @endif

                        </select>
                    </div>
                </div>

            @endcan

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('description') </label>
                <div class="col-lg-8">
                        <textarea id="auto-description" name="description" class="form-control ta"
                                  placeholder="@langapp('description') "></textarea>
                </div>
            </div>

            @if ($project->isTeam() || can('tasks_update'))
                <div class="form-group">
                    <label class="col-lg-4 control-label">@langapp('progress') @required</label>
                    <div class="col-lg-8">
                        <div id="progress-slider"></div>
                        <input id="progress" type="hidden" value="0" name="progress"/>
                    </div>
                </div>
            @endif

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('start_date')  </label>
                <div class="col-lg-8">

                    <div class="input-group">
                        <input class="datepicker-input form-control" size="16" type="text"
                               value="{{ datePickerFormat(now()) }}"
                               name="start_date"
                               data-date-format="{{ get_option('date_picker_format') }}"
                               required>
                        <label class="input-group-addon btn" for="date">
                            @icon('solid/calendar-alt', 'text-muted')
                        </label>
                    </div>

                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('due_date')  </label>
                <div class="col-lg-8">

                    <div class="input-group">
                        <input class="datepicker-input form-control" size="16" type="text"
                               value="{{ datePickerFormat(now()->addDays(7)) }}"
                               name="due_date" data-date-format="{{ config_item('date_picker_format') }}" data-date-start-date="moment()" required>
                        <label class="input-group-addon btn" for="date">
                            @icon('solid/calendar-alt', 'text-muted')
                        </label>
                    </div>

                </div>
            </div>

             @if (isAdmin() || $project->isTeam())

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('hourly_rate')</label>
                <div class="col-lg-8">
                    <input id="auto-hourly_rate" type="text" class="form-control money" value="{{ $project->hourly_rate }}" name="hourly_rate">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('estimated_hours')</label>
                <div class="col-lg-8">
                    <input id="auto-estimate" type="text" class="form-control money" value="0.00" name="estimated_hours">
                </div>
            </div>

            @endif

            

            <div class="form-group">
                                        <label class="col-md-4 control-label">@langapp('recur_frequency')</label>
                                        <div class="col-md-8">
                                            <select name="recurring[frequency]" class="form-control" id="frequency">
                                                <option value="none" selected>@langapp('none')  </option>
                                                <option value="1">@langapp('daily')</option>
                                                <option value="7">@langapp('week')</option>
                                                <option value="30">@langapp('month')</option>
                                                <option value="90">@langapp('quarter')</option>
                                                <option value="180">@langapp('six_months')</option>
                                                <option value="365">@langapp('year')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="recurring" class="display-none">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">@langapp('start_date')</label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input class="datepicker-input form-control" size="16" type="text"
                                                    value="{{  datePickerFormat(today()) }}"
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
                                                    value="{{  datePickerFormat(today()->addDays(180)) }}"
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

            <input type="hidden" name="visible" value="0">

            @if ($project->isTeam() || can('tasks_update'))
                    <div class="form-group">
                        <label class="col-lg-4 control-label"></label>
                        <div class="col-lg-8">
                                <label>
                                    <input type="checkbox" name="visible" value="1" checked>
                                    <span class="label-text">@langapp('visible_to_client')</span>
                                </label>

                        </div>

                    </div>



            <div class="form-group">
                                        <label class="col-lg-4 control-label">@langapp('tags')  </label>
                        <div class="col-lg-8">

                                        <select class="select2-tags form-control" name="tags[]" multiple>
                                            @foreach (App\Entities\Tag::all() as $tag)
                            <option value="{{  $tag->name  }}">{{  ucfirst($tag->name)  }}</option>
                                            @endforeach
                                        </select>
                                        </div>

            </div>
            @endif


        </div>
        <div class="modal-footer">
            
            {!! closeModalButton() !!}

            {!!  renderAjaxButton()  !!}
        </div>

        {!! Form::close() !!}

    </div>
</div>


@push('pagestyle')
<link href="{{ getAsset('plugins/typeahead/typeahead.css') }}" rel="stylesheet" type="text/css">
    @include('stacks.css.datepicker')
    @include('stacks.css.nouislider')
    @include('stacks.css.form')
@endpush 

@push('pagescript')
<script src="{{ getAsset('plugins/typeahead/typeahead.jquery.min.js') }}"></script>
@include('stacks.js.datepicker')
@include('stacks.js.form')
@include('stacks.js.nouislider')
    <script type="text/javascript">

    var substringMatcher = function (strs) {
        return function findMatches(q, cb) {
            var substrRegex;
            var matches = [];
            substrRegex = new RegExp(q, 'i');
            $.each(strs, function (i, str) {
                if (substrRegex.test(str)) {
                    matches.push(str);
                }
            });
            cb(matches);
        };
    };

    $('#auto-task-name').on('keyup', function () {
        $('#hidden-task-name').val($(this).val());
    });

    axios.post('{{ route('tasks.autotasks') }}', {
                "_token": '{{ csrf_token() }}'
            })
          .then(function (response) {
                        
            $('.typeahead').typeahead({
                    hint: true,
                    highlight: true,
                    minLength: 2
                },
                {
                    name: "task_name",
                    limit: 10,
                    source: substringMatcher(response.data)
                });
    $('.typeahead').bind('typeahead:select', function (ev, suggestion) {

    axios.post('{{ route('tasks.autotask') }}', {
                "name": suggestion
            })
          .then(function (response) {
                        $('#hidden-task-name').val(response.data.task_name);
                        $('#auto-description').val(response.data.description);
                        $('#auto-estimate').val(response.data.estimated_hours);
                        $('#auto-hourly_rate').val(response.data.hourly_rate);
          })
          .catch(function (error) {
            toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
});


                
            });
          })
          .catch(function (error) {
            toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
});

$('.money').maskMoney({allowZero: true, thousands: '', allowNegative: true});
   $('#frequency').change(function () {
        if ($("#frequency").val() === "none") {
            $("#recurring").hide();
        } else {
            $("#recurring").show();
        }
    }).change();
</script>
@include('partial.ajaxify')

@endpush

@stack('pagestyle')
@stack('pagescript')

