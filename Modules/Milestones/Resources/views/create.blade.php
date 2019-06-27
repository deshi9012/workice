<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/plus') @langapp('create')  </h4>
        </div>
        {!! Form::open(['route' => 'milestones.save', 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}
        
        <input type="hidden" name="project_id" value="{{  $project->id  }}">
        <div class="modal-body">

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('milestone_name') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="@langapp('milestone_name')  "
                           name="milestone_name" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('description')</label>
                <div class="col-lg-8">
                        <textarea name="description" class="form-control ta"
                                  placeholder="@langapp('description')"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('start_date')   </label>
                <div class="col-lg-8">
                    <div class="input-group">
                        <input class="datepicker-input form-control" size="16" type="text"
                               value="{{ datePickerFormat(now()) }}"
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
                <label class="col-lg-4 control-label">@langapp('due_date')   </label>
                <div class="col-lg-8">

                    <div class="input-group">
                        <input class="datepicker-input form-control" size="16" type="text"
                               value="{{ datePickerFormat(now()->addDays(30))  }}"
                               name="due_date"
                               data-date-format="{{ get_option('date_picker_format')  }}"
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
    </div>

    
</div>

@push('pagestyle')
@include('stacks.css.datepicker')
@endpush

@push('pagescript')
@include('stacks.js.datepicker')
@endpush

@stack('pagestyle')
@stack('pagescript')
@include('partial.ajaxify')
