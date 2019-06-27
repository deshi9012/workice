@extends('layouts.app')
@section('content')
<section id="content" class="bg">
    
    <section class="vbox">
        <header class="header bg-white b-b b-light">

            

            <div class="btn-group">
                <button class="btn btn-{{ get_option('theme_color') }} btn-sm dropdown-toggle"
                data-toggle="dropdown"> @langapp('filter')
                <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('clients.index', ['filter' => 'balance']) }}">
                        @langapp('outstanding')
                    </a>
                </li>
                <li>
                    <a href="{{ route('clients.index', ['filter' => 'expenses']) }}">
                    @langapp('expenses')
                    </a>
                </li>
                <li>
                    <a href="{{ route('clients.index', ['filter' => 'prospects']) }}">
                    @langapp('prospects')
                    </a>
                </li>
                <li>
                    <a href="{{ route('clients.index', ['filter' => 'customers']) }}">
                    @langapp('customers')
                    </a>
                </li>
            <li><a href="{{ route('clients.index') }}">@langapp('all') </a></li>
        </ul>
    </div>

    @can('clients_create')

    <a href="{{  route('clients.create')  }}"
        class="btn btn-{{ get_option('theme_color') }} btn-sm btn-responsive" data-toggle="ajaxModal"
        title="@langapp('create') " data-placement="bottom">
        @icon('solid/plus') @langapp('create')
    </a>
    
    <a href="{{  route('clients.import')  }}" class="btn btn-{{ get_option('theme_color') }} btn-sm btn-responsive" title="@langapp('import_clients') " data-placement="bottom" data-toggle="ajaxModal">
        @icon('solid/cloud-upload-alt') @langapp('import')
    </a>
    <a href="{{  route('clients.export')  }}"
        class="btn btn-{{ get_option('theme_color') }} btn-sm btn-responsive" title="CSV" data-placement="bottom">
        @icon('solid/cloud-download-alt') CSV
    </a>
    
    @endcan



    


</header>
<section class="scrollable wrapper">
            <section class="panel panel-default">
                <form id="frm-client" method="POST">
                    <div class="table-responsive">
                    <table class="table table-striped" id="clients-table">
                        <thead>
                            <tr>
                                <th class="hide"></th>
                                <th class="no-sort">
                                    <label>
                                        <input name="select_all" value="1" id="select-all" type="checkbox" />
                                        <span class="label-text"></span>
                                    </label>
                                </th>
                                <th>@langapp('name')</th>
                                <th class="col-currency">@langapp('balance') </th>
                                <th class="col-currency">@langapp('expenses') </th>
                                <th>@langapp('contact_person') </th>
                                <th>@langapp('email') </th>
                            </tr>
                        </thead>
                    </table>
                    @can('clients_delete')
                    <button type="submit" id="button" class="btn btn-sm btn-{{ get_option('theme_color') }} m-xs" value="bulk-delete">
                    <span class="">@icon('solid/trash-alt') @langapp('delete')</span>
                    </button>
                    @endcan

                    </div>
                </form>
            </section>
</section>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>
@push('pagestyle')
@include('stacks.css.datatables')
@endpush
@push('pagescript')
@include('stacks.js.datatables')
<script>
$(function() {
var table = $('#clients-table').DataTable({
processing: true,
serverSide: true,
ajax: {
url: '{!! route('clients.data') !!}',
data: {
"filter": '{{ $filter }}',
}
},
order: [[ 0, "desc" ]],
columns: [
{ data: 'id', name: 'id', searchable: false },
{ data: 'chk', name: 'chk', searchable: false, orderable:false },
{ data: 'name', name: 'name', searchable: true },
{ data: 'outstanding', name: 'balance' },
{ data: 'expense_cost', name: 'expense' },
{ data: 'contact_person', name: 'contact_person', orderable:false, searchable: false },
{ data: 'email', name: 'email' }
]
});
$("#frm-client button").click(function(ev){
ev.preventDefault();
if($(this).attr("value")=="bulk-delete"){
var form = $("#frm-client").serialize();
axios.post('{{ route('clients.bulk.delete') }}', form)
.then(function (response) {
    toastr.warning(response.data.message, '@langapp('response_status') ');
    window.location.href = response.data.redirect;
})
.catch(function (error) {
    var errors = error.response.data.errors;
    var errorsHtml= '';
    $.each( errors, function( key, value ) {
        errorsHtml += '<li>' + value[0] + '</li>';
    });
    toastr.error( errorsHtml , '@langapp('response_status') ');
});
}


});
});
</script>
@endpush
@endsection