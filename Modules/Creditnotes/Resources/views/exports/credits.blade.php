<table>
    <thead>
    <tr>
        <th>@langapp('reference_no')</th>
        <th>@langapp('status')</th>
        <th>@langapp('company')</th>
        <th>@langapp('currency')</th>
        <th>@langapp('xrate')</th>
        <th>@langapp('tax') (%)</th>
        <th>@langapp('tax')</th>
        <th>@langapp('sub_total')</th>
        <th>@langapp('credits_used')</th>
        <th>@langapp('balance')</th>
        <th>@langapp('created_at')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($credits as $credit)
        <tr>
            <td>{{ $credit->reference_no }}</td>
            <td>{{ ucfirst($credit->status) }}</td>
            <td>{{ $credit->company->name }}</td>
            <td>{{ $credit->currency }}</td>
            <td>{{ $credit->exchange_rate }}</td>
            <td>{{ $credit->tax }}</td>
            <td>{{ $credit->tax() }}</td>
            <td>{{ $credit->amount }}</td>
            <td>{{ $credit->used }}</td>
            <td>{{ $credit->balance }}</td>
            <td>{{ $credit->created_at->toIso8601String() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>