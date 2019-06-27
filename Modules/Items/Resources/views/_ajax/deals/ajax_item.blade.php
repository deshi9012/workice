<tr class="sortable" data-id="{{  $item->id  }}" id="item-{{ $item->id }}">
    
    <td>
        @can('deals_update')
        <a href="{{  route('items.edit', ['id' => $item->id])  }}" data-toggle="ajaxModal">
            {{ $item->name == '' ? '...' : $item->name }}
        </a>
        @endcan
    </td>
    <td class="text-muted">@parsedown($item->description)</td>
    <td class="text-right">{{ formatQuantity($item->quantity) }}</td>
    <td class="text-right">{{ formatCurrency($item->itemable->currency, $item->unit_cost) }}</td>
    <td class="text-right">{{ $item->discount }}%</td>
    <td class="text-right text-semibold">{{ formatCurrency($item->itemable->currency, $item->total_cost) }}</td>
    <td class="text-right">
        @can('deals_update')
        <a class="hidden-print deleteItem" href="#" data-item-id="{{ $item->id }}">
            @icon('regular/trash-alt', 'text-danger')
        </a>
        @endcan
    </td>
</tr>