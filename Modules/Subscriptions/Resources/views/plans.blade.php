@extends('layouts.app')
@section('content')
<section id="content" class="bg">

			<section class="vbox">
				<header class="header panel-heading bg-white b-b b-light">
					
                    @if(isAdmin() || can('subscriptions_create'))

                    <a href="{{ route('subscriptions.index') }}" title="@langapp('subscriptions')" class="btn btn-sm btn-{{ get_option('theme_color') }}">
                        @icon('solid/shield-alt') @langapp('subscriptions')
                    </a>
                  
                    <a href="{{ route('plans.create') }}" data-toggle="ajaxModal" title="@langapp('create')" class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right">
                        @icon('solid/plus') @langapp('create')
                    </a>

                    @endif

                   
                        
					
				</header>
				<section class="scrollable wrapper">

                    <section class="panel panel-default">
<header class="panel-heading">@langapp('plans')</header>


<div class="table-responsive">
    <table  class="table table-striped" id="plans-table">
        <thead>
            <tr>
            	<th class="hide"></th>
                <th>@langapp('name')</th>
                <th>@langapp('subscriber')</th>
                <th>@langapp('plan')</th>
                <th>@langapp('billing_date')</th>
                <th class="no-sort"></th>
            </tr>
        </thead>
        
    </table>
</div>
</section>
						
						
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
$('#plans-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
    url: '{!! route('plans.data') !!}',
    data: {
    "filter": '{{ $filter }}',
    }
    },
    order: [[ 0, "desc" ]],
    columns: [
    { data: 'id', name: 'id', searchable: false },
    { data: 'name', name: 'name' },
    { data: 'subscriber', name: 'owner.name' },
    { data: 'plan', name: 'stripe_plan_id' },
    { data: 'billing_date', name: 'billing_date'},
    { data: 'action', name: 'action', orderable: false, searchable: false}
    ]
    });
});
</script>
@endpush

@endsection