<a href="<?php echo e(route('reports.view', ['type' => 'reports', 'm' => 'invoices'])); ?>" class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm">
        <?php echo e(svg_image('solid/chart-line')); ?> <?php echo trans('app.'.'reports'); ?>
</a>