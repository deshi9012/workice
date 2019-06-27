<section class="panel panel-default">
  <header class="panel-heading font-bold">
    {{ $year }} - @langapp('yearly_overview')
  </header>
  <div class="panel-body">
    <div id="leads-heat"></div>
  </div>
</section>

@push('pagescript')
@include('stacks.js.chart')
<script>
	var today = new Date();
	let data = {
    dataPoints: {
    	@foreach ($calendar as $key => $value)
    		{{ strtotime($key) }} : {{ $value }},
    	@endforeach
    },
    start: moment().startOf("year")._d,
    end: moment().endOf("year")._d
};
let chart = new frappe.Chart("#leads-heat", {
    type: 'heatmap',
    title: "Leads received for year {{ $year }} ",
    countLabel: '@langapp('leads')',
    data: data,
    colors: ['#ebedf0', '#c6e48b', '#7bc96f', '#239a3b', '#196127'],
});

</script>
@endpush