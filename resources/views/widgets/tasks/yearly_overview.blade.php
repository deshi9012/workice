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
    <div id="tasks-chart"></div>
  </div>
</section>
@push('pagescript')
@include('stacks.js.chart')
<script>
let chart = new frappe.Chart( "#tasks-chart", {
data: {
  labels: ["{{ langdate('cal_jan') }}", "{{ langdate('cal_feb') }}", "{{ langdate('cal_mar') }}", "{{ langdate('cal_apr') }}", "{{ langdate('cal_may') }}", "{{ langdate('cal_jun') }}",
  "{{ langdate('cal_jul') }}", "{{ langdate('cal_aug') }}", "{{ langdate('cal_sep') }}", "{{ langdate('cal_oct') }}", "{{ langdate('cal_nov') }}", "{{ langdate('cal_dec') }}"],
  datasets: [
  {
    name: "{{ langapp('tasks') }}", chartType: 'bar',
    values: [{{ $all['jan'] }}, {{ $all['feb'] }}, {{ $all['mar'] }}, {{ $all['apr'] }}, {{ $all['may'] }}, {{ $all['jun'] }}, {{ $all['jul'] }},
    {{ $all['aug'] }}, {{ $all['sep'] }}, {{ $all['oct'] }}, {{ $all['nov'] }}, {{ $all['dec'] }}]
  },
  {
    name: "{{ langapp('done') }}", chartType: 'line',
    values: [{{ $done['jan'] }}, {{ $done['feb'] }}, {{ $done['mar'] }}, {{ $done['apr'] }}, {{ $done['may'] }}, {{ $done['jun'] }}, {{ $done['jul'] }},
    {{ $done['aug'] }}, {{ $done['sep'] }}, {{ $done['oct'] }}, {{ $done['nov'] }}, {{ $done['dec'] }}]
  }
  ]
},
title: "{{ langapp('overview') }}",
type: 'axis-mixed',
height: 300,
colors: ['#d5d1f1', '#fdab29'],
tooltipOptions: {
    formatTooltipX: function formatTooltipX(d) {
      return (d + '').toUpperCase();
    },
    formatTooltipY: function formatTooltipY(d) {
      return d + ' ';
    }
  }
});
</script>
@endpush