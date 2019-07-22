<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?php echo trans('app.'.'calendar'); ?> - <?php echo e($calendar->name); ?></h4>
        </div>
        <?php echo Form::open(['route' => ['settings.calendars.update', $calendar->id], 'method' =>'PUT', 'class' => 'bs-example form-horizontal ajaxifyForm', 'id' => 'editCalendar']); ?>

        <input type="hidden" name="id" value="<?php echo e($calendar->id); ?>">

        <div class="modal-body">
            <div class="form-group">
                <label class="col-lg-4 control-label"><?php echo trans('app.'.'calendar'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="<?php echo e($calendar->name); ?>" name="name">
                </div>
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