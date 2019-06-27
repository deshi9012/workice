<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@svg('solid/trash-alt') @langapp('delete')  </h4>
        </div>
        {!! Form::open(['route' => ['milestones.destroy', $milestone->id]]) !!}
       
        <div class="modal-body">
            <p>@langapp('delete_milestone_warning')  </p>

            <input type="hidden" name="id" value="{{  $milestone->id  }}">

        </div>
        <div class="modal-footer">
        {!! closeModalButton() !!}

        {!! okModalButton() !!}
            
        </div>
        {!! Form::close() !!}
        
    </div>

</div>