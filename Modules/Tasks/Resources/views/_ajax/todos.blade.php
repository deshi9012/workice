<div class="m-xs">
      <article class="chat-item" id="chat-form">
            <a class="pull-left thumb-sm avatar">
                  <img src="{{ avatar() }}" class="img-circle">
            </a>
            <section class="chat-body">
                  {!! Form::open(['route' => 'todos.api.save', 'id' => 'createTodo', 'class' => 'm-b-none']) !!}
                  
                  <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                  <input type="hidden" name="assignee" value="{{ Auth::id() }}">
                  <input type="hidden" name="module_id" value="{{ $task->id }}">
                  <input type="hidden" name="module" value="tasks">
                  <input type="hidden" name="url" value="{{ url()->previous() }}">
                  <input type="hidden" name="json" value="false">
                  <input type="hidden" name="due_date" value="{{ now()->addDays(7) }}">
                  <div class="input-group">
                        <input type="text" class="form-control" name="subject" placeholder="Add a new todo...">
                        <span class="input-group-btn">
                              <button class="btn btn-info formSaving submit" type="submit"> @icon('solid/check-circle') @langapp('save')  </button>
                        </span>
                  </div>
                  {!! Form::close() !!}
            </section>
      </article>
</div>
<div class="sortable">
      <div class="todo-list" id="nestable">
            @widget('Todos\ShowTodos', ['todos' => $task->todos()->where(function ($query) {
            $query->where('user_id', Auth::id())->orWhere('assignee', Auth::id());
            })->get()])

      </div>
</div>
@push('pagestyle')
<link rel=stylesheet href="{{ getAsset('plugins/nestable/nestable.css') }}">
@endpush
@push('pagescript')
@include('todos::_ajax.todojs')
@endpush

@stack('pagestyle')
@stack('pagescript')