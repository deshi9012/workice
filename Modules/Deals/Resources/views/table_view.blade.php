<div class="col-lg-12">

    <section class="panel panel-default">

        <form id="frm-deal"  method="POST">
        <input type="hidden" name="module" value="deals">

        <div class="table-responsive">
            <table id="deals-table" class="table table-striped">
                <thead>
                <tr>
                    <th class="hide"></th>
                    <th class="no-sort">
                        <label>
                            <input name="select_all" value="1" id="select-all" type="checkbox" />
                            <span class="label-text"></span>
                        </label>
                    </th>
                    <th>@langapp('title')   </th>
                    <th class="col-currency">@langapp('deal_value')  </th>
                    <th>@langapp('stage')  </th>
                    <th>@langapp('organization')  </th>
                    <th class="hidden-sm">@langapp('contact_person')  </th>
                    <th class="col-date">@langapp('close_date')   </th>
                </tr>
                </thead>

            </table>

        </div>

        @can('deals_update')
            <button type="submit" id="button" class="btn btn-sm btn-{{ get_option('theme_color') }} m-xs" value="bulk-archive">
            <span class="">@icon('solid/archive') @langapp('archive')</span>
            </button>
        @endcan

          @can('deals_delete')
                            <button type="submit" class="btn btn-sm btn-{{ get_option('theme_color') }} m-sm" value="bulk-delete">
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
    $(function() {

         var table = $('#deals-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('deals.data') }}',
                data: {
                    "filter": '{{ $filter }}',
                }
            },
            order: [[ 0, "desc" ]],
            columns: [
                { data: 'id', name: 'id' },
                { data: 'chk', name: 'chk' , searchable: false},
                { data: 'title', name: 'title' },
                { data: 'deal_value', name: 'deal_value' },
                { data: 'stage', name: 'category.name' },
                { data: 'organization', name: 'company.name' },
                { data: 'contact_person', name: 'contact.name' },
                { data: 'due_date', name: 'due_date' },
            ]
        });


        $("#frm-deal button").click(function(ev){
        ev.preventDefault();
        if($(this).attr("value")=="bulk-email"){
            var form = $("#frm-deal").serialize();
            $("#frm-deals").submit();
        }

    if($(this).attr("value")=="bulk-archive"){
        var form = $("#frm-deal").serialize();
        axios.post('{{ route('archive.process') }}', form)
        .then(function (response) {
        toastr.warning(response.data.message, '@langapp('response_status') ');
        window.location.href = response.data.redirect;
        })
        .catch(function (error) {
            showErrors(error);
        });
    }

if($(this).attr("value")=="bulk-delete"){
    var form = $("#frm-deal").serialize();
    axios.post('{{ route('deals.bulk.delete') }}', form)
    .then(function (response) {
    toastr.warning(response.data.message, '@langapp('response_status') ');
    window.location.href = response.data.redirect;
    })
    .catch(function (error) {
        showErrors(error);
    });
    }


});

    function showErrors(error){
        var errors = error.response.data.errors;
        var errorsHtml= '';
        $.each( errors, function( key, value ) {
        errorsHtml += '<li>' + value[0] + '</li>';
        });
        toastr.error( errorsHtml , '@langapp('response_status') ');
    }


    });
</script>
@endpush