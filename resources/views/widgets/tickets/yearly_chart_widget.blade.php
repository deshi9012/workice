<section class="panel panel-default">
        <header class="panel-heading font-bold">{{ $year }} - @langapp('yearly_overview') </header>
        <div class="panel-body">
            <div id="status-chart"></div>
        </div>
    </section>
   
           
    @push('pagescript')
    @include('stacks.js.chart')
    <script>
       let status_chart = new frappe.Chart( "#status-chart", {
    data: {
      labels: ["{{ langdate('cal_jan') }}", "{{ langdate('cal_feb') }}", "{{ langdate('cal_mar') }}", "{{ langdate('cal_apr') }}", "{{ langdate('cal_may') }}", "{{ langdate('cal_jun') }}", 
      "{{ langdate('cal_jul') }}", "{{ langdate('cal_aug') }}", "{{ langdate('cal_sep') }}", "{{ langdate('cal_oct') }}", "{{ langdate('cal_nov') }}", "{{ langdate('cal_dec') }}"],

      datasets: [
        {
          name: "{{ langapp('closed') }}", chartType: 'line',
          values: [{{ $closed['jan'] }}, {{ $closed['feb'] }}, {{ $closed['mar'] }}, {{ $closed['apr'] }}, {{ $closed['may'] }}, {{ $closed['jun'] }}, {{ $closed['jul'] }},
           {{ $closed['aug'] }}, {{ $closed['sep'] }}, {{ $closed['oct'] }}, {{ $closed['nov'] }}, {{ $closed['dec'] }}]
        },
        {
          name: "{{ langapp('open') }}", chartType: 'line',
          values: [{{ $open['jan'] }}, {{ $open['feb'] }}, {{ $open['mar'] }}, {{ $open['apr'] }}, {{ $open['may'] }}, {{ $open['jun'] }}, {{ $open['jul'] }},
           {{ $open['aug'] }}, {{ $open['sep'] }}, {{ $open['oct'] }}, {{ $open['nov'] }}, {{ $open['dec'] }}]
        }
      ],
    },

    title: "{{ langapp('tickets_analysis') }}",
    type: 'axis-mixed',
    height: 300,
    colors: ['#5b8aef', '#fdab29'],
    tooltipOptions: {
      formatTooltipX: d => (d + '').toUpperCase(),
      formatTooltipY: d => d + '',
    }
  });
    </script>
@endpush
           