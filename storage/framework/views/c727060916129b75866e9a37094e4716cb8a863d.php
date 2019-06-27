<section class="">
  
  <div class="chat-history">
    <article class="chat-item chat-message clearfix" id="chat-form">
      <a class="pull-left thumb-sm avatar">
      <img src="<?php echo e(avatar()); ?>" class="img-circle"></a>
      <section class="chat-body">
        <?php echo Form::open(['route' => ['leads.email', $lead->id], 'class' => 'bs-example ajaxifyForm m-b-none', 'id' => 'sendMail', 'data-toggle' => 'validator', 'files' => true]); ?>

        <input type="hidden" name="to" value="<?php echo e($lead->id); ?>">
        <input type="hidden" name="from" value="<?php echo e($lead->sales_rep); ?>">
        <div class="form-group">
          <label class="control-label"><?php echo trans('app.'.'subject'); ?> <span class="text-danger">*</span></label>
          <input type="text" name="subject" value="<?php echo e(optional($lead->emails->last())->subject); ?>" class="form-control">
        </div>
        <textarea name="message" id="cannedResponse" class="form-control markdownEditor" placeholder="Message"></textarea>
        <input type="file" class="form-control" name="uploads[]" multiple="">
        <div class="line"></div>
        <?php if(count(Auth::user()->cannedResponses) > 0): ?>
        <select name="selectCanned" class="form-control m-b" id="insertCannedResponse" onChange="insertMessage(this.value);">
          <option value="0">--- <?php echo trans('app.'.'canned_responses'); ?> ---</option>
          <?php $__currentLoopData = Auth::user()->cannedResponses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($template->id); ?>"><?php echo e($template->subject); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php endif; ?>
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

        <a href="#" id="sendLater" class="btn btn-sm btn-warning btn-rounded pull-right"><?php echo e(svg_image('solid/clock')); ?> Send Later</a>
        
        <?php echo Form::close(); ?>

      </section>
    </article>
    
    <section class="chat-list panel-body" id="msg-list">
      
      <?php echo $__env->make('messages::partials.search', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      
      <ul id="leadConversations" class="list">
        <?php $__currentLoopData = $lead->emails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
        <article id="message-<?php echo e($message->id); ?>" class="chat-item <?php echo e($message->from == $lead->sales_rep ? 'left' : 'right'); ?>">
          <a href="#" class="pull-<?php echo e($message->from == $lead->sales_rep ? 'left' : 'right'); ?> thumb-sm avatar">
          <img src="<?php echo e(getAvatarImage($lead->name)); ?>" class="img-circle"></a>
          
          <section class="chat-body comment-body">
            <div class="panel b-light m-b-none" >
              <header class="panel-heading bg-white b-b">
                <a href="#" class="<?php echo e($message->opened ? 'text-success': ''); ?>"><?php echo e($message->subject); ?></a>
                <label class="label bg-info m-l-xs"><?php echo e($message->meta['sender']); ?></label>
                <span class="text-muted m-l-sm pull-right">
                  <?php echo e(svg_image('solid/clock')); ?> <?php echo e(dateElapsed($message->created_at)); ?>

                </span>
              </header>
              <div class="panel-body">
                <span class="arrow <?php echo e($message->from === $lead->sales_rep ? 'left' : 'right'); ?>"></span>
                <div class="message other-message float-right m-b-sm">
                  <?php echo parsedown($message->message); ?>
                </div>
                <?php echo $__env->make('partial._show_files', ['files' => $message->files], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <span class="message-data-name text-muted" >
                  <a href="#" class="deleteMessage" data-message-id="<?php echo e($message->id); ?>" title="@langappapp('delete')">
                    <?php echo e(svg_image('solid/trash', 'pull-right')); ?>
                  </a>
                  <?php if($message->from == $lead->sales_rep): ?>
                  <i class="fas fa-<?php echo e($message->opened > 0 ? 'envelope-open text-success' : 'envelope text-danger'); ?>" data-rel="tooltip" title="<?php echo e($message->opened >= 1 ? 'Email Viewed' : 'Not Viewed'); ?>"></i>
                  <?php endif; ?>
                </span>
                
              </div>
            </div>
            <small class="text-muted message-data-time small"><?php echo e(svg_image('solid/user-circle')); ?> <?php echo e($lead->name); ?>

            <span class="m-l-sm"><?php echo e(svg_image('solid/calendar-alt')); ?> <?php echo e(dateTimeFormatted($message->created_at)); ?></span>
            </small>
            
          </section>
        </article>
        
        <?php if($message->from != Auth::id()): ?>
        <?php echo e($message->markRead()); ?>

        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </section>
    
    
    
    
  </div>
  
</section>
<?php $__env->startPush('pagestyle'); ?>
<?php echo $__env->make('stacks.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('pagescript'); ?>
<?php echo $__env->make('stacks.js.list', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('stacks.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript">
$('.datetimepicker-input').datetimepicker({showClose: true, showClear: true, minDate: moment() });

$( "#sendLater" ).click(function() {
$("#queueLater").show("fast");
$( ".datetimepicker-input" ).focus();
});
var options = {
valueNames: [ 'message' ]
};
var msgList = new List('msg-list', options);
$('.chat-list').on('click', '.deleteMessage', function (e) {
e.preventDefault();
var tag, url, id, request;
tag = $(this);
id = tag.data('message-id');
url = '<?php echo e(route('leads.email.delete')); ?>';
if(!confirm('Do you want to delete this message?')) {
  return false;
}
request = $.ajax({
  method: "post",
  url: url,
  data: {
  id: id,
  _token: '<?php echo e(csrf_token()); ?>'
  }
});
request.done(function(response) {
if (response.status == 'success') {
toastr.info( response.message , '<?php echo trans('app.'.'response_status'); ?>');
  $('#message-' + id).hide(500, function () {
$(this).remove();
});
}
});
});
function insertMessage(d) {
axios.post('<?php echo e(route('extras.canned_responses')); ?>', {
  "response_id": d
})
.then(function (response) {
  $("textarea#cannedResponse").val(response.data.message);
})
.catch(function (error) {
  toastr.error('Oops! Request failed to complete.', '<?php echo trans('app.'.'response_status'); ?> ');
});
}
</script>
<?php $__env->stopPush(); ?>