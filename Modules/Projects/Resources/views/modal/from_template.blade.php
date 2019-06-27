<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-{{ get_option('theme_color') }}">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('use_template') - {{ $project->name }} </h4>
        </div>
        {!! Form::open(['route' => ['projects.api.fromtemplate', $project->id], 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}
        <input type="hidden" name="id" value="{{  $project->id  }}">
        <div class="modal-body">

            <div class="form-group">
                <label class="col-md-3 control-label">@langapp('name') @required</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" name="name" placeholder="Project Name" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">@langapp('client')</label>
                <div class="col-lg-9">
                    <select class="select2-option form-control" name="client_id" required>
                        @foreach (classByName('clients')->select('id', 'name')->get() as $key => $client)
                        <option value="{{  $client->id  }}" {{ $project->client_id == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                        @endforeach
                    </select>
                    
                </div>
            </div>


            <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="fas fa-info-circle"></i> Select what to copy from <strong>{{  $project->name  }}</strong>
                  </div>
            
            <div class="checkbox">
                <label>
                    <input name="parts[expenses]" type="checkbox" checked>
                    <span class="label-text">@langapp('expenses') <span class="badge bg-success">{{ $project->expenses->count() }}</span> </span>
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input name="parts[tasks]" type="checkbox" checked>
                    <span class="label-text">@langapp('tasks') <span class="badge bg-success">{{ $project->tasks->count() }}</span></span>
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input name="parts[milestones]" type="checkbox" checked>
                    <span class="label-text">@langapp('milestones') <span class="badge bg-success">{{ $project->milestones->count() }}</span></span>
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input name="parts[timesheets]" type="checkbox" checked>
                    <span class="label-text">@langapp('timesheets') <span class="badge bg-success">{{ $project->timesheets->count() }}</span></span>
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input name="parts[tickets]" type="checkbox" checked>
                    <span class="label-text">@langapp('tickets') <span class="badge bg-success">{{ $project->tickets->count() }}</span></span>
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input name="parts[events]" type="checkbox" checked>
                    <span class="label-text">@langapp('events') <span class="badge bg-success">{{ $project->schedules->count() }}</span></span>
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input name="parts[comments]" type="checkbox" checked>
                    <span class="label-text">@langapp('comments') <span class="badge bg-success">{{ $project->comments->count() }}</span></span>
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input name="parts[issues]" type="checkbox" checked>
                    <span class="label-text">@langapp('issues') <span class="badge bg-success">{{ $project->issues->count() }}</span></span>
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input name="parts[files]" type="checkbox" checked>
                    <span class="label-text">@langapp('files') <span class="badge bg-success">{{ $project->files->count() }}</span></span>
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input name="parts[links]" type="checkbox" checked>
                    <span class="label-text">@langapp('links') <span class="badge bg-success">{{ $project->links->count() }}</span></span>
                </label>
            </div>
            
            <div class="line line-dashed line-lg pull-in"></div>
        </div>
        <div class="modal-footer">
            
            {!! closeModalButton() !!}
            {!! renderAjaxButton('create', 'fas fa-recycle') !!}
            
        </div>
        {!! Form::close() !!}
    </div>
</div>
@include('partial.ajaxify')