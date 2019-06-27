<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('upload_file')</h4>
        </div>

        {!! Form::open(['route' => 'settings.import.fo', 'class' => 'bs-example form-horizontal ajaxifyForm', 'files' => true]) !!}
        <div class="modal-body">

            <div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="fas fa-info-circle"></i> Upload your freelancer office JSON file. This process will run in the background
                  </div>

             <div class="form-group">
                <label class="col-lg-3 control-label">JSON File</label>
                <div class="col-lg-9">
                    <input type="file" name="jsondata" class="form-control" required="">
                </div>
            </div>

            


            <div class="modal-footer">

                {!! closeModalButton() !!}
                {!! renderAjaxButton() !!}
                
            </div>

            {!! Form::close() !!}
        </div>
    </div>

</div>
@include('partial.ajaxify')

