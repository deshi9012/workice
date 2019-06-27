<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?php echo trans('app.'.'next_stage'); ?></h4>
        </div>
        <?php
        $nextStage = $lead->nextStage() ? $lead->nextStage() : App\Entities\Category::leads()->max('order');
        ?>
        <?php echo Form::open(['route' => ['leads.api.next.stage', $lead->id], 'class' => 'bs-example form-horizontal ajaxifyForm']); ?>

        <input type="hidden" name="id" value="<?php echo e($lead->id); ?>">
        <input type="hidden" name="url" value="<?php echo e(url()->previous()); ?>">
        <div class="modal-body">
            <input type="hidden" value="<?php echo e(App\Entities\Category::leads()->whereOrder($nextStage)->first()->id); ?>" name="stage">
            <div class="padder m-b-lg">
                <?php echo trans('app.'.'lead_next_stage_message', ['name' => $lead->name, 'from' => $lead->status->name, 'to' => App\Entities\Category::leads()->whereOrder($nextStage)->first()->name]); ?>
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