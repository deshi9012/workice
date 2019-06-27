<div class="col-md-4">
        <div class="row">
    
            <div class="col-lg-12">
                <section class="panel panel-default">
                    <header class="panel-heading">@langapp('tasks') </header>
                    <div class="panel-body">
                        <section class="comment-list block">
                            <section class="slim-scroll" data-height="400" data-disable-fade-out="true" data-distance="0"
                                     data-size="5px" data-color="#333333">

                                @foreach (Auth::user()->undoneTasks() as $key => $task)
                                    <article class="comment-item small">
                                        <div class="pull-left thumb-sm avatar">
                                            <img src="{{ $task->user->photo }}" class="img-circle">
                                        </div>
                                        <section class="comment-body m-b-md">
                                            <header class="b-b">
                                                <strong class="text-muted">{{ $task->user->name }}</strong>
                                                <small class="text-muted pull-right">
                                                    {{ dateElapsed($task->created_at) }}
    
                                                    <span class="label label-warning">{{ $task->progress }}%</span>
                                                </small>
                                            </header>
                                            <div>
    
                                                <a href="{{ site_url('projects/tasks/close_open/' . $task->id) }}">
                                                    @if ($task->progress == '100')
                                                        @icon('solid/check-square', 'fa-lg text-success')
                                                    @endif
                                                    @if ($task->progress < '100')
                                                       @icon('regular/square', 'fa-lg text-success')
                                                    @endif
                                                </a>
    
                                                <a href="{{ site_url('projects/view/' . $task->project_id . '/tasks/' . $task->id) }}">
    
                                                    {{ $task->name }}
                                                </a>
                                            </div>
                                        </section>
                                    </article>
                                @endforeach


                            </section>
                        </section>
                    </div>
                </section>
            </div>
    
        </div>
    </div>