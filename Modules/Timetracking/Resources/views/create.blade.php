<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('time_entry')  </h4>
        </div>
        {!! Form::open(['route' => 'timers.api.save', 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}
        
        <input type="hidden" name="module" value="{{ $module }}">
        <input type="hidden" name="module_id" value="{{  $id  }}">
        <input type="hidden" name="billable" value="0">
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <input type="hidden" name="url" value="{{ url()->previous() }}">
        <div class="modal-body">
            @if($module === 'projects')
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('task')</label>
                <div class="col-lg-8">
                    <select name="task_id" class="form-control select2-option">
                        <option value="">None</option>
                        @foreach (classByName($module)->find($id)->tasks as $key => $task)
                        <option value="{{  $task->id  }}">{{  $task->name  }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endif
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('total_time')  </label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="5:30:00" name="total">
                    <span class="help-block text-dark small"><strong>HH:MM:SS</strong> e.g 4:10:15 (4hrs, 10minutes and 15seconds)</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label"></label>
                <div class="col-lg-8">
                    <div class="form-check text-muted m-t-xs">
                        <label>
                            <input type="checkbox" name="use_dates" id="use_dates" value="1">
                            <span class="label-text">@langapp('use_start_end_dates')</span>
                        </label>
                    </div>
                </div>
            </div>
            
            <div id="start_end" class="display-none">
                <div class="form-group">
                    <label class="col-md-4 control-label">@langapp('start_date')</label>
                    <div class="col-md-8">
                        <div class="input-group date">
                            <input type="text" class="form-control datetimepicker-input"
                            value="{{  timePickerFormat(now()->addMinutes(10)) }}" name="start"
                            data-date-format="DD-MM-YYYY hh:mm A" data-date-start-date="0d" required>
                            <div class="input-group-addon">
                                @icon('solid/calendar-alt', 'text-muted')
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">@langapp('end_date')</label>
                    <div class="col-md-8">
                        <div class="input-group date">
                            <input type="text" class="form-control datetimepicker-input"
                            value="{{  timePickerFormat(now()->addMinutes(30)) }}" name="end"
                            data-date-format="DD-MM-YYYY hh:mm A" data-date-start-date="0d" required>
                            <div class="input-group-addon">
                                @icon('solid/calendar-alt', 'text-muted')
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('notes')  </label>
                <div class="col-lg-8">
                    <textarea name="notes" class="form-control ta"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4"></label>
                <div class="col-lg-8">
                    <label>
                        <input type="checkbox" name="billable" value="1" checked>
                        <span class="label-text">@langapp('billable')</span>
                    </label>
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
@include('stacks.css.form')
@include('stacks.css.datepicker')
@endpush
@push('pagescript')
@include('stacks.js.form')
@include('partial.ajaxify')
@include('stacks.js.datepicker')
<script>
    $('.datetimepicker-input').datetimepicker({showClose: true, showClear: true, minDate: moment().add(-1, 'days') });
$('#use_dates').change(function() {
if($(this).is(":checked")) {
$("#start_end").show("fast");
$(this).attr("checked");
}else{
$("#start_end").hide("fast");
}
}).change();
</script>
@endpush
@stack('pagestyle')
@stack('pagescript')