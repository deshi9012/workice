<header class="header b-b clearfix">
    <div class="row m-t-sm">
        <div class="col-sm-12 m-b-xs">

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('files_create')): ?>
                <a href="<?php echo e(route('files.upload', ['module' => 'leads', 'id' => $lead->id])); ?>"
                   class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm pull-right" data-toggle="ajaxModal"
                   data-placement="left" title="<?php echo trans('app.'.'upload_file'); ?>  ">
                    <?php echo e(svg_image('solid/cloud-upload-alt')); ?> <?php echo trans('app.'.'upload_file'); ?>  </a>
            <?php endif; ?>


        </div>
    </div>
</header>


<div class="">

    <?php echo $__env->make('partial._show_files', ['files' => $lead->files], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</div>

<?php if(settingEnabled('filestack_active')): ?>
<?php $__env->startPush('pagescript'); ?>
<script src="//static.filestackapi.com/v3/filestack.js"></script>
<?php $__env->stopPush(); ?>
<?php endif; ?>