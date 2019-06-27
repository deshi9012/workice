<aside class="b-l bg" id="">
    
    
    <section class="scrollable">
        <div class="slim-scroll" data-color="#333333" data-disable-fade-out="true" data-distance="0" data-height="auto" data-size="3px">
            <section class="padder">
                <div class="row m-l-none m-r-none m-sm">
                    <div class="col-sm-6 col-md-3 padder-v lt pallete b-b">
                        <a class="clear" href="{{ route('invoices.index') }}">
                            <span class="fa-stack fa-2x pull-left m-r-xs">
                                <i class="fas fa-square fa-stack-2x text-white"></i>
                                <i class="fas fa-exclamation-circle fa-stack-1x text-success"></i>
                            </span>
                            
                            <small class="text-uc" data-rel="tooltip" title="@langapp('outstanding')">@langapp('outstanding')  </small>
                            <span class="h4 block m-t-xs text-dark">{{ Auth::user()->profile->company > 0 ? formatCurrency(get_option('default_currency'), Auth::user()->profile->business->due()) : 'N/A' }}</span>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-3 padder-v lt pallete b-b">
                        <a class="clear" href="{{ route('invoices.index') }}">
                            <span class="fa-stack fa-2x pull-left m-r-xs">
                                <i class="fas fa-square fa-stack-2x text-white"></i>
                                <i class="fas fa-calendar-times fa-stack-1x text-dracula"></i>
                            </span>
                            <small class="text-uc" data-rel="tooltip" title="@langapp('overdue')">@langapp('overdue') </small>
                            <span class="h4 block m-t-xs text-dark">{{ Auth::user()->profile->company > 0 ? formatCurrency(get_option('default_currency'), Auth::user()->profile->business->overdue()) : 'N/A' }}</span>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-3 padder-v pallete b-b">
                        <a class="clear" href="{{ route('tickets.index') }}">
                            <span class="fa-stack fa-2x pull-left m-r-xs">
                                <i class="fas fa-square fa-stack-2x text-white"></i>
                                <i class="fas fa-life-ring fa-stack-1x text-info"></i>
                            </span>
                            
                            <small class="text-uc" data-rel="tooltip" title="@langapp('tickets')">@langapp('tickets') </small>
                            <span class="h4 block m-t-xs text-dark"><span class="text-danger" data-rel="tooltip" title="Pending">{{ Auth::user()->tickets()->pending()->count() }}</span> / <span class="text-success" data-rel="tooltip" title="Closed">{{ Auth::user()->tickets()->closed()->count() }}</span></span> </a>
                        </div>
                        <div class="col-sm-6 col-md-3 padder-v pallete b-b">
                            <a class="clear" href="{{ route('creditnotes.index') }}">
                                <span class="fa-stack fa-2x pull-left m-r-xs">
                                    <i class="fas fa-square fa-stack-2x text-white"></i>
                                    <i class="fas fa-money-check fa-stack-1x text-danger"></i>
                                </span>
                                
                                <small class="text-uc" data-rel="tooltip" title="@langapp('credits') @langapp('balance')">@langapp('credits')   </small>
                                <span class="h4 block m-t-xs text-dark">{{ Auth::user()->profile->company > 0 ? formatCurrency(get_option('default_currency'), Auth::user()->profile->business->creditBalance()) : 'N/A' }}</span>
                            </a>
                        </div>
                        
                    </div>

            <section class="panel panel-default">
                <header class="panel-heading">@langapp('outstanding') @langapp('invoices')</header>
                @if (Auth::user()->profile->company > 0)
                    
                <div class="table-responsive">
                  <table class="table table-striped b-t b-light">
                    <thead>
                      <tr>
                        <th class="th-sortable" data-toggle="class">@langapp('reference_no')</th>
                        <th>@langapp('payable')</th>
                        <th>@langapp('paid')</th>
                        <th>@langapp('balance')</th>
                        <th>@langapp('due_date')</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach (Auth::user()->profile->business->invoices->take(15) as $invoice)
                            <tr>
                            <td><a href="{{ route('invoices.view', $invoice->id) }}">{{ $invoice->reference_no }}</a></td>
                            <td>{{ formatCurrency($invoice->currency, $invoice->payable()) }}</td>
                            <td>{{ formatCurrency($invoice->currency, $invoice->paid()) }}</td>
                            <td>{{ formatCurrency($invoice->currency, $invoice->due()) }}</td>
                            <td>{{ dateTimeString($invoice->due_date) }}</td>
                      </tr>
                        @endforeach
                      
                      
                    </tbody>
                  </table>
                </div>


                @endif
                
              </section>



              <section class="panel panel-default">
                <header class="panel-heading">@langapp('estimates')</header>
                @if (Auth::user()->profile->company)
                    
                <div class="table-responsive">
                  <table class="table table-striped b-t b-light">
                    <thead>
                      <tr>
                        <th class="th-sortable" data-toggle="class">@langapp('reference_no')</th>
                        <th>@langapp('sub_total')</th>
                        <th>@langapp('amount')</th>
                        <th>@langapp('due_date')</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach (Auth::user()->profile->business->estimates->take(15) as $estimate)
                            <tr>
                            <td><a href="{{ route('estimates.view', $estimate->id) }}">{{ $estimate->reference_no }}</a></td>
                            <td>{{ formatCurrency($estimate->currency, $estimate->sub_total) }}</td>
                            <td>{{ formatCurrency($estimate->currency, $estimate->amount) }}</td>
                            <td>{{ dateTimeString($estimate->due_date) }}</td>
                      </tr>
                        @endforeach
                      
                      
                    </tbody>
                  </table>
                </div>


                @endif
                
              </section>
                    

            <section class="panel panel-default">
                <header class="panel-heading">@langapp('projects')</header>
                @if (Auth::user()->profile->company)
                    
                <div class="table-responsive">
                  <table class="table table-striped b-t b-light">
                    <thead>
                      <tr>
                        <th class="th-sortable" data-toggle="class">@langapp('title')</th>
                        <th>@langapp('progress')</th>
                        <th>@langapp('expenses')</th>
                        <th>@langapp('due_date')</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach (Auth::user()->profile->business->projects->take(15) as $project)
                            <tr>
                            <td><a href="{{ route('projects.view', $project->id) }}">{{ str_limit($project->name,25) }}</a></td>
                            <td>{{ $project->progress }}%</td>
                            <td>{{ formatCurrency($project->currency, $project->total_expenses) }}</td>
                            <td>{{ dateTimeString($project->due_date) }}</td>
                      </tr>
                        @endforeach
                      
                      
                    </tbody>
                  </table>
                </div>


                @endif
                
              </section>



              <section class="panel panel-default">
                <header class="panel-heading">@langapp('tickets')</header>
                @if (Auth::user()->profile->company)
                    
                <div class="table-responsive">
                  <table class="table table-striped b-t b-light">
                    <thead>
                      <tr>
                        <th class="th-sortable" data-toggle="class">@langapp('subject')</th>
                        <th>@langapp('department')</th>
                        <th>@langapp('status')</th>
                        <th>@langapp('due_date')</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach (Auth::user()->tickets->take(15) as $ticket)
                            <tr>
                            <td><a href="{{ route('tickets.view', $ticket->id) }}">{{ str_limit($ticket->subject, 25) }}</a></td>
                            <td>{{ $ticket->dept->deptname }}</td>
                            <td>{{ $ticket->AsStatus->status }}</td>
                            <td>{{ dateTimeString($ticket->due_date) }}</td>
                      </tr>
                        @endforeach
                      
                      
                    </tbody>
                  </table>
                </div>


                @endif
                
              </section>
                    
                    
                    
                </section>





            </div>

        </section>
        
    </aside>
    <aside class="aside-lg b-l">
        <section class="vbox">
            
            <section class="scrollable" id="feeds">
                <div class="slim-scroll padder" data-color="#333333" data-disable-fade-out="true" data-distance="0" data-height="auto" data-size="3px">
                    
                    @widget('Activities\Feed', ['activities' => Modules\Activity\Entities\Activity::where('user_id', Auth::id())->take(50)->orderByDesc('id')->get(), 'view' => 'dashboard'])
                    
                </div>
            </section>
            
        </section>
    </aside>