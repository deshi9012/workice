@foreach ($subscriptions->chunk(2) as $chunk)
    <div class="row">
        @foreach ($chunk as $subscription)
            <div class="col-md-6">
                        <div class="panel invoice-grid widget-b">
                            <div class="panel-body">
                                <div class="row">

                                    <div class="col-sm-6">
                                        <h6 class="text-uc"><a href="#">{{ $subscription->name }}</a></h6>
                                        <ul class="list list-unstyled">
                                            <li>@langapp('name') : <span class="text-bold">{{ $subscription->name }}</span></li>
                                            <li>Trial Ends : <span class="text-semibold">{{ $subscription->trial_ends_at }}</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-sm-6">

                                        <h6 class="text-semibold text-right no-margin-top">
                                            {!!  $subscription->quantity !!}
                                        </h6>
                                        <ul class="list list-unstyled text-right">
                                            <li>Stripe ID : 
                                            <span class="text-semibold text-success">{{ $subscription->stripe_id }}</span>
                                            </li>
                                            <li>Stripe Plan : 
                                            <span class="label label-danger">{{  $subscription->stripe_plan  }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-footer panel-footer-condensed">
                                <a class="heading-elements-toggle"></a>
                                <div class="heading-elements">
                        <span class="heading-text">
                          @icon('solid/building', 'text-danger') 
                          <a href="{{ route('clients.view', ['id' => $subscription->client_id]) }}">
                            {{ str_limit($subscription->owner->name, 40) }}
                            </a>
                        </span>


                                </div>
                            </div>
                        </div>
                    </div>
        @endforeach
    </div>
@endforeach