<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('make_changes')   - {{ $category->name }}</h4>
        </div>

        {!! Form::open(['route' => ['kb.category.update', 'id' => $category->id], 'method' =>'PUT', 'class' => 'bs-example form-horizontal ajaxifyForm', 'id' => 'editCategory']) !!}
        <input type="hidden" name="id" value="{{ $category->id }}">
        <input type="hidden" name="module" value="{{ $category->module }}">
        <input type="hidden" name="active" value="1">
        
        <div class="modal-body">
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('name') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ $category->name }}" name="name">
                </div>
            </div>
            
        

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('description') @required </label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ $category->description }}" name="description">
                </div>
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