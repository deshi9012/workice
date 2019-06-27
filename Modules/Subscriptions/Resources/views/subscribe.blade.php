@extends('layouts.public')
@section('content')
<section id="content" class="details-page public-page">
    <div class="container details-container clearfix bg">
        <section class="vbox">
            <header class="header b-b b-light hidden-print">
                
                <a href="{{  route('subscriptions.index')  }}" class="btn btn-sm btn-info m-t-lg pull-right">@icon('solid/home') @langapp('dashboard')
                    </a>
                
                <p class="h3 display-block">
                    @if(!$subscribed)
                    <form action="{{ route('subscriptions.process') }}" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="plan" value="{{ $plan->stripe_plan_id }}">
                        <input type="hidden" name="name" value="{{ $plan->name }}">
                        <input type="hidden" name="billing_date" value="{{ $plan->billing_date }}">
                        
                        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                        data-key="{{ config('services.stripe.key') }}"
                        data-amount="{{ $subscription->amount }}"
                        data-name="{{ $plan->name }}"
                        data-description="{{$plan->description}}"
                        data-image="{{ getStorageUrl(config('system.media_dir').'/'.get_option('company_logo')) }}"
                        data-locale="auto"
                            data-label="Subscribe"
                            data-email="{{auth()->check() ? auth()->user()->profile->business->email : null}}"
                            data-panel-label="Subscribe">
                        </script>
                    </form>
                    @endif
                </p>

                    
            </header>
            <section class="wrapper panel-default">
                <div class="panel-body">
                    @php
                    $data['company'] = auth()->user()->profile->business;
                    $currency = auth()->user()->profile->business->currency;
                    @endphp
                    <div class="row">
                        <div class="col-xs-6">
                            <img src="{{ getStorageUrl(config('system.media_dir').'/'.get_option('invoice_logo'))  }}"
                            width="{{ get_option('invoice_logo_width')}}px">
                        </div>
                        <div class="col-xs-6 text-right">
                            <p class="font20">Subscription #{{ $plan->id}}</p>
                            <div class="estimate-header-text">
                                {{ stripAccents(langapp('date'))  }}
                                : {{ dateTimeFormatted($plan->created_at)}}
                            </div>
                            <div class="estimate-header-text">
                                {{ stripAccents(langapp('billing_date')) }}
                                : {{dateTimeFormatted($plan->billing_date)}}
                            </div>
                        </div>
                    </div>
                    <div class="well m-t bg-white">
                        <div class="row">
                            <div class="col-xs-6">
                                <p class="h3">@langapp('client')</p>
                                @include('partial.client_address', $data)
                            </div>
                            <div class="col-xs-6">
                                <p class="h3">@langapp('company_name')</p>
                                @include('partial.company_address', $data)
                            </div>
                        </div>
                    </div>
                    <div class="line"></div>
                    <table class="table">
                        <thead>
                            <tr class="text-uc">
                                <th width="40%">@langapp('product')</th>
                                <th width="10%">@langapp('qty')</th>
                                <th width="15%">@langapp('unit_price')</th>
                                <th width="15%" class="text-right">@langapp('total')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="text-bold">{{ $plan->name }} ({{ formatCurrency(strtoupper($subscription->currency), $subscription->amount / 100) }} / {{ $subscription->interval }})</span>
                                <div class="text-muted">@parsedown($plan->description)</div>
                            </td>
                            <td>1</td>
                            <td>{{ formatCurrency($currency, $subscription->amount/100) }}</td>
                            <td class="text-right">{{  formatCurrency($currency, $subscription->amount/100) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right"><strong>@langapp('sub_total') </strong></td>
                            <td class="text-right">{{  formatCurrency($currency, $subscription->amount/100)  }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-right no-border">
                            <strong>@langapp('balance_due')  </strong></td>
                            <td class="text-right text-bold">{{  formatCurrency($currency, $subscription->amount/100)  }}</td>
                        </tr>
                    </tbody>
                </table>
                
                
            </div>
        </section>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open"
    data-target="#nav,html"></a>
</div>
</section>
@endsection