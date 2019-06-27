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
          <li><a href="?m=deals&setyear={{ $y }}">{{ $y }}</a></li>
          @endforeach
        </ul>
      </div>
    </div>
  </header>
  <div class="panel-body">
    <div id="won-lost-chart"></div>
  </div>
  
</section>
@push('pagescript')
@include('stacks.js.chart')
<script>
let chart = new frappe.Chart( "#won-lost-chart", {
data: {
labels: ["{{ langdate('cal_jan') }}", "{{ langdate('cal_feb') }}", "{{ langdate('cal_mar') }}", "{{ langdate('cal_apr') }}", "{{ langdate('cal_may') }}", "{{ langdate('cal_jun') }}",
"{{ langdate('cal_jul') }}", "{{ langdate('cal_aug') }}", "{{ langdate('cal_sep') }}", "{{ langdate('cal_oct') }}", "{{ langdate('cal_nov') }}", "{{ langdate('cal_dec') }}"],
datasets: [
{
  name: "{{ langapp('won') }}", chartType: 'line',
  values: [{{ $won['jan'] }}, {{ $won['feb'] }}, {{ $won['mar'] }}, {{ $won['apr'] }}, {{ $won['may'] }}, {{ $won['jun'] }}, {{ $won['jul'] }},
  {{ $won['aug'] }}, {{ $won['sep'] }}, {{ $won['oct'] }}, {{ $won['nov'] }}, {{ $won['dec'] }}]
},
{
  name: "{{ langapp('lost') }}", chartType: 'line',
  values: [{{ $lost['jan'] }}, {{ $lost['feb'] }}, {{ $lost['mar'] }}, {{ $lost['apr'] }}, {{ $lost['may'] }}, {{ $lost['jun'] }}, {{ $lost['jul'] }},
  {{ $lost['aug'] }}, {{ $lost['sep'] }}, {{ $lost['oct'] }}, {{ $lost['nov'] }}, {{ $lost['dec'] }}]
}
],

},
title: "{{ langapp('won_lost_deals') }}",
type: 'axis-mixed',
height: 300,
colors: ['#3ac451', '#d5d1f1'],
tooltipOptions: {
  formatTooltipX: d => (d + '').toUpperCase(),
  formatTooltipY: function formatTooltipY(d) {
      return d.format(2, 3, "{{ get_option('thousands_separator') }}", "{{ get_option('decimal_separator') }}") + "{{ get_option('default_currency_symbol') }}";
    }
}
});
</script>
@endpush