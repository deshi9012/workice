<table>
    <thead>
    <tr>
        <th>@langapp('code')</th>
        <th>@langapp('category')</th>
        <th>@langapp('client')</th>
        <th>@langapp('project')</th>
        <th>@langapp('currency')</th>
        <th>@langapp('xrate')</th>
        <th>@langapp('tax')</th>
        <th>{{ get_option('tax1Label') }}</th>
        <th>@langapp('tax2')</th>
        <th>{{ get_option('tax2Label') }}</th>
        <th>@langapp('billable')</th>
        <th>@langapp('invoiced')</th>
        <th>@langapp('user')</th>
        <th>@langapp('recurring')</th>
        <th>@langapp('frequency') (days)</th>
        <th>@langapp('recur_starts')</th>
        <th>@langapp('recur_next_date')</th>
        <th>@langapp('recur_ends')</th>
        <th>@langapp('amount')</th>
        <th>@langapp('cost')</th>
        <th>@langapp('notes')</th>
        <th>@langapp('expense_date')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($expenses as $expense)
        <tr>
            <td>{{ $expense->code }}</td>
            <td>{{ $expense->AsCategory->name }}</td>
            <td>{{ $expense->company->name }}</td>
            <td>{{  $expense->project_id === 0 ? 'N/A' : $expense->AsProject->name }}</td>
            <td>{{ $expense->currency }}</td>
            <td>{{ $expense->exchange_rate }}</td>
            <td>{{ $expense->tax }}</td>
            <td>{{ $expense->tax1Amount() }}</td>
            <td>{{ $expense->tax2 }}</td>
            <td>{{ $expense->tax2Amount() }}</td>
            <td>{{ $expense->billable === 1 ? 'true' : 'false' }}</td>
            <td>{{ $expense->invoiced === 1 ? 'true' : 'false' }}</td>
            <td>{{ $expense->user->name }}</td>
            <td>{{ $expense->is_recurring === 1 ? 'true' : 'false' }}</td>
            <td>{{ $expense->frequency }}</td>
            <td>{{ !is_null($expense->recur_starts) ? dateIso8601String($expense->recur_starts) : '' }}</td>
            <td>{{ !is_null($expense->recur_next_date) ? dateIso8601String($expense->recur_next_date) : '' }}</td>
            <td>{{ !is_null($expense->recur_ends) ? dateIso8601String($expense->recur_ends) : '' }}</td>
            <td>{{ $expense->amount }}</td>
            <td>{{ $expense->cost }}</td>
            <td>{{ $expense->notes }}</td>
            <td>{{ dateIso8601String($expense->expense_date) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>