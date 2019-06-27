<ol class="dd-list">
@foreach ($todos as $task)
<li class="dd-item dd3-item" data-id="{{ $task->id }}" id="todo-{{ $task->id }}" >
  
  <span class="pull-right m-xs">
    <a href="{{ route('todo.edit', $task->id) }}" data-toggle="ajaxModal">
      @icon('solid/pencil-alt', 'icon-muted fa-fw m-r-xs')
    </a>
    
    <a href="{{ route('todo.subtask', ['id' => $task->id])  }}" data-toggle="ajaxModal">
      @icon('solid/plus', 'icon-muted fa-fw m-r-xs')
    </a>
    
    @if ($task->user_id === Auth::id())
    <a href="#" class="deleteTodo" data-todo-id="{{$task->id}}" title="@langapp('delete')">
      @icon('solid/times', 'icon-muted fa-fw m-r-xs')
    </a>
    @endif
  </span>
  
  <div class="dd3-content">
    <label>
      <input type="checkbox" class="checkItem" data-id="{{ $task->id }}" {!! $task->completed ? 'checked="checked"' : '' !!}>
      <span class="label-text">
        <span class="{!! $task->completed ? 'text-success' : 'text-danger' !!}" id="task-id-{{ $task->id }}">
          {{ $task->subject }} <small class="text-muted small m-l-sm" data-rel="tooltip" title="{{ $task->agent->name }}">@icon('solid/calendar-alt') {{ dateTimeFormatted($task->due_date) }}</small>
        </span>
      </span>
    </label>
    <p class="m-xs">@parsedown($task->notes)</p>
    
  </div>

    @if($task->child->count() > 0)
      @widget('Todos\ShowTodos', ['todos' => $task->child])
    @endif
</li>
@endforeach
</ol>