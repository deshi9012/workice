<div class="table-responsive">
    <table id="table-invoices" class="table table-striped">
        <thead>
            <tr>
                <th>@langapp('reference_no') </th>
                <th>@langapp('client') </th>
                <th>@langapp('due_date') </th>
                <th>@langapp('paid') </th>
                <th>@langapp('status') </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
            <tr>
                <td><a href="{{ route('invoices.view', ['id' => $invoice->id]) }}">{{ $invoice->reference_no }}</a></td>
                <td><a href="{{ route('clients.view', ['id' => $invoice->client_id]) }}">{{ optional($invoice->company)->name }}</a></td>
                <td>{{ dateFormatted($invoice->due_date) }}</td>
                <td>{{ formatCurrency($invoice->currency, $invoice->paid_amount) }}</td>
                <td>{{ $invoice->status }}</td>
                
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
$('#table-invoices').DataTable({
processing: true,
order: [[ 0, "desc" ]],
pageLength: 25
});
</script>
@endpush
@stack('pagestyle')
@stack('pagescript')