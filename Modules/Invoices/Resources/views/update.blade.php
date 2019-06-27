@extends('layouts.app')
@section('content')
<section id="content">
    <section class="hbox stretch">
        <aside>
            <section class="vbox">
                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-8 m-b-xs">
                            <a href="{{ route('invoices.view', ['id' => $invoice->id])  }}" class="btn btn-sm btn-{{ get_option('theme_color') }}" data-rel="tooltip" title="Back to Invoice" data-placement="bottom" >
                                @icon('solid/file-invoice-dollar') @langapp('invoice')
                            </a>
                            
                        </div>
                        <div class="col-sm-4 m-b-xs">
                        </div>
                    </div>
                </header>
                <section class="scrollable wrapper bg">
                    <div class="row">
                        {!! Form::open(['route' => ['invoices.api.update', $invoice->id], 'class' => 'bs-example ajaxifyForm validator', 'method' => 'PUT']) !!}
                        
                        <div class="col-md-6 form-horizontal">
                            <section class="panel panel-default">
                                <header class="panel-heading">@icon('solid/pencil-alt') @langapp('make_changes')
                                    #{{ $invoice->reference_no  }}
                                </header>
                                <div class="panel-body">
                                    <input type="hidden" name="id" value="{{ $invoice->id  }}">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">@langapp('reference_no') @required</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" value="{{ $invoice->reference_no  }}" name="reference_no" readonly required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                    <label class="col-md-4 control-label">@langapp('title')</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="title" value="{{ $invoice->title }}" class="input-sm form-control">
                                    </div>
                                </div>

                                    
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">@langapp('recur_frequency')</label>
                                        <div class="col-md-8">
                                            <select name="recurring[frequency]" class="form-control" id="frequency">
                                                <option value="none" {{ $invoice->is_recurring ? 'selected' : '' }}>@langapp('none')  </option>
                                                <option value="7"{{ $invoice->is_recurring && $invoice->recurring->frequency == '7' ? ' selected' : ''  }}>@langapp('week')</option>
                                                <option value="30"{{ $invoice->is_recurring && $invoice->recurring->frequency == '30' ? ' selected' : ''  }}>@langapp('month')</option>
                                                <option value="90"{{ $invoice->is_recurring && $invoice->recurring->frequency == '90' ? ' selected' : ''  }}>@langapp('quarter')</option>
                                                <option value="180"{{ $invoice->is_recurring && $invoice->recurring->frequency == '180' ? ' selected' : ''  }}>@langapp('six_months')</option>
                                                <option value="365"{{ $invoice->is_recurring && $invoice->recurring->frequency == '365' ? ' selected' : ''  }}>@langapp('year')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="recurring" class="{{ !$invoice->is_recurring ? 'display-none' : '' }}">
                                        @php
                                        $recurStarts = $invoice->is_recurring ? $invoice->recurring->recur_starts : today()->toDateString();
                                        $recurEnds = $invoice->is_recurring ? $invoice->recurring->recur_ends : today()->addYears(1)->toDateString();
                                        @endphp
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">@langapp('start_date')</label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input class="datepicker-input form-control" size="16" type="text"
                                                    value="{{  datePickerFormat($recurStarts) }}"
                                                    name="recurring[recur_starts]"
                                                    data-date-format="{{ get_option('date_picker_format')  }}"
                                                    required>
                                                    <label class="input-group-addon btn" for="date">
                                                        @icon('solid/calendar-alt', 'text-muted')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">@langapp('end_date')</label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input class="datepicker-input form-control" size="16" type="text"
                                                    value="{{  datePickerFormat($recurEnds) }}"
                                                    name="recurring[recur_ends]"
                                                    data-date-format="{{ get_option('date_picker_format')  }}"
                                                    required>
                                                    <label class="input-group-addon btn" for="date">
                                                        @icon('solid/calendar-alt', 'text-muted')
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">@langapp('client') </label>
                                        <div class="col-md-8">
                                            <select class="select2-option width100" name="client_id">
                                                
                                                @foreach (Modules\Clients\Entities\Client::select('id', 'name')->get() as $client)
                                                <option value="{{ $client->id  }}" {{ ($client->id === $invoice->client_id) ? 'selected' : ''  }}>
                                                {{ $client->name  }}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">@langapp('date_saved')</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <input class="datepicker-input form-control" size="16" type="text"
                                                value="{{  datePickerFormat($invoice->created_at) }}"
                                                name="created_at"
                                                data-date-format="{{ get_option('date_picker_format')  }}"
                                                required>
                                                <label class="input-group-addon btn" for="date">
                                                    @icon('solid/calendar-alt', 'text-muted')
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">{{ get_option('tax1Label')  }} </label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon">%</span>
                                                <input class="form-control money" type="text"
                                                value="{{ $invoice->tax }}" name="tax" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">{{ get_option('tax2Label')  }}</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon">%</span>
                                                <input class="form-control money" type="text"
                                                value="{{ $invoice->tax2 }}" name="tax2" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">@langapp('discount')   </label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon">-</span>
                                                <input class="form-control money" type="text"
                                                value="{{ $invoice->discount }}" name="discount" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">@langapp('discount_percent')  </label>
                                        <div class="col-md-8">
                                            <select name="discount_percent" width="100%" class="form-control">
                                                <option value="1" {{ $invoice->discount_percent === 1 ? 'selected' : '' }}>@langapp('percentage') </option>
                                                <option value="0" {{ $invoice->discount_percent === 0 ? 'selected' : '' }}>@langapp('amount') </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">{{ langapp('late_fee') }}</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon">-</span>
                                                <input class="form-control money" type="text" value="{{ $invoice->late_fee }}" name="late_fee"
                                                required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">{{ langapp('late_fee_percent') }}</label>
                                        <div class="col-md-8">
                                            <select name="late_fee_percent" width="100%" class="form-control">
                                                <option value="1" {!! $invoice->late_fee_percent ? 'selected' : '' !!}>@langapp('percentage')</option>
                                                <option value="0" {{ $invoice->late_fee_percent === 0 ? 'selected' : '' }}>@langapp('amount')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">@langapp('extra_fee')  </label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    {{ $invoice->fee_is_percent === 1 ? '%' : '$' }}
                                                </span>
                                                <input class="form-control money" type="text"
                                                value="{{ $invoice->extra_fee }}" name="extra_fee" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">@langapp('extra_fee_percent')  </label>
                                        <div class="col-md-8">
                                            <select name="fee_is_percent" class="form-control">
                                                <option value="1" {{ $invoice->fee_is_percent === 1 ? 'selected' : '' }}>
                                                    @langapp('percentage')
                                                </option>
                                                <option value="0" {{ $invoice->fee_is_percent === 0 ? 'selected' : '' }}>@langapp('amount')  </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">@langapp('currency')  </label>
                                        <div class="col-md-8">
                                            <select name="currency" class="select2-option width100">
                                                @foreach (App\Entities\Currency::select('title', 'code')->get() as $cur)
                                                <option value="{{ $cur->code  }}"{{ ($invoice->currency == $cur->code ? ' selected' : '')  }}>{{ $cur->title  }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">{{ langapp('xrate') }}</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <span class="input-group-addon">-</span>
                                                <input class="form-control" type="text" value="{{ $invoice->exchange_rate }}" name="exchange_rate"
                                                required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">@langapp('tags')  </label>
                                        <div class="col-md-8">
                                            <select class="select2-tags form-control" name="tags[]" multiple>
                                                @foreach (App\Entities\Tag::all() as $tag)
                                                <option value="{{ $tag->name  }}" {{ in_array($tag->id, array_pluck($invoice->tags->toArray(), 'id')) ? ' selected' : '' }}>
                                                    {{ $tag->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-6">
                            <section class="panel panel-default">
                            <header class="panel-heading">@icon('solid/info-circle') @langapp('terms')  </header>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>@langapp('payment_methods')  </label>

                                    <div class="row">
@php $counter = 0; @endphp
@foreach (explode(',', get_option('enabled_gateways')) as $gateway)
@if (!(($counter++) % 2))
</div>
                    <div class="row">
                        @endif
                        <div class="col-md-6">
                            <div class="form-check text-muted m-t-xs">
                                                <label>
                                                    <input type="checkbox" name="gateways[{{ $gateway }}]" {{  $invoice->gatewayEnabled($gateway) ? 'checked' : ''  }} {!! $gateway == 'braintree' ? 'id="use_braintree"' : '' !!} value="active">
                                                    <span class="label-text">{{ ucfirst($gateway) }}</span>
                                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>


                                    
                                </div>
                                <div id="braintree_setup" class="{{ !$invoice->gatewayEnabled('braintree') ? 'display-none' : ''  }}">
                                    <div class="form-group">
                                        <label>@langapp('braintree_merchant_account')  </label>
                                        <input type="text" class="form-control" name="gateways[braintree_merchant_account]"
                                        value="{{ isset($invoice->gateways['braintree_merchant_account']) ? $invoice->gateways['braintree_merchant_account'] : get_option('braintree_merchant_account')  }}">
                                        <span class="help-block m-b-none small text-danger">Check Braintree merchant Currency 
                                            <a href="https://articles.braintreepayments.com/control-panel/important-gateway-credentials"
                                        target="_blank">Read More</a></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>@langapp('terms')  </label>
                                    <div class="partial-labels row m-xs">
                                        <div class="amount">
                                            <label for="partial-amount"
                                            class="partial-amount">@langapp('amount')  </label>
                                        </div>
                                        <div class="due">
                                            <label for="partial-due_date"
                                            class="partial-due_date">@langapp('deadline')  </label>
                                        </div>
                                        <div class="seven columns">
                                            <label for="partial-notes"
                                            class="partial-notes">@langapp('notes')  </label>
                                        </div>
                                    </div>
                                    <div class="partial-input-container m-xs">
                                        @if (count($invoice->installments) <= 0)
                                        @php $disable = $invoice->hasPayment() ? 'disabled="disabled"' : ''; @endphp
                                        <div class="partial-inputs row height40">
                                            <div class="percent">
                                                <div class="input-group">
                                                    <span class="input-group-addon">%</span>
                                                    <input class="form-control" {{ $disable  }} type="number"
                                                    value="100" name="partial-amount[1]"
                                                    id="partial-amount" max="100">
                                                </div>
                                            </div>
                                            <div class="due">
                                                <input class="datepicker-input form-control" {{ $disable  }}
                                                size="16" type="text"
                                                value="{{ datePickerFormat($invoice->due_date) }}"
                                                name="partial-due_date[1]"
                                                data-date-format="{{get_option('date_picker_format') }}"
                                                id="partial-due_date" required>
                                            </div>
                                            <div class="notes">
                                                <input type="text" class="form-control" {{ $disable  }} value=""
                                                name="partial-notes[1]" id="partial-notes">
                                            </div>
                                            @if ($invoice->hasPayment() == 0)
                                            <div class="paid">
                                                <a href="#" data-details="1" class="btn-primary btn btn-sm partial-payment-delete">
                                                    <span class="display-inline">✗</span>
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                        @endif
                                        @foreach ($invoice->installments as $key => $partial)
                                        @php $disable = $invoice->hasPayment() ? 'disabled="disabled"' : ''; @endphp
                                        <div class="partial-inputs row height40">
                                            <div class="percent">
                                                <div class="input-group">
                                                    <span class="input-group-addon">%</span>
                                                    <input class="form-control" {{ $disable  }} type="number" value="{{ $partial->percentage  }}"
                                                    name="partial-amount[{{ $key + 1  }}]" id="partial-amount" max="100">
                                                </div>
                                            </div>
                                            <div class="due">
                                                <input class="datepicker-input form-control" {{ $disable  }}
                                                size="16" type="text"
                                                value="{{ datePickerFormat($partial->due_date) }}"
                                                name="partial-due_date[{{ $key + 1  }}]"
                                                data-date-format="{{get_option('date_picker_format') }}"
                                                id="partial-due_date"  required>
                                            </div>
                                            <div class="notes">
                                                <input type="text" class="form-control" {{ $disable  }}
                                                value="{{ $partial->notes  }}"
                                                name="partial-notes[{{ $key + 1  }}]" id="partial-notes">
                                            </div>
                                            @if ($invoice->hasPayment() == 0)
                                            <div class="paid">
                                                <a href="#" data-details="1"
                                                    class="btn-primary btn btn-sm partial-payment-delete">
                                                    <span class="display-inline">✗</span>
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                    @if ($invoice->hasPayment() == 0)
                                    <div class="partial-addmore">
                                        <div class="payment-plan-amounts row">
                                            <div class="twelve columns">
                                                <a href="#" class="btn btn-xs text-info"><span>Add another part to the payment schedule</span></a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label>@langapp('notes')   </label>
                                    <textarea name="notes" class="form-control markdownEditor">{{ strip_tags($invoice->getOriginal('notes'))  }}</textarea>
                                </div>

                @php
                    $data['fields'] = App\Entities\CustomField::invoices()->orderBy('order', 'desc')->get();
                @endphp
                @include('invoices::_includes.updateCustom', $data)

                                <div class="form-check text-muted m-t-xs">
                                                <label>
                                                    <input type="hidden" name="alert_overdue" value="0">
                                                    <input type="checkbox" name="alert_overdue" {{  $invoice->alert_overdue ? 'checked' : ''  }} value="1">
                                                    <span class="label-text" data-rel="tooltip" title="Navigate to Settings -> Invoice Settings to configure reminders">Send Invoice Reminders on overdue</span>
                                                </label>
                                </div>

                                <span class="pull-right">{!! renderAjaxButton()  !!}</span>
                            </div>
                        </section>
                    </div>
                    {!! Form::close() !!}
                </div>
            </section>
        </section>
    </aside>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
@push('pagestyle')
@include('stacks.css.datepicker')
@include('stacks.css.form')
@endpush
@push('pagescript')
@include('stacks.js.datepicker')
@include('stacks.js.form')
@include('stacks.js.markdown')
<script src="{{ getAsset('plugins/apps/payment_schedule.js') }}"></script>

<script type="text/javascript">
    $('#use_braintree').change(function() {
            if($(this).is(":checked")) {
                $("#braintree_setup").show("fast");
                $(this).attr("checked");
            }else{
                $("#braintree_setup").hide("fast");
            }       
    }).change(); 
    $('#frequency').change(function () {
        if ($("#frequency").val() === "none") {
            $("#recurring").hide();
        } else {
            $("#recurring").show();
        }
    });
</script>

@endpush
@endsection