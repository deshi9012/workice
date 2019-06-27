<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-success">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('mark_as_complete')  </h4>
        </div>
        {!! Form::open(['route' => ['projects.api.close', $project->id], 'class' => 'ajaxifyForm']) !!}
        
        <div class="modal-body">
            <p>@langapp('mark_as_complete_info')  </p>

            @if($project->feedback_disabled == 0)
            <div class="alert alert-info hidden-print">
                <button type="button" class="close" data-dismiss="alert">×</button>
                @icon('solid/envelope-open') An email will be sent to client for feedback. You can disable it by editing this project
            </div>
            @endif

            @langapp('name')  : <strong>{{ $project->name }}</strong>

            <input type="hidden" name="id" value="{{  $project->id  }}">

        </div>
        <div class="modal-footer">
            
            {!! closeModalButton() !!}
            {!! renderAjaxButton() !!}
            
        </div>
        {!! Form::close() !!}
    </div>
</div>

@include('partial.ajaxify')
    