<div class="col-lg-4">
                    <section class="panel panel-default">
                        <header class="panel-heading">
                            @langapp('tasks')
                        </header>
                        <div class="panel-body text-center">
                            <h4>
                            {{ $project->tasks->where('progress', '<', 100)->count() }}
                            <small>
                            @langapp('pending')
                            </small>
                            </h4>
                            <small class="text-muted block">
                            {{ $project->tasks->where('progress', 100)->count() }} @langapp('done')
                            </small>
                            <div class="inline">
                                <div class="easypiechart" data-line-width="6" data-loop="false" data-percent="{{ percent($project->taskDonePercent()) }}" data-size="150">
                                    <span class="h2 step">
                                        {{ percent($project->taskDonePercent()) }}
                                    </span>
                                    %
                                    <div class="easypie-text">
                                        @langapp('done')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <small>
                            @icon('solid/tasks')
                            @langapp('tasks') <span class="text-muted">({{ $project->tasks->count() }})</span>
                            </small>
                        </div>
                    </section>
                </div>