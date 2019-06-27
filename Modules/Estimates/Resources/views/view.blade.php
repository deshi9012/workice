@extends('layouts.app')

@section('content')

<section id="content">

    <section class="hbox stretch">
        <aside>

    
    <section class="vbox">
        <header class="header bg-white b-b clearfix hidden-print">
            <div class="row m-t-sm">
                <div class="col-md-8 m-b-xs">
                    
                    
                    
                    @can('estimates_send')
                    <a data-toggle="ajaxModal" class="btn btn-sm btn-{{ get_option('theme_color') }}" href="{{ route('estimates.send', ['id' => $estimate->id]) }}">
                       @icon('solid/envelope-open-text') @langapp('send')  
                    </a>
                    @endif
                    @can('invoices_create')
                    @if($estimate->status === 'Accepted' && is_null($estimate->invoiced_at))
                    <a class="btn btn-sm btn-{{ get_option('theme_color') }} {{ ($estimate->client_id == '0') ? 'disabled' : '' }}" data-rel="tooltip" data-placement="bottom" data-toggle="ajaxModal" href="{{  route('estimates.convert', ['id' => $estimate->id])  }}" title="@langapp('convert_to_invoice')  ">
                        @icon('solid/file-invoice-dollar')
                    </a>
                    @endif
                    @endcan
                    @can('estimates_update')
                    @if ($estimate->is_visible)
                    <a class="btn btn-sm btn-{{ get_option('theme_color') }}" data-placement="bottom" data-title="@langapp('hide_to_client')  " data-toggle="tooltip" href="{{  route('estimates.hide', ['id' => $estimate->id])  }}">
                        @icon('solid/eye-slash')
                    </a>
                    @else
                    <a class="btn btn-sm btn-dark" data-placement="bottom" data-title="@langapp('show_to_client')  " data-toggle="tooltip" href="{{  route('estimates.show', ['id' => $estimate->id])  }}">
                        @icon('solid/eye')
                    </a>
                    @endif
                    @endcan
                    <a class="btn btn-sm btn-{{ get_option('theme_color') }} btn-responsive" data-placement="bottom" data-rel="tooltip" data-toggle="ajaxModal" href="{{  route('estimates.activity', ['id' => $estimate->id])  }}" title="@langapp('activity')  ">
                        @icon('solid/history')
                    </a>
                    @can('reminders_create')
                    <a class="btn btn-sm btn-{{ get_option('theme_color') }}" data-toggle="ajaxModal" data-rel="tooltip"  data-placement="bottom" href="{{  route('calendar.reminder', ['module' => 'estimates', 'id' => $estimate->id])  }}" title="@langapp('set_reminder')  ">
                        @icon('solid/clock')
                    </a>
                    @endcan

                    @can('estimates_comment')
                    <a class="btn btn-sm btn-{{ get_option('theme_color') }}" data-toggle="ajaxModal" data-rel="tooltip"  data-placement="bottom" href="{{  route('estimates.comments', ['id' => $estimate->id])  }}" title="@langapp('comments')  ">
                        @icon('solid/comments')
                    </a>
                    @endcan
                    @if ($estimate->client_id != \Auth::user()->profile->company)
                    <div class="btn-group">
                        <button class="btn btn-sm btn-{{ get_option('theme_color') }} dropdown-toggle" data-toggle="dropdown">
                        @langapp('more_actions') 
                        <span class="caret">
                        </span>
                        </button>
                        <ul class="dropdown-menu">
                            @can('estimates_update')
                            <li>
                                <a href="{{ route('estimates.edit', ['id' => $estimate->id]) }}">
                                    @langapp('edit')  
                                </a>
                            </li>
                            <li>
                                <a href="{{  route('items.insert', ['id' => $estimate->id, 'module' => 'estimates'])  }}" data-toggle="ajaxModal" data-rel="tooltip"  data-placement="bottom" title="From Templates">
                                    @langapp('items') 
                                </a>
                            </li>
                            @endcan
                            @can('estimates_create')
                            <li>
                                <a href="{{ route('estimates.duplicate', ['id' => $estimate->id]) }}" data-toggle="ajaxModal">
                                    @langapp('copy')  
                                </a>
                            </li>
                            @endcan

                            
                            
                            @if ($estimate->status != 'Declined')
                            <li>
                                <a data-toggle="ajaxModal" href="{{ route('estimates.declined', ['id' => $estimate->id]) }}">
                                    @langapp('mark_as_declined')  
                                </a>
                            </li>
                            @endif
                            @if ($estimate->status != 'Accepted')
                            <li>
                                <a href="{{  route('estimates.accepted', ['id' => $estimate->id])  }}" {!! settingEnabled('estimate_to_project') ? 'title="A new project will be created" data-rel="tooltip"' : '' !!}  >
                                    @langapp('mark_as_accepted')  
                                </a>
                            </li>
                            @endif

                            @if ($estimate->status == 'Accepted')
                            <li>
                                <a href="{{  route('estimates.project', ['id' => $estimate->id])  }}" data-toggle="ajaxModal" title="Convert estimate to project" data-rel="tooltip">
                                    @langapp('convert_to_project')  
                                </a>
                            </li>
                            @endif

                            @can('estimates_delete')
                            <li class="divider">
                            </li>
                            <li>
                                <a data-toggle="ajaxModal" href="{{ route('estimates.delete', ['id' => $estimate->id]) }}">
                                    @langapp('delete') 
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                    @else
                    @php $active_button = ($estimate->status == 'Pending') ? null : 'disabled'; @endphp
                    <a class="btn btn-sm btn-success {{ $active_button }}" href="{{ route('estimates.accepted', $estimate->id) }}">
                        @langapp('mark_as_accepted') 
                    </a>
                    <a class="btn btn-sm btn-danger {{ $active_button }}" href="{{ route('estimates.declined', $estimate->id) }}" data-toggle="ajaxModal">
                        @langapp('mark_as_declined') 
                    </a>
                    @endif
                </div>
                <div class="col-md-4 m-b-xs">

                    <a href="#aside-files" data-toggle="class:show" class="btn btn-sm btn-default pull-right">@icon('solid/folder-open')</a>

                    <a class="btn btn-sm btn-dark pull-right" href="{{  route('estimates.pdf', ['id' => $estimate->id])  }}">
                        @icon('solid/file-pdf') PDF
                    </a>
                    @can('estimates_update')
                    <a class="btn btn-sm btn-default pull-right" data-placement="bottom" data-rel="tooltip" data-toggle="ajaxModal" href="{{  route('estimates.share', $estimate->id)  }}" title="Share Estimate">
                        @icon('solid/share-alt')
                    </a>
                    @endcan
                </div>
            </div>
        </header>
        <section class="scrollable ie-details bg">


