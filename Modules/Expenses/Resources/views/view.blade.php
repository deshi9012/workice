@extends('layouts.app')
@section('content')
<section id="content">
    <section class="hbox stretch">
        
        <section class="vbox">
            <header class="header bg-white b-b clearfix">
                <div class="row m-t-sm">
                    <div class="col-sm-8 m-b-xs">
                        <a class="btn btn-sm btn-dark" href="{{ route('expenses.index') }}" data-rel="tooltip" title="Back" data-placement="bottom">
                            @icon('solid/caret-left') @langapp('expenses')
                        </a>
                        @can('expenses_update')
                            @if ($expense->is_visible == 0)
                            <a class="btn btn-sm btn-dark" data-placement="bottom" data-title="@langapp('show_to_client')  " data-toggle="tooltip" href="{{  route('expenses.show', ['id' => $expense->id])  }}">
                                @icon('solid/eye')
                            </a>
                            @else
                            <a class="btn btn-sm btn-default" data-placement="bottom" data-title="@langapp('hide_to_client')  " data-toggle="tooltip" href="{{  route('expenses.hide', ['id' => $expense->id])  }}">
                                @icon('solid/eye-slash')
                            </a>
                            @endif
                        @endcan

                        @can('reminders_create')
                    <a class="btn btn-sm btn-{{ get_option('theme_color') }}" data-toggle="ajaxModal" data-rel="tooltip"  data-placement="bottom" href="{{  route('calendar.reminder', ['module' => 'expenses', 'id' => $expense->id])  }}" title="@langapp('set_reminder')  ">
                        @icon('solid/clock')
                    </a>
                    @endcan

                        @can('expenses_update')
                        <a class="btn btn-sm btn-{{ get_option('theme_color') }}" data-toggle="ajaxModal" href="{{  route('expenses.edit', ['id' => $expense->id])  }}" title="@langapp('make_changes')" data-rel="tooltip">
                            @icon('solid/pencil-alt') @langapp('edit')
                        </a>
                        @endcan
                        @can('expenses_create')
                        <a class="btn btn-sm btn-{{ get_option('theme_color') }}" data-toggle="ajaxModal" href="{{  route('expenses.copy', ['id' => $expense->id])  }}" title="{{  langapp('copy')  }}">
                            @icon('solid/copy') @langapp('copy')
                        </a>
                        @endcan
                        @can('expenses_delete')
                        <a class="btn btn-sm btn-danger" data-toggle="ajaxModal" href="{{  route('expenses.delete', ['id' => $expense->id])  }}">
                            @svg('solid/trash-alt')
                            @langapp('delete')
                        </a>
                        @endcan
                    </div>
                </div>
            </header>
            <section class="scrollable wrapper bg">
                <div class="column content-column">
                    <div class="details-page expense-margin">
                        <div class="details-container clearfix m-t-10">
                            @if($expense->is_visible === 0)
                            @component('components.alert')
                            <strong class="text-info">Notice!</strong>
                            @langapp('expense_hidden_from_client', ['code' => $expense->code])
                            @endcomponent
                            @endif
                            <div class="row">
                                <div class="col-md-5 b-r">
                                    <div class="expense-project text-center">
                                        <span class="expense-project-span text-uc">
                                            @if (optional($expense->AsProject)->id > 0)
                                            @langapp('project')   :
                                            <a href="{{  route('projects.view', ['id' => $expense->project_id])  }}">
                                                {{  $expense->AsProject->name  }}
                                            </a>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="bg-{{ get_option('theme_color') }} pull-right expense-total text-center">
                                        <span class="text-uc">
                                            @langapp('total')
                                        </span>
                                        <br>
                                        <span class="font16" data-rel="tooltip" title="Amount after tax">
                                            {{ formatCurrency($expense->currency, $expense->amount)  }}
                                        </span>
                                        @if ($expense->is_recurring)
                                        @icon('solid/sync-alt', 'fa-2x fa-spin')
                                        @endif
                                    </div>
                                    
                                    <div class="m-b-sm">
                                        {{  langapp('code')  }}: <strong>{{ $expense->code }}</strong>
                                    </div>
                                    <div class="m-b-sm">
                                        @langapp('before_tax')   : <strong data-rel="tooltip" title="Amount before tax">{{ formatCurrency($expense->currency, $expense->cost) }}</strong>
                                    </div>
                                    @if($expense->currency != 'USD')
                                    <div class="m-b-sm">
                                        @langapp('xrate')   : <strong>1 USD = {{ $expense->currency }} {{  $expense->exchange_rate  }}</strong>
                                    </div>
                                    @endif
                                    <div class="m-b-sm">
                                        @langapp('expense_date')   : <strong>{{ dateString($expense->expense_date) }}</strong>
                                    </div>
                                    <div class="m-b-sm">
                                        @langapp('category')   : <strong>{{ $expense->AsCategory->name }}</strong>
                                    </div>
                                    
                                    
                                    <div class="m-b-sm">
                                        {{  langapp('vendor')  }} : <strong>{{  $expense->vendor }}</strong>
                                    </div>
                                    @if(can('projects_view_clients') && $expense->client_id > 0)
                                    <div class="m-b-sm">
                                        @langapp('client')   : <strong>
                                        <a href="{{  route('clients.view', ['id' => $expense->client_id])  }}">
                                            {{ $expense->company->name }}
                                        </a>
                                        </strong>
                                    </div>
                                    @endif
                                    <div class="m-b-sm">
                                        @langapp('user')   :
                                        <strong>
                                        {{ $expense->user->name }}
                                        </strong>
                                    </div>
                                    <div class="m-b-sm">
                                        @langapp('billable')   :
                                        <strong>
                                        {!! $expense->billable ? '<span class="label label-success">Yes</span>' : '
                                        <span class="label label-danger">
                                            No
                                        </span>' !!}
                                        </strong>
                                    </div>
                                    <div class="m-b-sm">
                                        @langapp('invoiced')   :
                                        <strong>
                                        {!!  $expense->invoiced ? '<span class="label label-success">Yes</span>'
                                        : '<span class="label label-danger">No</span>' !!}
                                        </strong>
                                    </div>
                                    <div class="m-b-sm">
                                        {{  get_option('tax1Label')  }} :
                                        <strong>{{ formatCurrency($expense->currency, $expense->tax1Amount()) }}</strong>
                                        <small>({{ $expense->tax }}%)</small>
                                    </div>
                                    <div class="m-b-sm">
                                        {{  get_option('tax2Label')  }} :
                                        <strong>{{  formatCurrency($expense->currency, $expense->tax2Amount())  }}</strong>
                                        <small>({{ $expense->tax2 }}%)</small>
                                    </div>

                                    <div class="m-b-sm">
                                        @langapp('show_to_client') :
                                        <strong>{{ $expense->is_visible ? langapp('yes') : langapp('no') }}</strong>
                                    </div>

                                    @if ($expense->invoiced_id > 0)
                                    <div class="m-b-sm">
                                        @langapp('invoiced_in') :
                                        <strong>
                                        <a href="{{ route('invoices.view', ['id' => $expense->invoiced_id]) }}">
                                            #{{ $expense->AsInvoice->reference_no }}
                                        </a>
                                        </strong>
                                    </div>
                                    @endif
                                    @if ($expense->is_recurring)
                                    <div class="m-b-sm">
                                        @langapp('recur_frequency') :
                                        <strong>
                                        {{  $expense->frequency  }} Days
                                        </strong>
                                    </div>
                                    <div class="m-b-sm">
                                        @langapp('recur_next_date') :
                                        <strong>
                                        {{ dateTimeFormatted($expense->next_recur_date) }}
                                        </strong>
                                    </div>
                                    <div class="m-b-sm">
                                        @langapp('end_date') :
                                        <strong>
                                        {{  dateTimeFormatted($expense->recur_ends)  }}
                                        </strong>
                                    </div>
                                    @endif
                                    <h4 class="font-thin m-t-sm">
                                    @langapp('notes')
                                    </h4>
                                    @parsedown($expense->notes)


@widget('CustomFields\Extras', ['custom' => $expense->custom])


                                    <div class="line"></div>
                                    <small class="text-uc text-xs text-muted">@langapp('tags')</small>
                                    <div class="m-xs">
                                        @php
                                        $data['tags'] = $expense->tags;
                                        @endphp
                                        @include('partial.tags', $data)
                                    </div>

                                    

                                    <div class="line"></div>
                                    <small class="text-uc text-xs text-muted">@langapp('todo')</small>

                                    <div class="m-xs">

                <article class="chat-item" id="chat-form"> 
                    <a class="pull-left thumb-sm avatar">
                        <img src="{{ avatar() }}" class="img-circle">
                    </a> 

                    <section class="chat-body"> 

                        {!! Form::open(['route' => 'todos.api.save', 'id' => 'createTodo', 'class' => 'm-b-none']) !!}
                        
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="assignee" value="{{ Auth::id() }}">
                        <input type="hidden" name="module_id" value="{{ $expense->id }}">
                        <input type="hidden" name="module" value="expenses">
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
                </div>


                <div class="sortable">

                    <div class="todo-list" id="nestable">

                    @widget('Todos\ShowTodos', ['todos' => $expense->todos()->where(function ($query) {
                                $query->where('user_id', Auth::id())->orWhere('assignee', Auth::id());
                            })->get()])
                    
                    </div>

                </div>

                                    <section class="panel panel-default">
                                    <header class="panel-heading">@langapp('activities')</header>
                                    <div class="slim-scroll" data-color="#333333" data-disable-fade-out="true" data-distance="0" data-height="500px" data-size="3px">
                                        @widget('Activities\Feed', ['activities' => $expense->activities])
                                    </div>
                                </section>
                            </div>
                            <div class="col-md-7">

                                @include('partial._show_files', ['files' => $expense->files, 'limit' => true])

                                <div class="m-xs"></div>

                                <section class="comment-list block">
                                    <article class="comment-item" id="comment-form">
                                        <a class="pull-left thumb-sm avatar">
                                            <img src="{{ avatar() }}" class="img-circle">
                                        </a>
                                        <span class="arrow left"></span>
                                        <section class="comment-body">
                                            <section class="panel panel-default">
                                                @widget('Comments\CreateWidget', ['commentable_type' => 'expenses' , 'commentable_id' => $expense->id])
                                                
                                                
                                            </section>
                                        </section>
                                    </article>
                                    
                                    @widget('Comments\ShowComments', ['comments' => $expense->comments])
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
    </section>
</section>
<a class="hide nav-off-screen-block" data-target="#nav" data-toggle="class:nav-off-screen" href="#">
</a>
</section>

@push('pagestyle')
<link rel=stylesheet href="{{ getAsset('plugins/nestable/nestable.css') }}">
@endpush

@push('pagescript')
@include('stacks.js.markdown')
@include('comments::_ajax.ajaxify')
    @include('todos::_ajax.todojs')
@endpush
@endsection