@extends('layouts.app')
@section('content')
<section id="content">
    <section class="hbox stretch">
        <aside>
            <section class="vbox">
                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-8 m-b-xs">
                            @can('clients_create')
                            <a href="{{  route('clients.create')  }}"
                                class="btn btn-{{ get_option('theme_color')  }} btn-sm" data-toggle="ajaxModal"
                                title="@langapp('new_company')  " data-placement="bottom">
                            @icon('solid/building') @langapp('new_client')  </a>
                            @endcan
                        </div>
                        <div class="col-sm-4 m-b-xs">
                        </div>
                    </div>
                </header>
                <section class="scrollable wrapper bg">
                    <div class="row">
                        {!! Form::open(['route' => 'invoices.api.save', 'class' => 'ajaxifyForm validator']) !!}
                        
                        <input type="hidden" name="id" value="0">
                        <input type="hidden" name="gateways[paypal]" value="inactive">
                        <input type="hidden" name="gateways[braintree]" value="inactive">
                        <input type="hidden" name="gateways[stripe]" value="inactive">
                        <input type="hidden" name="gateways[2checkout]" value="inactive">
                        <input type="hidden" name="gateways[bitcoin]" value="inactive">
                        <input type="hidden" name="gateways[mollie]" value="inactive">
                        <input type="hidden" name="gateways[wepay]" value="inactive">
                        <div class="col-md-6 form-horizontal">
                            <section class="panel panel-default">
                            <header class="panel-heading">@langapp('information')</header>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">@langapp('reference_no') @required</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="reference_no" value="{{ generateCode('invoices') }}"
                                        class="input-sm form-control" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">@langapp('title')</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="title" placeholder="Website Project" class="input-sm form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">@langapp('client') @required</label>
                                    <div class="col-lg-8">
                                        <select class="select2-option form-control" name="client_id" required>
                                            
                                            @foreach (Modules\Clients\Entities\Client::select('id', 'name')->get() as $client)
                                            <option value="{{  $client->id  }}" {!! $selectClient == $client->id ? 'selected="selected"' : '' !!}>{{ $client->name  }}</option>
                                            @endforeach
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">{{  get_option('tax1Label')  }}</label>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">%</span>
                                            <input class="form-control money" type="text"
                                            value="{{  get_option('default_tax')  }}" name="tax" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">{{  get_option('tax2Label')  }}</label>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">%</span>
                                            <input class="form-control money" type="text"
                                            value="{{  get_option('default_tax2')  }}" name="tax2" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">@langapp('discount')  </label>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">-</span>
                                            <input class="form-control money" type="text" value="0.00" name="discount"
                                            required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">@langapp('discount_percent') </label>
                                    <div class="col-lg-8">
                                        <select name="discount_percent" width="100%" class="form-control">
                                            <option value="1">@langapp('percentage')</option>
                                            <option value="0">@langapp('amount')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">{{ langapp('late_fee') }}</label>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">-</span>
                                            <input class="form-control money" type="text" value="{{ get_option('late_fee') }}" name="late_fee"
                                            required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">{{ langapp('late_fee_percent') }}</label>
                                    <div class="col-lg-8">
                                        <select name="late_fee_percent" width="100%" class="form-control">
                                            <option value="1">@langapp('percentage')</option>
                                            <option value="0">@langapp('amount')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">@langapp('extra_fee')  </label>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">%</span>
                                            <input class="form-control money" type="text" value="0.00" name="extra_fee"
                                            required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">@langapp('extra_fee_percent')  </label>
                                    <div class="col-lg-8">
                                        <select name="fee_is_percent" width="100%" class="form-control">
                                            <option value="1">@langapp('percentage')</option>
                                            <option value="0">@langapp('amount')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">@langapp('currency')  </label>
                                    <div class="col-lg-8">
                                        <select name="currency" class="select2-option form-control">
                                            <option value="CL">@langapp('client_default_currency')  </option>
                                            @foreach (App\Entities\Currency::select('title', 'code')->get() as $cur)
                                            <option value="{{  $cur->code  }}">{{  $cur->title  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">@langapp('tags')  </label>
                                    <div class="col-lg-8">
                                        <select class="select2-tags form-control" name="tags[]" multiple>
                                            @foreach (App\Entities\Tag::all() as $tag)
                                            <option value="{{  $tag->name  }}">{{  $tag->name  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <section class="panel panel-default">
                            <header class="panel-heading"> @langapp('terms')  </header>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>@langapp('payment_methods')</label>


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
                                                    <input type="checkbox" name="gateways[{{ $gateway }}]" {!! $gateway == 'braintree' ? 'id="use_braintree"' : '' !!} checked value="active">
                                                    <span class="label-text">{{ ucfirst($gateway) }}</span>
                                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>

                                    
                                    
                                </div>
                                <div id="braintree_setup" class="display-none">
                                    <div class="form-group">
                                        <label>@langapp('braintree_merchant_account')</label>
                                        <input type="text" class="form-control" name="gateways[braintree_merchant_account]" value="{{ get_option('braintree_merchant_account') }}">
                                        <span class="help-block m-b-none small text-danger">If using multi currency 
                                            <a href="https://articles.braintreepayments.com/control-panel/important-gateway-credentials"
                                        target="_blank">Read More</a></span>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>@langapp('terms') </label>
                                    <div class="partial-labels row m-xs">
                                        <div class="amount">
                                            <label for="partial-amount"
                                            class="partial-amount">@langapp('amount')  </label>
                                        </div>
                                        <div class="due">
                                            <label for="partial-due_date"
                                            class="partial-due_date">@langapp('deadline')  </label>
                                        </div>
                                        <div class="notes">
                                            <label for="partial-notes"
                                            class="partial-notes">@langapp('notes')  </label>
                                        </div>
                                    </div>
                                    <div class="partial-input-container m-xs">
                                        <div class="partial-inputs row height40">
                                            <div class="percent">
                                                <div class="input-group">
                                                    <span class="input-group-addon">%</span>
                                                    <input class="form-control" type="number" max="100" value="100"
                                                    name="partial-amount[1]" id="partial-amount" required>
                                                </div>
                                            </div>
                                            <div class="due">
                                                <input class="datepicker-input form-control" size="16" type="text"
                                                value="{{ datePickerFormat(now()->addDays(get_option('invoices_due_after'))) }}"
                                                name="partial-due_date[1]"
                                                data-date-format="{{ get_option('date_picker_format')  }}"
                                                id="partial-due_date" data-date-start-date="moment()" required>
                                            </div>
                                            <div class="notes">
                                                <input type="text" class="form-control" value=""
                                                name="partial-notes[1]" id="partial-notes">
                                            </div>
                                            <div class="paid">
                                                <a href="#" data-details="1"
                                                    class="btn-danger btn btn-sm partial-payment-delete">
                                                    <span class="display-inline">✗</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="partial-addmore">
                                        <div class="payment-plan-amounts row">
                                            <div class="twelve columns">
                                                <a href="#" class="btn btn-xs text-info"><span>@langapp('add_payment_schedule')  </span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label>@langapp('notes')   </label>
                                            <textarea name="notes" class="form-control markdownEditor" value="notes">{!! get_option('default_terms') !!}
                                            </textarea>
                                        </div>

            @php 
                $data['fields'] = App\Entities\CustomField::invoices()->orderBy('order', 'desc')->get();
            @endphp
            @include('partial.customfields.createNoCol', $data)

                                        <span class="pull-right">
                                        {!! renderAjaxButton() !!}
                                    </span>
                                        {!! Form::close() !!}
                                    </div>
                                </section>
                            </div>
                        </section>
                    </div>
                </section>
            </section>
        </aside> 

    </section> 
        <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav">
        
    </a> 

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
        $(document).ready(function () {
            $('#use_braintree').change(function() {
            if($(this).is(":checked")) {
                $("#braintree_setup").show("fast");
                $(this).attr("checked");
            }else{
                $("#braintree_setup").hide("fast");
            }       
            }).change();    
        });
    </script>
    @endpush
@endsection