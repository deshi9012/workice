<html>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>@langapp('contract') {{ $contract->contract_title }}</title>
  @php
  ini_set('memory_limit', '-1');
  $color = config('system.contract_color');
  @endphp
  <head>
    <link rel="stylesheet" href="{{ getAsset('css/contract-pdf.css') }}">
    <style>
    h2{ font-family: {{ config('system.pdf_font') }}; }
    body {
    font-family: {{ config('system.pdf_font') }};
    }
    .color{ color: {{ $color }}; }
    .bg-color{ background-color: {{ $color }} !important; color:#ffffff; }
    footer {
    border-top: 1px solid {{ $color }};
    }
    .contract-title{
      border-bottom: 0.2mm solid {{ $color }};
    }
    .attachment{
      border-bottom: 0.2mm solid {{ $color }};
    }
    </style>
  </head>
  <body>
    @inject('clauses', 'Modules\Contracts\Entities\Clause')
    
    <div class="contract-page">
      <h1 class="text-center">Service Contract</h1>
      <h4 class="text-uc contract-title">{{ $contract->contract_title }}</h4>
      <div class="m-20">
        @parsedown(str_replace('{EXPIRY_DATE}', dateFormatted($contract->expiry_date), $clauses->readClause('intro')))
      </div>
      <div class="row">
        <div class="col-md-6 width40 float-left">
          <div class="h4">Client</div>
          <div class="m-md">
            @php
            $data['company'] = $contract->company;
            @endphp
            @include('partial.pdf.client_address', $data)
            
            
          </div>
          
        </div>
        <div class="col-md-6 width40 float-right">
          <div class="h4">Contractor</div>
          <div class="m-md">
            @include('partial.pdf.company_address', $data)
          </div>
        </div>
      </div>
      <div class="clear"></div>
      <h2 class="h-color text-muted">Services</h2>
      <p>Contractor agrees to perform services as described in Attachment A (the “Services”) and Client agrees to pay Contractor as described in Attachment A.</p>
      
      {{-- SIGNATURES --}}
      <h2 class="h-color text-muted">Signatures</h2>
      @parsedown($clauses->readClause('signatures'))
      
      <div class="row">
        <div class="col-md-6 width40 float-left">
          Client ({{ $contract->company->contact_person }})<br>
          @if ($contract->client_sign_id > 0)
          Signature - {{ dateTimeFormatted($contract->clientSign->created_at) }}
          @endif
          <div class="signatureSec">
            <div class="col-md-8">
              @if ($contract->client_sign_id > 0)
              <div class="signature">
                @if($contract->clientSign->image)
                <img src="{{ getStorageUrl(config('system.signature_dir').'/'.$contract->clientSign->image) }}" class="width200" alt="">
                @else
                <div class="m-t-40">{{  $contract->clientSign->signature  }}</div>
                @endif
              </div>
              
              
              @else
              <div class="line line-dashed line-lg pull-in m-t-40"></div>
              @endif
              
            </div>
            
          </div>
        </div>
        <div class="col-md-6 width40 float-left">
          Contractor ({{ get_option('contact_person') }})<br>
          @if ($contract->contractor_sign_id > 0)
          Signature - {{ dateTimeFormatted($contract->contractorSign->created_at) }}
          @endif
          <div class="signatureSec">
            <div class="col-md-8">
              @if ($contract->contractor_sign_id > 0)
              <div class="signature">
                @if($contract->contractorSign->image)
                <img src="{{ getStorageUrl(config('system.signature_dir').'/'.$contract->contractorSign->image) }}" class="width200" alt="">
                @else
                <div class="m-t-45">{{  $contract->contractorSign->signature  }}</div>
                @endif
              </div>
              
              
              @else
              <div class="line line-dashed line-lg pull-in m-t-40"></div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="page-break"></div>
    <div class="contract-page">
      <h4 class="text-uc attachment">Attachment A</h4>
      <h2 class="h-color text-muted">Services</h2>
      
      <h3 class="text-uc">Term</h3>
      <div class="m-b-20">Start date: {{ dateFormatted($contract->start_date) }} - End date: {{ dateFormatted($contract->end_date) }}</div>
      
      <h3 class="text-uc">Rate</h3>
      <div class="m-b-20">
        <p>{{ $contract->services }}</p>
        <p>
          @if ($contract->rate_is_fixed == 0)
          <span class="cur">{{ formatCurrency($contract->currency, $contract->hourly_rate)  }}</span> Per hour
          @else
          <span class="cur">{{ formatCurrency($contract->currency, $contract->fixed_rate)  }}</span> Fixed Fee
          @endif
        </p>
      </div>
      
      <h2 class="h-color text-muted">Project details</h2>
      <div class="m-t-10">
      @parsedown($contract->description)</p>
    </div>
    
    
    
    
  </div>
  <footer class="text-muted">
    <div class="text-left pt40 font9 float-left">
      Contract - {{ $contract->contract_title }}
    </div>
    <div class="text-right pt40 font9 float-right">
      <div class="pagenum-container">Page <span class="pagenum"></span></div>
    </div>
  </footer>
  <div class="page-break"></div>
  <div class="contract-page">
    <h4 class="text-uc attachment">Attachment B</h4>
    <h2 class="h-color text-muted">Terms and Conditions</h2>
    @parsedown($clauses->readClause('terms_condition'))
    {{-- ACCEPTANCES --}}
    <h2 class="h-color text-muted">Acceptances</h2>
    @parsedown($clauses->readClause('acceptances'))
    
    {{-- WARRANTY --}}
    <h2 class="h-color text-muted">Warranty</h2>
    @parsedown($clauses->readClause('warranty'))
    
    {{-- CONFIDENTIALITY --}}
    <h2 class="h-color text-muted">Confidentiality &amp; Non-Disclosure</h2>
    @parsedown($clauses->readClause('confidentiality'))
    
    
  </div>
  <footer class="text-muted">
    <div class="text-left pt40 font9 float-left">
      Contract - {{ $contract->contract_title }}
    </div>
    <div class="text-right pt40 font9 float-right">
      <div class="pagenum-container">Page <span class="pagenum"></span></div>
    </div>
  </footer>
  
  
  <div class="page-break"></div>
  <div class="contract-page">
    {{-- OWNERSHIP LICENSE --}}
    <h2 class="h-color text-muted">Ownership and Licenses</h2>
    @parsedown($clauses->readClause('ownership'))
    @if ($contract->license_owner == 'client')
    @parsedown($clauses->readClause('client_ownership'))
    @else
    <span class="text-danger">@parsedown($contract->client_rights)</span>
    
    @endif
    
    
    
    {{-- NON SOLICIT --}}
    
    <h2 class="h-color text-muted">Non-Solicit</h2>
    @parsedown($clauses->readClause('non_solicit'))
    
    {{-- NON COMPLETE --}}
    
    @if ($contract->non_compete == '1')
    <h2 class="h-color text-muted">Non-Compete</h2>
    @parsedown($clauses->readClause('non_compete'))
    @endif
    
    
    {{-- RELATIONSHIP --}}
    <h2 class="h-color text-muted">Relationship of Parties</h2>
    @parsedown($clauses->readClause('relationship'))
    
    {{-- TERMINATION --}}
    <h2 class="h-color text-muted">Term &amp; Termination </h2>
    @parsedown(str_replace('{TERM_DAYS}', $contract->termination_notice, $clauses->readClause('termination')))
    
    
  </div>
  <footer class="text-muted">
    <div class="text-left pt40 font9 float-left">
      Contract - {{ $contract->contract_title }}
    </div>
    <div class="text-right pt40 font9 float-right">
      <div class="pagenum-container">Page <span class="pagenum"></span></div>
    </div>
  </footer>
  
  <div class="page-break"></div>
  <div class="contract-page">
    
    {{-- CANCELLATION --}}
    
    @if ($contract->cancelation_fee > 0)
    <h2 class="h-color text-muted">Cancellation Fee</h2>
    @parsedown(str_replace('{CANCEL_FEE}', formatCurrency($contract->currency, $contract->cancelation_fee), $clauses->readClause('cancellation')))
    
    @endif
    
    {{-- PAYMENT TERMS --}}
    <h2 class="h-color text-muted">Payment Terms</h2>
    
    @parsedown(str_replace('{PAYMENT_DAYS}', $contract->payment_terms, $clauses->readClause('payment_terms')))
    
    
    
    {{-- LATE PAYMENT --}}
    
    @if ($contract->late_payment_fee > 0)
    @php $loadClause = 'late_payment'; @endphp
    @if ($contract->late_fee_percent == '1')
    @php $loadClause = 'late_payment_percent'; @endphp
    @endif
    @php
    $late_fee = ($contract->late_payment_percent == 0) ? formatCurrency($contract->currency, $contract->late_payment_fee) : $contract->late_payment_fee;
    @endphp
    
    @parsedown(str_replace('{LATE_FEE}', $late_fee, $clauses->readClause($loadClause)))
    
    @endif
    
    {{-- DEPOSIT --}}
    
    @if ($contract->deposit_required > 0)
    <h2 class="h-color text-muted">Deposit</h2>
    
    @parsedown(str_replace('{DEPOSIT_FEE}', formatCurrency($contract->currency, $contract->deposit_required), $clauses->readClause('deposit')))
    
    @endif
    
    {{-- REIMBURSEMENT --}}
    <h2 class="h-color text-muted">Expense Reimbursement</h2>
    
    @parsedown(str_replace('{PAYMENT_DAYS}', $contract->payment_terms, $clauses->readClause('reimburse')))
    
    
    
    {{-- FEEDBACK --}}
    
    @if ($contract->feedbacks > 0)
    <h2 class="h-color text-muted">Feedback</h2>
    
    @parsedown(str_replace('{FEEDBACKS}', $contract->feedbacks, $clauses->readClause('feedback')))
    
    @endif
    
    {{-- CHANGES --}}
    <h2 class="h-color text-muted">Changes</h2>
    
    @parsedown($clauses->readClause('changes'))
    
    
    {{-- LIABILITY --}}
    
    <h2 class="h-color text-muted">Indemnification and Limitation of Liability</h2>
    
    @parsedown($clauses->readClause('liability'))
  </div>
  <footer class="text-muted">
    <div class="text-left pt40 font9 float-left">
      Contract - {{ $contract->contract_title }}
    </div>
    <div class="text-right pt40 font9 float-right">
      <div class="pagenum-container">Page <span class="pagenum"></span></div>
    </div>
  </footer>
  
  
  <div class="page-break"></div>
  <div class="contract-page">
    {{-- AUTHORSHIP --}}
    <h2 class="h-color text-muted">Right to Authorship Credit</h2>
    @parsedown($clauses->readClause('authorship'))
    @if ($contract->portfolio_rights == '1')
    <p>Client hereby agrees Contractor may use the work product as part of Contractors portfolio and websites, galleries and other media solely for the purpose of showcasing Contractors work but not for any other purpose.</p>
    @endif
    
    
    {{-- DISPUTE --}}
    <h2 class="h-color text-muted">Governing Law and Dispute Resolution</h2>
    
    @parsedown($clauses->readClause('dispute'))
    
    
    
    {{-- FORCE MAJEURE --}}
    <h2 class="h-color text-muted">Force Majeure</h2>
    @parsedown($clauses->readClause('majeure'))
    
    {{-- NOTICES --}}
    
    <h2 class="h-color text-muted">Notices</h2>
    @parsedown($clauses->readClause('notices'))
    
    {{-- MISCELLANEOUS --}}
    <h2 class="h-color text-muted">Miscellaneous</h2>
    @parsedown($clauses->readClause('misc'))
    
    {{-- ENTIRE CONTRACT --}}
    <h2 class="h-color text-muted">Entire Contract</h2>
    @parsedown($clauses->readClause('entire_contract'))
    
    {{-- ANNOTATIONS --}}
    @if (!is_null($contract->annotations))
    <h2 class="h-color text-muted">Annotations and Alterations</h2>
    @parsedown($contract->annotations)
    
    @endif
    
    
    
  </div>
  
  
  <footer class="text-muted">
    <div class="text-left pt40 font9 float-left">
      Contract - {{ $contract->contract_title }}
    </div>
    <div class="text-right pt40 font9 float-right">
      <div class="pagenum-container">Page <span class="pagenum"></span></div>
    </div>
  </footer>
</body>
</html>