<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/envelope-open') @langapp('send_invite')</h4>
        </div>


        <div class="modal-body">

        {!! Form::open(['route' => 'invite.process', 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}
        

        <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('email') @required</label>
                <div class="col-lg-9">
                    <input type="email" class="form-control" placeholder="johndoe@example.com" required name="email">
                </div>
        </div>




            <div class="modal-footer">

            {!! closeModalButton() !!}
            {!! renderAjaxButton('send_invite') !!}

            </div>
    {!! Form::close() !!}



        </div>
</div>

@include('partial.ajaxify')