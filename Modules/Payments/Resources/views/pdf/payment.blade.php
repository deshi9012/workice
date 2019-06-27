@php
$ratio = 1.3;
$logo_height = intval(get_option('invoice_logo_height') / $ratio);
$logo_width = intval(get_option('invoice_logo_width') / $ratio);
$color = get_option('payment_color');
App::setLocale($payment->company->locale);
@endphp
<html>
    <head>
        <link rel="stylesheet" href="{{ getAsset('css/payment-pdf.css') }}">
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
            border-bottom:0.2mm solid {{ $color }};
        }
        .terms{
            padding:5px 0; color: #111111; border-bottom: 0.2mm solid {{ $color }};
        }
        .logo{
            height: {{ $logo_height }}px; width: {{ $logo_width }}px;
        }
        </style>
    </head>
    <body>
        <header>
            <div>
                <table class="width100">
                    <tr>
                        <td class="width55" height="{{ $logo_height }}">
                            <img class="logo" src="{{ $logo }}">
                        </td>
                        <td class="text-right width45">
                            <div class="color text-uc font20">{{ stripAccents(langapp('receipt')) }}</div>
                            
                            <table class="m-t-12 width100">
                                <tr>
                                    <td class="color text-left text-uc">
                                        ID #:
                                    </td>
                                    <td class="text-right">{{ $payment->code  }}</td>
                                </tr>
                                <tr>
                                    <td class="color text-left text-uc">
                                        {{ stripAccents(langapp('payment_date'))  }}:
                                    </td>
                                    <td class="text-right">{{ dateString($payment->payment_date) }}</td>
                                </tr>
                                <tr>
                                    <td class="color text-left text-uc">
                                        {{ stripAccents(langapp('payment_method')) }}:
                                    </td>
                                    <td class="text-right">{{ $payment->paymentMethod->method_name }}</td>
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
                    @if (get_option('swap_to_from') === 'FALSE')
                    <td class="width45 color text-uc b-b">{{ stripAccents(langapp('received_from')) }}</td>
                    <td class="width10">&nbsp;</td>
                    @endif
                    <td class="color text-uc width45 b-b">{{ stripAccents(langapp('bill_to')) }}</td>
                    @if (get_option('swap_to_from') === 'TRUE')
                    <td class="width10">&nbsp;</td>
                    <td class="width45 color text-uc b-b">{{ stripAccents(langapp('received_from')) }}</td>
                    @endif
                </tr>
                @php $data['company'] = $payment->company; @endphp
                <tr>
                    @if (get_option('swap_to_from') === 'FALSE')
                    <td class="width45">
                        @include('partial.pdf.company_address', $data)
                    </td>
                    <td class="width10">&nbsp;</td>
                    @endif
                    <td class="width45">
                        @include('partial.pdf.client_address', $data)
                    </td>
                    @if (get_option('swap_to_from') === 'TRUE')
                    <td class="width10">&nbsp;</td>
                    <td class="width45">
                        @include('partial.pdf.company_address', $data)
                    </td>
                    @endif
                </tr>
            </table>
        </div>
        <table class="items item-table width100" cellpadding="10">
            <thead>
                <tr>
                    <td class="text-left width60">{{ stripAccents(langapp('description')) }} </td>
                    <td class="text-center width10">{{ stripAccents(langapp('qty')) }} </td>
                    <td class="text-center width15">{{ stripAccents(langapp('unit_price')) }} </td>
                    <td class="text-center width15">{{ stripAccents(langapp('amount')) }} </td>
                </tr>
            </thead>
            <tbody>
                <tr class="">
                    <td class="text-left width60">
                        <div class="item-name m-b-6">Payment for Invoice #{{ $payment->AsInvoice->reference_no }}</div>
                        {!!  nl2br(langapp('invoice_amount') . ': ' . formatCurrency($payment->AsInvoice->currency, $payment->AsInvoice->payable())) . '<br/>' . langapp('balance') . ': ' . formatCurrency($payment->AsInvoice->currency, $payment->AsInvoice->due())  !!}
                    
                </td>
                <td class="width10 text-center">{{  formatQuantity(1)  }}</td>
                <td class="text-right width15">{{  formatCurrency($payment->currency, $payment->amount) }}</td>
                <td class="text-right width15">
                    {{ formatCurrency($payment->currency, $payment->amount) }}
                </td>
                </tr>


            <tr class="first">
                <td colspan="1" class="white-bg"></td>
                <td colspan="2">@langapp('sub_total')</td>
                <td class="text-right">{{ formatCurrency($payment->currency, $payment->amount) }}</td>
            </tr>
            <tr>
                <td colspan="1" class="white-bg"></td>
                <td class="bg-color" colspan="2">@langapp('total') ({{ $payment->currency }})</td>
                <td class="text-right bg-color text-right">{{ formatCurrency($payment->currency, $payment->amount) }}</td>
            </tr>
        </tbody>
    </table>
    <div class="m-t-40">
        <h4 class="text-uc terms">{{ stripAccents(langapp('payment_information')) }}</h4>
        @parsedown($payment->notes)
    </div>
</body>
</html>