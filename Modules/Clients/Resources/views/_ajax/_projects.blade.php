@foreach ($projects->chunk(2) as $chunk)
    <div class="row">
        @foreach ($chunk as $project)
            <div class="col-md-6">
                        <div class="panel invoice-grid widget-b">
                            <div class="panel-body">
                                <div class="row">

                                    <div class="col-sm-6">
                                        <h6 class="text-semibold"><a href="{{  route('projects.view', ['id' => $project->id])  }}">{{  $project->name  }}</a>
                                        </h6>
                                        <ul class="list list-unstyled">
                                            <li>@langapp('amount')  :
                                                &nbsp;<strong>
                    {{  formatCurrency($project->currency, $project->sub_total)  }}
                    </strong></li>
                                            <li>
                                                @langapp('start_date')  : <span class="text-semibold">{{  dateFormatted($project->start_date)  }}</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-sm-6">

                                        <h6 class="text-semibold text-right no-margin-top">
                                            <span data-rel="tooltip" title="@langapp('expenses') ">
                                                {{  formatCurrency($project->currency, $project->total_expenses)  }}
                                            </span>
                                        </h6>
                                        <ul class="list list-unstyled text-right">
                                            <li>@langapp('progress')  : 
                                            <span class="text-semibold text-success">{{ $project->progress }}%</span>
                                            </li>
                                            <li>@langapp('status')  : 
                                            <span class="label label-danger">@langapp(str_replace(' ', '_', strtolower($project->status)))  </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-footer panel-footer-condensed">
                                <a class="heading-elements-toggle"></a>
                                <div class="heading-elements">
                        <span class="heading-text">
                          @icon('solid/clock', 'text-danger') 
                          @langapp('due_date')  : <span class="text-semibold">{{  dateFormatted($project->due_date)  }}</span>
                        </span>

                        <a class="thumb-xs pull-right m-r-sm">
                        @foreach ($project->assignees->take(5) as $member)
                        <img src="{{ $member->user->profile->photo }}" class="img-circle" data-rel="tooltip" title="{{ $member->user->name }}" data-placement="top">
                        @endforeach
                    </a>

                                    


                                </div>
                            </div>
                        </div>
                    </div>
        @endforeach
    </div>
@endforeach