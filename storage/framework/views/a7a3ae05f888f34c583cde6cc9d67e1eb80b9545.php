<div class="panel panel-body border-top-teal">


            <?php echo Form::open(['route' => 'notes.save', 'class' => 'ajaxifyForm']); ?>

            <input type="hidden" name="noteable_type" value="<?php echo e($noteable_type); ?>">
            <input type="hidden" name="noteable_id" value="<?php echo e($noteable_id); ?>">
            <input type="hidden" name="user_id" value="<?php echo e(\Auth::id()); ?>">
            <input type="hidden" name="name" value="<?php echo e($title); ?>">
            <div class="form-group">
                <label><?php echo trans('app.'.'take_notes'); ?></label>
                <textarea name="description" class="form-control markdownEditor"></textarea>
            </div>
            <div class="text-right">
                <?php echo renderAjaxButton(); ?>

            </div>
            <?php echo Form::close(); ?>




            <div class="streamline streamline-dotted m-t-lg list-feed">

                
                <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="sl-item b-success" id="note-<?php echo e($note->id); ?>">
                    <div class="sl-icon"><i class="fas fa-file-alt"></i></div>
                    <div class="sl-content text-muted">

                        <div class="sl-author"><?php echo e($note->user->name); ?></div>

                <span class="pull-right sl-date">
                <a href="<?php echo e(route('notes.edit', ['id' => $note->id])); ?>" data-toggle="ajaxModal" class="m-r-xs">
                    <?php echo e(svg_image('solid/pencil-alt')); ?>
                </a>
                <a href="#" rel="tooltip" class="text-muted noteDelete" data-note-id="<?php echo e($note->id); ?>" title="<?php echo trans('app.'.'delete'); ?>">
                   <?php echo e(svg_image('solid/trash-alt')); ?>
                </a>
                </span>

                        <div class="sl-date text-muted">
                           <?php echo e(svg_image('solid/calendar-alt')); ?>
                            <?php echo e($note->created_at->diffForHumans()); ?>

                        </div>

                        <?php echo parsedown($note->description); ?>

                    <small class="sl-footer text-muted small">
                        <?php echo e(svg_image('solid/calendar-alt')); ?> <?php echo e(dateTimeFormatted($note->created_at)); ?>

                    </small>

                    </div>



                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               
        </div>

</div>

 <?php $__env->startPush('pagescript'); ?>
    <script>
        $('.list-feed').on('click', '.noteDelete', function (e) {
            e.preventDefault();
            var tag, url, id, request;

            tag = $(this);
            id = tag.data('note-id');
            url = '/notes/destroy-note/' + id;

            if (!confirm('Do you want to delete this note?')) {
                return false;
            }

            axios.post(url, {
                "id": id
            })
          .then(function (response) {
            toastr.info(response.data.message, "<?php echo trans('app.'.'notification'); ?> ");
                    $('#note-' + id).hide(500, function () {
                        $(this).remove();
                    });
          })
          .catch(function (error) {
            toastr.error('Oops! Request failed to complete.', '<?php echo trans('app.'.'response_status'); ?> ');
        });

            
        });
        
    </script>

    <?php $__env->stopPush(); ?>