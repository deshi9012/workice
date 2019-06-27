<div class="col-lg-12">
	<section class="panel panel-default">
		<form id="frm-lead" action="{{ route('leads.bulk.email') }}" method="POST">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="module" value="leads">
			<div class="table-responsive">
				<table class="table table-striped" id="leads-table">
					<thead>
					<tr>
						<th class="hide"></th>
						<th class="no-sort">
							<label>
								<input name="select_all" value="1" id="select-all" type="checkbox"/>
								<span class="label-text"></span>
							</label>
						</th>
						<th class="">@langapp('name')</th>

						<th class="">@langapp('mobile')</th>
						<th class="">@langapp('stage')</th>
						<th class="col-currency">@langapp('lead_value')</th>
						<th class="">@langapp('sales_rep')</th>
						<th class="">@langapp('email')</th>
					</tr>
					</thead>
				</table>
			</div>
			@can('leads_create')
				<button type="submit" id="button" class="btn btn-sm btn-{{ get_option('theme_color') }} m-xs"
						value="bulk-email">
					<span class="">@icon('solid/mail-bulk') @langapp('send_email')</span>
				</button>
			@endcan
			@can('leads_update')
				<button type="submit" id="button" class="btn btn-sm btn-{{ get_option('theme_color') }} m-xs"
						value="bulk-archive">
					<span class="">@icon('solid/archive') @langapp('archive')</span>
				</button>
			@endcan

			@can('leads_delete')
				<button type="submit" id="button" class="btn btn-sm btn-{{ get_option('theme_color') }} m-xs"
						value="bulk-delete">
					<span class="">@icon('solid/trash-alt') @langapp('delete')</span>
				</button>
			@endcan

		</form>
	</section>
</div>
@push('pagestyle')
	@include('stacks.css.datatables')
@endpush
@push('pagescript')
	@include('stacks.js.datatables')
	<script>
		$(function () {
			$('#leads-table').DataTable({
				processing: true,
				serverSide: true,
				ajax: {
					url: '{{ route('leads.data') }}',
					data: {
						"filter": '{{ $filter }}',
					}
				},
				order: [[0, "desc"]],
				columns: [
					{data: 'id', name: 'id'},
					{data: 'chk', name: 'chk', searchable: false},
					{data: 'name', name: 'name'},

					{data: 'mobile', name: 'mobile'},
					{data: 'stage', name: 'status.name'},
					{data: 'lead_value', name: 'lead_value'},
					{data: 'sales_rep', name: 'agent.name'},
					{data: 'email', name: 'email'}
				]
			});
			$("#frm-lead button").click(function (ev) {
				ev.preventDefault();
				if ($(this).attr("value") == "bulk-email") {
					var form = $("#frm-lead").serialize();
					$("#frm-lead").submit();
				}

				if ($(this).attr("value") == "bulk-archive") {
					var form = $("#frm-lead").serialize();
					axios.post('{{ route('archive.process') }}', form)
						.then(function (response) {
							toastr.warning(response.data.message, '@langapp('
							response_status
							')'
						)
							;
							window.location.href = response.data.redirect;
						})
						.catch(function (error) {
							showErrors(error);
						});
				}

				if ($(this).attr("value") == "bulk-delete") {
					var form = $("#frm-lead").serialize();
					axios.post('{{ route('leads.bulk.delete') }}', form)
						.then(function (response) {
							toastr.warning(response.data.message, '@langapp('
							response_status
							') '
						)
							;
							window.location.href = response.data.redirect;
						})
						.catch(function (error) {
							showErrors(error);
						});
				}
			});

			function showErrors(error) {
				var errors = error.response.data.errors;
				var errorsHtml = '';
				$.each(errors, function (key, value) {
					errorsHtml += '<li>' + value[0] + '</li>';
				});
				toastr.error(errorsHtml, '@langapp('
				response_status
				') '
			)
				;
			}

		});
	</script>
@endpush