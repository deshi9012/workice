<section class="panel panel-default">
        <header class="panel-heading padder-v">
                <?php echo e(svg_image('solid/language')); ?> <?php echo trans('app.'.'translations'); ?>

                

                <a data-rel="tooltip" data-toggle="ajaxModal" data-original-title="Restore Translations" class="btn btn-sm btn-warning pull-right" data-placement="left"
                               href="<?php echo e(route('translations.upload')); ?>">
                           Restore
                            </a>
                <a data-rel="tooltip" data-original-title="Backup Translations" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?> pull-right" data-placement="left"
                               href="<?php echo e(route('translations.download')); ?>">
                           Backup
                            </a>
                <a data-rel="tooltip" data-toggle="ajaxModal" data-original-title="New Language" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?> pull-right" data-placement="left"
                               href="<?php echo e(route('languages.create')); ?>"><?php echo e(svg_image('solid/plus')); ?> <?php echo trans('app.'.'create'); ?>
                </a>
                            
            </header>
        <div class="table-responsive">
            <table id="table-translations" class="table table-striped language-list">
                <thead>
                <tr>
                    <th><?php echo trans('app.'.'language'); ?></th>
                    <th><?php echo trans('app.'.'progress'); ?></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = App\Entities\Language::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr id="language-<?php echo e($l->id); ?>">
                        <td class=""><?php echo e(ucwords(str_replace('_', ' ', $l->name))); ?></td>
                        <td>
                            <?php $bar = 'danger';
                            if ($l->progress > 20) {
                                $bar = 'warning';
                            }
                            if ($l->progress > 50) {
                                $bar = 'info';
                            }
                            if ($l->progress > 80) {
                                $bar = 'success';
                            } ?>
                            <div class="progress progress-sm">
                                <div class="progress-bar progress-bar-<?php echo e($bar); ?>" role="progressbar" aria-valuenow="<?php echo e($l->progress); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($l->progress); ?>%;">
                                    <?php echo e($l->progress); ?>%
                                </div>
                            </div>
                        </td>
                        <td class="text-right">
                            
                            <a data-rel="tooltip"
                               data-original-title="<?php echo e(($l->active == 1 ? langapp('deactivate') : langapp('activate'))); ?>"
                               class="active-translation btn btn-xs btn-<?php echo e(($l->active == 0 ? 'default' : 'success')); ?>" data-href="<?php echo e(route('translations.status', ['name' => $l->code])); ?>">
                               <?php echo e(svg_image('solid/eye')); ?>
                           </a>
                            <a data-rel="tooltip" data-original-title="<?php echo trans('app.'.'edit'); ?>" class="btn btn-xs btn-default"
                               href="<?php echo e(route('translations.view', $l->code)); ?>">
                           <?php echo e(svg_image('solid/pencil-alt')); ?>
                            </a>
                            <a href="#" class="btn btn-xs btn-default deleteComment" data-language-id="<?php echo e($l->id); ?>" title="<?php echo trans('app.'.'delete'); ?>">
                                <?php echo e(svg_image('solid/trash-alt')); ?>
                            </a>
                            
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
            </table>
        </div>
    </section>

<?php $__env->startPush('pagestyle'); ?>
<?php echo $__env->make('stacks.css.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('pagescript'); ?>
<?php echo $__env->make('stacks.js.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('stacks.js.activate_lang', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
    $('.language-list').on('click', '.deleteComment', function (e) {
            e.preventDefault();
            var tag, id;

            tag = $(this);
            id = tag.data('language-id');

            if(!confirm('Do you want to delete this message?')) {
                return false;
            }
            axios.post('<?php echo e(route('languages.delete')); ?>', {
                id: id
            })
            .then(function (response) {
                    toastr.warning( response.data.message , '<?php echo trans('app.'.'response_status'); ?> ');
                    $('#language-' + id).hide(500, function () {
                        $(this).remove();
                    });
            })
            .catch(function (error) {
                toastr.error( 'Oop! Something went wrong!' , '<?php echo trans('app.'.'response_status'); ?> ');
        }); 

        });
</script>
<?php $__env->stopPush(); ?>
