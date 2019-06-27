<li class="dd-item dd3-item" data-id="{{ $todo->id }}" id="todo-{{ $todo->id }}" >
  
  <span class="pull-right m-xs">
    <a href="{{ route('todo.edit', $todo->id) }}" data-toggle="ajaxModal">
      @icon('solid/pencil-alt', 'icon-muted fa-fw m-r-xs')
    </a>
     <a href="{{ route('todo.subtask', ['id' => $todo->id])  }}" data-toggle="ajaxModal">
      @icon('solid/plus', 'icon-muted fa-fw m-r-xs')
    </a>
    @if ($todo->assignee == Auth::id())
    <a href="#" class="deleteTodo" data-todo-id="{{$todo->id}}" title="@langapp('delete')">
      @icon('solid/times', 'icon-muted fa-fw m-r-xs')
    </a>
    @endif
  </span>
  
  <div class="dd3-content">
    <span class="m-t-0">
      <label>
        <input type="checkbox" data-id="{{ $todo->id }}" {!! $todo->completed ? 'checked' : '' !!}>
        <span class="label-text {!! $todo->completed ? 'text-success' : 'text-danger' !!}" id="todo-id-{{ $todo->id }}">
          {{ $todo->subject }} <small class="text-muted small m-l-sm" data-rel="tooltip" title="{{ $todo->agent->name }}">@icon('solid/calendar-alt') {{ dateTimeFormatted($todo->due_date) }}</small>
        </span>
      </label>
    </span>
    <p class="m-xs">@parsedown($todo->notes)</p>
  </div>
  
</li>