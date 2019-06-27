<table>
    <thead>
    <tr>
        <th>@langapp('name')</th>
        <th>@langapp('job_title')</th>
        <th>@langapp('company')</th>
        <th>@langapp('source')</th>
        <th>@langapp('lead_score')</th>
        <th>@langapp('stage')</th>
        <th>@langapp('email')</th>
        <th>@langapp('phone')</th>
        <th>@langapp('mobile')</th>
        <th>@langapp('address1')</th>
        <th>@langapp('address2')</th>
        <th>@langapp('city')</th>
        <th>@langapp('state')</th>
        <th>@langapp('zipcode')</th>
        <th>@langapp('country')</th>
        <th>@langapp('timezone')</th>
        <th>@langapp('website')</th>
        <th>Skype</th>
        <th>Facebook</th>
        <th>Twitter</th>
        <th>LinkedIn</th>
        <th>@langapp('sales_rep')</th>
        <th>@langapp('lead_value')</th>
        <th>@langapp('created_at')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($leads as $lead)
        <tr>
            <td>{{ $lead->name }}</td>
            <td>{{ $lead->job_title }}</td>
            <td>{{ $lead->company }}</td>
            <td>{{ $lead->AsSource->name }}</td>
            <td>{{ $lead->score }}</td>
            <td>{{ $lead->status->name }}</td>
            <td>{{ $lead->email }}</td>
            <td>{{ formatPhoneNumber($lead->phone) }}</td>
            <td>{{ $lead->mobile }}</td>
            <td>{{ $lead->address1 }}</td>
            <td>{{ $lead->address2 }}</td>
            <td>{{ $lead->city }}</td>
            <td>{{ $lead->state }}</td>
            <td>{{ $lead->zip_code }}</td>
            <td>{{ $lead->country }}</td>
            <td>{{ $lead->timezone }}</td>
            <td>{{ $lead->website }}</td>
            <td>{{ $lead->skype }}</td>
            <td>{{ $lead->facebook }}</td>
            <td>{{ $lead->twitter }}</td>
            <td>{{ $lead->linkedin }}</td>
            <td>{{ $lead->agent->name }}</td>
            <td>{{ formatCurrency(get_option('default_currency'), $lead->lead_value) }}</td>
            <td>{{ $lead->created_at->toIso8601String() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>