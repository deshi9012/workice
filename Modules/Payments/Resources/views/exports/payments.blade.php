<table>
    <thead>
    <tr>
        <th>@langapp('code')</th>
        <th>@langapp('currency')</th>
        <th>@langapp('xrate')</th>
        <th>@langapp('amount')</th>
        <th>@langapp('company')</th>
        <th>@langapp('invoice')</th>
        <th>@langapp('payment_method')</th>
        <th>@langapp('refunded')</th>
        <th>@langapp('created_at')</th>
        <th>@langapp('notes')</th>
        
    </tr>
    </thead>
    <tbody>
    @foreach($payments as $payment)
        <tr>
            <td>{{ $payment->code }}</td>
            <td>{{ $payment->currency }}</td>
            <td>{{ $payment->exchange_rate }}</td>
            <td>{{ $payment->amount }}</td>
            <td>{{ $payment->company->name }}</td>
            <td>{{ $payment->AsInvoice->reference_no }}</td>
            <td>{{ $payment->paymentMethod->method_name }}</td>
            <td>{{ $payment->is_refunded === 1 ? langapp('yes') : langapp('no') }}</td>
            <td>{{ $payment->payment_date->toIso8601String() }}</td>
            <td>{{ $payment->notes }}</td>
            
        </tr>
    @endforeach
    </tbody>
</table>