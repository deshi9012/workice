<div class="btn-group">

    <button class="btn btn-{{ get_option('theme_color') }} btn-sm dropdown-toggle" data-toggle="dropdown">
        @langapp('modules')  - @langapp($module)
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">

        <li><a href="{{ route('reports.index', ['m' => 'deals']) }}">@langapp('deals') </a></li>
        <li><a href="{{ route('reports.index', ['m' => 'leads']) }}">@langapp('leads') </a></li>
        <li><a href="{{ route('reports.index', ['m' => 'invoices']) }}">@langapp('invoices') </a></li>
        <li><a href="{{ route('reports.index', ['m' => 'expenses']) }}">@langapp('expenses') </a></li>
        <li><a href="{{ route('reports.index', ['m' => 'payments']) }}">@langapp('payments') </a></li>
        <li><a href="{{ route('reports.index', ['m' => 'estimates']) }}">@langapp('estimates') </a></li>
        <li><a href="{{ route('reports.index', ['m' => 'creditnotes']) }}">@langapp('creditnotes') </a></li>
        <li><a href="{{ route('reports.index', ['m' => 'projects']) }}">@langapp('projects') </a></li>
        <li><a href="{{ route('reports.index', ['m' => 'tasks']) }}">@langapp('tasks') </a></li>
        <li><a href="{{ route('reports.index', ['m' => 'timesheets']) }}">@langapp('timesheets') </a></li>
        <li><a href="{{ route('reports.index', ['m' => 'tickets']) }}">@langapp('tickets') </a></li>
    </ul>
</div>

<div class="btn-group pull-right">

        <button class="btn btn-{{ get_option('theme_color') }} btn-sm dropdown-toggle" data-toggle="dropdown">
                @langapp('year')  <span class="caret"></span>
        </button>

        <ul class="dropdown-menu">
            @php
            $max = date('Y');
            $min = $max - 3;
            @endphp
            @foreach (range($min, $max) as $year) 
                <li><a href="?setyear={{ $year }}">{{ $year }}</a></li>
            @endforeach

        </ul>

    </div>

    <a href="#" class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right commandBtn" data-rel="tooltip" data-id="analytics-compute" title="Compute all analytics data">Compute Analytics</a>

@include('analytics::_'.$module.'.topmenu')
