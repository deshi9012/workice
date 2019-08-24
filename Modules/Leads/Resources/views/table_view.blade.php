<style>
	input#id, input#desk, input#source, input#language, input#courses, input#sales_rep {
		width: 50px;
	}

	input#name {
		width: 170px;
	}

	input#stage {
		width: 100px;
	}

	ul {
		list-style: none;
		padding: 0;
		margin: 0;
	}

	li.red, li.green {
		padding-left: 1em;
		text-indent: -.3em;
	}

	.red::before {
		content: "• ";
		color: red; /* or whatever color you prefer */
		font-size: 1.7em;
	}

	.green::before {
		content: "• ";
		color: green; /* or whatever color you prefer */
		font-size: 170%;
	}

	.table-responsive {
		max-height: 80vh;
	}

	input[name="select_all"] > span {
		display: none;
	}

	/*table#leads-table{*/
	/*max-height: 50vh;*/
	/*}*/
	/* The Modal (background) */
	.modal {
		display: none; /* Hidden by default */
		position: fixed; /* Stay in place */
		z-index: 1; /* Sit on top */
		padding-top: 100px; /* Location of the box */
		left: 0;
		top: 0;
		width: 100%; /* Full width */
		height: 100%; /* Full height */
		overflow: auto; /* Enable scroll if needed */
		background-color: rgb(0, 0, 0); /* Fallback color */
		background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
	}

	/* Modal Content */
	.modal-content {
		background-color: #fefefe;
		margin: auto;
		padding: 20px;
		border: 1px solid #888;
		width: 80%;
	}

	/* The Close Button */
	.close {
		color: #aaaaaa;
		float: right;
		font-size: 28px;
		font-weight: bold;
	}

	.close:hover,
	.close:focus {
		color: #000;
		text-decoration: none;
		cursor: pointer;
	}

	.radio-class {
		position: relative !important;
		right: 0px !important;
	}

	#question {
		text-align: center;
	}

	.custom-bulk {

		margin: 0 auto;
		/*top: 40px;*/
		display: block;
	}
	#select-country,#select-user,#select-stage,#select-desk{
		margin-top: 5px;
		margin-bottom: 3px;
	}

</style>
<!-- The Modal -->
<div id="myModal" class="modal">

	<!-- Modal content -->
	<div class="modal-content">
		<span class="close">&times;</span>
		<div id="message-modal"></div>
	</div>

</div>

