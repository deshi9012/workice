<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('create') @langapp('subscriptions')</h4>
        </div>
        {!! Form::open(['route' => 'plans.api.save', 'class' => 'bs-example form-horizontal ajaxifyForm', 'data-toggle' => 'validator']) !!}
        
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <div class="modal-body">
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('name') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ get_option('default_subscription') }}" name="name">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('billing_date') @required</label>
                    <div class="col-lg-8">
                        <div class="input-group date">
                        <input type="text" class="form-control datetimepicker-input"
                        value="{{ timePickerFormat(now()->addMinutes(5)) }}" name="billing_date"
                        data-date-format="DD-MM-YYYY hh:mm A" data-date-start-date="moment()" required>
                        <div class="input-group-addon">
                            @icon('solid/calendar-alt', 'text-muted')
                        </div>
                    </div>
                    </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('client') @required</label>
                <div class="col-lg-8">
                    <select name="client_id" class="select2-option form-control">
                        @foreach (Modules\Clients\Entities\Client::select('id', 'name')->get() as $key => $client)
                        <option value="{{  $client->id  }}">{{  $client->name  }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">Stripe Plan @required</label>
                <div class="col-lg-8">
                    <select name="stripe_plan_id" class="select2-option form-control">
                        @foreach ($plans->data as $plan)
                        <option value="{{ $plan->id }}">{{ $plan->nickname }} - {{ $plan->amount / 100 }}/{{ $plan->interval }} ({{ $plan->currency }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
           
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('description')</label>
                <div class="col-lg-8">
                    <textarea class="form-control ta" name="description"></textarea>
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