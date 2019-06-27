<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('delete')   {{  $user->name  }}</h4>
        </div>



        {!! Form::open(['route' => ['users.api.delete', $user->id], 'class' => 'ajaxifyForm', 'method' => 'DELETE']) !!}

        <div class="modal-body">
            <p class="text-danger">@langapp('delete_warning')  </p>



            <input type="hidden" name="checked[]" value="{{  $user->id  }}">

        </div>
        <div class="modal-footer">

            {!! closeModalButton() !!}
            {!! renderAjaxButton('ok') !!}

        </div>
        
        {!! Form::close() !!}
    </div>
</div>
@include('partial.ajaxify')