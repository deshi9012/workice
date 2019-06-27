<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@svg('solid/trash-alt') @langapp('delete')  </h4>
        </div>

        {!! Form::open(['route' => ['projects.api.delete', $project->id], 'method' => 'DELETE', 'class' => 'ajaxifyForm']) !!}

        <div class="modal-body">
            <p>@langapp('delete_warning')  </p>
            <p>
                @langapp('title')  : <strong>{{ $project->name }}</strong><br>
                @langapp('expenses')  : <strong>{{ formatCurrency($project->currency, $project->total_expenses) }}</strong><br>
                @langapp('cost')  : <strong>{{ formatCurrency($project->currency, $project->sub_total) }}</strong><br>
            </p>

            <input type="hidden" name="id" value="{{  $project->id  }}">

        </div>
        <div class="modal-footer">
            {!! closeModalButton() !!}
            {!! renderAjaxButton('ok') !!}
            
        </div>

        {!! Form::close() !!}
    </div>
</div>

@include('partial.ajaxify')