<?php echo Form::open(['route' => 'comments.create', 'novalidate' => '', 'id' => 'sendComment', 'files' => true]); ?>

<input type="hidden" name="commentable_id" value="<?php echo e($commentable_id); ?>">
<input type="hidden" name="commentable_type" value="<?php echo e($commentable_type); ?>">
<input type="hidden" name="user_id" value="<?php echo e(Auth::id()); ?>">
<textarea class="form-control markdownEditor" name="message" id="comment-editor" data-id="<?php echo e($commentable_id); ?>" required <?php echo e(isCommentLocked($commentable_type, $commentable_id) ? 'disabled' : ''); ?>></textarea>
<?php if($cannedResponse): ?>
<div class="m-xs">
    <?php if(count(Auth::user()->cannedResponses) > 0): ?>
    <select name="selectCanned" class="form-control m-b" id="insertCannedResponse" onChange="insertMessage(this.value);">
        <option value="0">--- <?php echo trans('app.'.'canned_responses'); ?> ---</option>
        <?php $__currentLoopData = Auth::user()->cannedResponses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($template->id); ?>"><?php echo e($template->subject); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php endif; ?>
</div>
<?php endif; ?>
<?php if($hasFiles): ?>
<input type="file" class="form-control no-border" name="uploads[]" multiple="" id="file-upload">
<?php endif; ?>

<?php if($commentable_type === 'tickets'): ?>
<div class="form-group">
    <div class="checkbox">
        <label>
            <input type="checkbox" name="reply_close" value="1">
            <span class="label-text"><?php echo trans('app.'.'reply_close'); ?></span>
        </label>
    </div>
</div>
<?php endif; ?>
<footer class="panel-footer bg-light lter">
    
    <?php echo renderAjaxButton('comment', 'fas fa-comment-dots'); ?>

<ul class="nav nav-pills nav-sm"></ul>
</footer>
<?php echo Form::close(); ?>

<?php if($cannedResponse): ?>
<script type="text/javascript">
function insertMessage(d) {
axios.post('<?php echo e(route('extras.canned_responses')); ?>', {
    "response_id": d
})
.then(function (response) {
    $("textarea#comment-editor").val(response.data.message);
})
.catch(function (error) {
    toastr.error('Oops! Request failed to complete.', '<?php echo trans('app.'.'response_status'); ?> ');
});
}
</script>
<?php endif; ?>