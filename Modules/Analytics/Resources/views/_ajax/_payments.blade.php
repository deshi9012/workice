<div class="table-responsive">
	<table id="table-payments" class="table table-striped">
		<thead>
			<tr>
				<th>@langapp('code')</th>
				<th>@langapp('client') </th>
				<th>@langapp('amount') </th>
				<th>@langapp('payment_method') </th>
				<th>@langapp('invoice') </th>
				<th>@langapp('date') </th>
			</tr>
		</thead>
		<tbody>
			@foreach ($payments as $payment)
			<tr>
				<td><a href="{{ route('payments.view', ['id' => $payment->id]) }}">{{ $payment->code }}</a></td>
				<td><a href="{{ route('clients.view', ['id' => $payment->client_id]) }}">{{ optional($payment->company)->name }}</a></td>
				<td>{{ formatCurrency($payment->currency, $payment->amount) }}</td>
				<td>{{ $payment->paymentMethod->method_name }}</td>
				<td>{{ $payment->AsInvoice->reference_no }}</td>
				<td>{{ dateTimeFormatted($payment->payment_date) }}</td>
				
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
$('#table-payments').DataTable({
processing: true,
order: [[ 0, "desc" ]],
pageLength: 25
});
</script>
@endpush
@stack('pagestyle')
@stack('pagescript')