<table>
    <thead>
    <tr>
        <th>@langapp('title')</th>
        <th>@langapp('reference_no')</th>
        <th>@langapp('due_date')</th>
        <th>@langapp('status')</th>
        <th>@langapp('company')</th>
        <th>@langapp('company_email')</th>
        <th>@langapp('discount')</th>
        <th>@langapp('discount_percent')</th>
        <th>@langapp('tax') (%)</th>
        <th>@langapp('tax2') (%)</th>
        <th>@langapp('currency')</th>
        <th>@langapp('xrate')</th>
        <th>@langapp('discount')</th>
        <th>{{ get_option('tax1Label') }}</th>
        <th>{{ get_option('tax2Label') }}</th>
        <th>@langapp('payable')</th>
        <th>@langapp('balance')</th>
        <th>@langapp('created_at')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($invoices as $invoice)
        <tr>
            <td>{{ $invoice->title }}</td>
            <td>{{ $invoice->reference_no }}</td>
            <td>{{ $invoice->due_date->toIso8601String() }}</td>
            <td>{{ $invoice->status }}</td>
            <td>{{ $invoice->company->name }}</td>
            <td>{{ $invoice->company->email }}</td>
            <td>{{ $invoice->discount }}</td>
            <td>{{ $invoice->discount_percent === 1 ? langapp('yes') : langapp('no') }}</td>
            <td>{{ $invoice->tax }}</td>
            <td>{{ $invoice->tax2 }}</td>
            <td>{{ $invoice->currency }}</td>
            <td>{{ $invoice->exchange_rate }}</td>
            <td>{{ $invoice->discounted() }}</td>
            <td>{{ round($invoice->tax1Amount(), get_option('tax_decimals')) }}</td>
            <td>{{ round($invoice->tax2Amount(), get_option('tax_decimals')) }}</td>
            <td>{{ $invoice->payable }}</td>
            <td>{{ $invoice->balance }}</td>
            <td>{{ $invoice->created_at->toIso8601String() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>