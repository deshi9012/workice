<div class="table-responsive">
	<table id="table-tickets" class="table table-striped">
		<thead>
			<tr>
				<th>@langapp('subject') </th>
				<th>@langapp('reporter') </th>
				<th>@langapp('date') </th>
				<th>@langapp('department')</th>
				<th>@langapp('status') </th>
			</tr>
		</thead>
		<tbody>
			@foreach ($tickets as $ticket)
			<tr>
				<td><a href="{{ route('tickets.view', ['id' => $ticket->id]) }}">{{ str_limit($ticket->subject, 25) }}</a></td>
				<td><a href="{{ route('users.view', ['id' => $ticket->id, 'tab' => 'tickets']) }}">{{ $ticket->user->name }}</a></td>
				<td>{{ dateFormatted($ticket->created_at) }}</td>
				<td>{{ optional($ticket->dept)->deptname }}</td>
				<td>{{ ucfirst($ticket->AsStatus->status) }}</td>
				
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
$('#table-tickets').DataTable({
processing: true,
order: [[ 0, "desc" ]],
pageLength: 25
});
</script>
@endpush
@stack('pagestyle')
@stack('pagescript')