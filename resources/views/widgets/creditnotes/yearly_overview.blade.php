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
    <div id="credits-chart"></div>
  </div>
</section>
@push('pagescript')
@include('stacks.js.chart')
<script>
let chart = new frappe.Chart( "#credits-chart", {
data: {
  labels: ["{{ langdate('cal_jan') }}", "{{ langdate('cal_feb') }}", "{{ langdate('cal_mar') }}", "{{ langdate('cal_apr') }}", "{{ langdate('cal_may') }}", "{{ langdate('cal_jun') }}",
  "{{ langdate('cal_jul') }}", "{{ langdate('cal_aug') }}", "{{ langdate('cal_sep') }}", "{{ langdate('cal_oct') }}", "{{ langdate('cal_nov') }}", "{{ langdate('cal_dec') }}"],
  datasets: [
  {
    name: "{{ langapp('open_credits') }}", chartType: 'line',
    values: [{{ $open['jan'] }}, {{ $open['feb'] }}, {{ $open['mar'] }}, {{ $open['apr'] }}, {{ $open['may'] }}, {{ $open['jun'] }}, {{ $open['jul'] }},
    {{ $open['aug'] }}, {{ $open['sep'] }}, {{ $open['oct'] }}, {{ $open['nov'] }}, {{ $open['dec'] }}]
  },
  {
    name: "{{ langapp('closed_credits') }}", chartType: 'line',
    values: [{{ $closed['jan'] }}, {{ $closed['feb'] }}, {{ $closed['mar'] }}, {{ $closed['apr'] }}, {{ $closed['may'] }}, {{ $closed['jun'] }}, {{ $closed['jul'] }},
    {{ $closed['aug'] }}, {{ $closed['sep'] }}, {{ $closed['oct'] }}, {{ $closed['nov'] }}, {{ $closed['dec'] }}]
  }
  ]
},
title: "{{ langapp('amount_in', ['currency' => get_option('default_currency')]) }}",
type: 'axis-mixed',
height: 300,
colors: ['#fdab29', '#81e4b4'],
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