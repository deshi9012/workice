<div class="panel-body">
	<a onClick="ex()" class="btn btn-sm btn-primary pull-right">@langapp('export')</a>
    <div id="busy-chart"></div>
  </div>

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
let chart = new frappe.Chart("#busy-chart", {
    type: 'heatmap',
    title: "Yearly Timesheet",
    countLabel: '@langapp('hours')',
    data: data,
    colors: ['#ebedf0', '#c0ddf9', '#73b3f3', '#3886e1', '#17459e'],
});

function ex(){
	chart.export();
}

</script>
@endpush