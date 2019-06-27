<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ settingEnabled('rtl') ? 'rtl' : 'ltr' }}" class="app">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>@langapp('invoice') {{ $invoice->reference_no }}</title>
    @php
    ini_set('memory_limit', '-1');
    $ratio = 1.3;
    $logo_height = intval(get_option('invoice_logo_height') / $ratio);
    $logo_width = intval(get_option('invoice_logo_width') / $ratio);
    $color = get_option('invoice_color');
    App::setLocale($invoice->company->locale);
    @endphp
    <head>
        <link rel="stylesheet" href="{{ getAsset('css/invoice-pdf.css') }}">
        <style>
        body {
            font-family: {{ config('system.pdf_font') }};
        }
        table thead td {
            border-bottom: 0.2mm solid {{ $color }};
        }
        table .last td {
            border-bottom: 0.2mm solid {{ $color }};
        }
        table .first td {
            border-top: 0.2mm solid {{ $color }};
        }
        .color{ color: {{ $color }}; }
        .bg-color{ background-color: {{  $color  }} !important; color:#ffffff; }
        footer {
            border-top: 1px solid {{ $color }};
        }
        .b-b{
            border-bottom:0.2mm solid {{  $color  }};
        }
        .terms{
            padding:5px 0; color: #111111; border-bottom: 0.2mm solid {{  $color  }};
        }
        .logo{
            height: {{ $logo_height }}px; width: {{ $logo_width }}px;
        }
        </style>
    </head>
    <body>
        <div id="container">
            <header>
                <div>
                    <table class="width100">
                        <tr>
                            <td class="width60" height="{{ $logo_height }}">
                                <img class="logo" src="{{ $logo }}"/>
                            </td>
                            <td class="text-right width40">
                                <div class="color text-uc font20">{{ stripAccents(langapp('invoice')) }}</div>
                                
                                <table class="m-t-12 width100">
                                    <tr>
                                        <td class="color text-left text-uc">
                                            {{ stripAccents(langapp('reference_no'))  }}:
                                        </td>
                                        <td class="text-right">{{ $invoice->reference_no  }}</td>
                                    </tr>
                                    <tr>
                                        <td class="color text-left text-uc">
                                            {{ stripAccents(langapp('invoice_date'))  }}:
                                        </td>
                                        <td class="text-right">{{ dateString($invoice->created_at) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="color text-left text-uc">
                                            {{ stripAccents(langapp('payment_due')) }}:
                                        </td>
                                        <td class="text-right">{{  dateString($invoice->due_date) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="color text-left text-uc">
                                            {{ stripAccents(langapp('status')) }}:
                                        </td>
                                        <td class="text-right">{{ $invoice->status }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </header>
            <div class="height10">&nbsp;</div>
            <div class="m-b-10">
                <table class="width100 v-t" cellpadding="10">
                    <tr>
                        @if (get_option('swap_to_from') == 'FALSE')
                        <td class="width45 color text-uc b-b">{{ stripAccents(langapp('received_from')) }}</td>
                        <td class="width10">&nbsp;</td>
                        @endif
                        <td class="color text-uc width45 b-b">{{  stripAccents(langapp('bill_to'))  }}</td>
                        @if (get_option('swap_to_from') == 'TRUE')
                        <td class="width10">&nbsp;</td>
                        <td class="width45 color text-uc b-b">{{  stripAccents(langapp('received_from'))  }}</td>
                        @endif
                    </tr>
                    @php $data['company'] = $invoice->company; @endphp
                    <tr>
                        @if (get_option('swap_to_from') == 'FALSE')
                        <td class="width45">
                            @include('partial.pdf.company_address', $data)
                        </td>
                        <td class="width10">&nbsp;</td>
                        @endif
                        <td class="width45">
                            @include('partial.pdf.client_address', $data)
                        </td>
                        @if (get_option('swap_to_from') == 'TRUE')
                        <td class="width10">&nbsp;</td>
                        <td class="width45">
                            @include('partial.pdf.company_address', $data)
                        </td>
                        @endif
                    </tr>
                </table>
            </div>
            <table class="items width100 item-table" cellpadding="10">
                <thead>
                    <tr class="inv-text inv-bg text-uc">
                        @if (get_option('show_invoice_tax') == 'FALSE')
                        <td class="text-left width40">{{  stripAccents(langapp('product'))  }} </td>
                        <td class="width8">{{  stripAccents(langapp('qty'))  }} </td>
                        <td class="width12">{{ itemUnit() }}</td>
                        <td class="width10">{{  stripAccents(langapp('disc'))  }} </td>
                        <td class="text-right width20">{{  stripAccents(langapp('total'))  }} </td>
                        @else
                        <td class="text-left width40">{{  stripAccents(langapp('product'))  }} </td>
                        <td class="width8">{{  stripAccents(langapp('qty'))  }} </td>
                        <td class="width12">{{ itemUnit() }}</td>
                        <td class="width10">{{  stripAccents(langapp('disc'))  }} </td>
                        <td class="width10">{{  stripAccents(langapp('tax'))  }} </td>
                        <td class="text-right width20">{{  stripAccents(langapp('total'))  }} </td>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    {{-- ITEMS HERE --}}
                    @foreach ($invoice->items as $idx => $item)
                    <tr class={{  $idx + 1 == count($invoice->items) ? 'last' : ''  }}>
                        @if (get_option('show_invoice_tax') == 'FALSE')
                        <td class="text-left">
                            <div class="item-name m-b-6">{{  $item->name  }}</div>
                            @parsedown($item->description)
                        </td>
                        <td class="text-center">{{ formatQuantity($item->quantity) }}</td>
                        <td class="text-right">{{ formatCurrency($invoice->currency, $item->unit_cost) }}</td>
                        <td class="text-right">{{ $item->discount }}%</td>
                        <td class="text-right">{{ formatCurrency($invoice->currency, $item->total_cost) }}</td>
                        @else
                        <td class="text-left">
                            <div class="item-name m-b-6">{{ $item->name }}</div>
                            @parsedown($item->description)
                        </td>
                        <td class="text-center">{{ formatQuantity($item->quantity) }}</td>
                        <td class="text-right">{{ formatCurrency($invoice->currency, $item->unit_cost) }}</td>
                        <td class="text-right">{{ $item->discount }}%</td>
                        <td class="text-right">{{ $item->tax_rate}}%</td>
                        <td class="text-right">{{ formatCurrency($invoice->currency, $item->total_cost) }}</td>
                        @endif
                    </tr>
                    @endforeach
                    @php $colspan = (get_option('show_invoice_tax') == 'FALSE' ? '2' : '3');  @endphp
                    <tr class="first">
                        <td colspan="{{ $colspan }}" class="white-bg"></td>
                        <td colspan="2">@langapp('total')</td>
                        <td class="text-right">{{ formatCurrency($invoice->currency, $invoice->subTotal()) }}</td>
                    </tr>
                    @if ($invoice->tax != 0)
                    <tr>
                        <td colspan="{{ $colspan }}" class="white-bg"></td>
                        <td colspan="2">{{ get_option('tax1Label') }} ({{  formatTax($invoice->tax)  }}%)</td>
                        <td class="text-right">{{ formatCurrency($invoice->currency, $invoice->tax1Amount()) }}</td>
                    </tr>
                    @endif
                    @if ($invoice->tax2 != 0)
                    <tr>
                        <td colspan="{{  $colspan  }}" class="white-bg"></td>
                        <td colspan="2">{{ get_option('tax2Label')  }} ({{  formatTax($invoice->tax2)  }}%)</td>
                        <td class="text-right">{{ formatCurrency($invoice->currency, $invoice->tax2Amount()) }}</td>
                    </tr>
                    @endif
                    @if ($invoice->discount > 0)
                    <tr>
                        <td colspan="{{ $colspan }}" class="white-bg"></td>
                        <td colspan="2">@langapp('discount') - {{  formatDecimal($invoice->discount)  }}%</td>
                        <td class="text-right">{{ formatCurrency($invoice->currency, $invoice->discounted()) }}</td>
                    </tr>
                    @endif
                    @if ($invoice->lateFee() > 0)
                    <tr>
                        <td colspan="{{ $colspan }}" class="white-bg"></td>
                        <td colspan="2">{{ langapp('late_fee') }}</td>
                        <td class="text-right">{{ formatCurrency($invoice->currency, $invoice->lateFee()) }}</td>
                    </tr>
                    @endif
                    @if ($invoice->extra_fee > 0)
                    <tr>
                        <td colspan="{{  $colspan  }}" class="white-bg"></td>
                        <td colspan="2">@langapp('extra_fee') - {{  formatDecimal($invoice->extra_fee)  }}%</td>
                        <td class="text-right">{{ formatCurrency($invoice->currency, $invoice->extraFee()) }}</td>
                    </tr>
                    @endif
                    @php $payment_made = $invoice->paid(); @endphp
                    @if ($payment_made > 0)
                    <tr>
                        <td colspan="{{ $colspan }}" class="white-bg"></td>
                        <td colspan="2">@langapp('payment_made')</td>
                        <td class="text-right">{{ formatCurrency($invoice->currency, $payment_made) }}</td>
                    </tr>
                    @endif
                    @if ($invoice->creditedAmount() > 0)
                    <tr>
                        <td colspan="{{ $colspan }}" class="white-bg"></td>
                        <td colspan="2">@langapp('credits_applied') </td>
                        <td class="text-right">{{ formatCurrency($invoice->currency, $invoice->creditedAmount()) }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td colspan="{{ $colspan }}" class="white-bg"></td>
                        <td class="bg-color text-uc" colspan="2">@langapp('balance_due')</td>
                        <td class="bg-color text-right">{{ formatCurrency($invoice->currency, $invoice->due()) }}</td>
                    </tr>
                </tbody>
            </table>
            @if ($invoice->gatewayEnabled('bank'))
            <h4 class="text-uc terms">{{ stripAccents(langapp('bank_details')) }}</h4>
            <span class="text-muted">@parsedown(get_option('bank_details'))</span>
            @endif
            <div class="m-t-40">
                <h4 class="text-uc terms">{{ stripAccents(langapp('payment_information')) }}</h4>
                @parsedown(str_replace('{REMAINING_DAYS}', $invoice->dueDays().' days', $invoice->notes))
            </div>
            <footer>
                <div class="text-left foot">
                    @parsedown(get_option('invoice_footer'))
                </div>
                <div class="text-right page-num">
                    <div class="pagenum-container">Page <span class="pagenum"></span></div>
                </div>
            </footer>
        </div>
    </body>
</html>