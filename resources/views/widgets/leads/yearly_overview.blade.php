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
          <li><a href="?m=leads&setyear={{ $y }}">{{ $y }}</a></li>
          @endforeach
        </ul>
      </div>
    </div>
  </header>
  <div class="panel-body">
    <div id="yearly-lead-chart"></div>
  </div>
  
</section>
@push('pagescript')
@include('stacks.js.chart')
<script>
let chart = new frappe.Chart( "#yearly-lead-chart", {
data: {
labels: ["{{ langdate('cal_jan') }}", "{{ langdate('cal_feb') }}", "{{ langdate('cal_mar') }}", "{{ langdate('cal_apr') }}", "{{ langdate('cal_may') }}", "{{ langdate('cal_jun') }}",
"{{ langdate('cal_jul') }}", "{{ langdate('cal_aug') }}", "{{ langdate('cal_sep') }}", "{{ langdate('cal_oct') }}", "{{ langdate('cal_nov') }}", "{{ langdate('cal_dec') }}"],
datasets: [
{
  name: "{{ langapp('leads') }}", chartType: 'line',
  values: [{{ $stats['jan'] }}, {{ $stats['feb'] }}, {{ $stats['mar'] }}, {{ $stats['apr'] }}, {{ $stats['may'] }}, {{ $stats['jun'] }}, {{ $stats['jul'] }},
  {{ $stats['aug'] }}, {{ $stats['sep'] }}, {{ $stats['oct'] }}, {{ $stats['nov'] }}, {{ $stats['dec'] }}]
}
],

},
title: "{{ langapp('leads_captured') }}",
type: 'axis-mixed',
height: 300,
colors: ['#fdab29'],
tooltipOptions: {
  formatTooltipX: d => (d + '').toUpperCase(),
  formatTooltipY: d => d + ' ',
}
});
</script>
@endpush