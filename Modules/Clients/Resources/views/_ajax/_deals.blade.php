@foreach ($deals->chunk(2) as $chunk)
    <div class="row">
        @foreach ($chunk as $deal)
            <div class="col-md-6">
                        <div class="panel invoice-grid widget-b">
                            <div class="panel-body">
                                <div class="row">

                                    <div class="col-sm-6">
                                        <h6 class="text-semibold"><a href="{{  route('deals.view', ['id' => $deal->id])  }}">{{  $deal->title  }}</a>
                                        </h6>
                                        <ul class="list list-unstyled">
                                            <li>@langapp('deal_value')  : <span class="text-bold">{{ $deal->computed_value  }}</span></li>
                                            <li>@langapp('close_date')  : <span class="text-semibold">{{  dateFormatted($deal->due_date)  }}</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-sm-6">

                                        <h6 class="text-semibold text-right no-margin-top">
                                            {{ $deal->category->name }}
                                        </h6>
                                        <ul class="list list-unstyled text-right">
                                            <li>@langapp('pipeline')  : 
                                            <span class="text-semibold text-success">{{ $deal->pipe->name }}</span>
                                            </li>
                                            <li>@langapp('sales_rep'): 
                                            <span class="label label-danger">{{  $deal->user->name  }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-footer panel-footer-condensed">
                                <a class="heading-elements-toggle"></a>
                                <div class="heading-elements">
                        <span class="heading-text">
                            @icon('solid/user-circle') <a href="{{ route('contacts.view', ['id' => $deal->contact_person]) }}">{{ $deal->contact->name }}</a>
                        </span>

                                    <span class="pull-right">@icon('solid/globe') {{ $deal->AsSource->name }}</span>


                                </div>
                            </div>
                        </div>
                    </div>
        @endforeach
    </div>
@endforeach