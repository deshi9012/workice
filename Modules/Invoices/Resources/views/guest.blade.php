@extends('layouts.public')
@section('content')

<section id="content" class="details-page public-page">
    <div class="container details-container clearfix bg">
        <section class="vbox">

            <section class="wrapper panel-default">


                <header class="header b-b b-light hidden-print">


            <div class="m-t-xs">

                <a href="{{  route('invoices.view', ['id' => $invoice->id, ])  }}" class="btn btn-sm btn-info">@icon('solid/home') @langapp('dashboard')  
                </a>

                <a href="{{ URL::signedRoute('invoices.guestpdf', $invoice->id) }}" class="btn btn-sm btn-info">
                    @icon('solid/file-pdf') PDF</a>

                    @if($invoice->due() > 0)

                    @include('invoices::_includes.payment_links')

                @endif

                

                            <span class="label label-danger pull-right">{{ $invoice->status }}</span>
                
                </div>



                    
                    



            </header>

                <div class="panel-body">


                    @php $data['company'] = $invoice->company; @endphp

                    <div class="row">
                        <div class="col-xs-6 with-responsive-img">
                            <img src="{{ getStorageUrl(config('system.media_dir').'/'.get_option('invoice_logo')) }}">
                        </div>
                        <div class="col-xs-6 text-right">
                            <p class="font20">#{{  $invoice->reference_no  }}</p>

                            <div class="estimate-header-text">
                                {{  stripAccents(langapp('invoice_date'))  }}
                                : {{  dateString($invoice->created_at)  }}
                            </div>


                            <div class="estimate-header-text">
                                {{   stripAccents(langapp('payment_due'))   }}
                                : {{  dateString($invoice->due_date)  }}
                            </div>

                            <div class="estimate-header-text">
                                {{   stripAccents(langapp('status'))   }}
                                : <strong>{{  $invoice->isOverdue() ? langapp('overdue') : $invoice->status  }}</strong>
                            </div>




                        </div>
                    </div>
                    <div class="well m-t bg-white">
                        <div class="row">
                            <div class="col-xs-6">
                                <p class="h3">@langapp('client')  </p>

                                @include('partial.client_address', $data)

                            </div>
                            <div class="col-xs-6">
                                <p class="h3">@langapp('company_name')  </p>
                                @include('partial.company_address', $data)


                            </div>
                        </div>
                    </div>
                    <div class="line"></div>
                    @php $showtax = get_option('show_invoice_tax') == 'TRUE' ? true : false; @endphp
                    <table class="table">
                        <thead>
                        <tr class="text-uc">
                            <th width="40%">@langapp('product')</th>
                            <th width="10%">@langapp('qty')</th>
                            <th width="15%">{{ itemUnit() }}</th>
                            <th width="10%">@langapp('disc')</th>
                            @if ($showtax)
                                <th width="10%">@langapp('tax')</th>
                            @endif
                            <th width="15%" class="text-right">@langapp('total')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($invoice->items as $key => $item)
                            <tr>
                                <td><span class="text-bold">{{ $item->name }}</span>
                                    <div class="text-muted">@parsedown($item->description)</div>
                                </td>
                                <td>{{ formatQuantity($item->quantity) }}</td>
                                <td>{{ formatCurrency($invoice->currency, $item->unit_cost) }}</td>
                                <td>{{ $item->discount }}%</td>
                                @if ($showtax)
                                    <td><span class="text-muted">{{  formatTax($item->tax_rate)  }}%</span></td>
                                @endif
                                <td class="text-right">{{  formatCurrency($invoice->currency, $item->total_cost) }}</td>
                            </tr>
                        @endforeach
                        @php $colspan = ($showtax) ? 5 : 4;  @endphp
                        <tr>
                            <td colspan="{{  $colspan  }}" class="text-right"><strong>@langapp('sub_total') </strong></td>
                            <td class="text-right">{{  formatCurrency($invoice->currency, $invoice->subtotal())  }}</td>
                        </tr>

                        @if ($invoice->discount > 0)
                            <tr>
                                <td colspan="{{  $colspan  }}" class="text-right no-border">
                                    <strong>
                                        @langapp('discount')   - {{ formatDecimal($invoice->discount) }}%
                                    </strong>
                                </td>
                                <td class="text-right">{{ formatCurrency($invoice->currency, $invoice->discounted()) }}</td>
                            </tr>
                        @endif
                        @if ($invoice->tax > 0.00)
                            <tr>
                                <td colspan="{{  $colspan  }}" class="text-right no-border"><strong>
                                        {{ get_option('tax1Label') }} ({{ formatTax($invoice->tax) }}%)</strong></td>
                                <td class="text-right">{{ formatCurrency($invoice->currency, $invoice->tax1Amount()) }}</td>
                            </tr>
                        @endif
                        @if ($invoice->tax2 > 0.00)
                            <tr>
                                <td colspan="{{ $colspan }}" class="text-right no-border"><strong>
                                        {{ get_option('tax2Label') }} ({{ formatTax($invoice->tax2) }}%)</strong></td>
                                <td class="text-right">{{ formatCurrency($invoice->currency, $invoice->tax2Amount()) }}</td>
                            </tr>
                        @endif


                        @if ($invoice->lateFee() > 0)
                                    <tr>
                                        <td colspan="{{  $colspan  }}" class="text-right no-border">
                                            <strong>@langapp('late_fee')</strong>
                                        </td>
                                        <td class="text-right">
                                                {{ formatCurrency($invoice->currency, $invoice->lateFee()) }}
                                        </td>

                                    </tr>

                        @endif

                        @if ($invoice->extra_fee > 0)
                            <tr>
                                <td colspan="{{  $colspan  }}" class="text-right no-border"><strong>
                                        @langapp('extra_fee')  ({{ formatDecimal($invoice->extra_fee) }}%)</strong></td>
                                <td class="text-right">{{ formatCurrency($invoice->currency, $invoice->fee())}}</td>
                            </tr>

                        @endif

                        @php $payment_made = $invoice->paid(); @endphp
                        @if ($payment_made > 0)
                            <tr>
                                <td colspan="{{  $colspan  }}" class="text-right no-border">
                                    <strong>@langapp('payment_made') </strong>
                                </td>
                                <td class="text-right">{{  formatCurrency($invoice->currency, $payment_made)  }}</td>
                            </tr>
                        @endif


                        <tr>
                            <td colspan="{{  $colspan  }}" class="text-right no-border">
                                <strong>@langapp('balance_due')  </strong></td>
                            <td class="text-right text-bold">{{  formatCurrency($invoice->currency, $invoice->due())  }}</td>
                        </tr>
                        </tbody>
                    </table>

                    @if ($invoice->late_fee > 0 && !$invoice->isOverdue())
                                <p class="text-danger">Late fee of {{ $invoice->late_fee_percent === 0 ? $invoice->currency : '' }} {{ $invoice->late_fee }} {{ $invoice->late_fee_percent ? '%' : '' }} will be applied.</p>
                    @endif

                    @if (in_array($invoice->currency, config('system.supported_currency_words')))
                        <p class="text-bold">{{ toWords($invoice->due(), $invoice->currency) }}</p>
                    @endif


                    <p class="">
                        @php 
                            $str = str_replace('{REMAINING_DAYS}', $invoice->dueDays().' days', $invoice->notes);
                            $str = str_replace('{PAYMENT_DETAILS}', get_option('invoice_payment_info'), $str);
                        @endphp
                        @parsedown($str)
                    </p>
                </div>
            </section>

            {{ $invoice->clientViewed() }}

        </section>
        <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open"
           data-target="#nav,html"></a>
    </div>
</section>

@endsection