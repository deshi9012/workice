<div class="modal-dialog">
    <div class="modal-content">


        @if (isset($task))
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title h3">{{  $task->name  }}</h4>
            </div>
            <div class="modal-body">
                <ul class="list-group no-radius">
                    <li class="list-group-item">
                    <span class="pull-right">
                        <a href="{{  route('projects.view', ['project' => $task->project_id])  }}">{{  $task->AsProject->name  }}</a>
                    </span>
                        @langapp('project')  
                    </li>
                    
                    @if ($task->milestone_id > 0)
                    <li class="list-group-item">
                    <span class="pull-right">
                        
                        <a href="{{ route('projects.view', ['project' => $task->project_id, 'tab' => 'milestones', 'item' => $task->milestone_id]) }}">{{ $task->AsMilestone->milestone_name }}</a>
                    </span>
                            @langapp('milestone')  
                        </li>
                    @endif


                    <li class="list-group-item">
                    <span class="pull-right">
                        <label class="label label-default">{{ $task->user->name }}</label>
                    </span>
                        @langapp('user')  
                    </li>

                    <li class="list-group-item">
                    <span class="pull-right">
                         <label class="label label-success">{{  dateTimeFormatted($task->start_date)  }}</label>
                    </span>
                        @langapp('start_date')  
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                         <label class="label label-danger">{{ dateTimeFormatted($task->due_date) }}</label>
                    </span>
                        @langapp('due_date')  
                    </li>

                    <li class="list-group-item">
                    <span class="pull-right">
                         <label class="label label-success">{{ $task->progress }}%</label>
                    </span>
                        @langapp('progress')  
                    </li>

                    
                </ul>
                @parsedown($task->description)
            </div>
            <div class="modal-footer">
                {!! closeModalButton() !!}
                <a href="{{  route('projects.view', ['project' => $task->project_id, 'tab' => 'tasks', 'item' => $task->id])  }}"
                   class="btn btn-{{  get_option('theme_color')  }} btn-rounded text-white">
                   @icon('solid/tasks') @langapp('preview')  </a>
            </div>
        @endif


        @if (isset($payment))
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title h3">@langapp('payment')  </h4>
            </div>
            <div class="modal-body">
                <ul class="list-group no-radius">
                    <li class="list-group-item">
                    <span class="pull-right">
                        <a href="{{  route('clients.view', ['id' => $payment->client_id])  }}">{{  $payment->company->name  }}</a>
                    </span>
                        @langapp('client')  
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                        <a href="{{  route('invoices.view', ['id' => $payment->invoice_id])  }}">{{  $payment->AsInvoice->reference_no  }}</a>
                    </span>
                        @langapp('invoice')  
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                    <label class="label label-success">
                    {{  dateString($payment->payment_date)  }}
                    </label>
                    </span>
                        @langapp('payment_date')  
                    </li>
                    <li class="list-group-item">
                        <span class="pull-right">{{ $payment->paymentMethod->method_name }}</span>@langapp('payment_method')  
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                    <label class="label label-success">{{ formatCurrency($payment->currency, $payment->amount) }}
                    </label>
                    </span>@langapp('amount')  

                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                {!! closeModalButton() !!}
                <a href="{{  route('payments.view', ['id' => $payment->id])  }}"
                   class="btn btn-{{  get_option('theme_color')  }} text-white btn-rounded">
                  @icon('solid/credit-card') @langapp('preview')  
               </a>
            </div>
        @endif

        @if (isset($project))
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title h3">{{  $project->name  }}</h4>
            </div>
            <div class="modal-body">
                <ul class="list-group no-radius">
                    <li class="list-group-item">
                    <span class="pull-right">
                        <a href="{{  route('clients.view', ['id' => $project->client_id])  }}">
                            {{  $project->company->name  }}
                        </a>
                    </span>
                        @langapp('client')  
                    </li>

                    <li class="list-group-item">
                    <span class="pull-right">
                         <label class="label label-success">{{  dateTimeFormatted($project->start_date)  }}</label>
                    </span>
                        @langapp('start_date')  
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                         <label class="label label-danger">{{  dateTimeFormatted($project->due_date)  }}</label>
                    </span>
                        @langapp('due_date')  
                    </li>

                    <li class="list-group-item">
                    <span class="pull-right">
                        <label class="label label-success">{{  $project->progress }}%</label>
                    </span>
                        @langapp('progress')  
                    </li>
                </ul>
                @parsedown(str_limit($project->description, 255))
            </div>
            <div class="modal-footer">
                {!! closeModalButton() !!}
                <a href="{{  route('projects.view', ['id' => $project->id])  }}"
                   class="btn btn-{{  get_option('theme_color')  }} text-white btn-rounded">
               @icon('solid/clock') @langapp('preview')  </a>
            </div>
        @endif

        @if (isset($invoice))
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">@langapp('invoice')   {{  $invoice->reference_no  }}</h4>
            </div>
            <div class="modal-body">
                <ul class="list-group no-radius">
                    <li class="list-group-item">
                    <span class="pull-right">
                        <a href="{{  route('clients.view', ['id' => $invoice->client_id])  }}">{{  $invoice->company->name  }}</a>
                    </span>
                        @langapp('client')  
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                        {{ $invoice->status }}
                    </span>
                        @langapp('status')  
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                    <label class="label label-success">
                        {{ formatCurrency($invoice->currency, $invoice->due()) }}
                    </label>
                    </span>
                        @langapp('balance_due')  
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                    <label class="label label-danger">
                    {{  dateFormatted($invoice->due_date)  }}
                    </label>
                    </span>
                        @langapp('due_date')  
                    </li>
                </ul>
                @parsedown($invoice->notes)
            </div>
            <div class="modal-footer">
                {!! closeModalButton() !!}
                <a href="{{  route('invoices.view', ['id' => $invoice->id])  }}"
                   class="btn btn-{{  get_option('theme_color')  }} text-white btn-rounded">
               @icon('solid/file-alt') @langapp('preview')  
                </a>
            </div>
        @endif

        @if (isset($estimate)) 
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">@langapp('estimate')   {{  $estimate->reference_no  }}</h4>
            </div>
            <div class="modal-body">
                <ul class="list-group no-radius">
                    <li class="list-group-item">
                    <span class="pull-right">
        <a href="{{  route('clients.view', ['id' => $estimate->client_id])  }}">{{  $estimate->company->name  }}</a>
                    </span>
                        @langapp('client')  
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                        @langapp(strtolower($estimate->status))  
                    </span>
                        @langapp('status')  
                    </li>

                    <li class="list-group-item">
                    <span class="pull-right">
                    <label class="label label-danger">
                    {{  dateFormatted($estimate->due_date)  }}
                    </label>
                    </span>
                        @langapp('expiry_date')  
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                     <label class="label label-success">
                        {{  formatCurrency($estimate->currency, $estimate->amount) }}
                        </label>
                    </span>
                        @langapp('cost')  
                    </li>
                </ul>
                @parsedown($estimate->notes)
            </div>
            <div class="modal-footer">
                {!! closeModalButton() !!}
                <a href="{{  route('estimates.view', ['id' => $estimate->id])  }}"
                   class="btn btn-{{ get_option('theme_color') }} text-white btn-rounded">
               @icon('solid/file-alt') @langapp('preview')  
                </a>
            </div>
        @endif


        @if (isset($deal)) 
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">@langapp('deal') {{  $deal->title  }}</h4>
            </div>
            <div class="modal-body">
                <ul class="list-group no-radius">
                    <li class="list-group-item">
                    <span class="pull-right">
        <a href="{{  route('clients.view', ['id' => $deal->organization])  }}">{{  $deal->company->name  }}</a>
                    </span>
                        @langapp('client')  
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                        {{  $deal->category->name  }}
                    </span>
                        @langapp('stage')  
                    </li>

                    <li class="list-group-item">
                    <span class="pull-right">
                    <label class="label label-danger">
                    {{  formatCurrency($deal->company->currency, $deal->deal_value)  }}
                    </label>
                    </span>
                        @langapp('deal_value')  
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                        {{ $deal->contact->name }}
                    </span>
                        @langapp('contact_person')  
                    </li>

                     <li class="list-group-item">
                    <span class="pull-right">
                     <label class="label label-info">
                        {{ $deal->AsSource->name }}
                        </label>
                    </span>
                        @langapp('source')  
                    </li>

                     <li class="list-group-item">
                    <span class="pull-right">
                     <label class="label label-success">
                        {{ $deal->pipe->name }}
                        </label>
                    </span>
                        @langapp('pipeline')  
                    </li>

                </ul>
            </div>
            <div class="modal-footer">
                {!! closeModalButton() !!}
                <a href="{{  route('deals.view', ['id' => $deal->id])  }}"
                   class="btn btn-{{  get_option('theme_color')  }} text-white btn-rounded">
               @icon('solid/laptop') @langapp('preview')
                </a>
            </div>
        @endif


        @if (isset($lead)) 
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">@langapp('lead') {{  $lead->name  }}</h4>
            </div>
            <div class="modal-body">
                <ul class="list-group no-radius">
                    <li class="list-group-item">
                    <span class="pull-right">
                        {{  $lead->company  }}
                    </span>
                        @langapp('company_name')  
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                        {{  $lead->status->name  }}
                    </span>
                        @langapp('stage')  
                    </li>

                    <li class="list-group-item">
                    <span class="pull-right">
                    <label class="label label-danger">
                    {{  formatCurrency(get_option('default_currency'), $lead->lead_value)  }}
                    </label>
                    </span>
                        @langapp('lead_value')  
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                        {{ $lead->AsSource->name }}
                    </span>
                        @langapp('source')  
                    </li>

                     <li class="list-group-item">
                    <span class="pull-right">
                     <label class="label label-info">
                        {{ $lead->agent->name }}
                        </label>
                    </span>
                        @langapp('sales_rep')  
                    </li>

                     <li class="list-group-item">
                    <span class="pull-right">
                     <label class="label label-success">
                        {{ dateElapsed($lead->due_date) }}
                        </label>
                    </span>
                        @langapp('due_date')  
                    </li>

                </ul>
            </div>
            <div class="modal-footer">
                {!! closeModalButton() !!}
                <a href="{{  route('leads.view', ['id' => $lead->id])  }}"
                   class="btn btn-{{  get_option('theme_color')  }} text-white btn-rounded">
               @icon('solid/laptop') @langapp('preview')
                </a>
            </div>
        @endif

        @if (isset($event))
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title h3">{{  $event->event_name  }}</h4>
            </div>
            <div class="modal-body">
                <ul class="list-group no-radius">
                    <li class="list-group-item">
                    <span class="pull-right">
                        {{  $event->event_name  }}
                    </span>
                        @langapp('event_name')  
                    </li>

                    <li class="list-group-item">
                    <span class="pull-right">
                        @icon('solid/calendar-alt', 'text-danger') {{  $event->calendar->name  }}
                    </span>
                     @langapp('calendar')  
                    </li>

                    <li class="list-group-item">
                    <span class="pull-right">
                         <label class="label label-success">{{  dateTimeFormatted($event->start_date)  }}</label>
                    </span>
                        @langapp('start_date')  
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                         <label class="label label-danger">{{  dateTimeFormatted($event->end_date)  }}</label>
                    </span>
                        @langapp('end_date')  
                    </li>

                    @if (!is_null($event->location))

                        <li class="list-group-item">
                    <span class="pull-right">
                         @icon('solid/building') <label class="label label-danger"> {{  $event->location  }}</label>
                    </span>
                            @langapp('venue')  
                        </li>

                    @endif


                    <li class="list-group-item">
                    <span class="pull-right">
                    <a class="thumb-xs avatar">
      <img src="{{ $event->user->profile->photo }}" class="img-rounded image-radius">

          </a> <label class="label label-default">{{  $event->user->name  }}</label></span>
                        @langapp('user')  
                    </li>

                @if ($event->project > 0) 

                        <li class="list-group-item">
                    <span class="pull-right">
                         <a href="{{  route('projects.view', ['id' => $event->project]) }}">
                         {{  $event->AsProject->name }}
                         </a>
                    </span>
                            @langapp('project')  
                        </li>
                @endif

                </ul>
                @parsedown($event->description)


                <div class="line line-dashed line-lg pull-in"></div>


            @if (!is_null($event->attendees)) 

                @foreach ($event->attendees as $user_id) 

                <a class="thumb-sm avatar" data-rel="tooltip" title="{{  fullname($user_id)  }}">
                    <img src="{{  avatar($user_id) }}" class="img-rounded shadowed">
                </a>
                @endforeach

            @endif


            </div>
            <div class="modal-footer">
                
                @if(can('events_update') || $event->user_id == Auth::id() || isAdmin())

                {!! closeModalButton() !!}

                    <a href="{{  route('calendar.edit', ['id' => $event->id])  }}"
                       class="btn btn-{{  get_option('theme_color')  }} btn-rounded text-white" data-toggle="ajaxModal"
                       data-dismiss="modal">@icon('solid/pencil-alt') @langapp('make_changes')  

                    </a>
                @endif
            </div>
        @endif


    </div>
</div>

<script>
$(document).ready(function(){
    $('[data-rel="tooltip"]').tooltip(); 
});
</script>