<div class="slim-scroll" data-color="#333333" data-disable-fade-out="true" data-distance="0" data-height="auto" data-size="3px">

                <div class="wrapper">


            @if (strtotime($estimate->due_date) < time() && $estimate->status == 'Pending')
            <div class="alert alert-danger hidden-print">
                <button class="close" data-dismiss="alert" type="button">×</button>
                @icon('solid/calendar-times')
                @langapp('estimate_overdue')  
            </div>
            @endif
            @if(!is_null($estimate->invoiced_at))
            <div class="alert alert-info hidden-print">
                <button class="close" data-dismiss="alert" type="button">
                ×
                </button>
                @icon('solid/check-circle')
                Estimate {{ $estimate->reference_no }} has been
                <a href="{{ route('invoices.view', ['id' => $estimate->invoiced_id]) }}">
                    Invoiced.
                </a>
            </div>
            @endif
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div style="height: {{ get_option('invoice_logo_height') }}px">
                        <img class="ie-logo img-responsive" src="{{ getStorageUrl(config('system.media_dir').'/'.get_option('invoice_logo')) }}">
                    </div>
                </div>
                <div class="col-md-6 col-xs-12 text-right">
                    <span class="inv-text font22">
                        {{ $estimate->reference_no }}
                    </span>
                    <span class="text-muted">
                        {!! $estimate->isDraft() ? '
                        <span class="label label-danger">
                            Draft
                        </span>
                        ' : '' !!}
                    </span>
                    <div>
                        @langapp('estimate_date')  
                        <span class="col-xs-4 no-gutter-right pull-right">
                            <strong>
                            {{  dateString($estimate->created_at) }}
                            </strong>
                        </span>
                    </div>
                    <div>
                        @langapp('valid_until')  
                        <span class="col-xs-4 no-gutter-right pull-right">
                            <strong>
                            {{  dateString($estimate->due_date) }}
                            </strong>
                        </span>
                    </div>
                    <div>
                        @langapp('status')  
                        <span class="col-xs-4 no-gutter-right pull-right">
                            <span class="label bg-success">
                                {{  $estimate->status  }}
                            </span>
                        </span>
                    </div>
                    @if($estimate->status == 'Declined')
                    <div>
                        @langapp('decline')
                        <span class="col-xs-4 no-gutter-right pull-right">
                            <span class="text-danger">
                                {{  dateTimeFormatted($estimate->rejected_time)  }}
                            </span>
                        </span>
                    </div>
                    @endif
                    @if($estimate->currency != 'USD')
                    <div>
                        @langapp('xrate')  
                        <span class="col-xs-4 no-gutter-right pull-right">
                            <strong>
                            1 USD = {{ $estimate->currency }} {{ $estimate->exchange_rate }}
                            </strong>
                        </span>
                    </div>
                    @endif
                </div>
            </div>
            @php $data['company'] = $estimate->company; @endphp
            <div class="well m-t">
                <div class="row">
                    @if (get_option('swap_to_from') == 'FALSE')
                    <div class="col-xs-6">
                        <strong>
                        @langapp('received_from')  :
                        </strong>
                        @include('partial.company_address', $data)
                    </div>
                    @endif
                    <div class="col-xs-6">
                        <strong>
                        @langapp('bill_to')  :
                        </strong>
                        @include('partial.client_address', $data)
                    </div>
                    @if (get_option('swap_to_from') == 'TRUE')
                    <div class="col-xs-6">
                        <strong>
                        @langapp('received_from')  :
                        </strong>
                        @include('partial.company_address', $data)
                    </div>
                    @endif
                </div>
            </div>
            @php $showtax = settingEnabled('show_estimate_tax') @endphp
            <div class="line"></div>
            <div class="table-responsive">

                {!! Form::open(['url' => '#', 'class' => 'bs-example form-horizontal', 'id' => 'saveItem']) !!}


                <table class="table sorted_table small" id="est-details" type="estimates">
                    <thead>
                        <tr class="est-text est-bg text-uc">
                            <th></th>
                            @if ($showtax)
                            <th width="20%">@langapp('product')</th>
                            <th width="25%" class="hidden-xs">@langapp('description')</th>
                            <th class="text-right" width="10%">@langapp('qty')</th>
                            <th class="text-right" width="10%">@langapp('tax_rate')</th>
                            <th class="text-right" width="12%">{{ itemUnit() }}</th>
                            <th class="text-right" width="7%">@langapp('disc')</th>
                            <th class="text-right" width="12%">@langapp('total')</th>
                            @else
                            <th width="25%">@langapp('product')  </th>
                            <th width="35%" class="hidden-xs">@langapp('description')  </th>
                            <th class="text-right" width="7%">@langapp('qty')  </th>
                            <th class="text-right" width="12%">{{ itemUnit() }}</th>
                            <th class="text-right" width="7%">@langapp('disc')  </th>
                            <th class="text-right" width="12%">@langapp('total')  </th>
                            @endif
                            <th class="text-right inv-actions"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estimate->items as $key => $item)
                        <tr class="sortable" data-id="{{  $item->id  }}" data-name="{{  $item->name  }}" id="item-{{ $item->id }}">
                            <td class="drag-handle">
                                @icon('solid/bars')
                            </td>
                            <td>
                                @if(can('estimates_update'))
                                <a class="text-info" data-toggle="ajaxModal" href="{{ route('items.edit', ['id' => $item->id]) }}">
                                    {{  $item->name == '' ? '...' : $item->name  }}
                                </a>
                                @else
                                {{ $item->name }}
                                @endif
                            </td>
                            <td class="text-muted hidden-xs">
                                @parsedown($item->description)
                            </td>
                            <td class="text-right">
                                {{  formatQuantity($item->quantity) }}
                            </td>
                            @if ($showtax)
                            <td class="text-right">
                                {{  formatTax($item->tax_rate) }}%
                            </td>
                            @endif
                            <td class="text-right">
                                {{  formatCurrency($estimate->currency, $item->unit_cost) }}
                            </td>
                            <td class="text-right text-dark">
                                {{ $item->discount }}%
                            </td>
                            <td class="text-right text-dark">
                                {{ formatCurrency($estimate->currency, $item->total_cost) }}
                            </td>
                            <td class="text-right">
                                @if(can('estimates_update') && $estimate->isEditable())
                                <a class="hidden-print deleteItem" data-item-id="{{ $item->id }}" href="#">
                                    @icon('solid/trash-alt', 'text-danger')
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        
                        @if (can('estimates_update') && $estimate->isEditable())

                        @widget('Items\CreateItemWidget', ['module_id' => $estimate->id, 'module' => 'estimates', 'order' => count($estimate->items) + 1 ])

                        
                        @endif
                        <div class="ajaxTotals">
                            <tr>
                                <td class="text-right no-border" colspan="{{  $showtax ? '7' : '6'  }}">
                                    <strong>
                                    @langapp('sub_total')  
                                    </strong>
                                </td>
                                <td class="text-right">
                                    <span id="estimate-subtotal">
                                        {{  formatCurrency($estimate->currency, $estimate->subTotal()) }}
                                    </span>
                                </td>
                                <td>
                                </td>
                            </tr>
                            @if ($estimate->tax > 0)
                            <tr>
                                <td class="text-right no-border" colspan="{{  $showtax ? '7' : '6'  }}">
                                    <strong>
                                    {{  get_option('tax1Label')  }} ({{  formatTax($estimate->tax)  }}%)
                                    </strong>
                                </td>
                                <td class="text-right">
                                    <span id="estimate-tax1">
                                        {{  formatCurrency($estimate->currency, $estimate->tax1Amount()) }}
                                    </span>
                                </td>
                                <td>
                                </td>
                            </tr>
                            @endif
                            @if ($estimate->tax2 > 0)
                            <tr>
                                <td class="text-right no-border" colspan="{{  $showtax ? '7' : '6'  }}">
                                    <strong>
                                    {{  get_option('tax2Label')  }} ({{  formatTax($estimate->tax2) }}%)
                                    </strong>
                                </td>
                                <td class="text-right">
                                    <span id="estimate-tax2">
                                        {{  formatCurrency($estimate->currency, $estimate->tax2Amount()) }}
                                    </span>
                                </td>
                                <td>
                                </td>
                            </tr>
                            @endif
                            @if ($estimate->discount > 0)
                            <tr>
                                <td class="text-right no-border" colspan="{{  $showtax ? '7' : '6'  }}">
                                    <strong>
                                    @langapp('discount')   - {{  formatDecimal($estimate->discount)  }}{{ ($estimate->discount_percent) ? '%' : ''  }}
                                    </strong>
                                </td>
                                <td class="text-right">
                                    <span id="estimate-discount">
                                        {{  formatCurrency($estimate->currency, $estimate->discounted()) }}
                                    </span>
                                </td>
                                <td>
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td class="text-right no-border" colspan="{{  $showtax ? '7' : '6'  }}">
                                    <strong>
                                    @langapp('total')  
                                    </strong>
                                </td>
                                <td class="text-right text-dark">
                                    <span id="estimate-total">
                                        {{ formatCurrency($estimate->currency, $estimate->amount()) }}
                                    </span>
                                </td>
                                <td>
                                </td>
                            </tr>
                        </div>
                    </tbody>
                </table>
                {!! Form::close() !!}
                
                
            </div>

            @widget('CustomFields\Extras', ['custom' => $estimate->custom])


            @if (settingEnabled('amount_in_words'))
                @widget('Payments\AmountWords', ['currency' => $estimate->currency, 'amount' => $estimate->amount()])
            @endif
            <h3 class="h3">
            @langapp('terms') 
            </h3>
            <p>
                @parsedown($estimate->notes)
            </p>
            @if($estimate->status == 'Declined')
            <h3 class="h3">
            @langapp('feedback')
            </h3>
            <blockquote>
                @parsedown($estimate->rejected_reason)
            </blockquote>
            @endif

            {{ $estimate->clientViewed() }}

