<div class="table-responsive">
	<table id="table-credits" class="table table-striped">
		<thead>
			<tr>
				<th>@langapp('reference_no') </th>
				<th>@langapp('client') </th>
				<th>@langapp('balance') </th>
				<th>@langapp('sent') </th>
				<th>@langapp('status') </th>
			</tr>
		</thead>
		<tbody>
			@foreach ($credits as $creditnote)
			
			<tr>
				<td><a href="{{ route('creditnotes.view', ['id' => $creditnote->id]) }}">{{ $creditnote->reference_no }}</a></td>
				<td><a href="{{ route('clients.view', ['id' => $creditnote->client_id]) }}">{{ optional($creditnote->company)->name }}</a></td>
				<td class="text-semibold">{{ formatCurrency($creditnote->currency, $creditnote->balance) }}</td>
				<td>{{ !is_null($creditnote->sent_at) ? langapp('yes') : langapp('no') }}</td>
				<td>{{ ucfirst($creditnote->status) }}</td>
				
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
$('#table-credits').DataTable({
processing: true,
order: [[ 0, "desc" ]],
pageLength: 25
});
</script>
@endpush
@stack('pagestyle')
@stack('pagescript')