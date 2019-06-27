<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header bg-danger">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">@langapp('recurring') #{{ $invoice->reference_no }}</h4>
		</div>
		<div class="modal-body">
			<div class="">
				<table class="table m-b-none">
					<thead>
						
						<th>@langapp('invoice')</th>
						<th>@langapp('balance')</th>
						<th>@langapp('date')</th>
						
					</thead>
					<tbody>
						@foreach ($invoice->children as $child)
						<tr>
							<td>
								<a href="{{ route('invoices.view', ['id' => $child->id]) }}">{{ $child->name }}</a>
							</td>
							<td>
								{{ formatCurrency($child->currency, $child->balance) }}
							</td>
							<td>
								{{ dateTimeFormatted($child->created_at) }}
							</td>
						</tr>
						@endforeach
						
						
					</tbody>
				</table>
				
			</div>
		</div>
		
	</div>
</div>
</div>