<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('delete')   {{  humanize($permission->name)  }}</h4>
        </div>



        {!! Form::open(['route' => ['users.perm.destroy', $permission->id], 'method' => 'DELETE']) !!}

        <div class="modal-body">
            <p class="">
            @icon('solid/exclamation-circle') Delete Permission <strong class="text-danger">{{ $permission->name }}</strong>
            </p>

            <p class="text-muted">{{ $permission->description }}</p>



            <input type="hidden" name="id" value="{{  $permission->id  }}">

        </div>
        <div class="modal-footer">
            
            {!! closeModalButton() !!}
            {!! okModalButton() !!}

        </div>
        {!! Form::close() !!}
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->