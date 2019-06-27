<div id="commentMessages" class="with-responsive-img">
    <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($comment->isVisible()): ?>
    <article id="comment-<?php echo e($comment->id); ?>" class="comment-item">
        <a class="pull-left thumb-sm avatar">
            <img src="<?php echo e($comment->user->profile->photo); ?>" class="img-circle">
        </a>
        <span class="arrow left"></span>
        <section class="comment-body panel panel-default <?php echo e($comment->user_id != Auth::id() ? 'comment-bg' : ''); ?>">
            <header class="panel-heading bg-white">
                <a href="#">
                    <?php echo e($comment->user->name); ?>

                </a>
                <?php if($comment->unread == 1 && $comment->user_id != Auth::id()): ?>
                <span class="label label-danger"><?php echo e(svg_image('solid/envelope-open')); ?> New</span>
                <?php endif; ?>
                <?php if($comment->is_note === 1): ?>
                <span class="m-l-xs text-danger">
                    ---- <?php echo e(svg_image('solid/sticky-note')); ?> Internal Note ----
                </span>
                <?php else: ?>
                <label class="label bg-light m-l-xs">
                    <?php echo e($comment->user->profile->job_title); ?> <?php echo e($comment->user->profile->company > 0 ? ' - '.$comment->user->profile->business->name : ''); ?>

                </label>
                <?php endif; ?>
                
                <span class="text-muted m-l-sm pull-right">
                    <?php if($comment->user_id == Auth::id() || can('comments_delete')): ?>
                    <a href="#" class="deleteComment" data-comment-id="<?php echo e($comment->id); ?>" title="<?php echo trans('app.'.'delete'); ?>">
                        <?php echo e(svg_image('solid/trash-alt', 'pull-right')); ?>
                    </a>
                    <?php endif; ?>
                </span>
                
            </header>
            <div class="panel-body">
                <?php if($comment->is_note === 1): ?>
                <blockquote class="comment-note">
                    <?php echo parsedown(str_replace('[NOTE]', '' , $comment->message)); ?>
                </blockquote>
                <?php else: ?>
                <div class="text-justify">
                    <?php echo parsedown($comment->message); ?>
                </div>
                <?php endif; ?>
                
                <?php if($withReplies): ?>
                <a href="<?php echo e(route('comments.reply', ['id' => $comment->id, 'module' => $comment->module])); ?>"
                    data-toggle="ajaxModal" class="pull-right" data-rel="tooltip" title="<?php echo trans('app.'.'reply'); ?> ">
                    <?php echo e(svg_image('solid/comments')); ?>
                </a>
                
                <?php endif; ?>
                <?php if($comment->user_id == Auth::id()): ?>
                <a href="<?php echo e(route('comments.edit', ['id' => $comment->id])); ?>" data-toggle="ajaxModal" class="pull-right m-r-sm" data-rel="tooltip" title="<?php echo trans('app.'.'edit'); ?> ">
                    <?php echo e(svg_image('solid/pencil-alt')); ?>
                </a>
                <?php endif; ?>
                <div class="comment-action m-t-sm">
                    <small class="block text-muted"><?php echo e(svg_image('solid/calendar-alt')); ?> <?php echo e(dateElapsed($comment->created_at)); ?></small>
                </div>
                <?php echo $__env->make('partial._show_files', ['files' => $comment->files, 'limit' => true], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                
                
            </div>
            <?php if($withReplies): ?>
            <?php if($comment->replies->count() > 0): ?>
            <div class="panel-body">
                <?php echo app('arrilot.widget')->run('Comments\ShowComments', ['comments' => $comment->replies]); ?>
            </div>
            <?php endif; ?>
            <?php endif; ?>
        </section>
        
        
    </article>
    <?php $comment->markRead();  ?>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php if($comments->count() === 0): ?>
    <article id="comment-id-1" class="comment-item">
        <section class="comment-body panel-default">
            
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <?php echo e(svg_image('solid/info-circle')); ?> <?php echo trans('app.'.'no_comments_found'); ?>
            </div>
            
        </section>
    </article>
    <?php endif; ?>
    
</div>