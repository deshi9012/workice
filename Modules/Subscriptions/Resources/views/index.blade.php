@extends('layouts.app')
@section('content')
<section id="content" class="bg">

			<section class="vbox">
				<header class="header panel-heading bg-white b-b b-light">

					@if(Auth::user()->profile->company > 0)
                    <a href="{{ route('subscriptions.invoices') }}" title="@langapp('invoices')" class="btn btn-sm btn-{{ get_option('theme_color') }}">
                        @icon('solid/file-invoice-dollar') @langapp('invoices')
                    </a>
                    @endif

					
                    @if(isAdmin() || can('subscriptions_create'))

                    <a href="{{ route('plans.index') }}" title="@langapp('plans')" class="btn btn-sm btn-{{ get_option('theme_color') }}">
                        @icon('solid/unlock-alt') @langapp('plans')
                    </a>
                  
                    <a href="{{ route('plans.create') }}" data-toggle="ajaxModal" title="@langapp('create')" class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right">
                        @icon('solid/plus') @langapp('create')
                    </a>

                    @endif

                   
                        
					
				</header>
				<section class="scrollable wrapper">

                    @if(isAdmin() || can('subscriptions_create'))

                    @include('subscriptions::_includes._admin_subscriptions')

                    @else

                    @include('subscriptions::_includes._client_subscriptions')

					@endif
						
						
					</section>
				</section>

		<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
	</section>

@push('pagestyle')
    @include('stacks.css.datatables')
@endpush

@push('pagescript')
@include('stacks.js.datatables')

<script>
    $(function() {
    $('#admin-subscriptions-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
    url: '{!! route('subscriptions.admin.data') !!}',
    data: {
    "filter": '{{ $filter }}',
    }
    },
    order: [[ 0, "desc" ]],
    columns: [
    { data: 'id', name: 'id', searchable: false },
    { data: 'name', name: 'name' },
    { data: 'client_id', name: 'owner.name' },
    { data: 'plan', name: 'stripe_plan' },
    { data: 'billing_date', name: 'created_at', searchable: false },
    { data: 'action', name: 'action', orderable: false, searchable: false}
    ]
    });

    $('#client-subscriptions-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
    url: '{!! route('subscriptions.client.data') !!}',
    data: {
    "filter": '{{ $filter }}',
    }
    },
    order: [[ 0, "desc" ]],
    columns: [
    { data: 'id', name: 'id', searchable: false },
    { data: 'name', name: 'name' },
    { data: 'status', name: 'status' },
    { data: 'billing_date', name: 'billing_date'},
    { data: 'period', name: 'period', orderable: false, searchable: false},
    { data: 'action', name: 'action', orderable: false, searchable: false}
    ]
    });

    });
    </script>
@endpush
	@endsection