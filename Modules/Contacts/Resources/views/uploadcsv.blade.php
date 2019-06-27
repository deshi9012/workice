<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/file-alt') @langapp('import')</h4>
        </div>
        {!! Form::open(['route' => 'contacts.csvmap', 'files' => true]) !!}
       
        <div class="modal-body">

            @include('partial.privacy_consent')

            @include('partial.csvupload')


        </div>
        <div class="modal-footer">
        
            {!! closeModalButton() !!}
            
            {!! renderAjaxButton('import', 'fas fa-cloud-upload-alt', true) !!}
            
        </div>
        {!! Form::close() !!}
        
    </div>
</div>