@foreach ($expenses->chunk(2) as $chunk)
    <div class="row">
        @foreach ($chunk as $expense)
            <div class="col-md-6">
                        <div class="panel invoice-grid widget-b">
                            <div class="panel-body">
                                <div class="row">

                                    <div class="col-sm-6">
                                        <h6 class="text-semibold"><a href="{{  route('expenses.view', ['id' => $expense->id])  }}">#{{ $expense->code }}</a>
                                        </h6>
                                        <ul class="list list-unstyled">
                                            <li>@langapp('amount')  : <span class="text-bold">{{  formatCurrency($expense->currency, $expense->amount)  }}</span></li>
                                            <li>@langapp('date')  : <span class="text-semibold">{{  dateFormatted($expense->expense_date)  }}</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-sm-6">

                                        <h6 class="text-semibold text-right no-margin-top">
                                            {{ $expense->AsCategory->name }}
                                        </h6>
                                        <ul class="list list-unstyled text-right">
                                            <li>@langapp('currency')  : 
                                            <span class="text-semibold text-success">{{ $expense->currency }}</span>
                                            </li>
                                            <li>@langapp('invoiced')  : 
                                            <span class="label label-danger">{{  $expense->invoiced ? langapp('yes') : langapp('no')  }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-footer panel-footer-condensed">
                                <a class="heading-elements-toggle"></a>
                                <div class="heading-elements">
                        <span class="heading-text">
                          @icon('solid/clock', 'text-danger') 
                        @if($expense->project_id > 0)
                          <a href="{{ route('projects.view', ['id' => $expense->project_id]) }}">
                            {{ str_limit($expense->AsProject->name, 40) }}
                          </a>
                        @else N/A
                        @endif
                        </span>

                                    <a href="{{  route('expenses.view', ['id' => $expense->id])  }}"
                                       class="btn btn-dark btn-xs pull-right">
                                            @icon('solid/credit-card') @langapp('preview')  
                                    </a>


                                </div>
                            </div>
                        </div>
                    </div>
        @endforeach
    </div>
@endforeach