@extends('layouts.app')
@section('content')
<section id="content">
    <section class="hbox stretch">
        <aside>
            <section class="vbox">
                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-5 m-b-xs">
                            <span class="h3">{{ __('CSV Map Fields') }} </span>
                        </div>
                        <div class="col-sm-7 m-b-xs">
                            <a href="{{ route('deals.export') }}" class="btn btn-sm btn-info pull-right">
                                @icon('solid/file-alt') CSV
                            </a>
                        </div>
                    </div>
                </header>
                <section class="scrollable wrapper bg">
                    <section class="panel panel-default">
                        <div class="panel-body">
                            
                                

                               
                            {!! Form::open(['route' => 'deals.csvprocess', 'class' => 'form-horizontal ajaxifyForm']) !!}
                            
                            <input type="hidden" name="csv_data_file_id" value="{{ $csv_data_file->id }}" />

                            @component('components.csv-note') @endcomponent

                            <div class="table-responsive">
                                <table class="table table-striped" id="csvmap">
                                    <thead>
                                        @if (isset($csv_header_fields))
                                        <tr>
                                            @foreach ($csv_header_fields as $csv_header_field)
                                            <th>{{ humanize($csv_header_field) }}</th>
                                            @endforeach
                                        </tr>
                                        @endif
                                    </thead>
                                    <tbody>
                                        @foreach ($csv_data as $row)
                                        <tr>
                                            @foreach ($row as $key => $value)
                                            <td>{{ is_numeric($value) ? sprintf('%.0f', $value) : $value }}</td>
                                            @endforeach
                                        </tr>
                                        @endforeach
                                        <tr>
                                            @foreach ($csv_data[0] as $key => $value)
                                            <td>
                                                <select name="fields[{{ $key }}]" class="form-control">
                                                    <option value="-">No Selection</option>
                                                    @foreach (config('db-fields.deal') as $db_field)
                                                    <option value="{{ (\Request::has('header')) ? $db_field : $loop->index }}" @if ($key === $db_field) selected @endif>{{ humanize($db_field) }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="pull-right m-xs">
                                {!! renderAjaxButton('import', 'fa fa-cloud-upload', true) !!}
                            </div>
                            {!! Form::close() !!}

                        

                        </div>
                    </div>
                </section>
            </section>
        </section>
    </aside>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
@push('pagescript')
@include('stacks.js.datatables')
<script type="text/javascript">
$(document).ready(function() {
$('#csvmap').DataTable( {
    "scrollX": false,
    "paging":   false,
    "searching": false,
} );
} );
</script>
@endpush
@endsection