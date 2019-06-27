<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Refresh Access Token</h4>
        </div>


        <div class="modal-body">

        {!! Form::open(['route' => ['oauth.recreate.token'], 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}
        
        <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="fa fa-ban-circle"></i><strong>Note!</strong> Your old access token will no longer work!
                  </div>
        

            <div class="modal-footer">
            {!! closeModalButton() !!}
        {!!  renderAjaxButton('ok') !!}
    </div>
    {!! Form::close() !!}



        </div>
</div>

@include('partial.ajaxify')