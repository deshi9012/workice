<div class="modal-dialog" id="eventModal">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Schedule system update</h4>
        </div>
        {!! Form::open(['route' => 'updates.process', 'class' => 'bs-example form-horizontal ajaxifyForm', 'data-toggle' => 'validator']) !!}
        
        <div class="modal-body">

        <div class="alert alert-warning small">
            <ul>
                <li>Ensure you have saved your purchase code in Settings > System Settings otherwise update will fail.</li>
                <li>During update installation your application will be set to maintainance mode.</li>
                <li>Read more on file and folder permissions <a href="https://docs.workice.com" target="_blank">https://docs.workice.com</a></li>
            </ul>
        </div>


            <div class="form-group">
                <div class="col-md-3 control-label">
                <label class="">Start Time @required</label>
                </div>
                <div class="col-md-9">
                    <div class="input-group date">
                        <input type="text" class="form-control datetimepicker-input"
                        value="{{ timePickerFormat(now()->addHours(2)) }}" name="start_time"
                        data-date-format="DD-MM-YYYY hh:mm A" data-date-start-date="moment()" required>
                        <div class="input-group-addon">
                            @icon('solid/calendar-alt', 'text-muted')
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                    <label class="col-lg-3 control-label">@langapp('timezone')  </label>
                    <div class="col-lg-9">
                        <select class="form-control select2-option" name="timezone" required>
                            @foreach (timezones() as $timezone => $description)
                            <option value="{{ $timezone }}" {{ $current_timezone == $timezone ? ' selected' : '' }}>{{ $description }}</option>
                            @endforeach
                        </select>
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
    @include('partial.ajaxify')
<script type="text/javascript">
    $('.datetimepicker-input').datetimepicker({showClose: true, showClear: true, minDate: moment().add(-1, 'days') });
</script>
@endpush
@stack('pagestyle')
@stack('pagescript')