<div class="col-lg-12">
    <section class="m-xs">
        <section class="comment-list block">


            <article class="comment-item" id="comment-form">
                <a class="pull-left thumb-sm avatar">
                    <img src="<?php echo e(avatar()); ?>" class="img-circle">
                </a>
                <span class="arrow left"></span>
                <section class="comment-body">
                    <section class="panel panel-default">

                        <?php echo app('arrilot.widget')->run('Comments\CreateWidget', ['commentable_type' => 'leads' , 'commentable_id' => $lead->id]); ?>
                        
            
                    </section>
                </section>
            </article>


            <?php echo app('arrilot.widget')->run('Comments\ShowComments', ['comments' => $lead->comments]); ?>

            

        </section>
    </section>
</div>

<?php echo $__env->make('comments::_ajax.ajaxify', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>