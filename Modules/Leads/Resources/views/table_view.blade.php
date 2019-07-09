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
						<th class="">ID</th>
						<th class="">@langapp('name')</th>
						<th class="">@langapp('email')</th>
						<th class="">@langapp('mobile')</th>
						{{--<th class="">@langapp('stage')</th>--}}
						<th class="">Counntry</th>
						<th class="">Source</th>
						<th class="">Desk</th>
						<th class="">Modified time</th>
						<th class="">Registration time</th>
						<th class="">Approx time</th>
						<th class="">Language</th>
						<th class="">Courses</th>

						<th class="col-currency">Sales rep</th>
						<th class="col-currency">Sales status</th>
						<th class="col-currency">Last login</th>
						<th class="col-currency">Local time</th>
						{{--<th class="">@langapp('sales_rep')</th>--}}

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

			$('#leads-table thead tr').clone(true).appendTo('#leads-table thead');
			var tableHeader = $('#leads-table thead tr:eq(1) th');
			var removed = tableHeader.splice(0, 3);

			tableHeader.each(function (i) {

				var title = $(this).text();
				if ($(this).attr('name') == 'select_all') {

					return true;

				} else {

					title = title.replace(/\s+/g, '_').toLowerCase();

					$(this).html('<input class="search" type="text" id="' + title + '" placeholder="Search ' + title + '" />');

					$('input', this).on('keyup change', function () {
						if (table.column(i).search() !== this.value) {

							table.draw();
						}
					});
				}

			});

			var table = $('#leads-table').DataTable({
				"searching": false,
				orderCellsTop: true,
				fixedHeader: true,
				"fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
					if (aData['sales_status'] == 'voice mail' || aData['sales_status'] == 'N/A') {
						$('td', nRow).css('background-color', '#fff7e5');
					} else if (aData['sales_status'] == 'call back' || aData['sales_status'] == 'high potential') {
						$('td', nRow).css('background-color', '#0303e275');
					} else if (aData['sales_status'] == 'closed account' ||
						aData['sales_status'] == 'test' ||
						aData['sales_status'] == 'not qualified - economic status' ||
						aData['sales_status'] == 'not qualified - under 18') {

						$('td', nRow).css('background-color', '#f4645fd6');

					} else if (aData['sales_status'] == 'converted') {
						$('td', nRow).css('background-color', '#0aad0aad');
					} else if(aData['sales_status'] == 'new'){
						$('td', nRow).css('background-color', 'white');
					}
					else {
						$('td', nRow).css('background-color', '#fff7e5')

					}
				},
				processing: true,
				serverSide: true,
				ajax: {
					url: '{{ route('leads.data') }}',
					data: function (data) {

						data['searchFields'] = [];
						$("input.search").map(function (index, value) {
							if ($(value).val()) {
								if ($(value).attr('id') == 'name' || $(value).attr('id') == 'email') {

									var name = $(value).attr('id').toLowerCase();

									data.search[name] = $(value).val();
								}
							}
						});
						console.log(data)
					}
				},
				order: [[0, "desc"]],
				columns: [
					{data: 'id', name: 'id'},
					{data: 'chk', name: 'chk', searchable: false},
					{data: 'id', name: 'id'},
					{data: 'name', name: 'name'},
					{data: 'email', name: 'email'},

					{data: 'mobile', name: 'mobile'},
					{data: 'country', name: 'country'},
					{data: 'source', name: 'source'},
					{data: 'desk', name: 'desk'},
					{data: 'modified_time', name: 'modified_time'},
					{data: 'registration_time', name: 'registration_time'},
					{data: 'approx_time', name: 'approx_time'},
					{data: 'language', name: 'language'},
					{data: 'courses', name: 'courses'},


					{data: 'sales_rep', name: 'agent.name'},
					{data: 'sales_status', name: 'sales_status'},
					{data: 'last_login', name: 'last_login'},
					{data: 'local_time', name: 'local_time'}

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