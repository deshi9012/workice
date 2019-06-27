<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@svg('solid/trash-alt') @langapp('delete')  </h4>
        </div>
        {!! Form::open(['route' => 'tasks.destroyTemplate', 'method' => 'DELETE']) !!}
       
        <div class="modal-body">
            <p>@langapp('delete_item_warning')  </p>

            <input type="hidden" name="id" value="{{  $task->id  }}">

            <p>@langapp('name'): <strong>{{ $task->name }}</strong></p>
            @parsedown(str_limit($task->description, 255))

        </div>
        <div class="modal-footer">
            
            {!! closeModalButton() !!}
            {!! okModalButton() !!}

        </div>
        {!! Form::close() !!}
    </div>
</div>