@extends('layouts.app')
@section('content')
<section id="content" class="bg">
  <section class="vbox">
    <header class="header panel-heading bg-white b-b b-light">
      <div class="btn-group">
        <button class="btn btn-{{ get_option('theme_color') }} btn-sm dropdown-toggle"
        data-toggle="dropdown"> @langapp('filter')
        <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          <li>
            <a href="{{ route('tasks.index', ['filter' => 'backlog']) }}">@langapp('backlog')  </a>
          </li>
          <li>
            <a href="{{ route('tasks.index', ['filter' => 'ongoing']) }}">@langapp('ongoing')  </a>
          </li>
          <li><a href="{{ route('tasks.index', ['filter' => 'done']) }}">@langapp('done')  </a></li>
          <li>
            <a href="{{ route('tasks.index', ['filter' => 'overdue']) }}">@langapp('overdue')  </a>
          </li>
          <li>
            <a href="{{ route('tasks.index', ['filter' => 'mine']) }}">@langapp('mine')</a>
          </li>
          <li><a href="{{ route('tasks.index') }}">@langapp('all')  </a></li>
        </ul>
      </div>
      
    </header>
    <section class="scrollable wrapper" id="task-list">
      
      <div class="input-group m-b-sm">
        <input type="text" class="form-control search" placeholder="Search by Name, Due Date and Description">
        <span class="input-group-btn">
          <button type="submit" class="btn btn-{{ get_option('theme_color') }} btn-icon">
          @icon('solid/search')
          </button>
        </span>
      </div>
      <ul class="list-group gutter list-group-lg list-group-sp list">
        
        @foreach ($tasks as $task)
        <li class="list-group-item box-shadow tasklist">
          <div class="inline pull-right small">

            <ul class="list-unstyled team-info m-l-sm">
              @foreach ($task->assignees as $assignee)
              <li><img src="{{ $assignee->user->profile->photo  }}" data-toggle="tooltip" data-title="{{  $assignee->user->name  }}" data-placement="top"></li>
              @endforeach
            </ul>

            
          </div>
          <div class="clear">
            <span class="pull-left ">
              <label>
                <input type="checkbox" data-id="{{ $task->id }}" {{ $task->progress === 100 ? 'checked' : '' }}>
                <span class="label-text"><a href="{{ route('projects.view', ['id' => $task->project_id, 'tab' => 'tasks', 'item' => $task->id]) }}" class="task-name">
                  {{ str_limit($task->name, 50) }}
                </a></span>
              </label>
            </span>
            
            
            
            
          </div>
          <div class="text-muted">
            <span class="task-desc">{{ str_limit(strip_tags($task->description), 100) }}</span>
            <span class="label label-{{ ($task->isOverdue()) ? 'danger' : 'success' }}">
              @icon('solid/calendar-check')
              <span class="due-date">@langapp('due') {{ dateElapsed($task->due_date) }}</span>
            </span>
          </div>

          <div class="progress progress-xxs active m-xs">
              <div class="progress-bar progress-bar-success" data-rel="tooltip" title="{{ $task->progress }}%" style="width: {{ $task->progress }}%"></div>
          </div>

          

        </li>
        @endforeach
        
        
      </ul>
    </section>
  </section>
  <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
@push('pagestyle')
@include('stacks.css.form')
@endpush
@push('pagescript')
@include('stacks.js.form')
<script src='{{ getAsset('plugins/apps/list.min.js') }}'></script>

<script>
  $('.tasklist input[type="checkbox"]').change(function () {
      var id = $(this).data().id;
      var progress = $(this).is(":checked");
      var formData = {
          'id': id,
          'done': progress,
      };
            axios.post('/api/v1/tasks/'+id+'/progress', formData)
          .then(function (response) {
              toastr.success(response.data.message, '@langapp('response_status') ');
            })
            .catch(function (error) {
              toastr.error('There was an error processing your request.' , '@langapp('response_status') ');
          });

});

var options = {
valueNames: [ 'task-name', 'task-desc', 'due-date' ]
};
var senderList = new List('task-list', options);
</script>
@endpush
@endsection