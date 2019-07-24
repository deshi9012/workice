<div class="modal-dialog" id="eventModal">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('appointments') </h4>
        </div>
        {!! Form::open(['route' => 'appointments.api.save', 'class' => 'bs-example form-horizontal ajaxifyForm', 'data-toggle' => 'validator']) !!}
        
        <div class="modal-body">
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="url" value="{{ url()->previous() }}">
            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('name') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="@langapp('name')" name="name" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('venue') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="@langapp('venue')" name="venue" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('user')</label>
                <div class="col-lg-8">
                    <select class="select2-option form-control" name="attendee_id">
                        @foreach (Modules\Users\Entities\User::select('id', 'username', 'name')->get() as $user)
                        <option value="{{ $user->id }}" {{ $user->id === Auth::id() ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('lead')</label>
                <div class="col-lg-8">
                    <select class="select2-option form-control" name="lead_id">
                        <option value="0">---None---</option>
                        @foreach (Modules\Leads\Entities\Lead::select('id', 'name')->whereNull('archived_at')->get() as $lead)
                        <option value="{{  $lead->id  }}" {{$lead->id == $lead_id ? 'selected' : '' }}>{{  $lead->name }}</option>

                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('start_date') @required</label>
                <div class="col-lg-8">
                    <div class="input-group date">
                        <input type="text" class="form-control datetimepicker-input"
                        value="{{  timePickerFormat(now()->addMinutes(10)) }}" name="start_time"
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
                        value="{{  timePickerFormat(now()->addHours(2)) }}" name="finish_time"
                        data-date-format="DD-MM-YYYY hh:mm A" data-date-start-date="moment()" required>
                        <div class="input-group-addon">
                            @icon('solid/calendar-alt', 'text-muted')
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('comments')  </label>
                <div class="col-lg-8">
                    <textarea class="form-control ta" name="comments" placeholder="Type here.."></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('alert')  </label>
                <div class="col-lg-8">
                    <select name="alert" class="form-control">
                        <option value="30">30 Minutes before</option>
                        <option value="60">1 Hour before</option>
                        <option value="1440" selected>1 Day before</option>
                        <option value="10080">1 Week before</option>
                    </select>
                </div>
            </div>

            <input type="hidden" name="timezone" value="{{ get_option('timezone') }}">
            
            

            
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
    @include('partial.ajaxify')
<script type="text/javascript">
    $('.datetimepicker-input').datetimepicker({showClose: true, showClear: true, minDate: moment().add(-1, 'days') });
</script>
@endpush
@stack('pagestyle')
@stack('pagescript')