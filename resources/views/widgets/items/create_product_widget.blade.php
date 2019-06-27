
<tr class="hidden-print">
	
	<input type="hidden" name="module_id" value="{{ $module_id }}">
	<input type="hidden" name="module" value="{{ $module }}">
	<input type="hidden" name="order" value="{{ $order }}">
	<input type="hidden" name="json" value="false">
	<input id="hidden-item-name" type="hidden" name="name">
	
	<td>
		<input id="auto-item-name" data-scope="{{ $scope }}" type="text" placeholder="@langapp('product')" class="typeahead form-control">
	</td>
	<td>
		<textarea id="auto-item-desc" rows="1" name="description" placeholder="@langapp('description')" class="form-control js-auto-size"></textarea>
	</td>
	<td>
		<input id="auto-quantity" type="text" name="quantity" value="1" class="form-control">
	</td>
	
	<td>
		<input id="auto-unit-cost" type="text" name="unit_cost" value="0.00" class="form-control text-right money" required>
	</td>
	<td>
		<input type="text" name="discount" placeholder="0.00" class="form-control text-right money">
	</td>
	
	<td>{!! renderAjaxButton() !!}</td>
</tr>