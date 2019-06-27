<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('include_expenses')  </h4>
        </div>

        {!! Form::open(['route' => 'items.bill.expenses', 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}

       
        <input type="hidden" name="invoice" value="{{  $invoice->id  }}">
        <div class="modal-body">
            @foreach ($invoice->company->expenses->where('invoiced', '!=', 1) as $key => $expense)

                <div class="form-group">
                    <div class="col-lg-12 small">
                        <label class="col-md-1">
                            <input type="checkbox" name="expense[{{  $expense->id  }}]" value="1" checked>
                            <span class="label-text"></span>
                        </label>


                        <div class="col-md-6">
                            @langapp('cost')  :
                            <strong>
                                {{  formatCurrency($expense->currency, $expense->cost)  }}
                            </strong>
                            <br>
                            @langapp('project')  :
                            <strong>
                                {{  optional($expense->AsProject)->name }}
                            </strong><br>
                            @langapp('category')  :
                            <strong>
                                {{  $expense->AsCategory->name  }}
                            </strong><br>

                        </div>

                        <div class="col-md-5">
                            @langapp('expense_date')  :
                            <strong>
                                {{  dateFormatted($expense->expense_date)  }}
                            </strong><br>
                            @langapp('notes')  :
                            <strong>
                                @parsedown(str_limit($expense->notes, 25))
                            </strong>

                        </div>

                    </div>

                </div>
                <div class="line line-dashed line-lg pull-in"></div>


                @endforeach


        </div>
        <div class="modal-footer">

           {!! closeModalButton() !!}

            {!! renderAjaxButton() !!}
            
        </div>

        {!! Form::close() !!}
    </div>
</div>

@include('partial.ajaxify')
