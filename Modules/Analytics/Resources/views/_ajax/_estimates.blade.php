<div class="table-responsive">
    <table id="table-estimates" class="table table-striped">
        <thead>
            <tr>
                <th>@langapp('reference_no') </th>
                <th>@langapp('client') </th>
                <th>@langapp('due_date') </th>
                <th>@langapp('amount') </th>
                <th>@langapp('status') </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($estimates as $estimate)
            
            <tr>
                <td><a href="{{ route('estimates.view', ['id' => $estimate->id]) }}">{{ $estimate->reference_no }}</a></td>
                <td><a href="{{ route('clients.view', ['id' => $estimate->client_id]) }}">{{ optional($estimate->company)->name }}</a></td>
                <td>{{ dateFormatted($estimate->due_date) }}</td>
                <td class="text-semibold">{{ formatCurrency($estimate->currency, $estimate->amount) }}</td>
                <td>{{ $estimate->status }}</td>
                
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
$('#table-estimates').DataTable({
processing: true,
order: [[ 0, "desc" ]],
pageLength: 25
});
</script>
@endpush
@stack('pagestyle')
@stack('pagescript')