@extends('layouts.app') 

@section('content')


<section id="content">
    <section class="hbox stretch">
        <aside>
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
                                    <header class="panel-heading">@langapp('tickets_reports')</header>
                                    <div class="row wrapper analytics">
                                        <div class="col-sm-10 m-b-xs">
                                            <form>

                                                <div class="inline v-middle col-md-4">
                                                            <label>@langapp('date_range')</label>
                                                            <input type="text" class="form-control" id="reportrange" name="range">
                                                          </div>


                                                <div class="inline v-middle">
                                            <label>@langapp('reporter')</label>
                                            <select class="form-control input-s-sm" id="filter-user" name="user">
                                                <option value="-">-</option>
                                                @foreach (Modules\Tickets\Entities\Ticket::select('user_id')->with('user:id,username,name')->groupBy('user_id')->get() as $t)
                                                <option value="{{ $t->user_id }}">{{ optional($t->user)->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                                     <div class="inline v-middle">
                                                        <label>@langapp('status')</label>
                                                <select class="form-control input-s-sm" id="filter-status">
                                                    <option value="-">-</option>
                                                    @foreach (App\Entities\Status::all() as $status)
                                                    <option value="{{ $status->id }}" {{ $status->status == 'open' ? 'selected' : '' }}>{{ ucfirst($status->status) }}</option>
                                                    @endforeach
                                                </select>
                                                </div>

                                                <div class="inline v-middle">
                                                        <label>@langapp('department')</label>
                                                <select class="form-control input-s-sm" id="filter-department">
                                                        <option value="-">-</option>
                                                     @foreach (App\Entities\Department::all() as $dept)
                                                            <option value="{{ $dept->deptid }}">{{ ucfirst($dept->deptname) }}</option>
                                                            @endforeach
                                                </select>
                                                </div>

                                                <div class="inline v-middle">
                                                        <label>@langapp('priority')</label>
                                                <select class="form-control input-s-sm" id="filter-priority">
                                                        <option value="-">-</option>
                                                     @foreach (App\Entities\Priority::all() as $p)
                                                            <option value="{{ $p->id }}">{{ ucfirst($p->priority) }}</option>
                                                            @endforeach
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
        </aside>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>

@push('pagescript')
@include('analytics::_daterangepicker')
<script type="text/javascript">
$('#reportrange, #filter-user, #filter-status, #filter-department, #filter-priority').change(function(event) {
loadData(event);
}).change();
function loadData(val) {
axios.post('{{ route('reports.tickets.filter') }}', {
    range: $('#reportrange').val(),
    status: $('#filter-status').val(),
    department: $('#filter-department').val(),
    priority: $('#filter-priority').val(),
    owner: $('#filter-user').val(),
})
.then(function (response) {
$('#ajaxData').html(response.data.html);
})
.catch(function (error) {
    toastr.error( 'Failed loading data' , '@langapp('response_status') ');
});
}
</script>
@endpush

@endsection