<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-success">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('copy')  </h4>
        </div>

        {!! Form::open(['route' => ['projects.api.copy', $project->id], 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}

        <input type="hidden" name="id" value="{{  $project->id  }}">

        <div class="modal-body">
            <p>Select what to copy from <strong>{{  $project->name  }}</strong></p>

            <div class="checkbox">
                <label>
                    <input name="parts[expenses]" type="checkbox" checked>
                    <span class="label-text">@langapp('expenses')</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input name="parts[tasks]" type="checkbox" checked>
                    <span class="label-text">@langapp('tasks')</span>
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input name="parts[milestones]" type="checkbox" checked>
                    <span class="label-text">@langapp('milestones')</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input name="parts[timesheets]" type="checkbox" checked>
                    <span class="label-text">@langapp('timesheets')</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input name="parts[tickets]" type="checkbox" checked>
                    <span class="label-text">@langapp('tickets')</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input name="parts[events]" type="checkbox" checked>
                    <span class="label-text">@langapp('events')</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input name="parts[comments]" type="checkbox" checked>
                    <span class="label-text">@langapp('comments')</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input name="parts[issues]" type="checkbox" checked>
                    <span class="label-text">@langapp('issues')</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input name="parts[todo]" type="checkbox" checked>
                    <span class="label-text">@langapp('todo')</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input name="parts[files]" type="checkbox" checked>
                    <span class="label-text">@langapp('files')</span>
                </label>
            </div>

            <div class="checkbox">
                <label>
                    <input name="parts[links]" type="checkbox" checked>
                    <span class="label-text">@langapp('links')</span>
                </label>
            </div>

            

            <div class="line line-dashed line-lg pull-in"></div>


        </div>
        <div class="modal-footer">
            
            {!! closeModalButton() !!}
            {!! renderAjaxButton('copy') !!}
            
        </div>
        {!! Form::close() !!}
    </div>
</div>

@include('partial.ajaxify')