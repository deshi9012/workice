@extends('layouts.app')
@section('content')
<section id="content">
    <section class="hbox stretch">

            <section class="vbox">
                <section class="scrollable wrapper bg">
                    <section class="panel panel-default">
                        <header class="panel-heading">
                            @include('analytics::report_header')
                        </header>
                        <div class="panel-body">
                            <?php
                            $start_date = date('F d, Y', strtotime($range[0]));
                            $end_date = date('F d, Y', strtotime($range[1]));
                            ?>
                            <section class="panel panel-default">
                            <header class="panel-heading">@langapp('reports')</header>
                            <div class="row wrapper analytics">
                                <div class="col-sm-12 m-b-xs">
                                    <form class="ajax-filter">
                                        <div class="inline v-middle col-md-4">
                                            <label>@langapp('date_range')</label>
                                            <input type="text" class="form-control" id="reportrange" name="range">
                                        </div>

                                        <div class="inline v-middle">
                                            <label>@langapp('pipeline')</label>
                                            <select class="form-control input-s-sm" id="filter-pipeline" name="pipeline">
                                                <option value="-">-</option>
                                                @foreach (\App\Entities\Category::whereModule('pipeline')->get() as $pipeline)
                                                <option value="{{ $pipeline->id }}" {{ $pipeline->id == get_option('default_deal_pipeline') ? 'selected' : '' }}>{{ ucfirst($pipeline->name) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="inline v-middle">
                                            <label>@langapp('stage')</label>
                                            <select class="form-control input-s-sm" name="stage_id" id="filter-stage">
                                                <option value="-">-</option>
                                                @foreach (Modules\Deals\Entities\Deal::select('stage_id')->with('category')->groupBy('stage_id')->get() as $dealStage)
                                                <option value="{{ $dealStage->stage_id }}" {{ $dealStage->stage_id == get_option('default_deal_stage') ? 'selected' : '' }}>{{ optional($dealStage->category)->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="inline v-middle">
                                            <label>@langapp('user')</label>
                                            <select class="form-control input-s-sm" name="owner" id="filter-owner">
                                                <option value="-">-</option>
                                                @foreach (Modules\Deals\Entities\Deal::select('user_id')->with('user:id,username,name')->groupBy('user_id')->get() as $dealOwner)
                                                <option value="{{ $dealOwner->user_id }}" {{ $dealOwner->user_id == get_option('default_deal_owner') ? 'selected' : '' }}>{{ optional($dealOwner->user)->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="inline v-middle">
                                            <label>@langapp('status')</label>
                                            <select class="form-control input-s-sm" name="status" id="filter-status">
                                                <option value="-">-</option>
                                                <option value="open">@langapp('open') </option>
                                                <option value="won">@langapp('won') </option>
                                                <option value="lost">@langapp('lost') </option>
                                                
                                            </select>
                                        </div>
                                        
                                        
                                        
                                    </form>
                                </div>
                            </div>


                            <div id="ajaxData"></div>
                            
                            
                            
                        </section>
                    </div>
                </section>
            </section>
        </section>

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>

@push('pagescript')
@include('analytics::_daterangepicker')
    <script type="text/javascript">
    $('#reportrange, #filter-stage, #filter-owner, #filter-status, #filter-pipeline').change(function(event) {
        loadData(event);
    }).change();

    function loadData(val) {
            axios.post('{{ route('reports.deals.filter') }}', {
                range: $('#reportrange').val(),
                stage_id: $('#filter-stage').val(),
                owner: $('#filter-owner').val(),
                status: $('#filter-status').val(),
                pipeline: $('#filter-pipeline').val(),
            })
            .then(function (response) {
                    $('#ajaxData').html(response.data.html);
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

    </script>
@endpush

@endsection