<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?php echo e(svg_image('solid/pencil-alt')); ?> <?php echo trans('app.'.'make_changes'); ?>  - <?php echo e(humanize($permission->name)); ?></h4>
        </div>


        <div class="modal-body">

        <?php echo Form::open(['route' => ['users.perm.update', 'id' => $permission->id], 'method' =>'PUT', 'class' => 'bs-example form-horizontal ajaxifyForm']); ?>

        <input type="hidden" name="id" value="<?php echo e($permission->id); ?>">

        <div class="form-group">
                <label class="col-lg-4 control-label"><?php echo trans('app.'.'name'); ?>   <span
                class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="<?php echo e($permission->name); ?>" name="name">
                </div>
        </div>

        <div class="form-group">
                <label class="col-lg-4 control-label"><?php echo trans('app.'.'description'); ?>   <span
                class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="<?php echo e($permission->description); ?>" name="description">
                </div>
        </div>



            <div class="modal-footer">

            <?php echo closeModalButton(); ?>

            <?php echo renderAjaxButton(); ?>

            
            </div>
    <?php echo Form::close(); ?>




        </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

<?php echo $__env->make('partial.ajaxify', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>