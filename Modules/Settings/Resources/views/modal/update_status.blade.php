<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('status') - {{ $status->status }}</h4>
        </div>
        {!! Form::open(['route' => ['settings.statuses.update', $status->id], 'method' =>'PUT', 'class' => 'bs-example form-horizontal ajaxifyForm', 'id' => 'editStatus']) !!}
        <input type="hidden" name="id" value="{{ $status->id }}">

        <div class="modal-body">
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('status') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ $status->status }}" name="status">
                </div>
            </div>

        </div>
        <div class="modal-footer">

            {!! closeModalButton() !!}
            {!!  renderAjaxButton()  !!}
            
        </div>
        {!! Form::close() !!}
    </div>
</div>

@include('partial.ajaxify')