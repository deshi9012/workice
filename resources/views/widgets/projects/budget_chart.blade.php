<div class="col-lg-4">
                    <section class="panel panel-default">
                        <header class="panel-heading">
                            @langapp('budget')
                        </header>
                        <div class="panel-body text-center">
                            <h4 class="small">
                            {{ secToHours($project->billable_time) }}
                            
                            </h4>
                            <small class="text-muted block">
                            @langapp('estimated_hours')  {{ $project->estimate_hours }}
                            </small>
                            <div class="inline">
                                <div class="easypiechart" data-line-width="16" data-loop="false" data-percent="{{ percent($project->used_budget) }}" data-size="150">
                                    <span class="h2 step">
                                        {{ percent($project->used_budget) }}
                                    </span>
                                    %
                                    <div class="easypie-text">
                                        @langapp('used')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <small>
                            @icon('solid/chart-line', 'text-success') {{ $project->used_budget > 100 ? 'Over Budget' : 'On Budget' }}
                            </small>
                        </div>
                    </section>
                </div>