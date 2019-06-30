<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?php echo e(svg_image('solid/plus')); ?> <?php echo trans('app.'.'create'); ?>  </h4>
        </div>


        <div class="modal-body">

        <?php echo Form::open(['route' => 'roles.save', 'class' => 'bs-example form-horizontal ajaxifyForm']); ?>

        

        <div class="form-group">
                <label class="col-lg-4 control-label"><?php echo trans('app.'.'name'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="Staff" name="name">
                </div>
        </div>



            <div class="modal-footer">
            <?php echo closeModalButton(); ?>

        <?php echo renderAjaxButton(); ?>

    </div>
    <?php echo Form::close(); ?>




        </div>
</div>

<?php echo $__env->make('partial.ajaxify', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>