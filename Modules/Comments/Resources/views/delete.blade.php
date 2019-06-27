<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@svg('solid/trash-alt') @langapp('delete')  </h4>
        </div>
        {!! Form::open(['route' => 'comments.destroy', 'method' => 'DELETE']) !!}
        
        <div class="modal-body">
            <p>@langapp('delete_message_warning')  </p>

            <blockquote>
             @parsedown(str_limit($comment->message, 200))
            </blockquote>

            <input type="hidden" name="id" value="{{  $comment->id  }}">
            <input type="hidden" name="module" value="{{  $module  }}">

        </div>
        <div class="modal-footer">
            
            {!! closeModalButton() !!}
            {!! okModalButton() !!}
            
        </div>

        {!! Form::close() !!}
    </div>
</div>
