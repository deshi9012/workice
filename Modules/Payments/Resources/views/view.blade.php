@extends('layouts.app')
@section('content')
<section id="content">
    <section class="hbox stretch">
        
        <section class="vbox">
            <header class="header bg-white b-b clearfix">
                <div class="row m-t-sm">
                    <div class="col-sm-8 m-b-xs">
                        @can('payments_update')
                        <a href="{{  route('payments.edit', ['id' => $payment->id])  }}"
                            title="@langapp('edit')" data-rel="tooltip" data-placement="bottom"
                            class="btn btn-sm btn-{{ get_option('theme_color') }}" data-toggle="ajaxModal">
                        @icon('solid/pencil-alt') @langapp('edit')</a>
                        @if ($payment->is_refunded === 0)
                        <a href="{{  route('payments.refund', ['id' => $payment->id])  }}"
                            title="@langapp('refunded')" data-rel="tooltip" data-placement="bottom"
                            class="btn btn-sm btn-{{ get_option('theme_color') }}"
                            data-toggle="ajaxModal">
                        @icon('solid/exchange-alt') @langapp('refund')</a>
                        
                        @endif
                        @endcan
                        
                        <a href="{{  route('payments.pdf', ['id' => $payment->id])  }}" title="@langapp('download')"
                            class="btn btn-sm btn-{{ get_option('theme_color')  }}" data-rel="tooltip" data-placement="bottom">
                            @icon('solid/file-pdf') @langapp('receipt')
                        </a>
                    </div>
                    <div class="col-sm-4 m-b-xs">
                        @can('payments_delete')
                        <a href="{{  route('payments.delete', ['id' => $payment->id])  }}"
                            title="@langapp('delete')" data-rel="tooltip" data-placement="bottom"
                            class="pull-right btn btn-sm btn-{{ get_option('theme_color') }}"
                            data-toggle="ajaxModal">
                        @icon('solid/trash-alt') @langapp('delete')</a>
                        @endcan
                    </div>
                </div>
            </header>
            <section class="scrollable wrapper bg">
                @if ($payment->is_refunded)
                <div class="alert alert-danger hidden-print">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    @icon('solid/exclamation-circle') @langapp('transaction_refunded')
                </div>
                @endif
                
                <div class="col-lg-5 b-r">
                    <div class="column content-column">
                        <div class="details-page">
                            <div class="details-container clearfix m-b-20">
                                <div class="font10">
                                    <div>
                                        <div class="text-center payment-received">
                                            <span class="text-uc payment-received-span">@langapp('payments_received')</span>
                                        </div>
                                        
                                        <div class="bg-{{ get_option('theme_color') }} pull-right text-center payment-amount">@langapp('amount')<br>
                                            <span class="font16">{{ formatCurrency($payment->currency, $payment->amount)}}</span>
                                        </div>
                                        <div class="m-b-sm">
                                            ID # : <strong>{{ $payment->code }}</strong>
                                        </div>
                                        <div class="m-b-sm">
                                            @langapp('currency') : <strong>{{ $payment->currency }}</strong>
                                        </div>
                                        
                                        <div class="m-b-sm">
                                            @langapp('payment_method') : <strong>{{ $payment->paymentMethod->method_name }}</strong>
                                        </div>
                                        
                                        @if($payment->currency != 'USD')
                                        <div class="m-b-sm">
                                            @langapp('xrate') :
                                            <strong>1 USD = {{ $payment->currency }} {{ $payment->exchange_rate  }}</strong>
                                            
                                        </div>
                                        @endif
                                        
                                        <div class="m-b-sm">
                                            @langapp('date') : <strong>{{ dateTimeFormatted($payment->payment_date) }}</strong>
                                            
                                        </div>
                                        <div class="m-b-sm">
                                            @langapp('received_from') : <strong><a href="{{ route('clients.view', ['id' => $payment->client_id])  }}">
                                            {{  $payment->company->name }}</a></strong>
                                        </div>
                                        <div class="line"></div>
                                        <small class="text-uc text-xs text-muted">@langapp('invoice')  </small>
                                        
                                        <div class="m-b-sm">
                                            @langapp('reference_no') :
                                            <strong>
                                            <a href="{{ route('invoices.view', ['id' => $payment->invoice_id]) }}">
                                                {{  $payment->AsInvoice->reference_no }}
                                            </a>
                                            </strong>
                                            
                                        </div>
                                        <div class="m-b-sm">
                                            @langapp('date') : <strong>{{ dateString($payment->AsInvoice->created_at) }}</strong>
                                        </div>
                                        <div class="m-b-sm">
                                            @langapp('balance') : <strong>{{ formatCurrency($payment->AsInvoice->currency, $payment->AsInvoice->due()) }} </strong>
                                        </div>
                                        <div class="line"></div>
                                        <small class="text-uc text-xs text-muted">@langapp('in_words')</small>
                                        @if (settingEnabled('amount_in_words'))
                                        @widget('Payments\AmountWords', ['currency' => $payment->currency, 'amount' => $payment->amount])
                                        @endif
                                        <div class="line"></div>
                                        <small class="text-uc text-xs text-muted">@langapp('tags')</small>
                                        @php
                                        $data['tags'] = $payment->tags;
                                        @endphp
                                        @include('partial.tags', $data)
                                        
                                        <div class="line"></div>
                                        <small class="text-uc text-xs text-muted">@langapp('notes')  </small>
                                        <div class="line"></div>

                                        @parsedown($payment->notes)
                                        <small class="text-uc text-xs text-muted">Meta JSON</small>
                                        <div class="line"></div>
                                        @if(!is_null($payment->meta))
                                        @foreach ($payment->meta as $key => $value)
                                        <div class="m-xs">
                                            <span class="text-muted">@icon('solid/caret-right')
                                            {{ $key }}: </span>
                                            <span class="">{{ $value }}</span>
                                        </div>
                                        @endforeach
                                        @endif
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                {{-- /COLUMN 5 --}}
                <div class="col-lg-7">
                    @include('partial._show_files', ['files' => $payment->files, 'limit' => true])
                    <div class="m-xs"></div>
                    
                    
                    <section class="comment-list block">
                        <article class="comment-item" id="comment-form">
                            <a class="pull-left thumb-sm avatar">
                                <img src="{{ avatar() }}" class="img-circle">
                            </a>
                            <span class="arrow left"></span>
                            <section class="comment-body">
                                <section class="panel panel-default">
                                    @widget('Comments\CreateWidget', ['commentable_type' => 'payments' , 'commentable_id' => $payment->id])
                                    
                                    
                                </section>
                            </section>
                        </article>
                        
                        @widget('Comments\ShowComments', ['comments' => $payment->comments])
                    </section>
                    
                </div>
                {{-- /COLUMN 7 --}}
            </section>
        </section>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
@push('pagescript')
@include('stacks.js.markdown')
@include('comments::_ajax.ajaxify')
@endpush
@endsection