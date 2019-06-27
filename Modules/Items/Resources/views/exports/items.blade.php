<table>
    <thead>
    <tr>
        <th>@langapp('name')</th>
        <th>@langapp('description')</th>
        <th>@langapp('quantity')</th>
        <th>@langapp('currency')</th>
        <th>@langapp('xrate')</th>
        <th>@langapp('unit_price')</th>
        <th>@langapp('discount') (%)</th>
        <th>@langapp('tax_rate') (%)</th>
        <th>@langapp('tax')</th>
        <th>@langapp('sub_total')</th>
        <th>@langapp('created_at')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->description }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->itemable->currency }}</td>
            <td>{{ $item->itemable->exchange_rate }}</td>
            <td>{{ $item->unit_cost }}</td>
            <td>{{ $item->discount }}</td>
            <td>{{ $item->tax_rate }}</td>
            <td>{{ $item->tax_total }}</td>
            <td>{{ $item->total_cost }}</td>
            <td>{{ $item->created_at->toIso8601String() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>