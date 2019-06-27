@extends('layouts.app')
@section('content')
<section id="content">
	<section class="hbox stretch">
		<aside>
			<section class="vbox">
				
				<header class="header bg-white b-b clearfix hidden-print">
					<div class="row m-t-sm">
						<div class="col-md-12">
							{{-- <a href="#" class="btn btn-sm btn-default" onClick="window.print();">
								@icon('solid/print')
							</a> --}}
											
							@if ($invoice->getOriginal('status') != 'fully_paid')
							@if(can('invoices_pay') && $invoice->balance > 0)
							<a class="btn btn-sm btn-{{ get_option('theme_color') }} btn-responsive" data-original-title="@langapp('pay_invoice')" data-placement="bottom" data-toggle="tooltip" href="{{  route('invoices.pay', ['id' => $invoice->id])  }}">
								@icon('solid/credit-card') @langapp('pay_invoice')
							</a>
							@endif
							@if($invoice->isClient())
							@include('invoices::_includes.payment_links')
							@endif
							@endif
							
							
							@can('invoices_send')
							<a href="{{  route('invoices.send', ['id' => $invoice->id]) }}" data-toggle="ajaxModal" class="btn btn-sm btn-{{  get_option('theme_color')  }} btn-responsive"
								data-rel="tooltip" title="@langapp('email') ">
								@icon('solid/envelope-open-text') @langapp('send')
							</a>
							@endcan

				@if ($invoice->is_visible)
					<a class="btn btn-sm btn-{{ get_option('theme_color') }}" href="{{ route('invoices.hide', ['id' => $invoice->id]) }}"
						data-toggle="tooltip" data-original-title="@langapp('hide_to_client')" data-placement="bottom">
						@icon('solid/eye-slash')
					</a>
					@else
					<a class="btn btn-sm btn-dark" href="{{  route('invoices.show', ['id' => $invoice->id])  }}" data-toggle="tooltip" data-original-title="@langapp('show_to_client')"
						data-placement="bottom">
						@icon('solid/eye')
					</a>
					@endif


							@canany(['invoices_create', 'invoices_update'])
							<a href="{{  route('invoices.activity', ['id' => $invoice->id]) }}" data-toggle="ajaxModal" class="btn btn-sm btn-{{  get_option('theme_color')  }} btn-responsive"
								data-rel="tooltip" title="@langapp('activity') ">
								@icon('solid/history')
							</a>
							@endcanany
							@can('reminders_create')
							<a class="btn btn-sm btn-{{ get_option('theme_color') }}" data-toggle="ajaxModal" data-rel="tooltip"  data-placement="bottom" href="{{  route('calendar.reminder', ['module' => 'invoices', 'id' => $invoice->id])  }}" title="@langapp('set_reminder')  ">
								@icon('solid/clock')
							</a>
							@endcan
							@can('invoices_comment')
							<a href="{{  route('invoices.comments', ['id' => $invoice->id])  }}" data-toggle="ajaxModal" class="btn btn-sm btn-{{  get_option('theme_color')  }} btn-responsive"
								data-rel="tooltip" title="@langapp('comments')">
								@icon('solid/comment-dollar')
							</a>
							@endcan
							<div class="btn-group">
								<button class="btn btn-sm btn-{{  get_option('theme_color')  }}  btn-responsive dropdown-toggle" data-toggle="dropdown">@langapp('more_actions')
								<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									@can('invoices_remind')
									<li>
										<a href="{{  route('invoices.remind', ['id' => $invoice->id]) }}" data-toggle="ajaxModal" data-rel="tooltip" title="@langapp('reminder')">@langapp('reminder')</a>
									</li>
									@endcan
									@can('invoices_create')
									<li>
										<a href="{{ route('invoices.copy', $invoice->id) }}" data-toggle="ajaxModal" data-rel="tooltip" title="@langapp('copy')">@langapp('copy')</a>
									</li>
									@endcan
									@if ($invoice->is_recurring)
									@can('invoices_update')
									<li>
										<a href="{{ route('invoices.stop_recur', $invoice->id) }}" data-toggle="ajaxModal" data-rel="tooltip" title="@langapp('stop_recurring')">@langapp('stop_recurring')</a>
									</li>
									@endcan
									@endif
									@admin
									<li>
										<a href="{{  route('invoices.child', ['id' => $invoice->id]) }}" data-toggle="ajaxModal" data-rel="tooltip" title="@langapp('children')">@langapp('children')
										</a>
									</li>
									@endadmin
									
									@can('invoices_update')
									@if ($invoice->isEditable())
									<li>
										<a href="{{ route('items.insert',['id' => $invoice->id, 'module' => 'invoices']) }}" title="@langapp('item_quick_add')"
											data-toggle="ajaxModal">@langapp('items')
										</a>
										@endif
									</li>
									
									@if ($invoice->balance > 0)
									<li>
										<a href="{{  route('creditnotes.apply', ['id' => $invoice->id])  }}" data-toggle="ajaxModal" data-rel="tooltip" title="@langapp('use_credits')">@langapp('use_credits')
										</a>
									</li>
									@endif
									
									@endcan
									<li>
										<a href="{{  route('invoices.transactions', $invoice->id)  }}">
											@langapp('payments')
										</a>
									</li>
									@if (can('invoices_pay') && $invoice->balance > 0)
									<li>
										<a href="{{ route('invoices.mark_paid', ['id' => $invoice->id]) }}" data-toggle="ajaxModal">@langapp('mark_as_paid')
										</a>
									</li>
									@if(!$invoice->hasPayment())
									<li>
										<a href="{{ route('invoices.cancel', ['id' => $invoice->id]) }}" data-toggle="ajaxModal">@langapp('cancelled')</a>
									</li>
									@endif
									@endif
									@can('invoices_send')
									<li>
										<a href="{{ route('invoices.mark.sent', ['id' => $invoice->id]) }}">@langapp('mark_as_sent')</a>
									</li>
									@endcan
									@can('invoices_update')
									<li>
										<a href="{{ route('invoices.edit', ['id' => $invoice->id]) }}" data-original-title="@langapp('make_changes') " data-toggle="tooltip"
											data-placement="bottom">@langapp('edit')
										</a>
									</li>
									@endcan
									@can('invoices_delete')
									<li>
										<a href="{{ route('invoices.delete', ['id' => $invoice->id]) }}" title="@langapp('delete')" data-rel="tooltip" data-toggle="ajaxModal">@langapp('delete')</a>
									</li>
									@endcan
								</ul>
							</div>
							<a href="#aside-files" data-toggle="class:show" class="btn btn-sm btn-default pull-right">@icon('solid/folder-open')</a>
							@admin
							@if($invoice->company->primary_contact)
							<a class="btn btn-sm btn-dark pull-right btn-responsive" data-placement="bottom" data-rel="tooltip" href="{{ route('users.impersonate', ['id' => $invoice->company->contact->id ]) }}" title="@langapp('client') @langapp('view')">
								@icon('solid/user-secret') @langapp('as_client')
							</a>
							@endif
							@endadmin
							<a href="{{ route('invoices.pdf', $invoice->id) }}" class="btn btn-sm btn-dark  btn-responsive pull-right">
								@icon('solid/file-invoice-dollar') PDF
							</a>
							@can('invoices_update')
							<a href="{{  route('invoices.share', $invoice->id)  }}" title="Share Invoice" class="btn btn-sm btn-default pull-right"
								data-toggle="ajaxModal">
								@icon('solid/share-alt')
							</a>
							@endcan
							
						</div>
					</div>
				</header>
				<section class="scrollable ie-details bg">
					<div class="wrapper">
						
						@if ($invoice->is_cancelled != 1)
						@if ($invoice->isOverdue())
						@component('components.alert')
						<strong class="text-info">Notice! </strong> @langapp('invoice_overdue')
						@endcomponent
						@endif
						
						@else
						<div class="alert alert-danger hidden-print">
							<button type="button" class="close" data-dismiss="alert">×</button>
							@icon('solid/exclamation-circle') This Invoice is Cancelled!
						</div>
						@endif
						@if ($invoice->company->creditBalance() > 0)
						<div class="invoice-cn-banner fill-container">
							<span class="text-success"> Credits Available: </span>
							A credit of {{ formatCurrency($invoice->company->currency, $invoice->company->creditBalance()) }} available for this customer.
							Click <strong>More</strong> button to use these credits.
						</div>
						@endif
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<div style="height: {{ get_option('invoice_logo_height') }}px">
									<img class="ie-logo with-responsive-img" src="{{ getStorageUrl(config('system.media_dir').'/'.get_option('invoice_logo'))  }}">
								</div>
							</div>
							<div class="col-md-6 col-xs-12 text-right">
								<p class="h4">
									<span class="inv-text font22">{{ $invoice->reference_no }}</span>
									<span class="text-muted">
										{!! $invoice->isDraft() ? '<span class="label label-danger">'.langapp('draft').'</span>' : '' !!}
									</span>
									@if ($invoice->is_recurring)
									<span class="label bg-danger">
									@icon('solid/sync-alt') {{ $invoice->recur_frequency }} </span>
									@endif
								</p>
								<div>
									@langapp('invoice_date')
									<span class="col-xs-4 no-gutter-right pull-right">
										<strong>
										{{ dateString($invoice->created_at) }}
										</strong>
									</span>
								</div>
								@if ($invoice->is_recurring)
								<div>
									@langapp('recur_next_date')
									<span class="col-xs-4 no-gutter-right pull-right">
										<strong>
										{{ dateTimeString($invoice->recur_next_date) }}
										</strong>
									</span>
								</div>
								@endif
								<div>
									@langapp('payment_due')
									<span class="col-xs-4 no-gutter-right pull-right">
										<strong>
										{{ dateString($invoice->due_date) }}
										</strong>
									</span>
								</div>
								<div>
									@langapp('status')
									<span class="col-xs-4 no-gutter-right pull-right">
										<span class="label label-success">
											{{ $invoice->status }}
										</span>
									</span>
								</div>
								@if(isAdmin() && $invoice->viewed_at != null)
								<div class="m-t-xs">
									@langapp('viewed')
									<span class="col-xs-4 no-gutter-right pull-right">
										<span class="label label-success">
											{{ dateElapsed($invoice->viewed_at) }}
										</span>
									</span>
								</div>
								@endif
								@if($invoice->currency != 'USD')
								<div>
									@langapp('xrate')
									<span class="col-xs-4 no-gutter-right pull-right">
										<strong>
										1 USD = {{ $invoice->currency }} {{ $invoice->exchange_rate }}
										</strong>
									</span>
								</div>
								@endif
								@if($invoice->project_id > 0 && isAdmin())
								<div>
									@langapp('project')
									<span class="col-xs-4 no-gutter-right pull-right">
										<a href="{{ route('projects.view', ['id' => $invoice->project_id, 'tab' => 'invoices']) }}">
											<strong>{{ $invoice->project->name }}</strong>
										</a>
									</span>
								</div>
								@endif
							</div>
						</div>
						@php $data['company'] = $invoice->company; @endphp
						<div class="well m-t">
							<div class="row">
								@if (get_option('swap_to_from') == 'FALSE')
								<div class="col-xs-6">
									<strong>@langapp('received_from'):</strong>
									@include('partial.company_address', $data)
								</div>
								@endif {{-- / SWAP FROM ADDRESS --}}
								<div class="col-xs-6">
									<strong>@langapp('bill_to'):</strong>
									<div class="pmd-card-body">
										@php $data['company'] = $invoice->company; @endphp @include('partial.client_address', $data)
									</div>
									@can('invoices_update')
									@if ($invoice->company->unbilledExpenses() > 0)
									<span class="text-info hidden-print">
										<a href="{{  route('items.expenses', ['id' => $invoice->id])  }}" class="btn btn-xs btn-danger" data-toggle="ajaxModal">@langapp('expenses_available') </a>
									</span>
									@endif
									@endcan
								</div>
								@if (get_option('swap_to_from') == 'TRUE')
								<div class="col-xs-6">
									<strong>@langapp('received_from'):</strong>
									@include('partial.company_address', $data)
								</div>
								@endif
							</div>
						</div>
						@php $showtax = settingEnabled('show_invoice_tax'); @endphp
						<div class="line"></div>
						<div class="table-responsive">
							{!! Form::open(['url' => '#', 'class' => 'bs-example form-horizontal', 'id' => 'saveItem']) !!}
							<table id="inv-details" class="table sorted_table" type="invoices">
								<thead>
									<tr class="inv-text inv-bg text-uc">
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
										<th width="25%">@langapp('product')</th>
										<th width="35%" class="hidden-xs">@langapp('description')</th>
										<th class="text-right" width="7%">@langapp('qty')</th>
										<th class="text-right" width="12%">{{ itemUnit() }}</th>
										<th class="text-right" width="7%">@langapp('disc')</th>
										<th class="text-right" width="12%">@langapp('total')</th>
										@endif
										<th class="text-right inv-actions"></th>
									</tr>
								</thead>
								<tbody>
									@foreach ($invoice->items as $key => $item)
									<tr class="sortable" data-id="{{  $item->id  }}" id="item-{{ $item->id }}">
										<td class="drag-handle">
											@icon('solid/bars')
										</td>
										<td>
											@if(can('invoices_update') && $invoice->isEditable())
											<a href="{{  route('items.edit', ['id' => $item->id])  }}" data-toggle="ajaxModal">
												{{ $item->name == '' ? '...' : $item->name }}
											</a>
											@else {{ $item->name }} @endif
										</td>
										<td class="text-muted hidden-xs">@parsedown($item->description)</td>
										<td class="text-right">{{ formatQuantity($item->quantity) }}</td>
										@if ($showtax)
										<td class="text-right">{{ formatTax($item->tax_rate).'%' }}</td>
										@endif
										<td class="text-right">{{ formatCurrency($invoice->currency, $item->unit_cost) }}</td>
										
										<td class="text-right text-dark">{{ $item->discount }}%</td>
										
										<td class="text-right text-dark">{{ formatCurrency($invoice->currency, $item->total_cost) }}</td>
										<td class="text-right">
											@if(can('invoices_update') && $invoice->isEditable())
											<a class="hidden-print deleteItem" href="#" data-item-id="{{ $item->id }}">
												@icon('regular/trash-alt', 'text-danger')
											</a>
											@endif
										</td>
									</tr>
									@endforeach
									@can('invoices_update')
									{{-- ADD ITEMS --}}
									
									@if ($invoice->isEditable())
									@widget('Items\CreateItemWidget', ['module_id' => $invoice->id, 'module' => 'invoices', 'order' => count($invoice->items) + 1 ])
									@endif
									{{-- / ADD ITEMS --}}
									@endcan
									{{-- / CAN EDIT INVOICE --}}
									<tr>
										<td colspan="{{  $showtax ? '7' : '6'  }}" class="text-right no-border">
											<strong>@langapp('sub_total')</strong>
										</td>
										<td class="text-right">
											<span id="subtotal">
												{{ formatCurrency($invoice->currency, $invoice->subTotal()) }}
											</span>
										</td>
										<td></td>
									</tr>
									@if ($invoice->tax != 0)
									<tr>
										<td colspan="{{  $showtax ? '7' : '6'  }}" class="text-right no-border">
											<strong>{{ get_option('tax1Label') }} ({{ formatTax($invoice->tax) }}%)</strong>
										</td>
										<td class="text-right">
											<span id="tax1">
												{{ formatCurrency($invoice->currency, $invoice->tax1Amount()) }}
											</span>
										</td>
										<td></td>
									</tr>
									@endif
									@if ($invoice->tax2 != 0)
									<tr>
										<td colspan="{{  $showtax ? '7' : '6'  }}" class="text-right no-border">
											<strong>{{ get_option('tax2Label') }} ({{ formatTax($invoice->tax2) }}%)</strong>
										</td>
										<td class="text-right">
											<span id="tax2">
												{{ formatCurrency($invoice->currency, $invoice->tax2Amount()) }}
											</span>
										</td>
										<td></td>
									</tr>
									@endif
									
									@if ($invoice->discount > 0)
									<tr>
										<td colspan="{{  $showtax ? '7' : '6'  }}" class="text-right no-border">
											<strong>@langapp('discount') - {{ formatTax($invoice->discount) }} {{ ($invoice->discount_percent) ? '%' : '' }}</strong>
										</td>
										<td class="text-right">
											<span id="discount">
												{{ formatCurrency($invoice->currency, $invoice->discounted()) }}
											</span>
										</td>
										<td></td>
									</tr>
									@endif
									@if ($invoice->lateFee() > 0)
									<tr>
										<td colspan="{{  $showtax ? '7' : '6'  }}" class="text-right no-border">
											<strong>@langapp('late_fee')</strong>
										</td>
										<td class="text-right">
											<span id="discount">
												{{ formatCurrency($invoice->currency, $invoice->lateFee()) }}
											</span>
										</td>
										<td></td>
									</tr>
									@endif
									
									@if ($invoice->extra_fee > 0)
									<tr>
										<td colspan="{{  $showtax ? '7' : '6'  }}" class="text-right no-border">
											<strong>@langapp('extra_fee') + {{ $invoice->extra_fee }}{{ ($invoice->fee_is_percent) ? '%' : '' }}</strong>
										</td>
										<td class="text-right">
											<span id="fee">
												{{ formatCurrency($invoice->currency, $invoice->extraFee()) }}
											</span>
										</td>
										<td></td>
									</tr>
									@endif
									
									@if ($invoice->paid() > 0)
									<tr>
										<td colspan="{{  $showtax ? '7' : '6'  }}" class="text-right no-border">
											<strong>@langapp('payment_made')</strong>
										</td>
										<td class="text-right text-danger">(-)<span id="paid">
											{{ formatCurrency($invoice->currency, $invoice->paid()) }}
										</span>
									</td>
									<td></td>
								</tr>
								@endif
								
								@if ($invoice->creditedAmount() > 0)
								<tr>
									<td colspan="{{  $showtax ? '7' : '6'  }}" class="text-right no-border">
										<strong>@langapp('credits_applied')</strong>
									</td>
									<td class="text-right text-danger">
										(-)
										<span id="credits">
											{{ formatCurrency($invoice->currency, $invoice->creditedAmount()) }}
										</span>
									</td>
									<td></td>
								</tr>
								@endif
								<tr class="inv-text inv-bg">
									<td colspan="{{  $showtax ? '7' : '6'  }}" class="text-right no-border">
										<strong>
										@langapp('balance')</strong>
									</td>
									<td class="text-right">
										<span id="invoiceDue">
											{{ formatCurrency($invoice->currency, $invoice->due()) }}
										</span>
									</td>
									<td></td>
								</tr>
							</tbody>
						</table>
						{!! Form::close() !!}
						
					</div>
					@if ($invoice->late_fee > 0 && !$invoice->isOverdue())
					<p class="text-danger">Late fee of {{ $invoice->late_fee_percent === 0 ? $invoice->currency : '' }} {{ $invoice->late_fee }} {{ $invoice->late_fee_percent ? '%' : '' }} will be applied.</p>
					@endif
					@if (settingEnabled('amount_in_words'))
					@widget('Payments\AmountWords', ['currency' => $invoice->currency, 'amount' => $invoice->due()])
					@endif
					@if ($invoice->gatewayEnabled('bank'))
					<hr class="dotted">
					<span class="text-muted">@parsedown(get_option('bank_details'))</span>
					
					@endif
					@widget('CustomFields\Extras', ['custom' => $invoice->custom])
					
					
					@if (count($invoice->installments) > 1)
					<div>
						<h4>@langapp('installments')</h4>
						<table class="table table-responsive table-hover">
							<thead>
								<tr>
									<th class="width25">@langapp('amount')</th>
									<th class="width25">@langapp('due_date')</th>
									<th>@langapp('description')</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($invoice->installments as $partial)
								<tr class="">
									<td>
										@if ($partial->balance() <=0 )
										@icon('solid/check-square', 'text-success')
										@endif
										@php
										$partial_total = $invoice->payable * ($partial->percentage / 100);
										@endphp
										{{ formatCurrency($invoice->currency, $partial_total) }} ({{ $partial->percentage }}%) bal.
										<span class="text-muted">
										{{ formatCurrency($invoice->currency, $partial->balance()) }}</span>
									</td>
									<td class="text-muted">{{ dateFormatted($partial->due_date) }}</td>
									<td>{{ $partial->notes }}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					@endif
					{{--  CREDITS APPLIED  --}}
					@if ($invoice->creditedAmount() > 0)
					<h4>@langapp('credits_applied')</h4>
					<table class="table">
						<tbody>
							<tr class="text-muted">
								<td class="width25">@langapp('date')</td>
								<td class="width20">@langapp('credit_note')#</td>
								<td class="width45" class="text-right">@langapp('credits_applied')</td>
								<td class="width10"></td>
							</tr>
							@foreach ($invoice->credited as $credited)
							<tr>
								<td>{{ dateFormatted($credited->created_at) }}</td>
								<td>
									<a href="{{  route('creditnotes.view', ['id' => $credited->creditnote_id]) }}" class=""> {{ $credited->credit->reference_no }} </a>
								</td>
								<td class="text-right">{{ formatCurrency($credited->credit->currency, $credited->credited_amount) }}</td>
								<td>
									@can('credits_update')
									<a href="{{ route('creditnotes.remove_credit', ['id' => $credited->id]) }}" data-toggle="ajaxModal">
										@icon('solid/times')
									</a>
									@endcan
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					@endif
					@parsedown(str_replace('{REMAINING_DAYS}', $invoice->dueDays().' days', $invoice->notes))
					
					{{ $invoice->clientViewed() }}
				</div>
			</section>
		</section>
		
	</aside>
	<aside class="aside-lg bg-white b-l hide" id="aside-files">
		<header class="header bg-white b-b b-light">
			@can('files_create')
			<a href="{{  route('files.upload', ['module' => 'invoices', 'id' => $invoice->id])  }}" data-placement="left" data-rel="tooltip" title="@langapp('upload_file')" data-toggle="ajaxModal" class="btn btn-sm btn-{{  get_option('theme_color')  }} pull-right">
				@icon('solid/file-upload')
			</a>
			@endcan
			<p>@langapp('files')</p>
		</header>
		<div class="m-xs">
			@include('partial._show_files', ['files' => $invoice->files, 'limit' => true])
		</div>
		
	</aside>
</section>


<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
@push('pagestyle')
<link href="{{ getAsset('plugins/typeahead/typeahead.css') }}" rel="stylesheet" type="text/css">
@include('stacks.css.form')
@endpush
@push('pagescript')
@cannot('invoices_pay')
@if ($invoice->gatewayEnabled('braintree'))
<script src="https://js.braintreegateway.com/web/dropin/1.14.1/js/dropin.min.js"></script>
@endif
@if ($invoice->gatewayEnabled('stripe') && $invoice->isClient())
<script src="https://checkout.stripe.com/checkout.js"></script>
@endif
@endcan
<script src="{{ getAsset('plugins/typeahead/typeahead.jquery.min.js') }}"></script>
@include('stacks.js.typeahead')
@include('stacks.js.form')
@include('stacks.js.sortable')
@include('invoices::_includes.items_ajax')
@endpush
</section>
@endsection