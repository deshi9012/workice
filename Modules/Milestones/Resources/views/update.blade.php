<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/pencil-alt') @langapp('make_changes')  </h4>
        </div>
        
        @if (can('milestones_update') || $project->isTeam()) 

        {!! Form::open(['route' => ['milestones.update', $milestone->id], 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}

        <input type="hidden" name="project_id" value="{{  $milestone->project_id  }}">
        <input type="hidden" name="id" value="{{  $milestone->id  }}">
        <div class="modal-body">

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('milestone_name') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ $milestone->milestone_name }}"
                           name="milestone_name">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('description')   </label>
                <div class="col-lg-8">
                    <textarea name="description" class="form-control ta">{{ $milestone->description }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('start_date')  </label>
                <div class="col-lg-8">

                    <div class="input-group">
                        <input class="datepicker-input form-control" size="16" type="text"
                               value="{{ datePickerFormat($milestone->start_date) }}"
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
                               value="{{  datePickerFormat($milestone->due_date) }}"
                               name="due_date"
                               data-date-format="{{ get_option('date_picker_format') }}"
                               required>
                        <label class="input-group-addon btn" for="date">
                            @icon('solid/calendar-alt', 'text-muted')
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


        @endif

        

        

    </div>
</div>

@push('pagestyle')
@include('stacks.css.datepicker')
@endpush
@push('pagescript')
@include('stacks.js.datepicker')
@include('partial.ajaxify')
@endpush

@stack('pagestyle')
@stack('pagescript')


