<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('convert_lead') <span class="small text-muted"> ({{ $lead->name }} - {{ $lead->company }}) </span> </h4>
        </div>
        {!! Form::open(['route' => ['leads.api.convert', $lead->id], 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}
        <input type="hidden" name="id" value="{{ $lead->id }}">
        <div class="modal-body">
            <input type="hidden" value="0" name="noPotential">
            <div class="padder m-b-xs">
                Create New Account: <strong>{{ $lead->company }}</strong>
            </div>
            <div class="padder m-b-lg">
                Create New Contact: <strong>{{ $lead->name }}</strong>
            </div>
            <div class="padder m-b-md">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="noPotential" value="1">
                        <span class="label-text">Create a new Deal for this Account. </span>
                    </label>
                </div>
                
            </div>
            <div class="form-group no-gutter-right">
                <label class="col-md-3 control-label">@langapp('title') @required</label>
                <div class="col-md-9">
                    <input type="text" name="deal_title" value="{{ $lead->company }} Deal" class="input-sm form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                
                {!! closeModalButton() !!}
                {!!  renderAjaxButton()  !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@include('partial.ajaxify')