<table>
    <thead>
    <tr>
        <th>@langapp('name')</th>
        <th>@langapp('company')</th>
        <th>@langapp('job_title')</th>
        <th>@langapp('email')</th>
        <th>@langapp('phone')</th>
        <th>@langapp('mobile')</th>
        <th>@langapp('address')</th>
        <th>@langapp('state')</th>
        <th>@langapp('zipcode')</th>
        <th>@langapp('city')</th>
        <th>@langapp('country')</th>
        <th>@langapp('created_at')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($contacts as $contact)
        <tr>
            <td>{{ $contact->user->name }}</td>
            <td>{{ optional($contact->business)->name }}</td>
            <td>{{ $contact->job_title }}</td>
            <td>{{ $contact->user->email }}</td>
            <td>{{ $contact->phone }}</td>
            <td>{{ $contact->mobile }}</td>
            <td>{{ $contact->address }}</td>
            <td>{{ $contact->state }}</td>
            <td>{{ $contact->zip_code }}</td>
            <td>{{ $contact->city }}</td>
            <td>{{ $contact->country }}</td>
            <td>{{ $contact->created_at->toIso8601String() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>