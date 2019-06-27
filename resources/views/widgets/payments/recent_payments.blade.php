<section class="panel panel-default">
        <header class="panel-heading font-bold">@langapp('payments')</header>

<div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>@langapp('date') </th>
                    <th>@langapp('client') </th>
                    <th>@langapp('invoice') </th>
                    <th>@langapp('payment_method') </th>
                    <th>@langapp('amount') </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments->take(15) as $payment)

                <tr>
                        <td><a href="{{ route('payments.view', ['id' => $payment->id]) }}">{{ dateFormatted($payment->payment_date) }}</a></td>
                        <td><a href="{{ route('clients.view', ['id' => $payment->client_id]) }}">{{ $payment->company->name }}</a></td>
                        <td><a href="{{ route('invoices.view', ['id' => $payment->invoice]) }}">{{ $payment->AsInvoice->reference_no }}</a></td>
                        <td><span class="badge bg-default">{{ $payment->paymentMethod->method_name }}</span></td>
                        <td class="text-semibold">{{ formatCurrency($payment->currency, $payment->amount) }}</td>
                    </tr>
                    
                @endforeach
                
               
            </tbody>
        </table>
    </div>

</section>