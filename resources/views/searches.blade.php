@extends('layouts.app')
@section('content')
<section id="content">
    <section class="hbox stretch">
        <aside>
            <section class="vbox bg">
                <header class="header bg-white b-b clearfix hidden-print">
                    @langapp('search_results_for_tag',['keyword' => $keyword])
                </header>
                <div class="scrollable wrapper">
                    <div class="row m-b"> 
                        <div class="col-sm-4"> 
                            <header class="panel-heading">@langapp('projects')</header>
                            <div class="dd" id="nestable-projects"> 
                                <ol class="dd-list"> 
                                    @foreach ($projects as $project)
                                        <li class="dd-item" data-id="project-{{ $project->id }}"> 
                                            <div class="dd-handle">@icon('solid/tag', 'text-dracula') <a href="{{ route('projects.view', $project->id) }}">{{ $project->name }}</a></div> 
                                        </li> 
                                    @endforeach
                                </ol> 
                            </div> 
                        </div> 
                        <div class="col-sm-4"> 
                            <header class="panel-heading">@langapp('invoices')</header>
                            <div class="dd" id="nestable-invoices"> 
                                <ol class="dd-list"> 
                                    @foreach ($invoices as $invoice)
                                        <li class="dd-item" data-id="invoice-{{ $invoice->id }}"> 
                                            <div class="dd-handle">@icon('solid/tag', 'text-primary') <a href="{{ route('invoices.view', $invoice->id) }}">{{ $invoice->name }}</a></div> 
                                        </li> 
                                    @endforeach
                                </ol> 
                            </div> 
                        </div> 
                        <div class="col-sm-4"> 
                            <header class="panel-heading">@langapp('estimates')</header>
                            <div class="dd" id="nestable-estimates"> 
                                <ol class="dd-list"> 
                                    @foreach ($estimates as $estimate)
                                        <li class="dd-item" data-id="estimate-{{ $estimate->id }}"> 
                                            <div class="dd-handle">@icon('solid/tag', 'text-danger') <a href="{{ route('estimates.view', $estimate->id) }}">{{ $estimate->name }}</a></div> 
                                        </li> 
                                    @endforeach
                                </ol> 
                            </div> 
                        </div> 
                    </div>

                    <div class="row m-b"> 
                        <div class="col-sm-4"> 
                            <header class="panel-heading">@langapp('deals')</header>
                            <div class="dd" id="nestable-deals"> 
                                <ol class="dd-list"> 
                                    @foreach ($deals as $deal)
                                        <li class="dd-item" data-id="deal-{{ $deal->id }}"> 
                                            <div class="dd-handle">@icon('solid/tag', 'text-dracula') <a href="{{ route('deals.view', $deal->id) }}">{{ $deal->title }}</a></div> 
                                        </li> 
                                    @endforeach
                                </ol> 
                            </div> 
                        </div> 
                        <div class="col-sm-4"> 
                            <header class="panel-heading">@langapp('leads')</header>
                            <div class="dd" id="nestable-leads"> 
                                <ol class="dd-list"> 
                                    @foreach ($leads as $lead)
                                        <li class="dd-item" data-id="invoice-{{ $lead->id }}"> 
                                            <div class="dd-handle">@icon('solid/tag', 'text-warning') <a href="{{ route('leads.view', $lead->id) }}">{{ $lead->name }}</a></div> 
                                        </li> 
                                    @endforeach
                                </ol> 
                            </div> 
                        </div> 
                        <div class="col-sm-4"> 
                            <header class="panel-heading">@langapp('expenses')</header>
                            <div class="dd" id="nestable-expenses"> 
                                <ol class="dd-list"> 
                                    @foreach ($expenses as $expense)
                                        <li class="dd-item" data-id="expense-{{ $expense->id }}"> 
                                            <div class="dd-handle">@icon('solid/tag', 'text-info') <a href="{{ route('expenses.view', $expense->id) }}">{{ $expense->name }}</a></div> 
                                        </li> 
                                    @endforeach
                                </ol> 
                            </div> 
                        </div>  
                    </div>


                    <div class="row m-b"> 
                        <div class="col-sm-4"> 
                            <header class="panel-heading">@langapp('credits')</header>
                            <div class="dd" id="nestable-credits"> 
                                <ol class="dd-list"> 
                                    @foreach ($credits as $credit)
                                        <li class="dd-item" data-id="credit-{{ $credit->id }}"> 
                                            <div class="dd-handle">@icon('solid/tag', 'text-dark') <a href="{{ route('creditnotes.view', $credit->id) }}">{{ $credit->name }}</a></div> 
                                        </li> 
                                    @endforeach
                                </ol> 
                            </div> 
                        </div> 
                        <div class="col-sm-4"> 
                            <header class="panel-heading">@langapp('milestones')</header>
                            <div class="dd" id="nestable-milestones"> 
                                <ol class="dd-list"> 
                                    @foreach ($milestones as $milestone)
                                        <li class="dd-item" data-id="milestone-{{ $milestone->id }}"> 
                                            <div class="dd-handle">@icon('solid/tag', 'text-dracula') <a href="{{ route('projects.view', ['project' => $milestone->project_id, 'tab' => 'milestones', 'item' => $milestone->id]) }}">{{ $milestone->milestone_name }}</a></div> 
                                        </li> 
                                    @endforeach
                                </ol> 
                            </div> 
                        </div> 
                        <div class="col-sm-4"> 
                            <header class="panel-heading">@langapp('payments')</header>
                            <div class="dd" id="nestable-payments"> 
                                <ol class="dd-list"> 
                                    @foreach ($payments as $payment)
                                        <li class="dd-item" data-id="payment-{{ $payment->id }}"> 
                                            <div class="dd-handle">@icon('solid/tag', 'text-success') <a href="{{ route('payments.view', $payment->id) }}">{{ $payment->code }}</a></div> 
                                        </li> 
                                    @endforeach
                                </ol> 
                            </div> 
                        </div> 
                    </div>

                    <div class="row m-b"> 
                        <div class="col-sm-4"> 
                            <header class="panel-heading">@langapp('clients')</header>
                            <div class="dd" id="nestable-clients"> 
                                <ol class="dd-list"> 
                                    @foreach ($clients as $client)
                                        <li class="dd-item" data-id="client-{{ $client->id }}"> 
                                            <div class="dd-handle">@icon('solid/tag', 'text-primary') <a href="{{ route('clients.view', $client->id) }}">{{ $client->name }}</a></div> 
                                        </li> 
                                    @endforeach
                                </ol> 
                            </div> 
                        </div> 
                        <div class="col-sm-4"> 
                            <header class="panel-heading">@langapp('tickets')</header>
                            <div class="dd" id="nestable-tickets"> 
                                <ol class="dd-list"> 
                                    @foreach ($tickets as $ticket)
                                        <li class="dd-item" data-id="ticket-{{ $ticket->id }}"> 
                                            <div class="dd-handle">@icon('solid/tag', 'text-dracula') <a href="{{ route('tickets.view', $ticket->id) }}">{{ $ticket->subject }}</a></div> 
                                        </li> 
                                    @endforeach
                                </ol> 
                            </div> 
                        </div> 
                        <div class="col-sm-4"> 
                            <header class="panel-heading">@langapp('tasks')</header>
                            <div class="dd" id="nestable-tasks"> 
                                <ol class="dd-list"> 
                                    @foreach ($tasks as $task)
                                        <li class="dd-item" data-id="task-{{ $task->id }}"> 
                                            <div class="dd-handle">@icon('solid/tag', 'text-danger') <a href="{{ route('projects.view', ['project' => $task->project_id, 'tab' => 'tasks', 'item' => $task->id]) }}">{{ $task->name }}</a></div> 
                                        </li> 
                                    @endforeach
                                </ol> 
                            </div> 
                        </div> 
                    </div>

                    
                </div>
            </section>
        </aside>
        
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
@push('pagestyle')
<link rel="stylesheet" href="{{ getAsset('plugins/nestable/nestable.css') }}">
@endpush
@endsection