<div class="col-lg-12">
	<section class="panel panel-default">

		<form id="frm-lead" action="{{ route('leads.bulk.email') }}" method="POST">
			@if((Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager') || Auth::user()->hasRole('office manager')))
				{{--<a href="{{ route('leads.bulkEdit') }}"--}}
				{{--class="btn btn-sm btn-{{ get_option('theme_color') }} m-xs" data-toggle="ajaxModal" data-rel="tooltip"--}}
				{{--title="@langapp('edit')  ">Bulk</a>--}}
				<button type="submit" id="button"
						class="btn btn-sm btn-{{ get_option('theme_color') }} m-xs custom-bulk"
						value="bulk-edit">
					<span class="">Mass assign</span>
				</button>
			@endif
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

						<th class="">Country</th>
						<th class="">Source</th>
						<th class="">Desk</th>
						<th class="">Modified time</th>
						<th class="">Registration time</th>

						<th class="">Language</th>
						<th class="">Courses</th>

						<th class="col-currency">Sales rep</th>
						<th class="">@langapp('stage')</th>
						<th class="col-currency">Last login</th>
						<th class="col-currency">Local time</th>
						{{--<th class="">@langapp('sales_rep')</th>--}}

					</tr>
					</thead>
				</table>
			</div>
			@if(!(Auth::user()->hasRole('sales agent') || Auth::user()->hasRole('sales team leader')))
				{{--@can('leads_create')--}}
				<button type="submit" id="button" class="btn btn-sm btn-{{ get_option('theme_color') }} m-xs"
						value="bulk-email">
					<span class="">@icon('solid/mail-bulk') @langapp('send_email')</span>
				</button>
				{{--@endcan--}}
				{{--			@can('leads_update')--}}
				<button type="submit" id="button" class="btn btn-sm btn-{{ get_option('theme_color') }} m-xs"
						value="bulk-archive">
					<span class="">@icon('solid/archive') @langapp('archive')</span>
				</button>
				{{--@endcan--}}

				{{--			@can('leads_delete')--}}
				<button type="submit" id="button" class="btn btn-sm btn-{{ get_option('theme_color') }} m-xs"
						value="bulk-delete">
					<span class="">@icon('solid/trash-alt') @langapp('delete')</span>
				</button>
				{{--@endcan--}}

			@endif
			{{--@if((Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager') || Auth::user()->hasRole('office manager')))--}}
			{{--<a href="{{ route('leads.bulkEdit') }}"--}}
			{{--class="btn btn-sm btn-{{ get_option('theme_color') }} m-xs" data-toggle="ajaxModal" data-rel="tooltip"--}}
			{{--title="@langapp('edit')  ">Bulk</a>--}}
			{{--<button type="submit" id="button" class="btn btn-sm btn-{{ get_option('theme_color') }} m-xs"--}}
			{{--value="bulk-edit">--}}
			{{--<span class="">@icon('solid/trash-alt')Bulk Edit</span>--}}
			{{--</button>--}}
			{{--@endif--}}
		</form>
	</section>
</div>
@push('pagestyle')
	@include('stacks.css.datatables')
@endpush
@push('pagescript')
	@include('stacks.js.datatables')
	<script>


		$(async function () {

			$('input#select-all[type="checkbox"]').click(async function () {

				if ($(this).prop("checked") == true) {
					console.log("Checkbox is checked.");
					$("input[type=checkbox]").prop('checked', $(this).prop('checked'));
					var pageRows = $('select[name="leads-table_length"]').children("option:selected").val();

					var filters = [];
					$("input.search").map(function (index, value) {

						if ($(value).val()) {

							var name = $(value).attr('id').toLowerCase();
							filters.push({[name]: $(value).val()});

						} else {

							var name = $(value).attr('id').toLowerCase();
							filters.push({[name]: false});
						}
					});

					const res = await axios.get('{{route('leads.leadsAllNumber')}}', {
						params: {
							'filters': filters,
							'perPage': pageRows
						}
					});
					if ($('input#select-all[type="checkbox"]').prop("checked") == true) {
						$("input[type=checkbox]").prop('checked', $(this).prop('checked'));
					}
					$('div.dataTables_length').append('<div id="question"><span >All ' + res.data.perPageCount + ' items on this page are selected </span>' +
						'<a id="selectAllRows" href="#">Select all ' + res.data.allCount + ' items</a></div>');

					$('a#selectAllRows').click(function (ev) {
						ev.preventDefault();

						bulkEdit(true);

					});
				}
				else {
					console.log("Checkbox is unchecked.");
					$('div#question').remove();
				}
				if ($(this).prop("checked") == true) {
					$("input[type=checkbox]").prop('checked', $(this).prop('checked'));
				}
			});
			var clickedOnce = 0;
			var modal = $('#myModal');

			$('.close').on('click', function () {
				modal.css('display', 'none');
				clickedOnce = 0;
			});

			$('#leads-table thead tr').clone(true).appendTo('#leads-table thead');
			var tableHeader = $('#leads-table thead tr:eq(1) th');

			var removed = tableHeader.splice(1, 1);

			$('#select-all').remove();
			tableHeader.each(async function (i, val) {

				var title = $(this).text();


				if ($(this).find("input").attr('name') == 'select_all' || !title) {

					return true;
				} else {
					title = title.replace(/\s+/g, '_').toLowerCase();

					if (title == 'local_time') {
						$(this).html('&nbsp');
						return true;
					}
					if (title.indexOf('_') > -1 && (title.split('_')[1] == 'time' || title.split('_')[1] == 'login')) {
						var field;
						field = $(this).html('<input class="search" type="text" name="daterange" id="' + title + '" placeholder="' + title + '" />').daterangepicker({
							autoUpdateInput: false,
							locale: {
								cancelLabel: 'Clear'
							}
						});

						field.on('apply.daterangepicker', function (ev, picker) {

							$(this).find('*').filter(':input:visible:first').val(picker.startDate.format('YYYY-MM-DD') + ' / ' + picker.endDate.format('YYYY-MM-DD'));
							$(this).find('*').filter(':input:visible:first').change();
							table.columns.adjust().draw();
						});
						field.on('cancel.daterangepicker', function (ev, picker) {
							$(this).find('*').filter(':input:visible:first').val('');
							$(this).find('*').filter(':input:visible:first').change();
							table.columns.adjust().draw();
						});


					} else if (title == 'stage') {
						$(this).html('<select class="select2-option form-control search"  id="' + title + '" name="stage" required>' +
							'<option value="">Choose: </option>' +
							'<option value="new">New</option>' +
							'<option value="voice mail">Voice Mail</option>' +
							'<option value="callback">Callback</option>' +
							'<option value="high potential">High potential</option>' +
							'<option value="converted">Converted</option>' +
							'<option value="closed account">Closed account</option>' +
							'<option value="not qualified - economic status">Not qualified - economic status</option>' +
							'<option value="not qualified - under 18">Not qualified - under 18</option>' +
							'</select>')

					} else if (title == 'sales_rep') {
						var self = $(this);
						await $.ajax({
							url: "/users/usersData",
							type: 'GET',
							success: function (res) {

								self.html(
									'<select class="select2-option form-control search"  id="' + title + '" name="stage" required>' +
									'<option value="">Choose: </option>' +
									res.map(function (value) {
										return '<option value="' + value + '">' + value + '</option>';
									}) +
									'</select>'
								);

							}
						});

					} else {

						$(this).html('<input class="search" type="text" id="' + title + '" placeholder="' + title + '" />');

					}
					$(this).find('*').filter('input[type=text]:visible:first').on('keyup change', function (event) {

						if (typeof event.keyCode !== "undefined") {
							if ($(this).val().length >= 2 || $(this).val().length == 0) {

								table.columns.adjust().draw();

								if ($('input#select-all[type="checkbox"]').prop("checked") === true) {
									$('input#select-all[type="checkbox"]').trigger('click');

									$('div#question').remove();
								}

							}
						}

					});

					$(this).find('select').on('change', function () {

						console.log('here2');
						if ($(this).val().length >= 2 || $(this).val().length == 0) {
							table.columns.adjust().draw();
							if ($('input#select-all[type="checkbox"]').prop("checked") === true) {
								$('input#select-all[type="checkbox"]').trigger('click');

								$('div#question').remove();
							}

						}

					});
					$(this).find('#sales_rep').on('change', function () {
						console.log('here3');
						if ($(this).val().length >= 2 || $(this).val().length == 0) {
							table.columns.adjust().draw();

							if ($('input#select-all[type="checkbox"]').prop("checked") === true) {
								$('input#select-all[type="checkbox"]').trigger('click');

								$('div#question').remove();
							}

						}
					});

				}
			});

			var table = $('#leads-table').DataTable({
				"autoWidth": true,

				"searching": false,
				orderCellsTop: true,
				fixedHeader: true,
				"fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
					if (aData['is_logged']) {
						$("td:eq(2)", nRow).html('<ul><li class="green">' + aData['name'] + '</li></ul>');
					} else {
						$("td:eq(2)", nRow).html('<ul><li class="red">' + aData['name'] + '</li></ul>');
					}

					if (aData['stage_id'] == 43 || aData['stage_id'] == null) {
						$('td', nRow).css('background-color', '#FCEFD8');
					} else if (aData['stage_id'] == 44 || aData['stage_id'] == 46) {
						$('td', nRow).css('background-color', '#DCECFB');
					} else if (aData['stage_id'] == 55 ||
						aData['stage_id'] == 45 ||
						aData['stage_id'] == 56 ||
						aData['stage_id'] == 57) {

						$('td', nRow).css('background-color', '#F9E1E0');

					} else if (aData['stage_id'] == 54) {
						$('td', nRow).css('background-color', '#F2FEE5');
					} else if (aData['stage_id'] == 42) {
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

								var name = $(value).attr('id').toLowerCase();

								data.search[name] = $(value).val();

							} else {

								var name = $(value).attr('id').toLowerCase();

								data.search[name] = false;
							}
						});
						$("select.search").map(function (index, value) {


							if ($(value).val()) {

								var name = $(value).attr('id').toLowerCase();

								data.search[name] = $(value).val();

							} else {

								var name = $(value).attr('id').toLowerCase();

								data.search[name] = false;
							}
						});
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

					{data: 'language', name: 'language'},
					{data: 'courses', name: 'courses'},


					{data: 'sales_rep', name: 'agent.name'},
					{data: 'stage', name: 'stage'},
					{data: 'last_login', name: 'last_login'},
					{data: 'local_time', name: 'local_time'}

				],
				"initComplete": function (settings, json) {

					if ($('input#select-all[type="checkbox"]').prop("checked") == true) {
						$("input[type=checkbox]").prop('checked', $(this).prop('checked'));
					}
				}
			}).columns.adjust();

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
				if ($(this).attr("value") == "bulk-edit") {
					clickedOnce++;

					if (clickedOnce <= 1) {
						bulkEdit();
						clickedOnce = 0;

					} else {
						console.log('nothing');
					}
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

			function bulkEdit(editAll) {


				var form = $("#frm-lead").serializeArray();
				var filters = [];
				$("input.search").map(function (index, value) {

					if ($(value).val()) {

						var name = $(value).attr('id').toLowerCase();
						filters.push({[name]: $(value).val()});

					} else {

						var name = $(value).attr('id').toLowerCase();
						filters.push({[name]: false});
					}
				});
				$("select.search").map(function (index, value) {

					if ($(value).val()) {
						var name = $(value).attr('id').toLowerCase();
						filters.push({[name]: $(value).val()});
					} else {

						var name = $(value).attr('id').toLowerCase();
						filters.push({[name]: false});
					}
				});
				var modal = $('#myModal');

				axios.post('{{ route('leads.bulkEditCheck') }}', {
					'form': form,
					'filters': filters,
					'perPage': $('select[name="leads-table_length"]').children("option:selected").val()
				}).then(async function (response) {

					try {
						const res = await axios.get('{{ route('leads.getEditValues') }}');
						console.log(res.data);
						$('#message-modal').html(
							'<form id="bulk-edit"> ' +
							'<label>Select Country:</label></br>' +
							'<select id="select-country" class="form-control select2-option" name="country">' +
							'</select>' +
							'<label>Select Agent:</label></br>' +
							'<select id="select-user" class="form-control select2-option" name="sales_rep">' +
							'</select>' +
							'<label>Select Stage:</label></br>' +
							'<select id="select-stage" class="form-control select2-option" name="stage">' +
							'</select>' +
							'<label>Select Desk:</label></br>' +
							'<select id="select-desk" class="form-control select2-option" name="desk">' +
							'</select>' +
							'<p>' + response.data.message + '</p>' +
							'<button id="submit-bulk-post" >Submit</button>' +
							'</form>'
						);


						var countrySelect = $('#select-country');

						$("<option />", {
							value: false,
							text: 'Select Country...'
						}).appendTo(countrySelect);

						for (var country in res.data.countries) {
							$("<option />", {
								value: res.data.countries[country]['name'],
								text: res.data.countries[country]['name']
							}).appendTo(countrySelect);
						}

						var userSelect = $('#select-user');
						$("<option />", {
							value: false,
							text: 'Select sales rep'
						}).appendTo(userSelect);

						for (var user in res.data.users) {

							$("<option />", {
								value: res.data.users[user]['id'],
								text: res.data.users[user]['name']
							}).appendTo(userSelect);
						}

						var stageSelect = $('#select-stage');
						$("<option />", {
							value: false,
							text: 'Select stage'
						}).appendTo(stageSelect);

						for (var stage in res.data.stages) {

							$("<option />", {
								value: res.data.stages[stage]['id'],
								text: res.data.stages[stage]['name']
							}).appendTo(stageSelect);
						}


						var deskSelect = $('#select-desk');
						$("<option />", {
							value: false,
							text: 'Select desk'
						}).appendTo(deskSelect);

						for (var desk in res.data.desks) {

							$("<option />", {
								value: res.data.desks[desk]['id'],
								text: res.data.desks[desk]['name']
							}).appendTo(deskSelect);
						}
						modal.css('display', 'block');

					} catch (error) {
						showErrors(error);
					}

					$('#submit-bulk-post').click(async function (ev) {

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

						console.log(filters);
						console.log(editAll);
						ev.preventDefault();
						try {
							const res = await axios.post('{{route('leads.postEdit')}}', {
								form: $('#bulk-edit').serializeArray(),
								filters: filters,
								editAll: editAll ? true : false
							});
							modal.css('display', 'none');
							table.columns.adjust().draw();
							$('div#question').remove();
							$("input[type=checkbox]").prop('checked', false);

							console.log(res.data);
						} catch (error) {
							showErrors(error);
						}
					});
				}).catch(function (error) {
					showErrors(error);
				});
			}
		});
	</script>
@endpush