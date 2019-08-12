<?php echo Form::open(['route' => 'contacts.send', 'class' => 'bs-example ajaxifyForm', 'data-toggle' => 'validator', 'files' => true]); ?>

<input type="hidden" name="id" value="<?php echo e($id); ?>">
<input type="hidden" name="url" value="<?php echo e(url()->previous()); ?>">
<div class="panel-body">
  <div class="form-group">
    <label class="control-label"><?php echo trans('app.'.'subject'); ?>  <span class="text-danger">*</span></label>
    <input type="text" class="form-control" value="<?php echo e($subject); ?>" name="subject">
  </div>
  
  <div class="form-group">
    <label class="control-label"><?php echo trans('app.'.'message'); ?> <span class="text-danger">*</span></label>
    <textarea name="message" class="form-control markdownEditor" id="cannedResponse"></textarea>
  </div>
  <?php if(count(Auth::user()->cannedResponses) > 0): ?>
  <select name="selectCanned" class="form-control m-b" id="insertCannedResponse" onChange="insertMessage(this.value);">
    <option value="0">--- <?php echo trans('app.'.'canned_responses'); ?> ---</option>
    <?php $__currentLoopData = Auth::user()->cannedResponses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($template->id); ?>"><?php echo e($template->subject); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </select>
  <?php endif; ?>
  <div class="line"></div>
  
  <div class="form-group">
    <label class="control-label"><?php echo trans('app.'.'attach_file'); ?>  </label>
    <input type="file" name="uploads[]" multiple="">
    
  </div>
  
  <div class="form-group display-none" id="queueLater">
    <label><?php echo trans('app.'.'schedule'); ?></label>
    <div class="input-group date">
      <input type="text" class="form-control datetimepicker-input"
      value="<?php echo e(timePickerFormat(now())); ?>" name="reserved_at"
      data-date-format="DD-MM-YYYY hh:mm A" data-date-start-date="0d">
      <div class="input-group-addon">
        <span class="fas fa-calendar-alt"></span>
      </div>
    </div>
  </div>
  <?php echo renderAjaxButton('send'); ?>

  <a href="#" id="sendLater" class="btn btn-sm btn-warning btn-rounded pull-right"><?php echo e(svg_image('solid/clock')); ?> <?php echo trans('app.'.'send_later'); ?></a>
</div>
<?php echo Form::close(); ?>