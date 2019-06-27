<section class="panel panel-default">
  
  <header class="panel-heading font-bold">
    {{ $year }} - @langapp('yearly_overview')
    <div class="m-b-sm pull-right">
      <div class="btn-group">
        <button class="btn btn-dark btn-xs dropdown-toggle" data-toggle="dropdown">@langapp('year') <span
        class="caret"></span></button>
        <ul class="dropdown-menu">
          @php $min = date('Y') - 3; @endphp
          @foreach (range($min, date('Y')) as $y)
          <li><a href="?setyear={{ $y }}">{{ $y }}</a></li>
          @endforeach
        </ul>
      </div>
    </div>
  </header>
  
  <div class="panel-body">
    <div id="task-project-chart"></div>
  </div>
</section>
@push('pagescript')
@include('stacks.js.chart')
<script>
let chart = new frappe.Chart( "#task-project-chart", {
data: {
labels: ["{{ langdate('cal_jan') }}", "{{ langdate('cal_feb') }}", "{{ langdate('cal_mar') }}", "{{ langdate('cal_apr') }}", "{{ langdate('cal_may') }}", "{{ langdate('cal_jun') }}",
"{{ langdate('cal_jul') }}", "{{ langdate('cal_aug') }}", "{{ langdate('cal_sep') }}", "{{ langdate('cal_oct') }}", "{{ langdate('cal_nov') }}", "{{ langdate('cal_dec') }}"],
datasets: [
{
  name: "{{ langapp('projects') }}", chartType: 'bar',
  values: [{{ $projects['jan'] }}, {{ $projects['feb'] }}, {{ $projects['mar'] }}, {{ $projects['apr'] }}, {{ $projects['may'] }}, {{ $projects['jun'] }}, {{ $projects['jul'] }},
  {{ $projects['aug'] }}, {{ $projects['sep'] }}, {{ $projects['oct'] }}, {{ $projects['nov'] }}, {{ $projects['dec'] }}]
},
{
  name: "{{ langapp('tasks') }}", chartType: 'bar',
  values: [{{ $tasks['jan'] }}, {{ $tasks['feb'] }}, {{ $tasks['mar'] }}, {{ $tasks['apr'] }}, {{ $tasks['may'] }}, {{ $tasks['jun'] }}, {{ $tasks['jul'] }},
  {{ $tasks['aug'] }}, {{ $tasks['sep'] }}, {{ $tasks['oct'] }}, {{ $tasks['nov'] }}, {{ $tasks['dec'] }}]
},
{
  name: "{{ langapp('issues') }}", chartType: 'line',
  values: [{{ $issues['jan'] }}, {{ $issues['feb'] }}, {{ $issues['mar'] }}, {{ $issues['apr'] }}, {{ $issues['may'] }}, {{ $issues['jun'] }}, {{ $issues['jul'] }},
  {{ $issues['aug'] }}, {{ $issues['sep'] }}, {{ $issues['oct'] }}, {{ $issues['nov'] }}, {{ $issues['dec'] }}]
},
],
},
title: "{{ langapp('projects_analysis') }}",
type: 'axis-mixed',
height: 300,
colors: ['#4a90e2', '#ffa3ef', 'light-blue'],
tooltipOptions: {
  formatTooltipX: d => (d + '').toUpperCase(),
  formatTooltipY: d => d + '',
}
});
</script>
@endpush