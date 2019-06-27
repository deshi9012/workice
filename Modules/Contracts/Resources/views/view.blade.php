@extends('layouts.app')
@section('content')
<section id="content">
    <section class="hbox stretch">
        <aside>
            <section class="vbox">
                <header class="header bg-white b-b clearfix hidden-print">
                    <div class="row m-t-sm">
                        <div class="col-sm-12 m-b-xs">
                        
                        <span class="h3">{{ $contract->contract_title }}

                            <a href="#aside-files" data-toggle="class:show" class="btn btn-sm btn-default pull-right">@icon('solid/folder-open')</a>

                        <div class="btn-group pull-right">
                          <button class="btn btn-{{ get_option('theme_color') }} btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">@langapp('more_actions') <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            @can('contracts_update')
                                @if ($contract->signed == 0)
                                <li><a href="{{ route('contracts.edit', ['id' => $contract->id]) }}">@icon('solid/pencil-alt') @langapp('edit')</a></li>
                                @endif
                            @endcan
                            @admin
                            <li><a href="{{ route('contracts.copy', $contract->id)  }}" data-toggle="ajaxModal">@icon('solid/copy') @langapp('copy')</a></li>
                            <li><a href="{{ route('contracts.activity', ['id' => $contract->id]) }}" data-toggle="ajaxModal">@icon('solid/history') @langapp('activities')</a></li>
                            @can('reminders_create')
                            <li><a data-toggle="ajaxModal" href="{{ route('calendar.reminder', ['module' => 'contracts', 'id' => $contract->id]) }}">
                                    @icon('solid/stopwatch') @langapp('set_reminder')
                                </a>
                            </li>
                            @endcan

                            @can('contracts_sign')
                                <li><a href="{{ route('contracts.share', $contract->id) }}" data-toggle="ajaxModal">@icon('solid/link') @langapp('share')</a></li>
                            @endcan
                            
                            @endadmin

                            <li><a href="{{ route('contracts.download', $contract->id) }}">@icon('solid/file-pdf') PDF</a></li>
                            

                          </ul>
                        </div>

                        @can('contracts_sign')
                                @if ($contract->signed == '0')
                                <a href="{{ route('contracts.send', ['id' => $contract->id]) }}" class="btn btn-sm btn-success pull-right" data-toggle="ajaxModal">@icon('solid/file-signature') @langapp('sign_send')</a>
                                @endif
                        @endcan

                        @if ($contract->client_id == Auth::user()->profile->company)
                            <a href="{{ URL::signedRoute('contracts.guest.show', $contract->id) }}" class="btn btn-sm btn-success pull-right">@icon('solid/file-signature') @langapp('preview')</a>
                        @endif

                            </span>
                        </div>
                    </div>
                </header>
                
                
                <section class="scrollable bg">
                    <div class="wrapper">
                        <section class="panel panel-body">
                            
                            @if ($contract->isExpired())
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                @icon('solid/calendar-times') @langapp('contract_expired', ['date' => dateTimeFormatted($contract->expiry_date)])
                            </div>
                            @endif
                            
                            
                            @inject('clauses', 'Modules\Contracts\Entities\Clause')
                            <!-- START CONTRACT -->
                            <div class="contract-page">
                                <h1 class="service-contract">@langapp('service_contract')</h1>
                                <h2 class="">{{  $contract->contract_title  }}</h2>
                                <div class="m-20">
                                    
                                    @parsedown(str_replace('{EXPIRY_DATE}', dateFormatted($contract->expiry_date), $clauses->readClause('intro')))
                                    
                                    
                                </div>
                                <div class="row pb15">
                                    <div class="col-md-6">
                                        <div class="h4"><strong>@langapp('client')</strong> (the "Client")</div>
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
                                    Contractor agrees to perform services as described in Attachment A (the “Services”)
                                    and Client agrees to pay Contractor as described in Attachment A.
                                </div>
                                <!-- SIGNATURES -->
                                <div class="pb15">
                                    <div class="h3 pb15"><strong>Signatures</strong></div>
                                    
                                    @parsedown($clauses->readClause('signatures'))
                                    
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Client</strong> ({{  $contract->company->contact_person }})
                                        @if ($contract->client_sign_id > 0)
                                        <span class="m-l-sm text-muted small">
                                            Signed - <strong>{{  dateTimeFormatted($contract->clientSign->created_at)  }}</strong>
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
                                        <strong>Contractor</strong> ({{  get_option('contact_person')  }})
                                        @if ($contract->contractor_sign_id > 0)
                                        <span class="m-l-sm text-muted small">
                                            Signed - <strong>{{  dateTimeFormatted($contract->contractorSign->created_at)  }}</strong>
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
                            <div class="contract-page">
                                <h1>Attachment A:</h1>
                                <h2 class="h3">Services</h2>
                                <div class="">
                                    <div class="">Term</div>
                                    <div class="m-b-20">Start date:
                                        <strong>{{  dateFormatted($contract->start_date)  }}</strong> - End date:
                                    <strong>{{  dateFormatted($contract->end_date)  }}</strong></div>
                                    <div class="">Rate</div>
                                    <div class="m-b-20">
                                        <p class="">{{  $contract->services  }}</p>
                                        <p class="">
                                            @if ($contract->rate_is_fixed == 0)
                                            {{ formatCurrency($contract->currency, $contract->hourly_rate)  }} Per hour
                                            @else
                                            {{ formatCurrency($contract->currency, $contract->fixed_rate)  }} Fixed Fee
                                            @endif
                                        </p>
                                    </div>
                                    <div class="">Project details</div>
                                    <div class="m-b-20">
                                        <blockquote>
                                            @parsedown($contract->description)
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <div class="contract-page">
                                <h1>Attachment B:</h1>
                                <div class="pb15 h3"><strong>Terms and Conditions</strong></div>
                                
                                @parsedown($clauses->readClause('terms_condition'))
                                
                                
                                <!-- ACCEPTANCES -->
                                <div class="pb15">
                                    <div class="pb15 h3"><strong>Acceptances</strong></div>
                                    
                                    @parsedown($clauses->readClause('acceptances'))
                                    
                                    
                                </div>
                                <!-- WARRANTY -->
                                <div class="pb15">
                                    <div class="pb15 h3"><strong>Warranty</strong></div>
                                    
                                    @parsedown($clauses->readClause('warranty'))
                                    
                                </div>
                                <!-- CONFIDENTIALITY -->
                                <div class="pb15">
                                    <div class="pb15 h3"><strong>Confidentiality &amp; Non-Disclosure</strong></div>
                                    
                                    @parsedown($clauses->readClause('confidentiality'))
                                    
                                </div>
                            </div>
                            <div class="contract-page">
                                <!-- OWNERSHIP LICENSE -->
                                <div class="pb15">
                                    <div class="pb15 h3"><strong>Ownership and Licenses</strong></div>
                                    
                                    @parsedown($clauses->readClause('ownership'))
                                    
                                    
                                    @if ($contract->license_owner == 'client')
                                    
                                    @parsedown($clauses->readClause('client_ownership'))
                                    
                                    @else
                                    <span class="text-danger">{{  $contract->client_rights  }}</span>
                                    @endif
                                </div>
                                <!-- NON SOLICIT -->
                                <div class="pb15">
                                    <div class="pb15 h3"><strong>Non-Solicit</strong></div>
                                    
                                    @parsedown($clauses->readClause('non_solicit'))
                                    
                                    
                                </div>
                                <!-- NON COMPLETE -->
                                <div class="pb15">
                                    <div class="pb15 h3"><strong>Non-Compete</strong></div>
                                    @if ($contract->non_compete)
                                    
                                    @parsedown($clauses->readClause('non_compete'))
                                    
                                    
                                    @else
                                    <p class="text-info">Note: This section only shows if applicable</p>
                                    @endif
                                </div>
                                <!-- RELATIONSHIP -->
                                <div class="pb15">
                                    <div class="pb15 h3"><strong>Relationship of Parties</strong></div>
                                    
                                    @parsedown($clauses->readClause('relationship'))
                                    
                                    
                                </div>
                                <!-- TERMINATION -->
                                <div class="pb15">
                                    <div class="pb15 h3"><strong>Term &amp; Termination</strong></div>
                                    
                                    @parsedown(str_replace('{TERM_DAYS}', $contract->termination_notice, $clauses->readClause('termination')))
                                    
                                </div>
                            </div>
                            <div class="contract-page">
                                <!-- CANCELLATION -->
                                <div class="pb15">
                                    <div class="pb15 h3"><strong>@langapp('cancellation_fee')</strong></div>
                                    @if ($contract->cancelation_fee > 0)
                                    
                                    @parsedown(str_replace('{CANCEL_FEE}', formatCurrency($contract->currency, $contract->cancelation_fee), $clauses->readClause('cancellation')))
                                    
                                    @else
                                    <p class="text-info">Note: This section only shows if applicable</p>
                                    @endif
                                </div>
                                <!-- PAYMENT TERMS -->
                                <div class="pb15">
                                    <div class="pb15 h3"><strong>@langapp('payment_terms')</strong></div>
                                    
                                    @parsedown(str_replace('{PAYMENT_DAYS}', $contract->payment_terms, $clauses->readClause('payment_terms')))
                                    
                                    
                                </div>
                                <!-- LATE PAYMENT -->
                                <div class="pb15">
                                    <div class="pb15 h3"><strong>Late Payment</strong></div>
                                    @if ($contract->late_payment_fee > 0)
                                    @php $loadClause = 'late_payment'; @endphp
                                    @if ($contract->late_fee_percent == '1')
                                    @php $loadClause = 'late_payment_percent'; @endphp
                                    @endif
                                    @php
                                    $late_fee = ($contract->late_payment_percent == 0) ? formatCurrency($contract->currency, $contract->late_payment_fee) : $contract->late_payment_fee;
                                    @endphp
                                    
                                    @parsedown(str_replace('{LATE_FEE}', $late_fee, $clauses->readClause($loadClause)))
                                    
                                    
                                    @else
                                    <p class="text-info">Note: This section only shows if applicable</p>
                                    @endif
                                </div>
                                <!-- DEPOSIT -->
                                <div class="pb15">
                                    <div class="pb15 h3"><strong>Deposit</strong></div>
                                    @if ($contract->deposit_required > 0)
                                    
                                    @parsedown(str_replace('{DEPOSIT_FEE}', formatCurrency($contract->currency, $contract->deposit_required), $clauses->readClause('deposit')))
                                    
                                    
                                    @else
                                    <p class="text-info">Note: This section only shows if applicable</p>
                                    @endif
                                </div>
                                <!-- REIMBURSEMENT -->
                                <div class="pb15">
                                    <div class="pb15 h3"><strong>Expense Reimbursement</strong></div>
                                    @parsedown(str_replace('{PAYMENT_DAYS}', $contract->payment_terms, $clauses->readClause('reimburse')))
                                    
                                </div>
                                <!-- FEEDBACK -->
                                <div class="pb15">
                                    <div class="pb15 h3"><strong>Feedback</strong></div>
                                    @if ($contract->feedbacks)
                                    @parsedown(str_replace('{FEEDBACKS}', $contract->feedbacks, $clauses->readClause('feedback')))
                                    @else
                                    <p class="text-info">Note: This section only shows if applicable</p>
                                    @endif
                                </div>
                                <!-- CHANGES -->
                                <div class="pb15">
                                    <div class="pb15 h3"><strong>Changes</strong></div>
                                    
                                    @parsedown($clauses->readClause('changes'))
                                    
                                </div>
                                <!-- LIABILITY -->
                                <div class="pb15">
                                    <div class="pb15 h3">
                                        <strong>Indemnification and Limitation of Liability</strong>
                                    </div>
                                    
                                    @parsedown($clauses->readClause('liability'))
                                    
                                    
                                </div>
                            </div>
                            <div class="contract-page">
                                <!-- AUTHORSHIP -->
                                <div class="pb15">
                                    <div class="pb15 h3"><strong>Right to Authorship Credit</strong></div>
                                    
                                    @parsedown($clauses->readClause('authorship'))
                                    
                                    
                                    @if ($contract->portfolio_rights == '1')
                                    <p>Client hereby agrees Contractor may use the work product as part of
                                        Contractors portfolio and websites, galleries and other media solely for the
                                    purpose of showcasing Contractors work but not for any other purpose.</p>
                                    @endif
                                </div>
                                <!-- DISPUTE -->
                                <div class="pb15">
                                    <div class="pb15 h3"><strong>Governing Law and Dispute Resolution</strong></div>
                                    
                                    @parsedown($clauses->readClause('dispute'))
                                    
                                    
                                </div>
                                <!-- FORCE MAJEURE -->
                                <div class="pb15">
                                    <div class="pb15 h3"><strong>Force Majeure</strong></div>
                                    
                                    @parsedown($clauses->readClause('majeure'))
                                    
                                </div>
                                <!-- NOTICES -->
                                <div class="pb15">
                                    <div class="pb15 h3"><strong>Notices</strong></div>
                                    
                                    @parsedown($clauses->readClause('notices'))
                                    
                                </div>
                                <!-- Conduct -->
                                <div class="pb15">
                                    <div class="pb15 h3"><strong>Appropriate Conduct</strong></div>
                                    @if ($contract->appropriate_conduct > 0)
                                    @parsedown($clauses->readClause('appropriate_conduct'))
                                    @else
                                    <p class="text-info">Note: This section only shows if applicable</p>
                                    @endif
                                </div>
                                <!-- MISCELLANEOUS -->
                                <div class="pb15">
                                    <div class="pb15 h3"><strong>Miscellaneous</strong></div>
                                    @parsedown($clauses->readClause('misc'))
                                </div>
                                <!-- ENTIRE CONTRACT -->
                                <div class="pb15">
                                    <div class="pb15 h3"><strong>Entire Contract</strong></div>
                                    @parsedown($clauses->readClause('entire_contract'))
                                </div>
                                <!-- ANNOTATIONS -->
                                <div class="pb15">
                                    <div class="pb15 h3"><strong>Annotations and Alterations</strong></div>
                                    @if (!is_null($contract->annotations))
                                    <p>{{  $contract->annotations  }}</p>
                                    @else
                                    <p class="text-info">Note: This section only shows if applicable</p>
                                    @endif
                                </div>
                            </div>
                            <p class="text-danger"><strong>Legal Disclaimer</strong></p>
                            <p class="text-danger">
                                @parsedown($clauses->readClause('disclaimer'))
                            </p>
                            
                            
                            
                        </section>
                    </div>
                    
                </section>
            </section>
        </aside>

        <aside class="aside-lg bg-white b-l hide" id="aside-files">
    <header class="header bg-white b-b b-light">
        @can('files_create')
        <a href="{{  route('files.upload', ['module' => 'contracts', 'id' => $contract->id])  }}" data-placement="left" data-rel="tooltip" title="@langapp('upload_file')" data-toggle="ajaxModal" class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right">
           @icon('solid/file-upload')
        </a>
        @endcan
        <p>@langapp('files')</p>
    </header>
            <div class="m-xs">
                @include('partial._show_files', ['files' => $contract->files, 'limit' => true])
                </div>
              
            </aside>
        
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
@endsection