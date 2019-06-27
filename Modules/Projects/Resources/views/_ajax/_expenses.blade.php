@foreach ($expenses->chunk(2) as $chunk)
    <div class="row">
        @foreach ($chunk as $expense)
            <div class="col-md-6">
                        <div class="panel invoice-grid widget-b">
                            <div class="panel-body">
                                <div class="row">


                                    <div class="col-sm-6">
                                        <h6 class="">
                    <a href="{{  route('expenses.view', ['id' => $expense->id])  }}">
                        {{  $expense->AsCategory->name  }}
                    </a>
                    @if ($expense->is_recurring)
                        @icon('solid/sync-alt', 'text-danger')
                    @endif
                                        </h6>
                                        <ul class="list list-unstyled">
                                            <li>@langapp('currency')  : &nbsp;{{  $expense->currency  }}</li>
                                            <li>@langapp('user')  : <span class="">
                                            {{  $expense->user->name  }}</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-sm-6">

                                        <h6 class="text-right no-margin-top">
                                        {{  formatCurrency($expense->currency, $expense->amount)  }}
                                        </h6>
                                        <ul class="list list-unstyled text-right">
                                            <li>@langapp('billed')  : <span class="text-success">
                            {{  $expense->invoiced === 1 ? langapp('yes') : langapp('no') }}</span>
                                            </li>
                                            <li>@langapp('billable')  : <span class="label label-danger">
                            {{  $expense->billable === 1 ? langapp('yes') : langapp('no') }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-footer panel-footer-condensed"><a
                                        class="heading-elements-toggle"></a>
                                <div class="heading-elements">
                        <span class="heading-text">
                          <span class="status-mark border-danger position-left"></span> @langapp('date')  : <span
                                    class="">{{  dateFormatted($expense->expense_date)  }}</span>
                        </span>

                                    <a href="{{ route('expenses.view', ['id' => $expense->id]) }}"
                                       class="btn btn-dark btn-xs pull-right">@icon('solid/laptop') @langapp('preview') </a>


                                </div>
                            </div>
                        </div>
                    </div>
        @endforeach
    </div>
@endforeach