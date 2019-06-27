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
          <li><a href="?m=expenses&setyear={{ $y }}">{{ $y }}</a></li>
          @endforeach
        </ul>
      </div>
    </div>
    
  </header>
  <div class="panel-body">
    <div id="billable-chart"></div>
  </div>
</section>

@push('pagescript')
@include('stacks.js.chart')
<script>
let chart = new frappe.Chart( "#billable-chart", {
data: {
labels: ["{{ langdate('cal_jan') }}", "{{ langdate('cal_feb') }}", "{{ langdate('cal_mar') }}", "{{ langdate('cal_apr') }}", "{{ langdate('cal_may') }}", "{{ langdate('cal_jun') }}",
"{{ langdate('cal_jul') }}", "{{ langdate('cal_aug') }}", "{{ langdate('cal_sep') }}", "{{ langdate('cal_oct') }}", "{{ langdate('cal_nov') }}", "{{ langdate('cal_dec') }}"],
datasets: [
{
  name: "{{ langapp('billable') }}", chartType: 'line',
  values: [{{ $billable['jan'] }}, {{ $billable['feb'] }}, {{ $billable['mar'] }}, {{ $billable['apr'] }}, {{ $billable['may'] }}, {{ $billable['jun'] }}, {{ $billable['jul'] }},
  {{ $billable['aug'] }}, {{ $billable['sep'] }}, {{ $billable['oct'] }}, {{ $billable['nov'] }}, {{ $billable['dec'] }}]
},
{
  name: "{{ langapp('billed') }}", chartType: 'line',
  values: [{{ $billed['jan'] }}, {{ $billed['feb'] }}, {{ $billed['mar'] }}, {{ $billed['apr'] }}, {{ $billed['may'] }}, {{ $billed['jun'] }}, {{ $billed['jul'] }},
  {{ $billed['aug'] }}, {{ $billed['sep'] }}, {{ $billed['oct'] }}, {{ $billed['nov'] }}, {{ $billed['dec'] }}]
}
],

},
title: "{{ langapp('expenses') }} - {{ get_option('default_currency') }}",
type: 'axis-mixed',
height: 300,
colors: ['purple', 'light-blue'],
tooltipOptions: {
  formatTooltipX: d => (d + '').toUpperCase(),
  formatTooltipY: function formatTooltipY(d) {
      return d.format(2, 3, "{{ get_option('thousands_separator') }}", "{{ get_option('decimal_separator') }}") + "{{ get_option('default_currency_symbol') }}";
    }
}
});
</script>
@endpush