<table>
    <thead>
    <tr>
        <th>@langapp('code')</th>
        <th>@langapp('name')</th>
        <th>@langapp('email')</th>
        <th>@langapp('contact_person')</th>
        <th>@langapp('contact_email')</th>
        <th>@langapp('phone')</th>
        <th>@langapp('mobile')</th>
        <th>@langapp('address1')</th>
        <th>@langapp('address2')</th>
        <th>@langapp('city')</th>
        <th>@langapp('state')</th>
        <th>@langapp('zipcode')</th>
        <th>@langapp('country')</th>
        <th>@langapp('tax_number')</th>
        <th>@langapp('currency')</th>
        <th>@langapp('expenses')</th>
        <th>@langapp('paid')</th>
        <th>@langapp('balance')</th>
        <th>@langapp('created_at')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($clients as $client)
        <tr>
            <td>{{ $client->code }}</td>
            <td>{{ $client->name }}</td>
            <td>{{ $client->email }}</td>
            <td>{{ optional($client->contact)->name }}</td>
            <td>{{ optional($client->contact)->email }}</td>
            <td>{{ $client->phone }}</td>
            <td>{{ $client->mobile }}</td>
            <td>{{ $client->address1 }}</td>
            <td>{{ $client->address2 }}</td>
            <td>{{ $client->city }}</td>
            <td>{{ $client->state }}</td>
            <td>{{ $client->zip_code }}</td>
            <td>{{ $client->country }}</td>
            <td>{{ $client->tax_number }}</td>
            <td>{{ $client->currency }}</td>
            <td>{{ formatCurrency($client->currency, $client->expense) }}</td>
            <td>{{ formatCurrency($client->currency, $client->paid) }}</td>
            <td>{{ formatCurrency($client->currency, $client->balance) }}</td>
            <td>{{ $client->created_at->toIso8601String() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>