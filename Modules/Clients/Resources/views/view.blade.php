@extends('layouts.app')
@section('content')
<section id="content" class="bg">
    <section class="hbox stretch">
        <section class="vbox">
            <header class="header bg-white b-b clearfix">
                <div class="row m-t-sm">
                    <div class="col-sm-12 m-b-xs">
                        <p class="h3">{{ $company->name }}
                            @can('clients_delete')
                            <a href="{{ route('clients.delete', ['id' => $company->id]) }}" class="btn btn-danger btn-sm pull-right" data-toggle="ajaxModal"
                            title="@langapp('delete')">@svg('solid/trash-alt')</a>
                            @endcan
                            @can('clients_update')
                            <a href="{{ route('clients.edit', ['id' => $company->id]) }}" class="btn btn-{{ get_option('theme_color') }} btn-sm pull-right"
                                data-toggle="ajaxModal" title="@langapp('edit')" data-placement="left">
                            @icon('solid/pencil-alt') @langapp('edit')</a>
                            @endcan
                        </p>
                    </div>
                </div>
            </header>
            <section class="scrollable wrapper scrollpane">

                <div class="row">
                    <div class="col-sm-12 m-b-xs">
                        <div class="sub-tab text-uc small m-b-10">
                            <ul class="nav pro-nav-tabs nav-tabs-dashed">
                                
                                <li class="{{ ($tab == 'dashboard') ? 'active' : ''  }}">
                                    
                                    <a href="{{ route('clients.view', ['id' => $company->id, 'tab' => 'dashboard']) }}">
                                        @icon('solid/tachometer-alt') @langapp('overview')
                                        @if ($company->hasUnread())
                                        <span class="label label-dracula">
                                            @icon('solid/envelope-alt') {{ $company->hasUnread() }}
                                        </span>
                                        @endif
                                    </a>
                                </li>
                                <li class="{{ $tab == 'contacts' ? 'active' : ''  }}">
                                    <a href="{{  route('clients.view', ['id' => $company->id, 'tab' => 'contacts']) }}">
                                    @icon('solid/users') @langapp('contacts')  </a>
                                </li>
                                <li class="{{ $tab == 'projects' ? 'active' : ''  }}">
                                    
                                    <a href="{{  route('clients.view', ['id' => $company->id, 'tab' => 'projects']) }}">
                                    @icon('solid/clock') @langapp('projects')  </a>
                                </li>
                                <li class="{{ $tab == 'invoices' ? 'active' : ''  }}">
                                    
                                    <a href="{{  route('clients.view', ['id' => $company->id, 'tab' => 'invoices']) }}">
                                        @icon('solid/file-invoice-dollar') @langapp('invoices')
                                    </a>
                                </li>
                                <li class="{{ $tab == 'estimates' ? 'active' : ''  }}">
                                    
                                    <a href="{{  route('clients.view', ['id' => $company->id, 'tab' => 'estimates']) }}">
                                    @icon('solid/file-alt') @langapp('estimates')  </a>
                                </li>
                                <li class="{{ $tab == 'payments' ? 'active' : ''  }}">
                                    
                                    <a href="{{  route('clients.view', ['id' => $company->id, 'tab' => 'payments']) }}">
                                    @icon('solid/credit-card') @langapp('payments')  </a>
                                </li>
                                <li class="{{ $tab == 'expenses' ? 'active' : ''  }}">
                                    
                                    <a href="{{  route('clients.view', ['id' => $company->id, 'tab' => 'expenses']) }}">
                                    @icon('solid/shopping-basket') @langapp('expenses')  </a>
                                </li>
                                <li class="{{ $tab == 'deals' ? 'active' : ''  }}">
                                    
                                    <a href="{{  route('clients.view', ['id' => $company->id, 'tab' => 'deals']) }}">
                                    @icon('solid/euro-sign') @langapp('deals')  </a>
                                </li>
                                <li class="{{ $tab == 'files' ? 'active' : ''  }}">
                                    
                                    <a href="{{  route('clients.view', ['id' => $company->id, 'tab' => 'files']) }}">
                                    @icon('solid/hdd') @langapp('files')  </a>
                                </li>
                                <li class="{{ $tab == 'subscriptions' ? 'active' : ''  }}">
                                    
                                    <a href="{{  route('clients.view', ['id' => $company->id, 'tab' => 'subscriptions']) }}">
                                    @icon('regular/calendar-alt') @langapp('subscriptions')  </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @if ($company->balance > 0)
                <div class="alert alert-primary alert-bordered m-b-2">
                    <strong class="text-info">Note! </strong>@langapp('client_has_balance', ['balance' => formatCurrency($company->currency, $company->balance)])
                </div>
                @endif
                <div class="row">
                    
                    @include('clients::tab._'.$tab)
                </div>
            </section>
        </section>
    </section>
</section>
@push('pagescript')
@include('stacks.js.markdown')
@endpush
@endsection