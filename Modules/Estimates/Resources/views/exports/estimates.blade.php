<table>
    <thead>
    <tr>
        <th>@langapp('title')</th>
        <th>@langapp('reference_no')</th>
        <th>@langapp('due_date')</th>
        <th>@langapp('status')</th>
        <th>@langapp('company')</th>
        <th>@langapp('discount')</th>
        <th>@langapp('discount_percent')</th>
        <th>@langapp('tax') (%)</th>
        <th>@langapp('tax2') (%)</th>
        <th>@langapp('currency')</th>
        <th>@langapp('xrate')</th>
        <th>@langapp('discount')</th>
        <th>@langapp('tax')</th>
        <th>@langapp('tax2')</th>
        <th>@langapp('sub_total')</th>
        <th>@langapp('amount')</th>
        <th>@langapp('created_at')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($estimates as $estimate)
        <tr>
            <td>{{ $estimate->title }}</td>
            <td>{{ $estimate->reference_no }}</td>
            <td>{{ $estimate->due_date->toIso8601String() }}</td>
            <td>{{ $estimate->status }}</td>
            <td>{{ $estimate->company->name }}</td>
            <td>{{ $estimate->discount }}</td>
            <td>{{ $estimate->discount_percent === 1 ? langapp('yes') : langapp('no') }}</td>
            <td>{{ $estimate->tax }}</td>
            <td>{{ $estimate->tax2 }}</td>
            <td>{{ $estimate->currency }}</td>
            <td>{{ $estimate->exchange_rate }}</td>
            <td>{{ $estimate->discounted }}</td>
            <td>{{ round($estimate->tax1Amount(), get_option('tax_decimals')) }}</td>
            <td>{{ round($estimate->tax2Amount(), get_option('tax_decimals')) }}</td>
            <td>{{ $estimate->subTotal() }}</td>
            <td>{{ $estimate->amount }}</td>
            <td>{{ $estimate->created_at->toIso8601String() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>