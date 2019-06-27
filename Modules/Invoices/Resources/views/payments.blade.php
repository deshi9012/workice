@extends('layouts.app')
@section('content')
<section id="content">
    <section class="hbox stretch">
        
        <aside>
            <section class="vbox">
                <header class="header bg-white b-b clearfix hidden-print">
            <div class="row m-t-sm">
                <div class="col-md-8">
                            <a href="{{ route('invoices.view', ['id' => $invoice->id])  }}" class="btn btn-sm btn-{{ get_option('theme_color') }}" data-rel="tooltip" title="Back to Invoice" data-placement="bottom" >
                                @icon('solid/file-invoice-dollar') @langapp('invoice')
                            </a>
                        </div>
                        
                    </div>
                </header>

                <section class="scrollable wrapper bg">
                    
                
                    <section class="panel panel-default">

                <header class="panel-heading">
                  @langapp('invoice') {{ $invoice->reference_no }} @langapp('payments')
                </header>
                            
                            <div class="table-responsive">
                                <table id="table-payments" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="hide display-none">ID</th>
                                            <th class="col-options no-sort  col-sm-2">@langapp('code')</th>
                                            <th class="col-sm-3">@langapp('client')</th>
                                            <th class="col-date col-sm-2">@langapp('payment_date')</th>
                                            <th class="col-currency col-sm-2">@langapp('amount')</th>
                                            <th class="col-sm-2">@langapp('payment_method')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoice->payments as $key => $payment)
                                        <tr>
                                            <td class="display-none">{{ $payment->id }}</td>
                                            <td>
                                                <a href="{{  route('payments.view', ['id' => $payment->id])  }}"
                                                    class=" text-info">{{  $payment->code  }}
                                                </a>
                                            </td>
                                            <td>{{ $payment->company->name  }}</td>
                                            <td>{{  dateFormatted($payment->payment_date)  }}</td>
                                            <td class="col-currency">
                                                {{  formatCurrency($invoice->currency, $payment->amount)  }}
                                            </td>
                                            <td>
                                                {{ $payment->paymentMethod->method_name }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        
                    </section>
                </section>

            </section>
        </aside>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a></section>
    

@push('pagestyle')
    @include('stacks.css.datatables')
@endpush

    @push('pagescript')
    @include('stacks.js.datatables')
    
    <script>
    $(function() {
    $('#table-payments').DataTable({
        processing: true,
        order: [[ 0, "desc" ]],
    });
    });
    </script>
    @endpush
    @endsection