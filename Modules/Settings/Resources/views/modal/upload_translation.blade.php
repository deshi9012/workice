<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/file-alt') Restore Translations</h4>
        </div>
        {!! Form::open(['route' => 'translations.restore', 'class' => 'ajaxifyForm', 'files' => true]) !!}
       
        <div class="modal-body">

            <div class="alert alert-warning alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <p>@icon('solid/exclamation-triangle') This action will overwrite your current translations</p>
                  </div>


            <div class="form-group">
                <label class="control-label">Backup File</label>
                <input type="file" name="backup" required>
            </div>


        </div>
        <div class="modal-footer">
        
            {!! closeModalButton() !!}
            
            {!! renderAjaxButton('upload_file', 'fas fa-cloud-upload-alt', true) !!}
            
        </div>
        {!! Form::close() !!}
        
    </div>
</div>
@include('partial.ajaxify')