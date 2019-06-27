<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('invoice_project')  </h4>
        </div>

        {!! Form::open(['route' => ['projects.api.invoice', $project->id], 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}

        <input type="hidden" name="id" value="{{ $project->id }}">
        <div class="modal-body">
            <p>Project <strong> {{ $project->name }} </strong> will be converted to an Invoice.</p>

            <p>@langapp('unbilled') : <strong>{{ secToHours($project->unbilled) }}</strong></p>
            <p>@langapp('expenses') : <strong>{{ formatCurrency($project->currency, $project->total_expenses) }}</strong> </p>

                <div class="m-sm">
                <label> 
                <input type="radio" name="invoice_style" value="single">
                <span class="label-text">
                Single Line - <small class="text-muted">Project displays in a single invoice item</small>
                </span>
                </label>
                </div>

                <div class="m-sm">
                <label> 
                    <input type="radio" name="invoice_style" value="task_line" checked> 
                    <span class="label-text">Task Per Line - <small class="text-muted">List tasks as invoice items</small></span>
                </label>
                </div>


            @php
            $expenses = $project->expenses->where('invoiced', 0);
            @endphp

            @if (count($expenses) > 0)
                <h3 class="small text-danger">@langapp('include_expenses')  </h3>
                    @foreach ($expenses as $key => $expense)
                                

                    <div class="form-group">
                        <div class="col-lg-12 small">
                            <div class="col-md-1">
                                <label>
                                <input type="checkbox" class="form-control" name="expense[{{ $expense->id }}]" value="1">
                                 <span class="label-text"></span>
                             </label>
                               
                            </div>
                            
                            <div class="col-md-6">
                                @langapp('cost')  :
                                <strong>{{ formatCurrency($expense->currency, $expense->cost) }}</strong><br>
                                @langapp('project')  : <strong>{{ $project->name }}</strong><br>
                                @langapp('category')  : <strong>{{ $expense->AsCategory->name }}</strong><br>

                            </div>

                            <div class="col-md-5">
                                @langapp('expense_date')  :
                                <strong>{{ dateFormatted($expense->expense_date) }}</strong><br>
                                @langapp('notes')  : <strong class="text-ellipsis">
                                    @parsedown($expense->notes)
                                </strong>

                            </div>

                        </div>

                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>


                @endforeach
                

        @endif

                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    @langapp('time_entries_marked_as_billed')
                </div>
        


        </div>
        <div class="modal-footer">
            
            {!! closeModalButton() !!}
            {!! renderAjaxButton()  !!}
            
        </div>
        {!! Form::close() !!}
    </div>
</div>

@include('partial.ajaxify')