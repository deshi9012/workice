<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('suspend')   - {{  $user->name  }}</h4>
        </div>

        {!! Form::open(['route' => ['users.api.ban', $user->id], 'class' => 'bs-example ajaxifyForm']) !!}

        <div class="modal-body">
            <input type="hidden" name="id" value="{{ $user->id }}">

            <div class="form-group">
                <label class="control-label">@langapp('ban_reason')  </label>
                
                    <textarea class="markdownEditor" name="ban_reason">{{ $user->ban_reason }}</textarea>
               
            </div>

        </div>
        <div class="modal-footer">
            {!! closeModalButton() !!}
            {!! renderAjaxButton() !!}
        </div>

        {!! Form::close() !!}
    </div>
</div>
@push('pagescript')
    @include('stacks.js.markdown')
    @include('partial/ajaxify')
@endpush

@stack('pagescript')
