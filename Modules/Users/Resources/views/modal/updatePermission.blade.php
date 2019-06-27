<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/pencil-alt') @langapp('make_changes')  - {{ humanize($permission->name) }}</h4>
        </div>


        <div class="modal-body">

        {!! Form::open(['route' => ['users.perm.update', 'id' => $permission->id], 'method' =>'PUT', 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}
        <input type="hidden" name="id" value="{{ $permission->id }}">

        <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('name')   <span
                class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ $permission->name }}" name="name">
                </div>
        </div>

        <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('description')   <span
                class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ $permission->description }}" name="description">
                </div>
        </div>



            <div class="modal-footer">

            {!! closeModalButton() !!}
            {!! renderAjaxButton() !!}
            
            </div>
    {!! Form::close() !!}



        </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

@include('partial.ajaxify')