<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('make_changes')   - #{{ $payment->code }}</h4>
        </div>
        {!! Form::open(['route' => ['payments.api.update', $payment->id], 'class' => 'bs-example form-horizontal ajaxifyForm', 'files' => true, 'method' => 'PUT', 'data-toggle' => 'validator']) !!}
        <input type="hidden" name="id" value="{{  $payment->id  }}">
        <input type="hidden" name="code" value="{{  $payment->code  }}">
        <input type="hidden" name="gateway" value="{{  $payment->payment_method  }}">
        <input type="hidden" name="invoice_id" value="{{  $payment->invoice_id  }}">
        <div class="modal-body">
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('amount') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{  $payment->amount  }}"
                    name="amount" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('payment_method') @required</label>
                <div class="col-lg-8">
                    <select name="payment_method" class="form-control select2-option" required>
                        @foreach (App\Entities\AcceptPayment::all() as $key => $gateway)
                        <option value="{{  $gateway->method_id  }}" {{ $payment->payment_method == $gateway->method_id ? ' selected="selected"' : '' }}>
                            {{ $gateway->method_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('refunded')  @required</label>
                <div class="col-lg-8">
                    <select name="is_refunded" class="form-control" required>
                        <option value="1" {{ $payment->is_refunded === 1 ? ' selected="selected"' : ''  }}>@langapp('yes')  </option>
                        <option value="0" {{ $payment->is_refunded === 0 ? ' selected="selected"' : ''  }}>@langapp('no')  </option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('currency') @required</label>
                <div class="col-lg-8">
                    <select name="currency" class="select2-option form-control" required>
                        @foreach (App\Entities\Currency::select('code', 'title')->get() as $cur)
                        <option value="{{  $cur->code  }}" {{ $payment->currency == $cur->code ? ' selected="selected"' : '' }}>
                            {{ $cur->title }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">{{ langapp('xrate') }}</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon">-</span>
                        <input class="form-control" type="text" value="{{ $payment->exchange_rate }}" name="exchange_rate" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('payment_date')  </label>
                <div class="col-lg-8">
                    <div class="input-group">
                        <input class="datepicker-input form-control" size="16" type="text"
                        value="{{  datePickerFormat($payment->payment_date)  }}"
                        name="payment_date"
                        data-date-format="{{  get_option('date_picker_format') }}"
                        required>
                        <label class="input-group-addon btn" for="date">
                            @icon('solid/calendar-alt')
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">@langapp('tags')  </label>
                <div class="col-md-8">
                    <select class="select2-tags form-control" name="tags[]" multiple>
                        @foreach (App\Entities\Tag::all() as $tag)
                        <option value="{{ $tag->name  }}" {{  in_array($tag->id, array_pluck($payment->tags->toArray(), 'id')) ? ' selected="selected"' : '' }}>
                            {{ $tag->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('notes')  </label>
                <div class="col-lg-8">
                    <textarea name="notes" class="form-control ta">{{ $payment->notes }}</textarea>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('receipt')  </label>
                <div class="col-lg-8">
                    <input type="file" name="uploads[]">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            {!! closeModalButton() !!}
            {!!  renderAjaxButton()  !!}
            
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
@endpush
@stack('pagestyle')
@stack('pagescript')