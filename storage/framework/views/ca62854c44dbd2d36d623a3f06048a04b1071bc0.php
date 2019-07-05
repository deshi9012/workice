<div class="modal-dialog" id="eventModal">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?php echo trans('app.'.'appointments'); ?>  </h4>
        </div>
        <?php echo Form::open(['route' => 'appointments.api.save', 'class' => 'bs-example form-horizontal ajaxifyForm', 'data-toggle' => 'validator']); ?>

        
        <div class="modal-body">
            <input type="hidden" name="user_id" value="<?php echo e(Auth::id()); ?>">
            <input type="hidden" name="url" value="<?php echo e(url()->previous()); ?>">
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo trans('app.'.'name'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="<?php echo trans('app.'.'name'); ?>" name="name" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo trans('app.'.'venue'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="<?php echo trans('app.'.'venue'); ?>" name="venue" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo trans('app.'.'user'); ?></label>
                <div class="col-lg-8">
                    <select class="select2-option form-control" name="attendee_id">
                        <?php $__currentLoopData = Modules\Users\Entities\User::select('id', 'username', 'name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>" <?php echo e($user->id === Auth::id() ? 'selected' : ''); ?>><?php echo e($user->name); ?></option>
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
                        <option value="<?php echo e($lead->id); ?>"><?php echo e($lead->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo trans('app.'.'start_date'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <div class="input-group date">
                        <input type="text" class="form-control datetimepicker-input"
                        value="<?php echo e(timePickerFormat(now()->addMinutes(10))); ?>" name="start_time"
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
                        value="<?php echo e(timePickerFormat(now()->addHours(2))); ?>" name="finish_time"
                        data-date-format="DD-MM-YYYY hh:mm A" data-date-start-date="moment()" required>
                        <div class="input-group-addon">
                            <?php echo e(svg_image('solid/calendar-alt', 'text-muted')); ?>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo trans('app.'.'comments'); ?>  </label>
                <div class="col-lg-8">
                    <textarea class="form-control ta" name="comments" placeholder="Type here.."></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo trans('app.'.'alert'); ?>  </label>
                <div class="col-lg-8">
                    <select name="alert" class="form-control">
                        <option value="30">30 Minutes before</option>
                        <option value="60">1 Hour before</option>
                        <option value="1440" selected>1 Day before</option>
                        <option value="10080">1 Week before</option>
                    </select>
                </div>
            </div>

            <input type="hidden" name="timezone" value="<?php echo e(get_option('timezone')); ?>">
            
            

            
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