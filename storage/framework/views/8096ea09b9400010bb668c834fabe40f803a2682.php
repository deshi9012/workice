<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?php echo e(svg_image('solid/cloud-upload-alt')); ?> <?php echo trans('app.'.'import'); ?></h4>
        </div>
        <?php echo Form::open(['route' => 'leads.csvmap', 'files' => true]); ?>

        <div class="modal-body">


            <?php echo $__env->make('partial.csvupload', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php echo $__env->make('partial.privacy_consent', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>


        </div>
        <div class="modal-footer">
            <?php echo closeModalButton(); ?>

            <?php echo renderAjaxButton('import', 'fas fa-cloud-upload-alt', true); ?>

        </div>
        <?php echo Form::close(); ?>

    </div>
</div>