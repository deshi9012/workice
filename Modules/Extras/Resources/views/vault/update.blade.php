<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/shield-alt') @langapp('make_changes')  </h4>
        </div>

        {!! Form::open(['route' => ['vaults.api.update', $vault->id], 'class' => 'ajaxifyForm', 'method' => 'PUT']) !!}

        <input type="hidden" name="id" value="{{ $vault->id }}">
        <input type="hidden" name="module" value="{{ $vault->vaultable_type }}">
        <input type="hidden" name="module_id" value="{{ $vault->vaultable_id }}">
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <input type="hidden" name="url" value="{{ url()->previous() }}">


        <div class="modal-body">


             <div class="form-group">
                <label class="control-label">@langapp('key') @required</label>
                    <input type="text" class="form-control" name="key" value="{{ $vault->key }}" required>
                
            </div>

            <div class="form-group">
                <label class="control-label">@langapp('value') @required </label>
                
                    <textarea class="form-control js-auto-size" name="value" required>{{ $vault->key_value }}</textarea>
                
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