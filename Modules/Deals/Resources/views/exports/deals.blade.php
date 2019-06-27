<table>
    <thead>
    <tr>
        <th>@langapp('title')</th>
        <th>@langapp('stage')</th>
        <th>@langapp('currency')</th>
        <th>@langapp('deal_value')</th>
        <th>@langapp('contact_person')</th>
        <th>@langapp('organization')</th>
        <th>@langapp('user')</th>
        <th>@langapp('due_date')</th>
        <th>@langapp('status')</th>
        <th>@langapp('source')</th>
        <th>@langapp('pipeline')</th>
        <th>@langapp('propability') (%)</th>
        <th>@langapp('won_time')</th>
        <th>@langapp('lost_time')</th>
        <th>@langapp('lost_reason')</th>
        <th>@langapp('done') (%)</th>
        <th>@langapp('created_at')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($deals as $deal)
        <tr>
            <td>{{ $deal->title }}</td>
            <td>{{ optional($deal->category)->name }}</td>
            <td>{{ $deal->currency }}</td>
            <td>{{ $deal->computed_value }}</td>
            <td>{{ optional($deal->contact)->name }}</td>
            <td>{{ optional($deal->company)->name }}</td>
            <td>{{ optional($deal->user)->name }}</td>
            <td>{{ $deal->due_date->toIso8601String() }}</td>
            <td>{{ $deal->status }}</td>
            <td>{{ $deal->AsSource->name }}</td>
            <td>{{ $deal->pipe->name }}</td>
            <td>{{ $deal->propability }}</td>
            <td>{{ is_null($deal->won_time) ? '' : dateIso8601String($deal->won_time) }}</td>
            <td>{{ is_null($deal->lost_time) ? '' : dateIso8601String($deal->lost_time) }}</td>
            <td>{{ $deal->lost_reason }}</td>
            <td>{{ $deal->doneTasks() }}</td>
            <td>{{ $deal->created_at->toIso8601String() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>