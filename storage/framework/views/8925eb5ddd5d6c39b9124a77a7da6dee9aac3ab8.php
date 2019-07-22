<div class="modal-dialog" id="eventModal">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?php echo trans('app.'.'add_event'); ?>  </h4>
        </div>
        <?php echo Form::open(['route' => 'events.api.save', 'class' => 'bs-example form-horizontal ajaxifyForm', 'data-toggle' => 'validator']); ?>

        
        <div class="modal-body">
            <input type="hidden" name="module" value="<?php echo e($module); ?>">
            <input type="hidden" name="module_id" value="<?php echo e($module_id ?? 0); ?>">
            <input type="hidden" name="user_id" value="<?php echo e(Auth::id()); ?>">
            <input type="hidden" name="redirect" value="<?php echo e(url()->previous()); ?>">
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo trans('app.'.'title'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="<?php echo trans('app.'.'event_name'); ?>  " name="event_name" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo trans('app.'.'venue'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="<?php echo trans('app.'.'venue'); ?>  " name="location" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo trans('app.'.'description'); ?>  </label>
                <div class="col-lg-8">
                    <textarea class="form-control ta" name="description" placeholder="Type here.."></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo trans('app.'.'start_date'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <div class="input-group date">
                        <input type="text" class="form-control datetimepicker-input"
                        value="<?php echo e(timePickerFormat(now()->addHours(1))); ?>" name="start_date"
                        data-date-format="DD-MM-YYYY hh:mm A" data-date-start-date="moment()" required>
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
                        value="<?php echo e(timePickerFormat(now()->addDays(1))); ?>" name="end_date"
                        data-date-format="DD-MM-YYYY hh:mm A" data-date-start-date="moment()" required>
                        <div class="input-group-addon">
                            <?php echo e(svg_image('solid/calendar-alt', 'text-muted')); ?>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo trans('app.'.'calendar'); ?>  </label>
                <div class="col-lg-8">
                    <select class="form-control" name="calendar_id">
                        <?php $__currentLoopData = Modules\Calendar\Entities\CalendarType::get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $calendar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($calendar->id); ?>" <?php echo e($calendar->id != get_option('default_calendar') ?? 'selected="selected"'); ?>><?php echo e($calendar->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>


            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('projects_view_all')): ?>
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo trans('app.'.'project'); ?>  </label>
                <div class="col-lg-8">
                    <select class="select2-option form-control" name="project_id">
                        <option value="0" selected><?php echo trans('app.'.'none'); ?>  </option>
                        <?php $__currentLoopData = Modules\Projects\Entities\Project::select('id', 'name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($project->id); ?>"><?php echo e($project->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <?php endif; ?>
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo trans('app.'.'attendees'); ?>  </label>
                <div class="col-lg-8">
                    <select class="select2-option form-control" name="attendees[]" multiple="">
                        <?php $__currentLoopData = Modules\Users\Entities\User::select('id', 'username', 'name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>" <?php echo e($user->id === Auth::id() ? 'selected' : ''); ?>><?php echo e($user->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo trans('app.'.'event_color'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input type="text" class="form-control color-selector" value="#FE528C" name="color" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo trans('app.'.'alert'); ?></label>
                <div class="col-lg-8">
                    <select name="alert" class="form-control">
                        <option value="30"><?php echo trans('app.'.'30_minutes_before'); ?></option>
                        <option value="60"><?php echo trans('app.'.'1_hour_before'); ?></option>
                        <option value="1440" selected><?php echo trans('app.'.'1_day_before'); ?></option>
                        <option value="10080"><?php echo trans('app.'.'1_week_before'); ?></option>
                    </select>
                </div>
            </div>
            <input type="hidden" name="is_private" value="0">
            <div class="form-group">
                
                <label class="col-lg-3 control-label"></label>
                <div class="col-lg-8">
                    <div class="form-check text-muted m-t-xs">
                        <label>
                            <input type="checkbox" name="is_private" checked value="1">
                            <span class="label-text"><?php echo trans('app.'.'hidden_from_users'); ?></span>
                        </label>
                    </div>
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
<?php $__env->startPush('pagestyle'); ?>
    <?php echo $__env->make('stacks.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('stacks.css.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('stacks.css.colorpicker', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('pagescript'); ?>
    <?php echo $__env->make('stacks.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('stacks.js.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('stacks.js.colorpicker', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('partial.ajaxify', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript">
    $('.datetimepicker-input').datetimepicker({showClose: true, showClear: true, minDate: moment().add(-1, 'days') });
    $('.color-selector').colorpicker();
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->yieldPushContent('pagestyle'); ?>
<?php echo $__env->yieldPushContent('pagescript'); ?>