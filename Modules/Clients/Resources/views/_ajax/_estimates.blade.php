@foreach ($estimates->chunk(2) as $chunk)
    <div class="row">
        @foreach ($chunk as $estimate)
            <div class="col-md-6">
                        <div class="panel invoice-grid widget-b">
                            <div class="panel-body">
                                <div class="row">

                                    <div class="col-sm-6">
                                        <h6 class="text-semibold"><a href="{{  route('estimates.view', ['id' => $estimate->id])  }}">#{{  $estimate->reference_no  }}</a>
                                        </h6>
                                        <ul class="list list-unstyled">
                                            <li>@langapp('amount')  : <span class="text-bold">{{  formatCurrency($estimate->currency, $estimate->amount)  }}</span></li>
                                            <li>@langapp('date_issued')  : <span class="text-semibold">{{  dateFormatted($estimate->created_at)  }}</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-sm-6">

                                        <h6 class="text-semibold text-right no-margin-top">
                                            @if(!is_null($estimate->viewed_at))
                                                @icon('solid/eye', 'text-success', ['data-rel' => 'tooltip', 'title' => 'Viewed'])
                                            @else @icon('solid/eye-slash', 'text-danger', ['data-rel' => 'tooltip', 'title' => 'Not Viewed'])
                                            @endif
                                        </h6>
                                        <ul class="list list-unstyled text-right">
                                            <li>@langapp('sent')  : 
                                            <span class="text-semibold text-success">
                            {{ $estimate->is_sent ? langapp('yes') : langapp('no') }}</span>
                                            </li>
                                            <li>@langapp('status')  : 
                                            <span class="label label-danger">@langapp(strtolower($estimate->status))  </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-footer panel-footer-condensed">
                                <a class="heading-elements-toggle"></a>
                                <div class="heading-elements">
                        <span class="heading-text">
                          @icon('solid/calendar-alt', 'text-danger') @langapp('due_date')  : <span
                                    class="text-semibold">{{  dateFormatted($estimate->due_date)  }}</span>
                        </span>

                                    <a href="{{  route('estimates.view', ['id' => $estimate->id])  }}"
                                       class="btn btn-dark btn-xs pull-right">
                                            @icon('solid/file-alt') @langapp('preview')  
                                    </a>


                                </div>
                            </div>
                        </div>
                    </div>
        @endforeach
    </div>
@endforeach