<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?php echo trans('app.'.'delete'); ?> <?php echo e(ucfirst($role->name)); ?></h4>
        </div>



        <?php echo Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'DELETE', 'class' => 'ajaxifyForm']); ?>


        <div class="modal-body">
            <p><?php echo trans('app.'.'delete_warning'); ?></p>
            <p class="">
            Delete Role <strong class="text-danger"><?php echo e($role->name); ?></strong>
            </p>
            <input type="hidden" name="id" value="<?php echo e($role->id); ?>">

        </div>
        <div class="modal-footer">
            
            <?php echo closeModalButton(); ?>

            <?php echo renderAjaxButton('ok'); ?>


        </div>
        <?php echo Form::close(); ?>

    </div>
</div>

<?php echo $__env->make('partial.ajaxify', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>