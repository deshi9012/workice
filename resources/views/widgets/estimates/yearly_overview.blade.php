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
    <div id="yearly-estimate-chart"></div>
  </div>
</section>
@push('pagescript')
@include('stacks.js.chart')
<script>
let chart = new frappe.Chart( "#yearly-estimate-chart", {
data: {
  labels: ["{{ langdate('cal_jan') }}", "{{ langdate('cal_feb') }}", "{{ langdate('cal_mar') }}", "{{ langdate('cal_apr') }}", "{{ langdate('cal_may') }}", "{{ langdate('cal_jun') }}",
  "{{ langdate('cal_jul') }}", "{{ langdate('cal_aug') }}", "{{ langdate('cal_sep') }}", "{{ langdate('cal_oct') }}", "{{ langdate('cal_nov') }}", "{{ langdate('cal_dec') }}"],
  datasets: [
  {
    name: "{{ langapp('accepted') }}", chartType: 'line',
    values: [{{ $accepted['jan'] }}, {{ $accepted['feb'] }}, {{ $accepted['mar'] }}, {{ $accepted['apr'] }}, {{ $accepted['may'] }}, {{ $accepted['jun'] }}, {{ $accepted['jul'] }},
    {{ $accepted['aug'] }}, {{ $accepted['sep'] }}, {{ $accepted['oct'] }}, {{ $accepted['nov'] }}, {{ $accepted['dec'] }}]
  },
  {
    name: "{{ langapp('declined') }}", chartType: 'line',
    values: [{{ $declined['jan'] }}, {{ $declined['feb'] }}, {{ $declined['mar'] }}, {{ $declined['apr'] }}, {{ $declined['may'] }}, {{ $declined['jun'] }}, {{ $declined['jul'] }},
    {{ $declined['aug'] }}, {{ $declined['sep'] }}, {{ $declined['oct'] }}, {{ $declined['nov'] }}, {{ $declined['dec'] }}]
  }
  ]
},
title: "{{ langapp('amount_in', ['currency' => get_option('default_currency')]) }}",
type: 'axis-mixed',
height: 300,
colors: ['#8baaef', 'red'],
tooltipOptions: {
    formatTooltipX: function formatTooltipX(d) {
      return (d + '').toUpperCase();
    },
    formatTooltipY: function formatTooltipY(d) {
      return d.format(2, 3, "{{ get_option('thousands_separator') }}", "{{ get_option('decimal_separator') }}") + "{{ get_option('default_currency_symbol') }}";
    }
  }
});
</script>
@endpush