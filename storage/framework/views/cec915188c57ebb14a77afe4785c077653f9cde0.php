<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> <span class="thumb-xs avatar lobilist-check">
                                    <img src="<?php echo e($user->profile->photo); ?>" class="img-circle">
                                </span> <?php echo e($user->name); ?></h4>
        </div>
        <div class="modal-body">

            <?php echo Form::open(['route' => ['users.changePermission', $user->id], 'class' => 'bs-example form-horizontal ajaxifyForm']); ?>



            <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">



            <?php $__currentLoopData = \Spatie\Permission\Models\Permission::select('name', 'description')->orderBy('name', 'asc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
                    <div class="">
                        <label class="">
                            <input type="checkbox" name="perm[<?php echo e($permission->name); ?>]" <?php echo e($user->hasPermissionTo($permission->name) ? 'checked' : ''); ?>>
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