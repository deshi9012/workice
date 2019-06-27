<section class="panel panel-default">
  <header class="panel-heading">
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
    <div id="invoice-chart"></div>
  </div>
</section>
@push('pagescript')
@include('stacks.js.chart')
<script>
let chart = new frappe.Chart( "#invoice-chart", {
data: {
  labels: ["{{ langdate('cal_jan') }}", "{{ langdate('cal_feb') }}", "{{ langdate('cal_mar') }}", "{{ langdate('cal_apr') }}", "{{ langdate('cal_may') }}", "{{ langdate('cal_jun') }}",
  "{{ langdate('cal_jul') }}", "{{ langdate('cal_aug') }}", "{{ langdate('cal_sep') }}", "{{ langdate('cal_oct') }}", "{{ langdate('cal_nov') }}", "{{ langdate('cal_dec') }}"],
  datasets: [
  {
    name: "{{ langapp('invoiced') }}", chartType: 'bar',
    values: [{{ $invoiced['jan'] }}, {{ $invoiced['feb'] }}, {{ $invoiced['mar'] }}, {{ $invoiced['apr'] }}, {{ $invoiced['may'] }}, {{ $invoiced['jun'] }}, {{ $invoiced['jul'] }},
    {{ $invoiced['aug'] }}, {{ $invoiced['sep'] }}, {{ $invoiced['oct'] }}, {{ $invoiced['nov'] }}, {{ $invoiced['dec'] }}]
  },
  {
    name: "{{ langapp('receipts') }}", chartType: 'line',
    values: [{{ $receipts['jan'] }}, {{ $receipts['feb'] }}, {{ $receipts['mar'] }}, {{ $receipts['apr'] }}, {{ $receipts['may'] }}, {{ $receipts['jun'] }}, {{ $receipts['jul'] }},
    {{ $receipts['aug'] }}, {{ $receipts['sep'] }}, {{ $receipts['oct'] }}, {{ $receipts['nov'] }}, {{ $receipts['dec'] }}]
  }
  ]
},
title: "{{ langapp('amount_in', ['currency' => get_option('default_currency')]) }}",
type: 'axis-mixed',
height: 300,
colors: ['#d5d1f1', '#4a90e2'],
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