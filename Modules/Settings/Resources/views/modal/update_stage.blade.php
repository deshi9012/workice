<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{  langapp('stage')  }} - {{ $stage->name }}</h4>
        </div>
        {!! Form::open(['route' => ['settings.stages.update', $stage->id], 'method' =>'PUT', 'class' => 'bs-example form-horizontal ajaxifyForm', 'id' => 'editStage']) !!}
        <input type="hidden" name="id" value="{{ $stage->id }}">
        <input type="hidden" name="active" value="1">
        
        <div class="modal-body">
            <div class="form-group">
                <label class="col-lg-4 control-label">{{ langapp('stage') }} @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ $stage->name }}" name="name">
                </div>
            </div>

            @if($stage->module === 'deals')

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('pipeline') @required</label>
                <div class="col-lg-8">
                    <select name="pipeline" class="form-control">
                        @foreach (App\Entities\Category::whereModule('pipeline')->get() as $pipeline)
                           <option value="{{ $pipeline->id }}" {{ $pipeline->id == $stage->pipeline ? 'selected' : '' }}>{{ $pipeline->name }}</option>
                        @endforeach
                        
                    </select>
                </div>
            </div>

            @endif
            
        </div>
        <div class="modal-footer">
            {!! closeModalButton() !!}
            {!!  renderAjaxButton()  !!}
        </div>
        
    {!! Form::close() !!}
</div>
</div>
@include('partial.ajaxify')