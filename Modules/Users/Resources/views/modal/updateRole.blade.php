<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/pencil-alt') @langapp('make_changes')  - {{ ucfirst($role->name) }}</h4>
        </div>


        <div class="modal-body">

        {!! Form::open(['route' => ['roles.update', 'id' => $role->id], 'method' =>'PUT', 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}
        <input type="hidden" name="id" value="{{ $role->id }}">

        <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('name') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ $role->name }}" name="name">
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