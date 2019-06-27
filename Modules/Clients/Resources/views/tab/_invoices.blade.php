<section class="col-md-12">
	@can('invoices_create')
	<header class="panel-heading">
		<a href="{{  route('invoices.create', ['client' => $company->id])  }}" class="btn btn-sm btn-{{ get_option('theme_color') }}">
			@icon('solid/file-invoice-dollar') @langapp('create')  
		</a>
	</header>
	@endcan
	<div id="ajaxData"></div>
	
</section>

@push('pagestyle')
	@include('stacks.css.form')
@endpush
@push('pagescript')
@include('clients::_scripts._invoices')
@include('stacks.js.form')
@endpush