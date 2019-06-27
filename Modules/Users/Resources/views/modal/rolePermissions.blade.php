<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> @langapp('permissions') - {{ ucfirst($role->name) }}</h4>
            </div>
            <div class="modal-body">
    
                {!! Form::open(['route' => ['users.roles.changePerm', $role->id], 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}
    
    
                <input type="hidden" name="role_id" value="{{ $role->id }}">
    
                @foreach (\Spatie\Permission\Models\Permission::select('name', 'description')->orderBy('name', 'asc')->get() as $permission)

                    <div class="">
                        <label>
                            <input type="checkbox" name="perm[{{ $permission->name }}]" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                            <span class="label-text">{{ humanize($permission->name) }} - <span class="text-muted small">{{ $permission->description }}</span></span>
                        </label>
                    </div>
    
    
                <div class="line line-dashed line-lg pull-in"></div>
    
                @endforeach
    
                <div class="modal-footer">
                    {!! closeModalButton() !!}
                    {!! renderAjaxButton() !!}
                </div>
    
                {!! Form::close() !!}
    
    
            </div>
    
        </div>
    </div>
    
    @include('partial.ajaxify')