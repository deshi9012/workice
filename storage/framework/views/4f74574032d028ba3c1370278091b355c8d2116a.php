<div class="alert alert-primary alert-bordered">
    <button class="close" data-dismiss="alert" type="button">
        <span>×</span>
        <span class="sr-only">
            Close
        </span>
    </button>
    <?php echo trans('app.'.'amount_displayed_in_your_cur'); ?>
    <a class="alert-link" href="<?php echo e(route('settings.edit', ['section' => 'system'])); ?>">
        <?php echo e(get_option('default_currency')); ?>

    </a>
</div>