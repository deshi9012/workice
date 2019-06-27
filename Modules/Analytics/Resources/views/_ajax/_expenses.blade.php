<div class="table-responsive">
    <table id="table-expenses" class="table table-striped">
        <thead>
            <tr>
                <th>@langapp('code') </th>
                <th>@langapp('client') </th>
                <th>@langapp('amount') </th>
                <th>@langapp('category') </th>
                <th>@langapp('date') </th>
                <th>@langapp('status') </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expenses as $expense)
            <tr>
                <td><a href="{{ route('expenses.view', ['id' => $expense->id]) }}">{{ $expense->code }}</a></td>
                <td><a href="{{ route('clients.view', ['id' => $expense->client_id]) }}">{{ optional($expense->company)->name }}</a></td>
                <td>{{ $expense->amount_formatted }}</td>
                <td>{{ $expense->AsCategory->name }}</td>
                <td>{{ dateFormatted($expense->expense_date) }}</td>
                <td>{{ $expense->invoiced ? langapp('billed') : langapp('unbilled') }}</td>
                
            </tr>
            
            @endforeach
        </tbody>
    </table>
</div>
@push('pagestyle')
@include('stacks.css.datatables')
@endpush
@push('pagescript')
@include('stacks.js.datatables')
<script>
$('#table-expenses').DataTable({
processing: true,
order: [[ 0, "desc" ]],
pageLength: 25
});
</script>
@endpush
@stack('pagestyle')
@stack('pagescript')