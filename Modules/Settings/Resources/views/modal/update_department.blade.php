<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{  langapp('department')  }} - {{ $department->deptname }}</h4>
        </div>
        {!! Form::open(['route' => ['departments.update', $department->deptid], 'method' =>'PUT', 'class' => 'bs-example form-horizontal ajaxifyForm', 'id' => 'editDepartment']) !!}
        <input type="hidden" name="deptid" value="{{ $department->deptid }}">
        
        <div class="modal-body">
            <div class="form-group">
                <label class="col-lg-4 control-label">{{ langapp('department') }} @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ $department->deptname }}" name="deptname">
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