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
    <div id="timesheet-chart"></div>
  </div>
</section>
@push('pagescript')
@include('stacks.js.chart')
<script>
let chart = new frappe.Chart( "#timesheet-chart", {
data: {
  labels: ["{{ langdate('cal_jan') }}", "{{ langdate('cal_feb') }}", "{{ langdate('cal_mar') }}", "{{ langdate('cal_apr') }}", "{{ langdate('cal_may') }}", "{{ langdate('cal_jun') }}",
  "{{ langdate('cal_jul') }}", "{{ langdate('cal_aug') }}", "{{ langdate('cal_sep') }}", "{{ langdate('cal_oct') }}", "{{ langdate('cal_nov') }}", "{{ langdate('cal_dec') }}"],
  datasets: [
  {
    name: "{{ langapp('worked') }}", chartType: 'line',
    values: [{{ $worked['jan'] }}, {{ $worked['feb'] }}, {{ $worked['mar'] }}, {{ $worked['apr'] }}, {{ $worked['may'] }}, {{ $worked['jun'] }}, {{ $worked['jul'] }},
    {{ $worked['aug'] }}, {{ $worked['sep'] }}, {{ $worked['oct'] }}, {{ $worked['nov'] }}, {{ $worked['dec'] }}]
  },
  {
    name: "{{ langapp('billed') }}", chartType: 'line',
    values: [{{ $billed['jan'] }}, {{ $billed['feb'] }}, {{ $billed['mar'] }}, {{ $billed['apr'] }}, {{ $billed['may'] }}, {{ $billed['jun'] }}, {{ $billed['jul'] }},
    {{ $billed['aug'] }}, {{ $billed['sep'] }}, {{ $billed['oct'] }}, {{ $billed['nov'] }}, {{ $billed['dec'] }}]
  }
  ]
},
title: "{{ langapp('overview') }}",
type: 'axis-mixed',
height: 300,
colors: ['purple', '#7cd6fd'],
tooltipOptions: {
    formatTooltipX: function formatTooltipX(d) {
      return (d + '').toUpperCase();
    },
    formatTooltipY: function formatTooltipY(d) {
      return d.format(2, 3, "{{ get_option('thousands_separator') }}", "{{ get_option('decimal_separator') }}") + "@langapp('hours')";
    }
  }
});
</script>
@endpush