<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?php echo trans('app.'.'make_changes'); ?> - <strong><?php echo e($contact->name); ?></strong> </h4>
        </div>
        <?php echo Form::open(['route' => ['contacts.api.update', $contact->id], 'class' => 'bs-example form-horizontal ajaxifyForm validator', 'method' => 'PUT']); ?>

        <div class="modal-body">
            <input type="hidden" name="id" value="<?php echo e($contact->id); ?>">
            <span id="status"></span>
            <div class="form-group">
                <label class="col-lg-4 control-label"><?php echo trans('app.'.'fullname'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="<?php echo e($contact->name); ?>" name="name" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label"><?php echo trans('app.'.'username'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input class="form-control" id='username' type="text" value="<?php echo e($contact->username); ?>" name="username" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label"><?php echo trans('app.'.'password'); ?></label>
                <div class="col-lg-8">
                    <input class="form-control" type="password" placeholder="Leave blank" name="password">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label"><?php echo trans('app.'.'email'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input class="form-control" id='email' type="email" value="<?php echo e($contact->email); ?>" name="email" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label"><?php echo trans('app.'.'job_title'); ?></label>
                <div class="col-lg-8">
                    <input class="form-control" type="text" value="<?php echo e($contact->profile->job_title); ?>" name="job_title">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label"><?php echo trans('app.'.'company'); ?></label>
                <div class="col-lg-8">
                    <select class="form-control select2-option" name="company">
                                    <?php $__currentLoopData = Modules\Clients\Entities\Client::select('id', 'name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($company->id); ?>" <?php echo e($contact->profile->company == $company->id ? ' selected="selected"' : ''); ?>>
                                            <?php echo e($company->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label"><?php echo trans('app.'.'phone'); ?> </label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="phone" value="<?php echo e($contact->profile->phone); ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label"><?php echo trans('app.'.'city'); ?> </label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="city" value="<?php echo e($contact->profile->city); ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label"><?php echo trans('app.'.'country'); ?> </label>
                <div class="col-lg-8">
                    <select class="form-control select2-option" name="country">
                                <?php $__currentLoopData = countries(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($country['name']); ?>" <?php echo e($country['name'] == $contact->profile->country ? 'selected' : ''); ?>>
                                        <?php echo e($country['name']); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>
                </div>
            </div>

            
            
            <div class="modal-footer">
                <?php echo closeModalButton(); ?>

                <?php echo renderAjaxButton(); ?>

                
            </div>
        </div>
        <?php echo Form::close(); ?>

    </div>

<?php $__env->startPush('pagestyle'); ?>
    <?php echo $__env->make('stacks.css.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>
    
<?php $__env->startPush('pagescript'); ?>
    <?php echo $__env->make('stacks.js.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('partial.ajaxify', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->yieldPushContent('pagestyle'); ?>
<?php echo $__env->yieldPushContent('pagescript'); ?>
