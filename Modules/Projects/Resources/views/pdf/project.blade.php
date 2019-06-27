<html>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>@langapp('project') {{ $project->name }}</title>
  @php
  ini_set('memory_limit', '-1');
  $color = config('system.contract_color');
  @endphp
  <head>
    <link rel="stylesheet" href="{{ getAsset('css/project-pdf.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ getAsset('css/pure-tables.css') }}" type="text/css"/>
    <style>
    footer {
      border-top: 1px solid {{ $color }};
    }
    .header4{
      border-bottom: 0.2mm solid {{  $color  }};
    }
    </style>
  </head>
  <body>
    
    <div class="project-page">
      <h1 class="text-center">@langapp('project') @langapp('overview')</h1>
      <h4 class="header4">{{ $project->name }}</h4>
      <div class="m-20">
          @parsedown($project->description)
        
      </div>
      <div class="row">
        <div class="col-md-6 width40 float-left">
          <div class="h4">@langapp('client')</div>
          <div class="m-md">
            @php
            $data['company'] = $project->company;
            @endphp
            @include('partial.pdf.client_address', $data)
            
            
          </div>
          
        </div>
        <div class="col-md-6 width40 float-right">
          <div class="h4">@langapp('company')</div>
          <div class="m-md">
            @include('partial.pdf.company_address', $data)
          </div>
        </div>
      </div>
      <div class="clear"></div>

      <h4 class="header4">@langapp('information')</h4>
      
      <div class="row">
        
        <div class="col-md-6 width40 float-left">
         
            <div class="col-md-8">
              <div class="m-xs">@langapp('start_date'): {{ dateFormatted($project->start_date) }}</div>
              <div class="m-xs">@langapp('end_date'): {{ dateFormatted($project->due_date) }}</div>
              <div class="m-xs">@langapp('status'): {{ $project->progress }}%</div>
              <div class="m-xs">@langapp('billing_method'): {{ humanize($project->billing_method) }}</div>
              <div class="m-xs">@langapp('created_at'): {{ dateFormatted($project->created_at) }}</div>
              
            </div>
        </div>
        <div class="col-md-6 width40 float-left">
            <div class="col-md-8">
              <div class="m-xs">@langapp('hourly_rate'): {{ $project->hourly_rate }}/hr</div>
              <div class="m-xs">@langapp('billable'): {{ secToHours($project->billable_time) }}</div>
              <div class="m-xs">@langapp('unbillable'): {{ secToHours($project->unbillable_time) }}</div>
              <div class="m-xs">@langapp('cost'): {{ formatCurrency($project->currency, $project->sub_total) }}</div>
              <div class="m-xs">@langapp('expenses'): {{ formatCurrency($project->currency, $project->total_expenses) }}</div>

            </div>
          
        </div>
      </div>
    </div>
    <div class="page-break"></div>
    <div class="project-page">
      <h4 class="header4">@langapp('tasks') @langapp('overview')</h4>
      
      
      
      <div class="table-responsive">
                  <table class="table pure-table pure-table-horizontal">
                    <thead>
                      <tr>
                        <th>@langapp('name')</th>
                        <th>@langapp('start_date')</th>
                        <th>@langapp('end_date')</th>
                        <th>@langapp('hourly_rate')</th>
                        <th>@langapp('hours')</th>
                        <th>@langapp('cost')</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($project->tasks as $task)
                        <tr>
                        <td>{{ str_limit($task->name, 30) }}</td>
                        <td>{{ dateFormatted($task->start_date) }}</td>
                        <td>{{ dateFormatted($task->due_date) }}</td>
                        <td>{{ $task->hourly_rate }}/hr</td>
                        <td>{{ secToHours($task->time) }}</td>
                        <td>{{ formatCurrency($task->AsProject->currency, (toHours($task->time) * $task->hourly_rate)) }}</td>
                      </tr>
                      @endforeach
                      

                    </tbody>
                  </table>
                </div>
      
      
      
    </div>
    <footer>
      <div class="foot-name">
        @langapp('project') - {{ $project->name }}
      </div>
      <div class="foot-page">
        <div class="pagenum-container">Page <span class="pagenum"></span></div>
      </div>
    </footer>

    <div class="page-break"></div>
    <div class="project-page">
      <h4 class="header4">@langapp('timesheets') @langapp('overview')</h4>
      

      <div class="table-responsive">
                  <table class="table pure-table pure-table-horizontal">
                    <thead>
                      <tr>
                        <th>@langapp('name')</th>
                        <th>@langapp('start_date')</th>
                        <th>@langapp('end_date')</th>
                        <th>@langapp('billed')</th>
                        <th>@langapp('hours')</th>
                        <th>@langapp('user')</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($project->timesheets as $entry)
                        <tr>
                        <td>{{ str_limit($entry->task_id ? $entry->task->name : $entry->timeable->name, 30) }}</td>
                        <td>{{ !is_null($entry->start) ? dateTimeFormatted(dateFromUnix($entry->start)) : 'N/A'}}</td>
                        <td>{{ !is_null($entry->end) ? dateTimeFormatted(dateFromUnix($entry->end)) : 'N/A'}}</td>
                        <td>{{ $entry->billed ? langapp('yes') : langapp('no') }}</td>
                        <td>{{ secToHours($entry->worked) }}</td>
                        <td>{{ $entry->user->name }}</td>
                      </tr>
                      @endforeach
                      

                    </tbody>
                  </table>
                </div>
      
      
    </div>
    <footer>
      <div class="foot-name">
        @langapp('projects') - {{ $project->name }}
      </div>
      <div class="foot-page">
        <div class="pagenum-container">Page <span class="pagenum"></span></div>
      </div>
    </footer>

    
    
  
  </body>
</html>