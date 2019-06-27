<section class="panel panel-default">
  <header class="header b-b clearfix">
    <div class="m-t-sm">
      @if (session('taskview') == 'table')
      
      <div class="btn-group">
        <button class="btn btn-{{ get_option('theme_color') }} btn-sm dropdown-toggle"
        data-toggle="dropdown"> @langapp('filter')
        <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          <li>
            <a href="{{ route('projects.view', ['project' => $project->id, 'tab' => 'tasks', 'item' => null, 'filter' => 'backlog']) }}">@langapp('backlog')  </a>
          </li>
          <li>
            <a href="{{ route('projects.view', ['project' => $project->id, 'tab' => 'tasks', 'item' => null, 'filter' => 'ongoing']) }}">@langapp('ongoing')  </a>
          </li>
          <li><a href="{{ route('projects.view', ['project' => $project->id, 'tab' => 'tasks', 'item' => null, 'filter' => 'done']) }}">@langapp('done')  </a></li>
          <li>
            <a href="{{ route('projects.view', ['project' => $project->id, 'tab' => 'tasks', 'item' => null, 'filter' => 'overdue']) }}">@langapp('overdue')  </a>
          </li>
          <li>
            <a href="{{ route('projects.view', ['project' => $project->id, 'tab' => 'tasks', 'item' => null, 'filter' => 'mine']) }}">@langapp('mine')</a>
          </li>
          <li><a href="{{ route('projects.view', ['project' => $project->id, 'tab' => 'tasks', 'item' => null, 'filter' => 'all']) }}">@langapp('all')  </a></li>
        </ul>
      </div>
      @endif
      @if (can('tasks_create') || $project->isTeam() || $project->setting('client_add_tasks'))
      <a href="{{  route('tasks.create', ['id' => $project->id])  }}"
        data-toggle="ajaxModal" class="btn btn-sm btn-{{  get_option('theme_color')  }}">
        @icon('solid/plus') @langapp('create')
      </a>
      @endif
      <div class="pull-right">
        <div class="btn-group">
          <a href="{{ route('set.view.type', ['type' => 'tasks', 'view' => 'table']) }}" data-rel="tooltip" title="Table" data-placement="bottom" class="btn btn-sm btn-default">
            @icon('solid/th')
          </a>
          <a href="{{ route('set.view.type', ['type' => 'tasks', 'view' => 'kanban']) }}" data-rel="tooltip" title="Kanban" data-placement="bottom" class="btn btn-sm btn-default">
            @icon('solid/align-justify')
          </a>
        </div>
        @admin
        <a href="{{ route('settings.stages.show', 'tasks') }}" data-toggle="ajaxModal" class="btn btn-sm btn-{{ get_option('theme_color') }}" data-rel="tooltip" title="@langapp('stages')" data-placement="bottom">
          @icon('solid/cogs')
        </a>
        @endadmin
      </div>
      
    </div>
  </header>
  @include('tasks::partial._'.session('taskview', 'table').'_view')
  
</section>