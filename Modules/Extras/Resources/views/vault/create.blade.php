<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/shield-alt') @langapp('vaults')  </h4>
        </div>

        {!! Form::open(['route' => ['vaults.api.save'], 'class' => 'ajaxifyForm']) !!}

        <input type="hidden" name="module" value="{{ $module }}">
        <input type="hidden" name="module_id" value="{{ $module_id }}">
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <input type="hidden" name="url" value="{{ url()->previous() }}">


        <div class="modal-body">


             <div class="form-group">
                <label class="control-label">@langapp('key') @required</label>
                    <input type="text" class="form-control" name="key" placeholder="Login Details" required>
                
            </div>

            <div class="form-group">
                <label class="control-label">@langapp('value') @required </label>
                
                    <textarea class="form-control js-auto-size" name="value" required placeholder="username: example"></textarea>
                
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
<script>
$('textarea.js-auto-size').textareaAutoSize();
</script>