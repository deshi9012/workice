<div class="modal-dialog" id="eventModal">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('set_reminder')  </h4>
        </div>
        {!! Form::open(['route' => 'reminders.api.save', 'class' => 'bs-example ajaxifyForm', 'data-toggle' => 'validator']) !!}
        
        <div class="modal-body">
            <input type="hidden" name="module" value="{{  $module  }}">
            <input type="hidden" name="module_id" value="{{  $module_id  }}">
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="send_email" value="0">
            <input type="hidden" name="url" value="{{ url()->previous() }}">

            <div class="form-group">
                <label class="">@langapp('reminder_date') @required</label>
                    <div class="input-group date">
                        <input type="text" class="form-control datetimepicker-input"
                        value="{{ timePickerFormat(now()->addHours(2)) }}" name="reminder_date"
                        data-date-format="DD-MM-YYYY hh:mm A" data-date-start-date="moment()" required>
                        <div class="input-group-addon">
                            @icon('solid/calendar-alt', 'text-muted')
                        </div>
                    </div>
            </div>

             <div class="form-group">
                <label class="">@langapp('recipient') @required </label>
                    <select class="form-control select2-option" name="recipient_id">
                        @foreach (app('user')->select('id','username', 'name')->get() as $user)
                        <option value="{{  $user->id  }}" {{ Auth::id() === $user->id ? 'selected="selected"' : '' }}>{{  $user->name  }}</option>
                        @endforeach
                    </select>
            </div>
            
            <div class="form-group">
                <label class="">@langapp('description')</label>
                    <textarea class="form-control markdownEditor" name="description" placeholder="Type here.."></textarea>
                
            </div>

            <div class="form-group">
                                    <label>
                                        <input type="checkbox" name="send_email" checked value="1">
                                        <span class="label-text">@langapp('send_email_for_reminder')</span>
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
@endpush
@push('pagescript')
    @include('stacks.js.datepicker')
    @include('stacks.js.form')
    @include('stacks.js.markdown')
    @include('partial.ajaxify')
<script type="text/javascript">
    $('.datetimepicker-input').datetimepicker({showClose: true, showClear: true, minDate: moment().add(-1, 'days') });
</script>
@endpush
@stack('pagestyle')
@stack('pagescript')