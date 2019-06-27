@foreach ($payments->chunk(2) as $chunk)
    <div class="row">
        @foreach ($chunk as $payment)
            <div class="col-md-6">
                        <div class="panel invoice-grid widget-b">
                            <div class="panel-body">
                                <div class="row">

                                    <div class="col-sm-6">
                                        <h6 class="text-semibold"><a href="{{  route('payments.view', ['id' => $payment->id])  }}">#{{  $payment->code  }}</a>
                                        </h6>
                                        <ul class="list list-unstyled">
                                            <li>@langapp('amount')  : <span class="text-bold">{{  formatCurrency($payment->currency, $payment->amount)  }}</span></li>
                                            <li>@langapp('date')  : <span class="text-semibold">{{  dateFormatted($payment->payment_date)  }}</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-sm-6">

                                        <h6 class="text-semibold text-right no-margin-top">
                                            {!!  $payment->is_refunded ? '<span class="text-danger">✘</span>' : '<span class="text-success">✔</span>' !!}
                                        </h6>
                                        <ul class="list list-unstyled text-right">
                                            <li>@langapp('currency')  : 
                                            <span class="text-semibold text-success">{{ $payment->currency }}</span>
                                            </li>
                                            <li>@langapp('payment_method')  : 
                                            <span class="label label-danger">{{  $payment->paymentMethod->method_name  }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-footer panel-footer-condensed">
                                <a class="heading-elements-toggle"></a>
                                <div class="heading-elements">
                        <span class="heading-text">
                          @icon('solid/building', 'text-danger') 
                          <a href="{{ route('clients.view', ['id' => $payment->client_id]) }}">
                            {{ str_limit($payment->company->name, 40) }}
                            </a>
                        </span>

                                    <a href="{{  route('payments.view', ['id' => $payment->id])  }}"
                                       class="btn btn-dark btn-xs pull-right">
                                            @icon('solid/credit-card') @langapp('preview')  
                                    </a>


                                </div>
                            </div>
                        </div>
                    </div>
        @endforeach
    </div>
@endforeach