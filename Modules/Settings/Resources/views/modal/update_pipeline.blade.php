<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{  langapp('deal_pipelines')  }} - {{ $pipeline->name }}</h4>
        </div>
        {!! Form::open(['route' => ['settings.pipelines.update', $pipeline->id], 'method' =>'PUT', 'class' => 'bs-example form-horizontal ajaxifyForm', 'id' => 'editPipeline']) !!}
        <input type="hidden" name="id" value="{{ $pipeline->id }}">
        <input type="hidden" name="active" value="1">
        
        <div class="modal-body">
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('pipeline') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ $pipeline->name }}" name="name">
                </div>
            </div>
            
        </div>
        <div class="modal-footer">
            {!! closeModalButton() !!}
            {!! renderAjaxButton()  !!}
        </div>
    {!! Form::close() !!}
</div>

</div>

@include('partial.ajaxify')