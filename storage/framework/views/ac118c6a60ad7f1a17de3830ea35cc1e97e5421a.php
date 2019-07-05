<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> <?php echo trans('app.'.'permissions'); ?> - <?php echo e(ucfirst($role->name)); ?></h4>
            </div>
            <div class="modal-body">
    
                <?php echo Form::open(['route' => ['users.roles.changePerm', $role->id], 'class' => 'bs-example form-horizontal ajaxifyForm']); ?>

    
    
                <input type="hidden" name="role_id" value="<?php echo e($role->id); ?>">
    
                <?php $__currentLoopData = \Spatie\Permission\Models\Permission::select('name', 'description')->orderBy('name', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="">
                        <label>
                            <input type="checkbox" name="perm[<?php echo e($permission->name); ?>]" <?php echo e($role->hasPermissionTo($permission->name) ? 'checked' : ''); ?>>
                            <span class="label-text"><?php echo e(humanize($permission->name)); ?> - <span class="text-muted small"><?php echo e($permission->description); ?></span></span>
                        </label>
                    </div>
    
    
                <div class="line line-dashed line-lg pull-in"></div>
    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
                <div class="modal-footer">
                    <?php echo closeModalButton(); ?>

                    <?php echo renderAjaxButton(); ?>

                </div>
    
                <?php echo Form::close(); ?>

    
    
            </div>
    
        </div>
    </div>
    
    <?php echo $__env->make('partial.ajaxify', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>