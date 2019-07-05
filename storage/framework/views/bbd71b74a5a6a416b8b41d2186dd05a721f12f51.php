<?php $__env->startSection('content'); ?>


<section id="content">
    <section class="hbox stretch">

            <section class="vbox">
                <section class="scrollable wrapper bg">
                    <section class="panel panel-default">

                        <header class="panel-heading">

                            <?php echo $__env->make('analytics::report_header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                        </header>

                        <div class="panel-body">

                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <?php echo e(svg_image('solid/info-circle')); ?> <?php echo trans('app.'.'amount_displayed_in_your_cur'); ?>  &nbsp;<span
                                        class="label label-success"><?php echo e(get_option('default_currency')); ?></span>
                            </div>




                            <?php echo $__env->make('analytics::_'.$module.'.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                            

                            


                        </div>

                    </section>
                </section>


            </section>

    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('pagescript'); ?>
    <script>
        $(".commandBtn").click(function() {
        command = $(this).data("id");
        axios.get('<?php echo e(url('/').'/settings/artisan/'.get_option('cron_key')); ?>/'+command)
        .then(function (response) {
            toastr.success(response.data.message, '<?php echo trans('app.'.'response_status'); ?> ');
        })
        .catch(function (error) {
            toastr.error('Failed to execute artisan command or disabled', '<?php echo trans('app.'.'response_status'); ?> ');
        });
    });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>