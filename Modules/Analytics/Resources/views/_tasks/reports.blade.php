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
                            <header class="panel-heading">@langapp('tasks_overview')</header>
                            <div class="row wrapper analytics">
                                <div class="col-sm-12 m-b-xs">
                                    <form>
                                        <div class="inline v-middle col-md-4">
                                            <label>@langapp('date_range')</label>
                                            <input type="text" class="form-control" id="reportrange" name="range">
                                        </div>
                                        
                                        <div class="inline v-middle">
                                            <label>@langapp('project')</label>
                                            <select class="form-control input-s-sm" id="filter-project" name="project">
                                                <option value="-">-</option>
                                                @foreach (Modules\Tasks\Entities\Task::select('project_id')->with('AsProject:id,name')->where('project_id', '>', 0)->groupBy('project_id')->orderBy('id','desc')->get() as $task)
                                                <option value="{{ $task->project_id }}">{{ optional($task->AsProject)->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="inline v-middle">
                                            <label>@langapp('milestone')</label>
                                            <select class="form-control input-s-sm" id="filter-milestone" name="milestone">
                                                <option value="-">-</option>
                                                @foreach (Modules\Tasks\Entities\Task::select('id', 'milestone_id')->with('AsMilestone:id,milestone_name')->where('milestone_id', '>', 0)->groupBy('milestone_id')->get() as $mil)
                                                <option value="{{ $mil->milestone_id }}">{{ optional($mil->AsMilestone)->milestone_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="inline v-middle">
                                            <label>@langapp('stage')</label>
                                            <select class="form-control input-s-sm" id="filter-status" name="stage">
                                                <option value="-">-</option>
                                                @foreach (App\Entities\Category::tasks()->get() as $stage)
                                                    <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                        <div class="inline v-middle">
                                            <label>@langapp('user')</label>
                                            <select class="form-control input-s-sm" id="filter-user" name="user_id">
                                                <option value="-">-</option>
                                                @foreach (Modules\Tasks\Entities\Task::select('user_id')->with('user:id,username,name')->groupBy('user_id')->get() as $cr)
                                                <option value="{{ $cr->user_id }}">{{ optional($cr->user)->name }}</option>
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
$('#reportrange, #filter-project, #filter-milestone, #filter-status, #filter-user').change(function(event) {
loadData(event);
}).change();
function loadData(val) {
axios.post('{{ route('reports.tasks.filter') }}', {
    range: $('#reportrange').val(),
    project: $('#filter-project').val(),
    milestone: $('#filter-milestone').val(),
    stage: $('#filter-status').val(),
    owner: $('#filter-user').val(),
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