<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>@langapp('credit_note') {{ $creditnote->reference_no }}</title>
    @php
    ini_set('memory_limit', '-1');
    $ratio = 1.3;
    $logo_height = intval(get_option('invoice_logo_height') / $ratio);
    $logo_width = intval(get_option('invoice_logo_width') / $ratio);
    $color = get_option('creditnote_color');
    App::setLocale($creditnote->company->locale);
    @endphp
    <head>
        <link rel="stylesheet" href="{{ getAsset('css/credits-pdf.css') }}">
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
        .bg-color{ background-color: {{ $color }} !important; color:#ffffff; }
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
                        <td class="width60" height="{{ $logo_height }}">
                            <img class="logo" src="{{ $logo }}"/>
                        </td>
                        <td class="text-right width40">
                            <div class="color text-uc font20">{{ stripAccents(langapp('credit_note')) }}</div>
                            
                            <table class="m-t-12 width100">
                                <tr>
                                    <td class="color text-left text-uc">
                                        {{ stripAccents(langapp('reference_no')) }}:
                                    </td>
                                    <td class="text-right">{{ $creditnote->reference_no }}</td>
                                </tr>
                                <tr>
                                    <td class="color text-left text-uc">
                                        {{ stripAccents(langapp('credit_date'))  }}:
                                    </td>
                                    <td class="text-right">{{ dateString($creditnote->created_at) }}</td>
                                </tr>
                                <tr>
                                    <td class="color text-left text-uc">
                                        {{ stripAccents(langapp('balance')) }}:
                                    </td>
                                    <td class="text-right">{{ formatCurrency($creditnote->currency, $creditnote->balance) }}</td>
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
                    <td class="width45 color text-uc b-b">{{  stripAccents(langapp('received_from'))  }}</td>
                    <td class="width10">&nbsp;</td>
                    @endif
                    <td class="color text-uc width45 b-b">{{ stripAccents(langapp('bill_to')) }}</td>
                    @if (get_option('swap_to_from') == 'TRUE')
                    <td class="width10">&nbsp;</td>
                    <td class="color text-uc width45 b-b">{{ stripAccents(langapp('received_from')) }}</td>
                    @endif
                </tr>
                @php $data['company'] = $creditnote->company; @endphp
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
                <tr>
                    @if (get_option('show_invoice_tax') == 'FALSE')
                    <td class="text-left width60">{{ stripAccents(langapp('product')) }} </td>
                    <td class="width10">{{ stripAccents(langapp('qty')) }} </td>
                    <td class="width15">{{ itemUnit() }}</td>
                    <td class="text-right width15">{{ stripAccents(langapp('total')) }} </td>
                    @else
                    <td class="text-left width45">{{  stripAccents(langapp('product'))  }}</td>
                    <td class="width10">{{ stripAccents(langapp('qty')) }} </td>
                    <td class="width15">{{ itemUnit() }}</td>
                    <td class="width15">{{ stripAccents(langapp('tax')) }} </td>
                    <td class="text-right width15">{{ stripAccents(langapp('total')) }} </td>
                    @endif
                </tr>
            </thead>
            <tbody>
                <!-- ITEMS HERE -->
                @foreach ($creditnote->items as $idx => $item)
                <tr class={{  $idx + 1 == count($creditnote->items) ? 'last' : ''  }}>
                    @if (get_option('show_invoice_tax') == 'FALSE')
                    <td class="text-left width60">
                        <div class="item-name m-b-6">{{  $item->name  }}</div>
                    {{  nl2br($item->description)  }}
                    </td>
                    <td class="width10 text-center">{{  formatQuantity($item->quantity)  }}</td>
                    <td class="text-right width15">{{ formatCurrency($creditnote->currency, $item->unit_cost) }}</td>
                    <td class="text-right width15">{{ formatCurrency($creditnote->currency, $item->total_cost) }}</td>
                    @else
                    <td class="text-left width45">
                        <div class="item-name m-b-6">{{ $item->name }}</div>
                    {{  nl2br($item->description)  }}</td>
                    <td class="width10 text-center">{{ formatQuantity($item->quantity) }}</td>
                    <td class="text-right width15">{{ formatCurrency($creditnote->currency, $item->unit_cost) }}</td>
                    <td class="text-right width15">{{ formatCurrency($creditnote->currency, $item->tax_total) }}</td>
                    <td class="text-right width15">{{ formatCurrency($creditnote->currency, $item->total_cost) }}</td>
                    @endif
                </tr>
                @endforeach
                @php $colspan = (get_option('show_invoice_tax') == 'FALSE' ? '1' : '2');  @endphp
                <tr class="first">
                    <td colspan="{{ $colspan }}" class="white-bg"></td>
                    <td colspan="2">@langapp('total')</td>
                    <td class="text-right">{{ formatCurrency($creditnote->currency, $creditnote->subTotal()) }}</td>
                </tr>
                @if ($creditnote->tax > 0)
                <tr>
                    <td colspan="{{ $colspan }}" class="white-bg"></td>
                    <td colspan="2">@langapp('tax') ({{ formatTax($creditnote->tax) }}%)</td>
                    <td class="text-right">{{ formatCurrency($creditnote->currency, $creditnote->tax()) }}</td>
                </tr>
                @endif
                @if ($creditnote->usedCredits() > 0)
                <tr>
                    <td colspan="{{  $colspan  }}" class="white-bg"></td>
                    <td colspan="2">@langapp('credits_used')</td>
                    <td class="text-right">{{ formatCurrency($creditnote->currency, $creditnote->usedCredits()) }}</td>
                </tr>
                @endif
                <tr>
                    <td colspan="{{ $colspan }}" class="white-bg"></td>
                    <td class="bg-color" colspan="2">@langapp('balance')</td>
                    <td class="text-right bg-color">{{ formatCurrency($creditnote->currency, $creditnote->balance) }}</td>
                </tr>
            </tbody>
        </table>
        <div class="m-t-40">
            <h4 class="text-uc terms">{{ stripAccents(langapp('terms')) }}</h4>
            @parsedown($creditnote->terms)
        </div>
        <footer>
            <div class="text-left foot">
                @parsedown(get_option('creditnote_footer'))
            </div>
            <div class="text-right page-num">
                <div class="pagenum-container">Page <span class="pagenum"></span></div>
            </div>
        </footer>
    </body>
</html>