<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <span class="thumb-xs avatar lobilist-check">
                                    <img src="{{ $user->profile->photo }}" class="img-circle">
                                </span> {{ $user->name }}</h4>
        </div>
        <div class="modal-body">

            {!! Form::open(['route' => ['users.changePermission', $user->id], 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}


            <input type="hidden" name="user_id" value="{{ $user->id }}">



            @foreach (\Spatie\Permission\Models\Permission::select('name', 'description')->orderBy('name', 'asc')->get() as $permission)
    
                    <div class="">
                        <label class="">
                            <input type="checkbox" name="perm[{{ $permission->name }}]" {{ $user->hasPermissionTo($permission->name) ? 'checked' : '' }}>
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