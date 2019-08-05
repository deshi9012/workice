<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?php echo trans('app.'.'convert_lead'); ?> <span class="small text-muted"> (<?php echo e($lead->name); ?> - <?php echo e($lead->company); ?>) </span> </h4>
        </div>
        <?php echo Form::open(['route' => ['leads.api.convert', $lead->id], 'class' => 'bs-example form-horizontal ajaxifyForm']); ?>

        <input type="hidden" name="id" value="<?php echo e($lead->id); ?>">
        <div class="modal-body">
            <input type="hidden" value="0" name="noPotential">
            <div class="padder m-b-xs">
                Create New Account: <strong><?php echo e($lead->company); ?></strong>
            </div>
            <div class="padder m-b-lg">
                Create New Contact: <strong><?php echo e($lead->name); ?></strong>
            </div>
            <div class="padder m-b-md">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="noPotential" value="1">
                        <span class="label-text">Create a new Deal for this Account. </span>
                    </label>
                </div>
                
            </div>
            <div class="form-group no-gutter-right">
                <label class="col-md-3 control-label"><?php echo trans('app.'.'title'); ?> <span class="text-danger">*</span></label>
                <div class="col-md-9">
                    <input type="text" name="deal_title" value="<?php echo e($lead->company); ?> Deal" class="input-sm form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                
                <?php echo closeModalButton(); ?>

                <?php echo renderAjaxButton(); ?>

            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
</div>
<?php echo $__env->make('partial.ajaxify', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>