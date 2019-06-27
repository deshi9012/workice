<section class="panel panel-default">
  <header class="panel-heading font-bold">@langapp('deals_by_stage')
    <div class="btn-group pull-right">
      <button class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
      @langapp('pipeline') <span class="caret"></span>
      </button>
      <ul class="dropdown-menu">
        @foreach (App\Entities\Category::whereModule('pipeline')->get() as $cat)
        <li><a href="?pipeline={{ $cat->id }}">{{ $cat->name }}</a></li>
        @endforeach
        
      </ul>
    </div>
  </header>
  
  <div class="panel-body">
    @inject('metrics', 'App\Helpers\Report')
    <div id="deal-stage-chart"></div>
    
  </div>
</section>
@push('pagescript')
@include('stacks.js.chart')
<script>
let stage_chart = new frappe.Chart( "#deal-stage-chart", {
data: {
labels: [
@foreach($stages as $stage)
  "{{ $stage->name }}",
@endforeach
],
datasets: [
{
name: "Deal Value", chartType: 'line',
values: [
@foreach($stages as $s)
    "{{ $metrics->dealsByStage($s->id) }}",
  @endforeach
  ]
}
],
},
title: "{{ langapp('currency') }} - {{ get_option('default_currency') }}",
type: 'axis-mixed',
height: 300,
colors: ['light-green'],
isNavigable: 1,
  lineOptions: {
    dotSize: 8
  },
tooltipOptions: {
  formatTooltipX: d => (d + '').toUpperCase(),
  formatTooltipY: d => d + ' {{ get_option('default_currency') }}',
}
});
</script>
@endpush