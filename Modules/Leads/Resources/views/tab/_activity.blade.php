<section class="" id="taskapp">
    <aside>
        <section class="">
        	

            <header class="header">
            	
                <a href="{{ route('todo.create', ['module' => 'leads', 'id' => $lead->id]) }}" data-toggle="ajaxModal" class="btn btn-success btn-sm pull-right btn-icon" id="new-task" >
                    @icon('solid/plus')
                </a>

                <div class="m-t-sm pull-left text-muted">
                       <label >
                            <input id="checkAll" type="checkbox" data-id="{{ $lead->id }}" name="leads" {!! $lead->todo_percent >= 100 ? 'checked="checked" disabled=""' : '' !!}>
                                
                                <span class="label-text">@langapp('mark_as_complete')</span>
                       </label>
                </div> 

                


            </header>
            <div class="progress progress-xxs progress-striped active"> 
        		<div class="progress-bar progress-bar-success" data-toggle="tooltip" data-original-title="{{ $lead->todo_percent }}%" data-placement="bottom" style="width: {{ $lead->todo_percent }}%"></div> 
        	</div>

            <section class="">

            	<div class="m-xs">

                    

            	<article class="chat-item" id="chat-form"> 
            		<a class="pull-left thumb-sm avatar">
            			<img src="{{ avatar() }}" class="img-circle">
            		</a> 
            		<section class="chat-body"> 
            			{!! Form::open(['route' => 'todos.api.save', 'id' => 'createTodo', 'class' => 'm-b-none']) !!}
            			
            			<input type="hidden" name="user_id" value="{{ Auth::id() }}">
            			<input type="hidden" name="assignee" value="{{ Auth::id() }}">
            			<input type="hidden" name="module_id" value="{{ $lead->id }}">
                        <input type="hidden" name="module" value="leads">
                        <input type="hidden" name="url" value="{{ url()->previous() }}">
            			<input type="hidden" name="json" value="false">
            			<input type="hidden" name="due_date" value="{{ now()->addDays(7) }}">
            				<div class="input-group"> 
            					<input type="text" class="form-control" name="subject" placeholder="Create new Activity"> 
            					<span class="input-group-btn"> 
            						<button class="btn btn-info formSaving submit" type="submit">@icon('solid/save') @langapp('save')  </button> 
            					</span> 
            				</div> 
            				{!! Form::close() !!}
            			</section> 
            	</article>
            	</div>


            	<div class="sortable">

            		<div class="todo-list" id="nestable">
                    	

                @widget('Todos\ShowTodos', ['todos' => $lead->todos()->where(function ($query) {
                                $query->where('user_id', Auth::id())->orWhere('assignee', Auth::id());
                            })->get()])
            		
            			
            		</div>

            	</div>

                    
            </section>
        </section>
    </aside>
    
</section>

@push('pagestyle')
<link rel=stylesheet href="{{ getAsset('plugins/nestable/nestable.css') }}">
@endpush

@push('pagescript')
    @include('todos::_ajax.todojs')
@endpush