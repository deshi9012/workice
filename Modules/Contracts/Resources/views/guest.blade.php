@extends('layouts.public')
@section('content')
<section id="content" class="details-page bg">
    <div class="container details-container clearfix">
        <section class="vbox">
            <header class="header b-b b-light hidden-print">
                <a href="{{ URL::signedRoute('contracts.client.pdf', $contract->id) }}"
                    class="btn btn-sm btn-dark btn-responsive">
                @icon('solid/file-pdf') PDF </a>
                @if ($contract->client_sign_id <= 0 && is_null($contract->rejected_at))
                    @if (!$contract->isExpired() && $contract->company->primary_contact > 0)
                    <a href="{{ URL::signedRoute('contracts.client.approve', $contract->id) }}" data-toggle="ajaxModal"
                    class="btn btn-sm btn-success">@icon('solid/check-circle') @langapp('approve_contract') </a>
                    <a href="{{ URL::signedRoute('contracts.client.dismiss', $contract->id) }}" data-toggle="ajaxModal"
                    class="btn btn-sm btn-danger">@icon('solid/times') @langapp('dismiss') </a>
                    @endif
                @endif
                <a href="{{ route('contracts.view', ['id' => $contract->id]) }}"
                    class="btn btn-sm btn-info btn-responsive pull-right">
                @icon('solid/home') @langapp('dashboard') </a>
            </header>
            <section class="panel panel-body wrapper m-t-10">
                @if ($contract->client_sign_id > 0)
                <div class="alert alert-success">
                    <strong> Contract Approved!</strong> This contract was approved on {{ $contract->clientSign->updated_at->toDayDateTimeString() }}
                </div>
                @endif
                @if ($contract->isExpired())
                <div class="alert alert-danger"><strong> Contract Expired!</strong> This contract expired
                on {{ dateTimeFormatted($contract->expiry_date) }}</div>
                @endif
                @if (!is_null($contract->rejected_at))
                <div class="alert alert-danger font14"><strong> Contract Rejected!</strong> This contract was rejected
                on {{ dateTimeFormatted($contract->rejected_at) }}
                <blockquote class="font14">@parsedown($contract->rejected_reason)</blockquote>
            </div>
                @endif
                <p class="h3 display-block">{{ isset($is_due_txt) ? $is_due_txt : '' }} </p>
                @inject('clauses', 'Modules\Contracts\Entities\Clause')
                <div class="contract-page">
                    <h1 class="font40">Service Contract</h1>
                    <h2 class="">{{ $contract->contract_title }}</h2>
                    <div class="m-20">
                        <p>
                            {!! str_replace('{EXPIRY_DATE}', dateFormatted($contract->expiry_date), $clauses->readClause('intro')) !!}
                        </p>
                    </div>
                    <div class="row pb15">
                        <div class="col-md-6">
                            <div class="h4"><strong>Client</strong> (the "Client")</div>
                            <div class="m-md">
                                @php
                                $data['company'] = $contract->company;
                                @endphp
                                @include('partial.client_address', $data)
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="h4"><strong>Contractor</strong> (the "Contractor")</div>
                            <div class="m-md">
                                @include('partial.company_address', $data)
                            </div>
                            
                        </div>
                    </div>
                    <div class="pb15">
                        <div class="h3 pb15"><strong>Services</strong></div>
                        Contractor agrees to perform services as described in Attachment A (the “Services”) and Client
                        agrees to pay Contractor as described in Attachment A.
                    </div>
                    <!-- SIGNATURES -->
                    <div class="pb15">
                        <div class="h3 pb15"><strong>Signatures</strong></div>
                        {!! $clauses->readClause('signatures') !!}
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Client</strong> ({{ $contract->company->contact_person }})
                            @if ($contract->client_sign_id > 0)
                            <span class="m-l-sm text-muted">
                                @icon('solid/gavel') Signed - <strong>{{ dateTimeFormatted($contract->clientSign->created_at) }}</strong>
                            </span>
                            @endif
                            <div class="signatureSec">
                                <div class="col-md-8">
                                    @if ($contract->client_sign_id > 0)
                                    <span class="signature">
                                        @if($contract->clientSign->image)
                                        <img src="{{ getStorageUrl(config('system.signature_dir').'/'.$contract->clientSign->image) }}" width="200" alt="">
                                        @else
                                        {{  $contract->clientSign->signature  }}
                                        @endif
                                    </span>
                                    
                                    
                                    
                                    @else
                                    <div class="line line-dashed line-lg pull-in m-t-40"></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <strong>Contractor</strong> ({{ get_option('contact_person') }})
                            @if ($contract->contractor_sign_id > 0)
                            <span class="m-l-sm text-muted">
                                @icon('solid/gavel') Signed - <strong>{{ dateTimeFormatted($contract->contractorSign->created_at) }}</strong>
                            </span>
                            @endif
                            <div class="signatureSec">
                                <div class="col-md-8">
                                    @if ($contract->contractor_sign_id > 0)
                                    
                                    <span class="signature">
                                        @if($contract->contractorSign->image)
                                        <img src="{{ getStorageUrl(config('system.signature_dir').'/'.$contract->contractorSign->image) }}" width="200" alt="">
                                        @else
                                        {{  $contract->contractorSign->signature  }}
                                        @endif
                                    </span>
                                    
                                    
                                    @else
                                    <div class="line line-dashed line-lg pull-in m-t-40"></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-t-lg">
                    <h1>Attachment A:</h1>
                    <h4 class="">Services</h4>
                    <div class="">
                        <div class="">Term</div>
                        <div class="m-b-20">Start date:
                            <strong>{{ dateFormatted($contract->start_date) }}</strong> - End date:
                        <strong>{{ dateFormatted($contract->end_date) }}</strong></div>
                        <div class="">Rate</div>
                        <div class="m-b-20">
                            <p class="">{{ $contract->services }}</p>
                            <p class="">
                                @if ($contract->rate_is_fixed == 0)
                                {{ formatCurrency($contract->currency, $contract->hourly_rate) }} Per hour
                                @else
                                {{ formatCurrency($contract->currency, $contract->fixed_rate) }} Fixed Fee
                                @endif
                            </p>
                        </div>
                        <div class="">Project details</div>
                        <div class="m-b-20">
                            <blockquote>
                                {{ $contract->description }}
                            </blockquote>
                        </div>
                    </div>
                </div>
                <div class="m-t-lg">
                    <h1>Attachment B:</h1>
                    <h4 class=""><strong>Terms and Conditions</strong></h4>
                    {!! $clauses->readClause('terms_condition') !!}
                    {{-- ACCEPTANCES --}}
                    <h4 class=""><strong>Acceptances</strong></h4>
                    {!! $clauses->readClause('acceptances') !!}
                    {{-- WARRANTY --}}
                    <h4 class=""><strong>Warranty</strong></h4>
                    {!! $clauses->readClause('warranty') !!}
                    {{-- CONFIDENTIALITY --}}
                    <h4 class=""><strong>Confidentiality &amp; Non-Disclosure</strong></h4>
                    {!! $clauses->readClause('confidentiality') !!}
                </div>
                <div class="">
                    {{-- OWNERSHIP LICENSE --}}
                    <h4 class=""><strong>Ownership and Licenses</strong></h4>
                    <p>
                        {!! $clauses->readClause('ownership') !!}
                    </p>
                    @if ($contract->license_owner == 'client')
                    <p>
                        {!! $clauses->readClause('client_ownership') !!}
                    </p>
                    @else
                    <span class="text-danger">{{  $contract->client_rights  }}</span>
                    @endif
                    {{-- NON SOLICIT --}}
                    <h4 class=""><strong>Non-Solicit</strong></h4>
                    <p>
                        {!! $clauses->readClause('non_solicit') !!}
                    </p>
                    {{-- NON COMPLETE --}}
                    @if ($contract->non_compete)
                    <p>
                        {!! $clauses->readClause('non_compete') !!}
                    </p>
                    
                    @else
                    <p class="text-info">Note: This section only shows if applicable</p>
                    @endif
                    {{-- RELATIONSHIP --}}
                    <h4 class=""><strong>Relationship of Parties</strong></h4>
                    <p>
                        {!! $clauses->readClause('relationship') !!}
                    </p>
                    {{-- TERMINATION --}}
                    <h4 class=""><strong>Term &amp; Termination</strong></h4>
                    <p>
                        {!! str_replace('{TERM_DAYS}', $contract->termination_notice, $clauses->readClause('termination')) !!}
                    </p>
                </div>
                <div class="">
                    {{-- CANCELLATION --}}
                    @if ($contract->cancelation_fee > 0)
                    <h4 class=""><strong>Cancellation Fee</strong></h4>
                    <p>
                        {!! str_replace('{CANCEL_FEE}', formatCurrency($contract->currency, $contract->cancelation_fee), $clauses->readClause('cancellation')) !!}
                    </p>
                    @endif
                    {{-- PAYMENT TERMS --}}
                    <h4 class=""><strong>Payment Terms</strong></h4>
                    <p>
                        {!! str_replace('{PAYMENT_DAYS}', $contract->payment_terms, $clauses->readClause('payment_terms')) !!}
                    </p>
                    {{-- LATE PAYMENT --}}
                    @if ($contract->late_payment_fee > 0)
                    <h4 class=""><strong>Late Payment</strong></h4>
                    @php $loadClause = 'late_payment'; @endphp
                    @if ($contract->late_fee_percent == '1')
                    @php $loadClause = 'late_payment_percent'; @endphp
                    @endif
                    @php
                    $late_fee = ($contract->late_payment_percent == 0) ? formatCurrency($contract->currency, $contract->late_payment_fee) : $contract->late_payment_fee;
                    @endphp
                    <p>
                        {!! str_replace('{LATE_FEE}', $late_fee, $clauses->readClause($loadClause)) !!}
                    </p>
                    @endif
                    {{-- DEPOSIT --}}
                    @if ($contract->deposit_required > 0)
                    <h4 class=""><strong>Deposit</strong></h4>
                    <p>
                        {!! str_replace('{DEPOSIT_FEE}', formatCurrency($contract->currency, $contract->deposit_required), $clauses->readClause('deposit')) !!}
                    </p>
                    @endif
                    {{-- REIMBURSEMENT --}}
                    <h4 class=""><strong>Expense Reimbursement</strong></h4>
                    <p>
                        {!! str_replace('{PAYMENT_DAYS}', $contract->payment_terms, $clauses->readClause('reimburse')) !!}
                    </p>
                    {{-- FEEDBACK --}}
                    @if ($contract->feedbacks > 0)
                    <h4 class=""><strong>Feedback</strong></h4>
                    <p>
                        {!! str_replace('{FEEDBACKS}', $contract->feedbacks, $clauses->readClause('feedback')) !!}
                    </p>
                    @endif
                    {{-- CHANGES --}}
                    <h4 class=""><strong>Changes</strong></h4>
                    <p>
                        {!! $clauses->readClause('changes') !!}
                    </p>
                    {{-- LIABILITY --}}
                    <h4 class=""><strong>Indemnification and Limitation of Liability</strong></h4>
                    <p>
                        {!! $clauses->readClause('liability') !!}
                    </p>
                </div>
                <div class="">
                    {{-- AUTHORSHIP --}}
                    <h4 class=""><strong>Right to Authorship Credit</strong></h4>
                    <p>
                        {!! $clauses->readClause('authorship') !!}
                    </p>
                    @if ($contract->portfolio_rights == '1')
                    <p>{!! $clauses->readClause('portfolio_rights') !!}</p>
                    @endif
                    {{-- DISPUTE --}}
                    <h4 class=""><strong>Governing Law and Dispute Resolution</strong></h4>
                    <p>
                        {!! $clauses->readClause('dispute') !!}
                    </p>
                    {{-- FORCE MAJEURE --}}
                    <h4 class=""><strong>Force Majeure</strong></h4>
                    <p>
                        {!! $clauses->readClause('majeure') !!}
                    </p>
                    
                    {{-- NOTICES --}}
                    <h4 class=""><strong>Notices</strong></h4>
                    <p>
                        {!! $clauses->readClause('notices') !!}
                    </p>
                    {{-- CONDUCT --}}
                    <h4 class=""><strong>Appropriate Conduct</strong></h4>
                    @if ($contract->appropriate_conduct > 0)
                    <p>
                        {!! $clauses->readClause('appropriate_conduct') !!}
                    </p>
                    
                    @endif
                    {{-- MISCELLANEOUS --}}
                    <h4 class=""><strong>Miscellaneous</strong></h4>
                    <p>
                        {!! $clauses->readClause('misc') !!}
                    </p>
                    {{-- ENTIRE CONTRACT --}}
                    <h4 class=""><strong>Entire Contract</strong></h4>
                    <p>
                        {!! $clauses->readClause('entire_contract') !!}
                    </p>
                    {{-- ANNOTATIONS --}}
                    @if (!is_null($contract->annotations))
                    <h4 class="pb15"><strong>Annotations and Alterations</strong></h4>
                    <p>{{  $contract->annotations  }}</p>
                    @endif
                </div>
            </div>
            {{-- END CONTRACT --}}
            {{ $contract->clientViewed() }}
        </section>
        
        
        @endsection