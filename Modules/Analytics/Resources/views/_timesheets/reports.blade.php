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
                            <header class="panel-heading">@langapp('timesheets_reports')</header>
                            <div class="row wrapper analytics">
                                <div class="col-sm-12 m-b-xs">
                                    <form>
                                        <div class="inline v-middle col-md-4">
                                            <label>@langapp('date_range')</label>
                                            <input type="text" class="form-control" id="reportrange" name="range">
                                        </div>
                                        
                                        <div class="inline v-middle">
                                            <label>@langapp('project')</label>
                                            <select class="form-control input-s-sm" id="filter-project">
                                                <option value="-">-</option>
                                                @foreach (Modules\Timetracking\Entities\TimeEntry::select('timeable_type', 'timeable_id')->where('timeable_type', Modules\Projects\Entities\Project::class)->groupBy('timeable_id')->get() as $entry)
                                                <option value="{{ $entry->timeable_id }}">{{ optional($entry->timeable)->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="inline v-middle">
                                            <label>@langapp('task')</label>
                                            <select class="form-control input-s-sm" id="filter-task">
                                                <option value="-">-</option>
                                                @foreach (Modules\Timetracking\Entities\TimeEntry::select('timeable_type', 'timeable_id')->where('timeable_type', Modules\Tasks\Entities\Task::class)->groupBy('timeable_id')->get() as $taskEntry)
                                                <option value="{{ $taskEntry->timeable_id }}">{{ optional($taskEntry->timeable)->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="inline v-middle">
                                            <label>@langapp('billable')</label>
                                            <select class="form-control input-s-sm" id="filter-billable">
                                                <option value="1">@langapp('yes') </option>
                                                <option value="0">@langapp('no') </option>
                                            </select>
                                        </div>
                                        <div class="inline v-middle">
                                            <label>@langapp('user')</label>
                                            <select class="form-control input-s-sm " id="filter-user">
                                                <option value="-">-</option>
                                                @foreach (Modules\Timetracking\Entities\TimeEntry::select('user_id')->with('user:id,username,name')->groupBy('user_id')->get() as $userEntry)
                                                <option value="{{ $userEntry->user_id }}">{{ optional($userEntry->user)->name }}</option>
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
$('#reportrange, #filter-project, #filter-task, #filter-billable, #filter-user').change(function(event) {
loadData(event);
}).change();
function loadData(val) {
axios.post('{{ route('reports.timesheets.filter') }}', {
    range: $('#reportrange').val(),
    timeable_project: $('#filter-project').val(),
    timeable_task: $('#filter-task').val(),
    billable: $('#filter-billable').val(),
    owner: $('#filter-user').val(),
})
.then(function (response) {
    $('#ajaxData').html(response.data.html);
})
.catch(function (error) {
    toastr.error( 'Failed to load data', '@langapp('response_status') ');
});
}
</script>
@endpush
@endsection