</div>
</div>



        </section>


    </section>

</aside>

<aside class="aside-lg bg-white b-l hide" id="aside-files">
    <header class="header bg-white b-b b-light">
        @can('files_create')
        <a href="{{  route('files.upload', ['module' => 'estimates', 'id' => $estimate->id])  }}" data-placement="left" data-rel="tooltip" title="Upload" data-toggle="ajaxModal" class="btn btn-sm btn-{{  get_option('theme_color')  }} pull-right">
           @icon('solid/file-upload')
        </a>
        @endcan
        <p>@langapp('files')</p>
    </header>
            <div class="m-xs">
                @include('partial._show_files', ['files' => $estimate->files, 'limit' => true])
            </div>
              
            </aside>

</section>

    
</section>
<a class="hide nav-off-screen-block" data-target="#nav" data-toggle="class:nav-off-screen" href="#">
</a>
@push('pagestyle')
<link href="{{ getAsset('plugins/typeahead/typeahead.css') }}" rel="stylesheet" type="text/css">
@include('stacks.css.form')
@endpush

@push('pagescript')
<script src="{{ getAsset('plugins/typeahead/typeahead.jquery.min.js') }}"></script>
@include('stacks.js.typeahead')
@include('stacks.js.form')
@include('stacks.js.sortable')
@include('estimates::_includes.items_ajax')

@endpush

@endsection