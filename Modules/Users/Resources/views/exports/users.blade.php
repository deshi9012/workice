<table>
    <thead>
    <tr>
        <th>@langapp('name')</th>
        <th>@langapp('email')</th>
        <th>@langapp('job_title')</th>
        <th>@langapp('company')</th>
        <th>@langapp('city')</th>
        <th>@langapp('country')</th>
        <th>@langapp('phone')</th>
        <th>@langapp('mobile')</th>
        <th>@langapp('hourly_rate')</th>
        <th>@langapp('last_login')</th>
        <th>@langapp('created_at')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->profile->job_title }}</td>
            <td>{{ optional($user->profile->business)->name }}</td>
            <td>{{ $user->profile->city }}</td>
            <td>{{ $user->profile->country }}</td>
            <td>{{ $user->profile->phone }}</td>
            <td>{{ $user->profile->mobile }}</td>
            <td>{{ $user->profile->hourly_rate }}</td>
            <td>{{ $user->last_login }}</td>
            <td>{{ $user->created_at->toIso8601String() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>