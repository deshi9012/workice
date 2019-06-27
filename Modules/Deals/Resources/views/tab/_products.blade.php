<section class="">
    
    <div class="table-responsive">
        {!! Form::open(['url' => '#', 'class' => 'bs-example form-horizontal', 'id' => 'saveItem']) !!}
        <table id="deals-products" class="table sorted_table" type="deals">
            <thead>
                <tr class="inv-text inv-bg text-uc">
                    <th width="25%">@langapp('name')</th>
                    <th width="35%">@langapp('description')</th>
                    <th class="text-right" width="7%">@langapp('qty')</th>
                    <th class="text-right" width="12%">@langapp('unit_price')</th>
                    <th class="text-right" width="7%">@langapp('disc')</th>
                    <th class="text-right" width="12%">@langapp('total')</th>
                    <th class="text-right inv-actions"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deal->items as $key => $item)
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
                    
                    <td class="text-right">{{ formatCurrency($deal->currency, $item->unit_cost) }}</td>
                    <td class="text-right">{{ $item->discount }}%</td>
                    <td class="text-right text-dark">{{ formatCurrency($deal->currency, $item->total_cost) }}</td>
                    <td class="text-right">
                        @can('deals_update')
                        <a class="hidden-print deleteItem" href="#" data-item-id="{{ $item->id }}">
                            @icon('regular/trash-alt', 'text-danger')
                        </a>
                        @endcan
                    </td>
                </tr>
                @endforeach
                @can('deals_update')
                
                @widget('Items\CreateProductWidget', ['module_id' => $deal->id, 'module' => 'deals', 'order' => count($deal->items) + 1 ])
                @endif
                <tr>
                    <td colspan="5" class="text-right no-border">
                        <strong>@langapp('deal_value')</strong>
                    </td>
                    <td class="text-right">
                        <span id="deal_value">
                            {{ formatCurrency($deal->currency, $deal->deal_value) }}
                        </span>
                    </td>
                    <td></td>
                </tr>
                
                
                
            </tbody>
        </table>
        {!! Form::close() !!}
        
    </div>
    
    
    
    @push('pagestyle')
    <link href="{{ getAsset('plugins/typeahead/typeahead.css') }}" rel="stylesheet" type="text/css">
    @include('stacks.css.form')
    @endpush
    @push('pagescript')
    <script src="{{ getAsset('plugins/typeahead/typeahead.jquery.min.js') }}"></script>
    @include('stacks.js.typeahead')
    @include('stacks.js.form')
    @include('deals::_includes.items_ajax')
    @endpush
</section>