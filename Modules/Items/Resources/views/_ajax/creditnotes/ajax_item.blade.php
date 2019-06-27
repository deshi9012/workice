<tr class="sortable" data-name="{{  $item->name  }}"
    data-id="{{  $item->id  }}">
    <td class="drag-handle">@icon('solid/bars')</td>
    <td>
        @if (can('credits_update') && $item->itemable->isEditable())
        <a href="{{  route('items.edit', ['id' => $item->id]) }}"
            data-toggle="ajaxModal">
            {{  $item->name == '' ? '...' : $item->name  }}
        </a>
        @else
        {{  $item->name  }}
        @endif
    </td>
    <td class="text-muted">@parsedown($item->description)</td>
    <td class="text-right">{{  formatQuantity($item->quantity) }}</td>
    @if (settingEnabled('show_creditnote_tax'))
    <td class="text-right">{{  formatTax($item->tax_rate).'%'  }}</td>
    @endif
    <td class="text-right">{{ formatCurrency($item->itemable->currency, $item->unit_cost) }}</td>
    <td class="text-right">{{ $item->discount }}%</td>
    @if (settingEnabled('show_creditnote_tax'))
    <td class="text-right">{{  formatCurrency($item->itemable->currency, $item->tax_total)  }}</td>
    @endif
    <td class="text-right">{{  formatCurrency($item->itemable->currency, $item->total_cost)  }}</td>
    <td class="text-right">
        @if (can('credits_update') && $item->itemable->isEditable())
        <a class="hidden-print" href="{{  route('items.delete', ['id' => $item->id])  }}"
            data-toggle="ajaxModal">@icon('solid/trash-alt', 'text-danger')
        </a>
        @endif
    </td>
</tr>