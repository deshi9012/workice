<?php $__env->startSection('content'); ?>
<section id="content">
  <section class="hbox stretch">
    <aside class="lter b-l">
      <section class="vbox">
        <header class="header bg-white b-b clearfix">
          <div class="row m-t-sm">
            <div class="col-sm-12 m-b-xs">
              <p class="h3"><?php echo trans('app.'.'send_email_to_leads'); ?></p>
            </div>
          </div>
        </header>
        <section class="scrollable wrapper bg">
          <div class="panel panel-body">
            
            
            <section class="panel panel-default">
              
              
            <header class="panel-heading"><span class="text-dracula"><?php echo e($leads->count()); ?> <?php echo trans('app.'.'leads'); ?></span></header>
            <?php echo Form::open(['route' => 'leads.bulk.send', 'class' => 'bs-example ajaxifyForm', 'data-toggle' => 'validator']); ?>

            
            <div class="panel-body">
              
              <div class="form-group">
                <label class="control-label"><?php echo trans('app.'.'leads'); ?> <span class="text-danger">*</span></label>
                <select class="select2-option width100" multiple="multiple" name="leads[]">
                  <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($lead->id); ?>" selected><?php echo e($lead->name); ?> &laquo;<?php echo e($lead->email); ?>&raquo;</option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label"><?php echo trans('app.'.'subject'); ?> <span class="text-danger">*</span></label>
                <input type="text" name="subject" class="form-control">
              </div>
              <div class="form-group">
                <label class="control-label">BCC</label>
                <input type="text" name="bcc" placeholder="you@domain.com" class="form-control">
              </div>
              <?php if(count(Auth::user()->cannedResponses) > 0): ?>
              <select name="selectCanned" class="form-control m-b" id="insertCannedResponse" onChange="insertMessage(this.value);">
                <option value="0">--- <?php echo trans('app.'.'canned_responses'); ?> ---</option>
                <?php $__currentLoopData = Auth::user()->cannedResponses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($template->id); ?>"><?php echo e($template->subject); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <?php endif; ?>
              <div class="form-group">
                <label class="control-label"><?php echo trans('app.'.'message'); ?> <span class="text-danger">*</span></label>
                <textarea name="message" class="form-control markdownEditor" id="cannedResponse"></textarea>
              </div>
              
              <div class="form-group display-none" id="queueLater">
                <label><?php echo e(langapp('schedule')); ?></label>
                <div class="input-group date">
                  <input type="text" class="form-control datetimepicker-input"
                  value="<?php echo e(timePickerFormat(now())); ?>" name="later_date"
                  data-date-format="DD-MM-YYYY hh:mm A" data-date-start-date="0d">
                  <div class="input-group-addon">
                    <?php echo e(svg_image('solid/calendar-alt', 'text-muted')); ?>
                  </div>
                </div>
              </div>
              
              
              
            </div>
            <div class="panel-footer">
              <?php echo renderAjaxButton('send'); ?>

              <a href="#" id="sendLater" class="btn btn-sm btn-success btn-rounded pull-right"><?php echo e(svg_image('solid/clock')); ?> Send Later</a>
            </div>
            <?php echo Form::close(); ?>

          </section>
          
          
        </div>
      </section>
    </section>
  </aside>
</section>
</section>
<?php $__env->startPush('pagestyle'); ?>
<?php echo $__env->make('stacks.css.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('stacks.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('pagescript'); ?>
<?php echo $__env->make('stacks.js.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('stacks.js.markdown', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('stacks.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript">
$('.datetimepicker-input').datetimepicker({showClose: true, showClear: true, minDate: moment() });
$( "#sendLater" ).click(function() {
$("#queueLater").show("fast");
  $( ".datetimepicker-input" ).focus();
});
function insertMessage(d) {
axios.post('<?php echo e(route('extras.canned_responses')); ?>', {
  "response_id": d
})
.then(function (response) {
  $("textarea#cannedResponse").html(response.data.message);
})
.catch(function (error) {
  toastr.error('Oops! Request failed to complete.', '<?php echo trans('app.'.'response_status'); ?> ');
});
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>