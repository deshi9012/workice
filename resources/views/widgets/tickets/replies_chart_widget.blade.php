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
        <div id="replies-chart"></div>
    </div>
</section>



@push('pagescript')
    @include('stacks.js.chart')
    <script>
       let chart = new frappe.Chart( "#replies-chart", {
    data: {
      labels: ["{{ langdate('cal_jan') }}", "{{ langdate('cal_feb') }}", "{{ langdate('cal_mar') }}", "{{ langdate('cal_apr') }}", "{{ langdate('cal_may') }}", "{{ langdate('cal_jun') }}", 
      "{{ langdate('cal_jul') }}", "{{ langdate('cal_aug') }}", "{{ langdate('cal_sep') }}", "{{ langdate('cal_oct') }}", "{{ langdate('cal_nov') }}", "{{ langdate('cal_dec') }}"],

      datasets: [
        {
          name: "{{ langapp('tickets') }}", chartType: 'bar',
          values: [{{ $tickets['jan'] }}, {{ $tickets['feb'] }}, {{ $tickets['mar'] }}, {{ $tickets['apr'] }}, {{ $tickets['may'] }}, {{ $tickets['jun'] }}, {{ $tickets['jul'] }},
           {{ $tickets['aug'] }}, {{ $tickets['sep'] }}, {{ $tickets['oct'] }}, {{ $tickets['nov'] }}, {{ $tickets['dec'] }}]
        },
        {
          name: "{{ langapp('replies') }}", chartType: 'line',
          values: [{{ $replies['jan'] }}, {{ $replies['feb'] }}, {{ $replies['mar'] }}, {{ $replies['apr'] }}, {{ $replies['may'] }}, {{ $replies['jun'] }}, {{ $replies['jul'] }},
           {{ $replies['aug'] }}, {{ $replies['sep'] }}, {{ $replies['oct'] }}, {{ $replies['nov'] }}, {{ $replies['dec'] }}]
        }
      ],

      
    },

    title: "{{ langapp('tickets_and_conversations') }}",
    type: 'axis-mixed',
    height: 300,
    colors: ['#a2a1a9', 'green'],

    tooltipOptions: {
      formatTooltipX: d => (d + '').toUpperCase(),
      formatTooltipY: d => d + '',
    }
  });
    </script>
@endpush
