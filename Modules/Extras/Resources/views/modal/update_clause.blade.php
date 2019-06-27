<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/pencil-alt') @langapp('make_changes')  </h4>
        </div>

        {!! Form::open(['route' => ['clauses.api.update', $clause->id], 'class' => 'ajaxifyForm', 'method' => 'PUT']) !!}


        <div class="modal-body">


            <div class="form-group">
                <label class="control-label">@langapp('clause') @required </label>
                
                    <textarea class="form-control markdownEditor" name="clause" rows="10" required>{{ $clause->clause }} </textarea>
                
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