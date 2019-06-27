<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('delete') {{ ucfirst($role->name) }}</h4>
        </div>



        {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'DELETE', 'class' => 'ajaxifyForm']) !!}

        <div class="modal-body">
            <p>@langapp('delete_warning')</p>
            <p class="">
            Delete Role <strong class="text-danger">{{ $role->name }}</strong>
            </p>
            <input type="hidden" name="id" value="{{  $role->id  }}">

        </div>
        <div class="modal-footer">
            
            {!! closeModalButton() !!}
            {!! renderAjaxButton('ok') !!}

        </div>
        {!! Form::close() !!}
    </div>
</div>

@include('partial.ajaxify')