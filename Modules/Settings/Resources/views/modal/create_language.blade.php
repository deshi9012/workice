<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create new language</h4>
        </div>

        {!! Form::open(['route' => 'languages.save', 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}

        <div class="modal-body">

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('code') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="en" name="code" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('name') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="english" name="name" required>
                </div>
            </div>


        </div>
        <div class="modal-footer">

            {!! closeModalButton() !!}
            {!! renderAjaxButton() !!}
            
        </div>
        {!! Form::close() !!}
    </div>
</div>

    @include('partial.ajaxify')