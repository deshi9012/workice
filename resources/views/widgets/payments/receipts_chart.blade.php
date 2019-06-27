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
  
  <div id="receipts-chart"></div>
  
</section>


@push('pagescript')
@include('stacks.js.chart')
<script>
let chart = new frappe.Chart( "#receipts-chart", {
data: {
labels: ["{{ langdate('cal_jan') }}", "{{ langdate('cal_feb') }}", "{{ langdate('cal_mar') }}", "{{ langdate('cal_apr') }}", "{{ langdate('cal_may') }}", "{{ langdate('cal_jun') }}",
"{{ langdate('cal_jul') }}", "{{ langdate('cal_aug') }}", "{{ langdate('cal_sep') }}", "{{ langdate('cal_oct') }}", "{{ langdate('cal_nov') }}", "{{ langdate('cal_dec') }}"],
datasets: [
{
  name: "{{ langapp('payments') }}", chartType: 'bar',
  values: [{{ $payments['jan'] }}, {{ $payments['feb'] }}, {{ $payments['mar'] }}, {{ $payments['apr'] }}, {{ $payments['may'] }}, {{ $payments['jun'] }}, {{ $payments['jul'] }},
  {{ $payments['aug'] }}, {{ $payments['sep'] }}, {{ $payments['oct'] }}, {{ $payments['nov'] }}, {{ $payments['dec'] }}]
},
{
  name: "{{ langapp('credits') }}", chartType: 'line',
  values: [{{ $credits['jan'] }}, {{ $credits['feb'] }}, {{ $credits['mar'] }}, {{ $credits['apr'] }}, {{ $credits['may'] }}, {{ $credits['jun'] }}, {{ $credits['jul'] }},
  {{ $credits['aug'] }}, {{ $credits['sep'] }}, {{ $credits['oct'] }}, {{ $credits['nov'] }}, {{ $credits['dec'] }}]
}
],

},
title: "{{ langapp('receipts') }} - {{ langapp('credits') }}",
type: 'axis-mixed',
height: 300,
colors: ['#d5d1f1', '#fb6f5f'],
tooltipOptions: {
  formatTooltipX: d => (d + '').toUpperCase(),
  formatTooltipY: function formatTooltipY(d) {
      return d.format(2, 3, "{{ get_option('thousands_separator') }}", "{{ get_option('decimal_separator') }}") + "{{ get_option('default_currency_symbol') }}";
    }
}
});
</script>
@endpush