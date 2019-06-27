<tr class="sortable" data-id="{{  $item->id  }}" data-name="{{  $item->name  }}" id="item-{{ $item->id }}">
    <td class="drag-handle">
        @icon('solid/bars')
    </td>
    <td>
        @if(can('invoices_update')  && $item->itemable->isEditable())
        <a data-toggle="ajaxModal" href="{{  route('items.edit', ['id' => $item->id])  }}">
            {{  $item->name == '' ? '...' : $item->name  }}
        </a>
        @else
        {{  $item->name  }}
        @endif
    </td>
    <td class="text-muted">
        @parsedown($item->description)
    </td>
    <td class="text-right">
        {{  formatQuantity($item->quantity) }}
    </td>
    @if (settingEnabled('show_invoice_tax'))
    <td class="text-right">
        {{  formatTax($item->tax_rate).'%'  }}
    </td>
    @endif
    <td class="text-right">
        {{  formatCurrency($item->itemable->currency, $item->unit_cost) }}
    </td>
    <td class="text-right">
        {{ $item->discount }}%
    </td>
    <td class="text-right">
        {{  formatCurrency($item->itemable->currency, $item->total_cost) }}
    </td>
    <td class="text-right">
        @if(can('invoices_update')  && $item->itemable->isEditable())
        <a class="hidden-print deleteItem" data-item-id="{{ $item->id }}" href="#">
            @icon('solid/trash-alt', 'text-danger')
        </a>
        @endif
    </td>
</tr>