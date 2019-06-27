<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/plus') @langapp('create')  </h4>
        </div>


        <div class="modal-body">

        {!! Form::open(['route' => 'roles.save', 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}
        

        <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('name') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="Staff" name="name">
                </div>
        </div>



            <div class="modal-footer">
            {!! closeModalButton() !!}
        {!!  renderAjaxButton()  !!}
    </div>
    {!! Form::close() !!}



        </div>
</div>

@include('partial.ajaxify')