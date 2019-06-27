<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">@svg('solid/pencil-alt') @langapp('make_changes')  </h4>
            </div>
            {!! Form::open(['route' => ['comments.update', $comment->id], 'method' => 'PUT', 'class' => 'ajaxifyForm']) !!}
            
            <div class="modal-body">
    
                <textarea name="message" class="markdownEditor form-control">{{ $comment->getOriginal('message') }}</textarea>
    
                <input type="hidden" name="id" value="{{ $comment->id }}">
                <input type="hidden" name="previous_url" value="{{ url()->previous() }}">
    
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