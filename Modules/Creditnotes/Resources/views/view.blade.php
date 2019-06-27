@extends('layouts.app')

@section('content')


<section id="content">

    <section class="hbox stretch">
        <aside>


            <section class="vbox">
                <header class="header bg-white b-b clearfix hidden-print">
                    <div class="row m-t-sm">
                        <div class="col-md-12">

                            @can('credits_send')
                        @if ($creditnote->company->email)
                                <a href="{{ route('creditnotes.send', ['id' => $creditnote->id]) }}" data-toggle="ajaxModal"
                                   class="btn btn-sm btn-{{ get_option('theme_color') }} btn-responsive" data-rel="tooltip"
                                   title="@langapp('email')  ">@icon('solid/envelope-open-text') @langapp('send') </a>
                        @endif
                        @endcan

                        @can('credits_update')

                                <a href="{{  route('creditnotes.edit', ['id' => $creditnote->id])  }}"
                                   class="btn btn-sm btn-{{  get_option('theme_color')  }} btn-responsive"
                                   data-original-title="@langapp('make_changes')  "
                                   data-toggle="tooltip" data-placement="bottom">@icon('solid/pencil-alt')
                                </a>

                                <a href="{{ route('items.insert', ['id' => $creditnote->id, 'module' => 'creditnotes'])  }}" title="@langapp('item_quick_add')" class="btn btn-sm btn-{{  get_option('theme_color')  }}" data-toggle="ajaxModal">
                                    @icon('solid/list') @langapp('items')  
                                </a>
                        @endcan


                        

                            <a href="{{  route('creditnotes.activity', ['id' => $creditnote->id]) }}" data-toggle="ajaxModal"
                               class="btn btn-sm btn-{{  get_option('theme_color')  }} btn-responsive" data-rel="tooltip"
                               title="@langapp('activity')  ">@icon('solid/history')</a>

                            <a href="{{  route('creditnotes.comments', ['id' => $creditnote->id]) }}" data-toggle="ajaxModal"
                               class="btn btn-sm btn-{{  get_option('theme_color')  }} btn-responsive" data-rel="tooltip"
                               title="@langapp('comments')  ">@icon('solid/comments')</a>

                        <a href="#aside-files" data-toggle="class:show" class="btn btn-sm btn-default pull-right">@icon('solid/folder-open')</a>


                        @can('credits_delete')

                                <a href="{{ route('creditnotes.delete', ['id' => $creditnote->id]) }}"
                                   class="btn btn-sm btn-danger btn-responsive"
                                   title="@langapp('delete')  " data-toggle="ajaxModal">@icon('solid/trash-alt')
                                </a>

                        @endcan

                                <a href="{{  route('creditnotes.pdf', ['id' => $creditnote->id])  }}"
                                   class="btn btn-sm btn-dark  btn-responsive pull-right">
                                    @icon('solid/file-pdf') PDF 
                                </a>




                        </div>
                    </div>
                </header>


                <section class="scrollable ie-details cr-bg">

                    <div class="slim-scroll" data-color="#333333" data-disable-fade-out="true" data-distance="0" data-height="auto" data-size="3px">

                <div class="wrapper">

                  
                @if ($creditnote->status == 'void')
                        <div class="alert alert-danger hidden-print">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            @icon('solid/exclamation-circle') This Credit Note is marked as VOID
                        </div>

                @endif

                    
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div style="height: {{ get_option('invoice_logo_height') }}px">
                                    <img class="ie-logo img-responsive" src="{{ getStorageUrl(config('system.media_dir').'/'.get_option('invoice_logo')) }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 text-right credit-text">

                                <p class="h4">
                                    <span class="font22">{{ $creditnote->reference_no  }}</span>
                                </p>


                                <div>
                                    @langapp('credit_date')  
                                    <span class="col-xs-4 no-gutter-right pull-right">
                                    <strong>
                                        {{ dateString($creditnote->created_at) }}
                                    </strong>
                                    </span>
                                </div>


                                <div>
                                    @langapp('status')  
                                    <span class="col-xs-4 no-gutter-right pull-right">
                                        <span class="label bg-success">
                                        @langapp($creditnote->status)  
                                        </span>
                                        @if ($creditnote->is_refunded)
                                        <span class="label bg-danger m-l-xs">
                                        @langapp('refunded') 
                                        </span>
                                        @endif
                                    </span>
                                </div>

                                <div>
                                    @langapp('balance')  
                                    <span class="col-xs-4 no-gutter-right pull-right">
                                        <strong>{{  formatCurrency($creditnote->currency, $creditnote->balance) }}</strong></span>
                                </div>

                                @if($creditnote->currency != 'USD')

                                <div>
                                    @langapp('xrate')  
                                    <span class="col-xs-4 no-gutter-right pull-right">
                                        <strong>
                                        1 USD = {{ $creditnote->currency }} {{  $creditnote->exchange_rate  }}
                                        </strong>
                                    </span>
                                </div>

                                @endif

                            </div>
                        </div>
                        <div class="well m-t">
                            <div class="row">

                            @php $data['company'] = $creditnote->company; @endphp

                        @if (get_option('swap_to_from') == 'FALSE')

                                    <div class="col-xs-6">
                                        <strong>@langapp('received_from')  :</strong>
                                        @include('partial.company_address', $data)

                                    
                                    </div>
                        @endif

                                <div class="col-xs-6">
                                    <strong>@langapp('bill_to')  :</strong>
                                    @include('partial.client_address', $data)


                                </div>

                        @if (get_option('swap_to_from') == 'TRUE')

                                    <div class="col-xs-6">
                                        <strong>@langapp('received_from')  :</strong>
                                        @include('partial.company_address', $data)

                                    </div>
                        @endif

                            </div>
                        </div>
                        @php $showtax = settingEnabled('show_creditnote_tax') @endphp
                        <div class="line"></div>
                        <div class="table-responsive">

                {!! Form::open(['url' => '#', 'class' => 'bs-example form-horizontal', 'id' => 'saveItem']) !!}


                        <table id="cr-details" class="table sorted_table small" type="creditnotes">
                            <thead>
                            <tr class="inv-text inv-bg text-uc">
                            <th></th>
                            
                            <th width="20%">@langapp('product')  </th>
                            <th width="25%" class="hidden-xs">@langapp('description')  </th>
                            <th class="text-right" width="10%">@langapp('qty')  </th>
                            @if ($showtax)
                            <th class="text-right" width="10%">@langapp('tax_rate')  </th>
                            @endif
                            <th class="text-right" width="12%">{{ itemUnit() }}</th>
                            <th class="text-right" width="7%">@langapp('disc')  </th>
                            @if ($showtax)
                            <th class="text-right" width="7%">@langapp('tax')  </th>
                            @endif
    
                            <th class="text-right" width="12%">@langapp('total')  </th>
                            
                            <th class="text-right inv-actions"></th>
                        </tr>
                            </thead>
                            <tbody>
                        @foreach ($creditnote->items as $key => $item) 
                        <tr class="sortable" data-id="{{  $item->id  }}" data-name="{{  $item->name  }}" id="item-{{ $item->id }}">
                                    <td class="drag-handle">@icon('solid/bars')</td>
                                    <td>

                        @if (can('credits_update')) 
                        <a href="{{  route('items.edit', ['id' => $item->id]) }}" data-toggle="ajaxModal">
                        {{  $item->name == '' ? '...' : $item->name  }}
                        </a>
                        @else
                            {{  $item->name  }}
                        @endif

                                    </td>
                            <td class="text-muted hidden-xs">@parsedown($item->description)</td>

                            <td class="text-right">{{  formatQuantity($item->quantity) }}</td>
                            @if ($showtax)
                            <td class="text-right">{{  formatTax($item->tax_rate).'%'  }}</td>
                            @endif
                            <td class="text-right">{{ formatCurrency($creditnote->currency, $item->unit_cost) }}</td>

                            <td class="text-right text-dark">
                                {{ $item->discount }}%
                            </td>
                            @if ($showtax) 
                            <td class="text-right text-semibold">{{  formatCurrency($creditnote->currency, $item->tax_total)  }}</td>
                            @endif
                            
                        <td class="text-right text-semibold">{{  formatCurrency($creditnote->currency, $item->total_cost)  }}</td>

                        <td class="text-right">
                                @if(can('credits_update') && $creditnote->isEditable())
                                <a class="hidden-print deleteItem" data-item-id="{{ $item->id }}" href="#">
                                    @icon('solid/trash-alt', 'text-danger')
                                </a>
                                @endif
                            </td>
                                    
                                </tr>
                    @endforeach

                    @if(can('credits_update') && $creditnote->isEditable())

                    @widget('Items\CreateItemWidget', ['module_id' => $creditnote->id, 'module' => 'credits', 'order' => count($creditnote->items) + 1 ])

                    @endif
                            <tr>
                                <td colspan="{{  $showtax ? '8' : '6'  }}" class="text-right no-border">
                                    <strong>@langapp('total')  </strong></td>
                                <td class="text-right">
                                    <span id="cr-subtotal">{{  formatCurrency($creditnote->currency, $creditnote->subTotal())  }}</span>
                                </td>

                                <td></td>
                            </tr>

                        @if ($creditnote->tax() > 0)
                        <tr>
                                    <td colspan="{{  $showtax ? '8' : '6'  }}" class="text-right no-border">
                                        <strong>@langapp('tax')   ({{  formatTax($creditnote->tax)  }}%)</strong></td>
                                    <td class="text-right text-danger">
                                        <span id="cr-tax">{{  formatCurrency($creditnote->currency, $creditnote->tax())  }}</span>
                                    </td>
                                    <td></td>
                                </tr>
                        @endif




                        

                        @if ($creditnote->used > 0) 
                        <tr>
                                    <td colspan="{{  $showtax ? '8' : '6'  }}" class="text-right no-border">
                                        <strong>@langapp('credits_used')  </strong></td>
                                    <td class="text-right text-danger">
                                        <span id="cr-used"> {{  formatCurrency($creditnote->currency, $creditnote->used)  }}</span>
                                    </td>
                                    <td></td>
                        </tr>
                        @endif


                            <tr>
                                <td colspan="{{  $showtax ? '8' : '6'  }}" class="text-right no-border"><strong>
                                        @langapp('balance')  </strong></td>
                                <td class="text-right">
                                     <span id="cr-balance">
                                    {{  formatCurrency($creditnote->currency, $creditnote->balance())  }}
                                    </span>
                                </td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>

                        {!! Form::close() !!}

                        </div>


                        {{-- START INVOICES CREDITED --}}
                        @if($creditnote->used > 0)
                        <div class="m-b-60">
                            <h4>@langapp('invoices_credited')</h4>
                            <table class="table">
                                <tbody>
                                <tr class="text-muted">
                                    <td>@langapp('date')  </td>
                                    <td>@langapp('invoice_code')  #</td>
                                    <td class="tr">@langapp('amount_credited')  </td>
                                    <td></td>
                                </tr>


                        @foreach ($creditnote->credited as $credited) 
                                    <tr class="table-row">
                                        <td>  {{  dateTimeString($credited->created_at)  }} </td>
                                        <td>
                                            <a href="{{  route('invoices.view', ['id' => $credited->invoice->id])  }}">{{  $credited->invoice->reference_no  }}</a>
                                        </td>
                                        <td class="tr">  {{  formatCurrency($credited->credit->currency, $credited->credited_amount)  }}</td>
                                        <td>
                                        <a href="{{  route('creditnotes.remove_credit', ['id' => $credited->id])  }}"
                                               data-toggle="ajaxModal">@icon('solid/trash-alt', 'text-danger')
                                        </a>
                                        </td>
                                    </tr>
                        @endforeach

                                </tbody>
                            </table>
                        </div>
                        @endif

                            @parsedown($creditnote->terms)

                    



</div>
</div>


                </section>
            </section>



        </aside>

        <aside class="aside-lg bg-white b-l hide" id="aside-files">
    <header class="header bg-white b-b b-light">
        @can('files_create')
        <a href="{{  route('files.upload', ['module' => 'credits', 'id' => $creditnote->id])  }}" data-placement="left" data-rel="tooltip" title="Upload" data-toggle="ajaxModal" class="btn btn-sm btn-{{  get_option('theme_color')  }} pull-right">
           @icon('solid/file-upload')
        </a>
        @endcan
        <p>@langapp('files')</p>
    </header>
            <div class="m-xs">
                @include('partial._show_files', ['files' => $creditnote->files, 'limit' => true])
                </div>
              
            </aside>

    </section>



    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>


@push('pagestyle')
<link href="{{ getAsset('plugins/typeahead/typeahead.css') }}" rel="stylesheet" type="text/css">
@include('stacks.css.form')
@endpush


@push('pagescript')
<script src="{{ getAsset('plugins/typeahead/typeahead.jquery.min.js') }}"></script>
@include('stacks.js.form')
@include('stacks.js.markdown')
@include('stacks.js.sortable')
@include('stacks.js.typeahead')
@include('creditnotes::_includes.items_ajax')
@endpush

@endsection
