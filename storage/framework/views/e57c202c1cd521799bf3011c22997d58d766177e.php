<div class="modal-dialog" id="eventModal">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?php echo trans('app.'.'appointments'); ?>  </h4>
        </div>
        <?php echo Form::open(['route' => ['appointments.api.update', $appointment->id], 'class' => 'bs-example form-horizontal ajaxifyForm', 'data-toggle' => 'validator', 'method' => 'PUT']); ?>

        <input type="hidden" name="url" value="<?php echo e(url()->previous()); ?>">
        <div class="modal-body">
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo trans('app.'.'name'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="<?php echo e($appointment->name); ?>" name="name" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo trans('app.'.'venue'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="<?php echo e($appointment->venue); ?>" name="venue" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo trans('app.'.'user'); ?></label>
                <div class="col-lg-8">
                    <select class="select2-option form-control" name="attendee_id">
                        <option value="0">---None---</option>
                        <?php $__currentLoopData = Modules\Users\Entities\User::select('id', 'username', 'name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>" <?php echo e($user->id == $appointment->attendee_id ? 'selected' : ''); ?>><?php echo e($user->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo trans('app.'.'lead'); ?></label>
                <div class="col-lg-8">
                    <select class="select2-option form-control" name="lead_id">
                        <option value="0">---None---</option>
                        <?php $__currentLoopData = Modules\Leads\Entities\Lead::select('id', 'name')->whereNull('archived_at')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($lead->id); ?>" <?php echo e($lead->id == $appointment->lead_id ? 'selected' : ''); ?>><?php echo e($lead->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo trans('app.'.'start_date'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <div class="input-group date">
                        <input type="text" class="form-control datetimepicker-input"
                        value="<?php echo e(timePickerFormat($appointment->start_time)); ?>" name="start_time"
                        data-date-format="DD-MM-YYYY hh:mm A" data-date-start-date="0d" required>
                        <div class="input-group-addon">
                            <?php echo e(svg_image('solid/calendar-alt', 'text-muted')); ?>
                        </div>
                    </div>
                    
                    
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo trans('app.'.'end_date'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <div class="input-group date">
                        <input type="text" class="form-control datetimepicker-input"
                        value="<?php echo e(timePickerFormat($appointment->finish_time)); ?>" name="finish_time"
                        data-date-format="DD-MM-YYYY hh:mm A" data-date-start-date="0d" required>
                        <div class="input-group-addon">
                            <?php echo e(svg_image('solid/calendar-alt', 'text-muted')); ?>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo trans('app.'.'comments'); ?>  </label>
                <div class="col-lg-8">
                    <textarea class="form-control ta" name="comments"><?php echo e($appointment->comments); ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo trans('app.'.'alert'); ?>  </label>
                <div class="col-lg-8">
                    <select name="alert" class="form-control">
                        <option value="30" <?php echo e($appointment->alert == 30 ? 'selected' : ''); ?>>30 Minutes before</option>
                        <option value="60" <?php echo e($appointment->alert == 60 ? 'selected' : ''); ?>>1 Hour before</option>
                        <option value="1440" <?php echo e($appointment->alert == 1440 ? 'selected' : ''); ?>>1 Day before</option>
                        <option value="10080" <?php echo e($appointment->alert == 10080 ? 'selected' : ''); ?>>1 Week before</option>
                    </select>
                </div>
            </div>

            <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="deleted" value="1">
                                        <span class="label-text text-danger"><?php echo trans('app.'.'mark_as_deleted'); ?></span>
                                    </label>
                                </div>
            
            

            
        </div>
        <div class="modal-footer">
            <?php echo closeModalButton(); ?>

            <?php echo renderAjaxButton(); ?>

            
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>
<?php $__env->startPush('pagestyle'); ?>
    <?php echo $__env->make('stacks.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('stacks.css.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('pagescript'); ?>
    <?php echo $__env->make('stacks.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('stacks.js.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('partial.ajaxify', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript">
    $('.datetimepicker-input').datetimepicker({showClose: true, showClear: true, minDate: moment().add(-1, 'days') });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->yieldPushContent('pagestyle'); ?>
<?php echo $__env->yieldPushContent('pagescript'); ?>