<div class="modal-dialog" id="eventModal">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('log_call')  </h4>
        </div>
        {!! Form::open(['route' => 'calls.api.save', 'class' => 'bs-example ajaxifyForm', 'data-toggle' => 'validator']) !!}
        
        <div class="modal-body">
            <input type="hidden" name="module" value="{{ $module }}">
            <input type="hidden" name="module_id" value="{{ $id }}">
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="url" value="{{ url()->previous() }}">
            <div class="form-group">
                <label class="control-label">@langapp('subject') @required</label>
                <input type="text" class="form-control" name="subject" placeholder="Project Demo" required>
            </div>
            <div class="form-group">
                <label class="">@langapp('call_type') @required </label>
                <select class="form-control" name="type">
                    <option value="outbound">@langapp('outbound')</option>
                    <option value="inbound">@langapp('inbound')</option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label">@langapp('duration') <strong>(Format h:m:s i.e 00:35:20 means 35 Minutes and 20 Sec)</strong></label>
                <input type="text" class="form-control" name="duration" placeholder="00:35:20">
            </div>
            <div class="form-group">
                <label class="">@langapp('assigned') @required </label>
                <select class="form-control select2-option" name="assignee">
                    @foreach (app('user')->select('id','username','name')->get() as $user)
                    <option value="{{  $user->id  }}" {{ Auth::id() === $user->id ? 'selected' : '' }}>{{  $user->name  }}</option>
                    @endforeach
                </select>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" class="sendLater" id="sendLater" name="scheduled" value="1">
                    <span class="label-text">Schedule call</span>
                </label>
            </div>
            <div id="queueLater" class="display-none">
                <div class="form-group">
                    <label>{{  langapp('schedule') }}</label>
                    <div class="input-group date">
                        <input type="text" class="form-control datetimepicker-input"
                        value="{{  timePickerFormat(now()->addMinutes(15)) }}" name="scheduled_date"
                        data-date-format="DD-MM-YYYY hh:mm A" data-date-start-date="0d">
                        <div class="input-group-addon">
                            @icon('solid/calendar-alt', 'text-muted')
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">@langapp('reminder') (Minutes before)</label>
                    <input type="text" class="form-control" name="reminder" value="5">
                </div>
            </div>
            
            <div class="form-group">
                <label class="">@langapp('description')</label>
                <textarea class="form-control ta" name="description" placeholder="Type here.."></textarea>
                
            </div>
            <div class="form-group">
                <label class="">@langapp('call_result')</label>
                <textarea class="form-control markdownEditor" name="result" placeholder="Approval of the Invoice"></textarea>
                
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
@endpush
@push('pagescript')
@include('stacks.js.datepicker')
@include('stacks.js.form')
@include('stacks.js.markdown')
@include('partial.ajaxify')
<script type="text/javascript">
$('.datetimepicker-input').datetimepicker({showClose: true, showClear: true, minDate: moment().add(-1, 'days') });
$('.checkbox input[type="checkbox"]').change(function () {
    if($("#sendLater").is(':checked')){
        $("#queueLater").show("fast");
    }else{
        $("#queueLater").hide("fast");
    }
}).change();
</script>
@endpush
@stack('pagestyle')
@stack('pagescript')