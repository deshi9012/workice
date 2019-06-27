<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('delete')  </h4>
        </div>
        {!! Form::open(['route' => 'files.destroy', 'class' => 'ajaxifyForm', 'method' => 'DELETE']) !!}

        <div class="modal-body">
            <p>@langapp('delete_warning')  </p>

            {{ $file->title }} - {{ $file->size  }}KB

            <p>{{ $file->description }}</p>

            <input type="hidden" name="id" value="{{ $file->id }}">

        </div>
        <div class="modal-footer">
            {!! closeModalButton() !!}
            
            {!! renderAjaxButton('ok') !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>

@include('partial.ajaxify')
