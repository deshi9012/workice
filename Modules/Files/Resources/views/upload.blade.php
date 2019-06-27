<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('upload_file')  </h4>
        </div>

        {!! Form::open(['route' => 'files.save', 'class' => 'bs-example form-horizontal ajaxifyForm', 'files' => true]) !!}

        <input type="hidden" name="module_id" value="{{ $id }}">
        <input type="hidden" name="module" value="{{ $module }}">
        <input type="hidden" name="filestack" id="filestack">
        <div class="modal-body">

            <div id="uploadedFiles"></div>

            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('title') @required</label>
                <div class="col-lg-9">
                    <input name="title" class="form-control" placeholder="@langapp('title')" required/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('description')</label>
                <div class="col-lg-9">
                    <textarea name="description" class="form-control ta" placeholder="@langapp('description')"></textarea>
                </div>
            </div>


            

            <div id="file_container">
                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-9">
                        @if(settingEnabled('filestack_active'))
                        
                        <a href="#" class="btn btn-danger btn-sm" id="filePicker" onclick="openPicker()">
                            @icon('solid/cloud') File Picker
                        </a>
                        @else
                        <input type="file" name="uploads[]" required="" multiple="">
                        @endif
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

</div>

@if(settingEnabled('filestack_active'))
@include('files::_includes.filestack')
@endif

@include('partial.ajaxify')

