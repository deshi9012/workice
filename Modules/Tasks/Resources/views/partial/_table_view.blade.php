<form id="frm-tasks" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="url" value="{{ url()->full() }}">
                    <table class="table table-striped" id="tasks-table">
                                <thead>
                                <tr>
                                    <th class="hide"></th>
                                    <th class="no-sort">
                                        <label>
                                            <input name="select_all" value="1" id="select-all" type="checkbox" />
                                            <span class="label-text"></span>
                                        </label>
                                    </th>

                                    <th class="">@langapp('task_name')</th>
                                    <th class="">@langapp('total_time')</th>
                                    <th class="">@langapp('hourly_rate')</th>
                                    <th class="col-date">@langapp('due_date')</th>
                                    <th class="no-sort">@langapp('progress')</th>
                                    <th class="col-options no-sort"></th>

                                </tr>
                                </thead>
                                
                </table>

                @if(can('tasks_update') || can('tasks_complete'))
                    <button type="submit" id="button" class="btn btn-sm btn-info m-xs" value="bulk-complete">
                        <span class="" data-rel="tooltip" title="Mark as Done">@icon('solid/check-circle') @langapp('done')</span>
                    </button>
                @endif
                @can('tasks_delete')
                    <button type="submit" id="button" class="btn btn-sm btn-danger m-xs" value="bulk-delete">
                        <span class="" data-rel="tooltip" title="Delete Selected">@icon('solid/trash-alt')</span>
                    </button>
                @endcan

        </form>


@push('pagestyle')
@include('stacks.css.datatables')
@endpush

@push('pagescript')
@include('stacks.js.datatables')
<script>
$(function() {
    $('#tasks-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
        url: '{!! route('tasks.all', ['id' => $project->id])!!}',
        data: {
        "filter": '{{ $filter }}',
        }
        },
        order: [[ 0, "desc" ]],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'chk', name: 'chk', orderable: false, searchable: false, sortable: false },
            { data: 'name', name: 'name' },
            { data: 'hours', name: 'hours', searchable: false, orderable: false},
            { data: 'hourly_rate', name: 'hourly_rate'},
            { data: 'due_date', name: 'due_date' },
            { data: 'progress', name: 'progress', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    $("#frm-tasks button").click(function(ev){
        ev.preventDefault();
        if($(this).attr("value")=="bulk-complete"){
            var form = $("#frm-tasks").serialize();
            axios.post('{{ route('tasks.api.bulk.close') }}', form).then(function (response) {
                toastr.info(response.data.message, '@langapp('response_status') ');
                window.location.href = response.data.redirect;
            })
            .catch(function (error) {
                    showErrors(error);
                });
        }  
        if($(this).attr("value")=="bulk-delete"){
            var form = $("#frm-tasks").serialize();
            axios.post('{{ route('tasks.api.bulk.delete') }}', form).then(function (response) {
                toastr.warning(response.data.message, '@langapp('response_status') ');
                window.location.href = response.data.redirect;
            })
            .catch(function (error) {
                    showErrors(error);
                });
        }   
        function showErrors(error){
        var errors = error.response.data.errors;
        var errorsHtml= '';
        $.each( errors, function( key, value ) {
            errorsHtml += '<li>' + value[0] + '</li>';
        });
            toastr.error( errorsHtml , '@langapp('response_status') ');
        }
});

});
</script>
@endpush