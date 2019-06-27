<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('make_changes')  </h4>
        </div>

        {!! Form::open(['route' => ['notes.change', $note->id], 'class' => 'ajaxifyForm']) !!}

        <input type="hidden" name="id" value="{{  $note->id  }}">

        <div class="modal-body">

            <div class="form-group">
                <label>@langapp('notes')  </label>

                <textarea name="description" class="form-control markdownEditor">{{ $note->getOriginal('description') }}</textarea>

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
    @include('partial.ajaxify')
@endpush

@stack('pagescript')