<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('delete_task') - {{ $task->name }} </h4>
        </div>
        {!! Form::open(['route' => ['tasks.api.delete', $task->id], 'method' => 'DELETE', 'class' => 'ajaxifyForm']) !!}
        <div class="modal-body">
            <p>@langapp('delete_warning')  </p>

            <input type="hidden" name="id" value="{{ $task->id }}">

        </div>
        <div class="modal-footer">

            {!! closeModalButton() !!}
            {!! renderAjaxButton('ok') !!}
            
        </div>
        {!! Form::close() !!}
    </div>

</div>
@include('partial.ajaxify')