@extends('layouts.app')
@section('content')
@php
$ticket->is_locked ? $ticket->releaseTicket() : '';
$isAgent = $ticket->isAgent();
@endphp
<section id="content">
    <section class="hbox stretch">
        <aside>
        <section class="vbox">
            <header class="header bg-white b-b clearfix hidden-print">
                
                <div class="col-md-12 m-t-sm">
                    @can('reminders_create')
                    <a class="btn btn-sm btn-{{ get_option('theme_color') }}" data-toggle="ajaxModal" data-rel="tooltip"  data-placement="bottom" href="{{  route('calendar.reminder', ['module' => 'tickets', 'id' => $ticket->id])  }}" title="@langapp('set_reminder')">
                        @icon('solid/clock')
                    </a>
                    @endcan
                    
                    @if (isAdmin() || $isAgent)
                    <a href="{{  route('tickets.edit', ['id' => $ticket->id])  }}" data-rel="tooltip" title="@langapp('edit')" class="btn btn-sm btn-dark btn-responsive" data-placement="bottom">
                        @icon('solid/pencil-alt')
                    </a>
                    @endif
                    @if (isAdmin() || $isAgent)
                    <a href="{{  route('tickets.convert', ['id' => $ticket->id])  }}"
                        class="btn btn-sm btn-dark btn-responsive" data-toggle="ajaxModal">
                        @icon('solid/check-circle') @langapp('convert_to_task')
                    </a>
                    @endif
                    <div class="btn-group">
                        <button class="btn btn-sm btn-{{ get_option('theme_color') }} dropdown-toggle btn-responsive"
                        data-toggle="dropdown">@langapp('status')
                        <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            @foreach (App\Entities\Status::select('id', 'status')->get() as $key => $status)
                            @if($status->id != $ticket->status)
                            <li>
                                <a href="{{ route('tickets.status', ['id' => $ticket->id, 'status' => $status->id])  }}" data-toggle="ajaxModal">
                                    {{  ucfirst($status->status)  }}
                                </a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    @if (isAdmin() || $isAgent)
                    @if($ticket->rated)
                    <a href="{{ route('tickets.reviews', ['id' => $ticket->id]) }}"
                        class="btn btn-sm btn-info" data-toggle="ajaxModal">
                        @icon('solid/star') @langapp('reviews')
                    </a>
                    @endif
                    @endif
                    @if (isAdmin() || can('tickets_delete'))
                    <a href="#aside-todos" data-toggle="class:show" class="btn btn-sm btn-default pull-right">@icon('solid/list-ul')</a>

                    <a href="{{  route('tickets.delete', ['id' => $ticket->id])  }}"
                        class="btn btn-sm btn-danger pull-right btn-responsive" data-toggle="ajaxModal">
                        @svg('solid/trash-alt') @langapp('delete')
                    </a>
                    @endif
                    
                </div>
            </header>
            <section class="scrollable bg">

            <div class="wrapper">

                @if($ticket->isLocked())
                <div class="alert alert-danger">
                    <a class="thumb-xs avatar">
                        <img src="{{ $ticket->activeAgent->profile->photo }}" class="img-circle">
                    </a> <strong>{{ $ticket->activeAgent->name }}</strong> is working on this ticket...
                </div>
                @endif
                
                <div class="row">
                    <section class="">
                        <div class="col-sm-4">
                            @if (isAdmin() || $isAgent)
                            
                            <section class="panel panel-default">
                            <header class="panel-heading">@langapp('make_changes') </header>
                            <div class="panel-body">
                                {!! Form::open(['route' => ['tickets.api.update', $ticket->id], 'class' => 'ajaxifyForm', 'method' => 'PUT', 'data-toggle' => 'validator']) !!}
                                <input type="hidden" name="id" value="{{ $ticket->id }}">
                                <input type="hidden" name="subject" value="{{ $ticket->subject }}">
                                <div class="form-group">
                                    <label>@langapp('code')</label>
                                    <input type="text" class="form-control" value="{{ $ticket->code }}" readonly="readonly">
                                </div>
                                <div class="form-group">
                                    <label>@langapp('created_at')</label>
                                    <input type="text" class="form-control" value="{{ dateTimeFormatted($ticket->created_at) }}" readonly="readonly">
                                </div>
                                @if (isAdmin() || can('tickets_reporter'))
                                <div class="form-group">
                                    <label>@langapp('reporter')  @required</label>
                                    <div class="m-b">
                                        <select class="select2-option form-control" name="user_id">
                                            @foreach (app('user')->select('id', 'username', 'name')->offHoliday()->get() as $user)
                                            <option value="{{ $user->id }}"{{ $ticket->user_id == $user->id ? ' selected' : ''  }}>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif
                                <div class="form-group">
                                    <label>@langapp('project')</label>
                                        <select class="select2-option form-control" name="project_id" required>
                                            <option value="0">None</option>
                                            @if(isAdmin())
                                            @foreach (Modules\Projects\Entities\Project::select('id', 'name')->get() as $project)
                                            <option value="{{ $project->id }}" {{ $project->id === $ticket->project_id ? 'selected' : '' }}>{{ $project->name }}</option>
                                            @endforeach
                                            @else
                                            @foreach (Auth::user()->assignments()->where('assignable_type', Modules\Projects\Entities\Project::class)->get() as $entity)
                                            <option value="{{ $entity->assignable->id }}" {{ $entity->assignable->id === $ticket->project_id ? 'selected' : '' }}>{{ $entity->assignable->name }}</option>
                                            @endforeach
                                            @endif

                                        </select>
                                </div>
                                <div class="form-group">
                                    <label>@langapp('department') @required</label>
                                    <div class="m-b">
                                        <select name="department" class="form-control">
                                            @foreach (App\Entities\Department::all() as $d)
                                            <option value="{{ $d->deptid }}"{{ $ticket->department === $d->deptid ? ' selected' : '' }}>{{  ucfirst($d->deptname)  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>@langapp('assigned')</label>
                                    <div class="m-b">
                                        <select name="assignee" class="form-control">
                                            @foreach (Modules\Users\Entities\User::role('admin')->get() as $admin)
                                                <option value="{{ $admin->id }}" {{ $admin->id === $ticket->assignee ? 'selected' : '' }}>
                                                {{ $admin->name }}
                                            </option>
                                            @endforeach
                                            @foreach (Modules\Users\Entities\UserHasDepartment::all() as $user)
                                            <option value="{{ $user->user_id }}" {{ $user->user_id === $ticket->assignee ? 'selected' : '' }}>
                                                {{ $user->user->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {!! renderAjaxButton() !!}
                                {!! Form::close() !!}
                            </div>
                        </section>
                        @else
                        <ul class="list-group no-radius small">
                            <li class="list-group-item"><span
                            class="pull-right">#{{ $ticket->code }}</span>@langapp('code')
                        </li>
                        <li class="list-group-item">
                            @langapp('reporter')
                            <span class="pull-right">
                                @if (!is_null($ticket->user_id))
                                <a class="thumb-xs avatar pull-left" data-toggle="tooltip"
                                    data-title="{{ $ticket->user->email  }}"
                                    data-placement="right">
                                    <img src="{{ $ticket->user->profile->photo }}" class="img-circle">
                                    {{  $ticket->user->name }}
                                </a>
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="pull-right">
                                {{ $ticket->dept->deptname }}
                            </span>@langapp('department')
                        </li>
                        <li class="list-group-item">
                            <span class="pull-right"><label class="label label-default">
                            {{  ucfirst(langapp($ticket->AsStatus->status))  }}</label>
                        </span>@langapp('status')
                    </li>
                    <li class="list-group-item">
                        <span class="pull-right">{{ $ticket->AsPriority->priority }}</span>
                        @langapp('priority')
                    </li>
                    <li class="list-group-item">
                        <span class="pull-right label label-success" data-toggle="tooltip"
                            data-title="{{  $ticket->created_at  }}" data-placement="left">
                            {{  dateTimeFormatted($ticket->created_at) }}
                        </span>@langapp('created_at')
                    </li>
                    
                </ul>
                @endif
                <small class="text-uc text-muted">@icon('solid/shield-alt')
                @langapp('vaults')
                <a href="{{ route('extras.vaults.create', ['module' => 'tickets', 'id' => $ticket->id]) }}" class="btn btn-xs btn-danger pull-right" data-toggle="ajaxModal">@icon('solid/plus')</a>
                </small>
                <div class="line"></div>
                @widget('Vaults\Show', ['vaults' => $ticket->vault])
                @if (isAdmin() || $isAgent)
                <div class="line"></div>
                <small class="text-uc text-xs text-muted">@langapp('tags')  </small>
                <div class="m-xs">
                    @php
                    $data['tags'] = $ticket->tags;
                    @endphp
                    @include('partial.tags', $data)
                </div>
                @endif
                
                <section class="panel panel-default">
                <header class="panel-heading">@langapp('additional_fields')  </header>
                <div class="">
                    <table class="table table-borderless table-xs small">
                        <tbody>
                            @foreach ($ticket->custom as $field)
                            <tr>
                                <td>{{  ucfirst(humanize($field->meta_key, '-'))  }}</td>
                                <td class="text-right">
                                    <span class="pull-right">
                                        <span class="">{{ isJson($field->meta_value) ? implode(', ', json_decode($field->meta_value)) : $field->meta_value }}</span>
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    
                </div>
            </section>
            <section class="panel panel-default">
                <header class="panel-heading">
                    @icon('solid/bell') @langapp('activities')
                </header>
                @widget('Activities\Feed', ['activities' => $ticket->activities])
                
            </section>
        </div>
        
        <div class="col-sm-8 ticket_body">
            <header class="panel-heading">
                <strong>{{ $ticket->subject }}</strong>
                <label class="label label-dracula">
                    {{  strtoupper($ticket->AsStatus->status) }}
                </label>
                <div class="pull-right text-muted">
                    <a class="thumb-xs avatar">
                        <img src="{{ $ticket->user->profile->photo }}" class="img-circle"
                        alt="{{ $ticket->user->name  }}">
                    </a> <span class="small">{{ $ticket->user->name }}
                        &laquo;{{ $ticket->user->email }}&raquo;
                </span>
                @icon('solid/clock') <span class="small">{{ dateElapsed($ticket->created_at) }}</span>
            </div>
        </header>
        <div class="line line-dashed line-lg pull-in"></div>
        @parsedown($ticket->body)
        @include('partial._show_files', ['files' => $ticket->files])
        <div class="m-xs"></div>
        
        <div class="line line-dashed line-lg pull-in"></div>
        <section class="comment-list block">
            @widget('Comments\ShowComments', ['comments' => $ticket->comments])
            <article class="comment-item" id="comment-form">
                <a class="pull-left thumb-sm avatar">
                    <img src="{{ avatar() }}" class="img-circle">
                </a>
                <span class="arrow left"></span>
                <section class="comment-body">
                    <section class="panel panel-default">
                        @widget('Comments\CreateWidget', ['commentable_type' => 'tickets' , 'commentable_id' => $ticket->id, 'hasFiles' => true, 'cannedResponse' => true])
                        
                        
                    </section>
                </section>
            </article>
            
            
        </section>
    </div>
</section>
</div>


</div>




</section>


</section>

</aside>

<aside class="aside-lg bg-white b-l hide" id="aside-todos">
    <header class="header bg-white b-b b-light">
        <p>@langapp('todo')</p>
    </header>
            <div class="m-xs">
                <article class="chat-item" id="chat-form"> 
                    <a class="pull-left thumb-sm avatar">
                        <img src="{{ avatar() }}" class="img-circle">
                    </a> 

                    <section class="chat-body"> 

                        {!! Form::open(['route' => 'todos.api.save', 'id' => 'createTodo', 'class' => 'm-b-none']) !!}
                        
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="assignee" value="{{ Auth::id() }}">
                        <input type="hidden" name="module_id" value="{{ $ticket->id }}">
                        <input type="hidden" name="module" value="tickets">
                        <input type="hidden" name="url" value="{{ url()->previous() }}">
                        <input type="hidden" name="json" value="false">
                        <input type="hidden" name="due_date" value="{{ now()->addDays(7) }}">
                            <div class="input-group"> 
                                <input type="text" class="form-control" name="subject" placeholder="Add a new todo..."> 
                                <span class="input-group-btn"> 
                                    <button class="btn btn-info formSaving submit" type="submit"> @icon('solid/check-circle') @langapp('save')</button> 
                                </span> 
                            </div> 
                        {!! Form::close() !!}

                        </section> 
                </article>

                <div class="sortable">

                    <div class="todo-list" id="nestable">

                    @widget('Todos\ShowTodos', ['todos' => $ticket->todos()->where(function ($query) {
                                $query->where('user_id', Auth::id())->orWhere('assignee', Auth::id());
                            })->get()])
                    
                    </div>

                </div>

            </div>
              
            </aside>

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
@push('pagestyle')
@include('stacks.css.form')
<link rel=stylesheet href="{{ getAsset('plugins/nestable/nestable.css') }}">
@endpush
@push('pagescript')
@include('stacks.js.markdown')
@include('stacks.js.form')
@include('todos::_ajax.todojs')

@if($isAgent)
<script>
$( document ).ready(function() {
$( "#comment-editor" ).on('focusin', function() {
ticketId = $(this).attr("data-id");
axios.post('{{ route('tickets.lock') }}', {
"id": ticketId
})
.then(function (response) {
})
.catch(function (error) {
toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
});
});
});
</script>
@endif
@include('comments::_ajax.ajaxify')
@endpush
@endsection