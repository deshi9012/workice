<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('delete')</h4>
        </div>
        {!! Form::open(['route' => ['email.destroy', $mail->id], 'class' => 'ajaxifyForm', 'method' => 'DELETE']) !!}
        <div class="modal-body">
            <p>@langapp('delete_warning')</p>

            <input type="hidden" name="id" value="{{ $mail->id }}">

        </div>
        <div class="modal-footer">
            {!! closeModalButton() !!}
            {!! renderAjaxButton('ok') !!}
        </div>

        {!! Form::close() !!}
    </div>

</div>

@include('partial.ajaxify')