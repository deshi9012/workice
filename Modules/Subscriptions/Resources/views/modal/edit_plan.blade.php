<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('make_changes')</h4>
        </div>
        {!! Form::open(['route' => ['plans.api.update', $plan->id], 'class' => 'bs-example form-horizontal ajaxifyForm', 'data-toggle' => 'validator', 'method' => 'PUT']) !!}
        
        <div class="modal-body">
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('name') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ $plan->name}}" name="name">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('billing_date') @required</label>
                    <div class="col-lg-8">
                        <div class="input-group date">
                        <input type="text" class="form-control datetimepicker-input"
                        value="{{ timePickerFormat($plan->billing_date) }}" name="billing_date"
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
                        <option value="{{  $client->id  }}" {{ $client->id == $plan->client_id ? 'selected' : '' }}>{{  $client->name  }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">Stripe Plan @required</label>
                <div class="col-lg-8">
                    <select name="stripe_plan_id" class="select2-option form-control">
                        @foreach ($plans->data as $p)
                        <option value="{{ $p->id }}" {{ $p->id == $plan->stripe_plan_id ? 'selected' : '' }}>{{ $p->nickname }} - {{ $p->amount / 100 }}/{{ $p->interval }} ({{ $p->currency }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
           
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('description')</label>
                <div class="col-lg-8">
                    <textarea class="form-control ta" name="description">{{ $plan->description }}</textarea>
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