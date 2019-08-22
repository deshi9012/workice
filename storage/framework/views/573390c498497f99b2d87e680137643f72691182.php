<section class="panel panel-default">
    <header class="panel-heading"><?php echo e(svg_image('solid/list')); ?> <?php echo trans('app.'.'menu_settings'); ?>  </header>
    <div class="panel-body">


       
                <div class="table-responsive">
                    <table id="menu-main" class="table table-striped b-t b-light table-menu sorted_table">
                        <thead>
                        <tr>
                            <th></th>
                            <th class="col-xs-2"><?php echo trans('app.'.'icon'); ?></th>
                            <th class="col-xs-8"><?php echo trans('app.'.'menu'); ?></th>
                            <th class="col-xs-2"><?php echo trans('app.'.'visible'); ?></th>
                        </tr>
                        </thead>
                        <tbody>

<?php 
    $menu = App\Entities\Hook::with('children')->whereHook('main_menu')->orderBy('order', 'asc')->get();
?>
            <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                      <tr class="sortable" data-module="<?php echo e($adm->module); ?>" data-access="1">
                                <td class="drag-handle"><?php echo e(svg_image('solid/bars')); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-default iconpicker-component" type="button">
                                            <i class="<?php echo e($adm->icon); ?> fa-fw"></i></button>
                                        <button data-toggle="dropdown" data-selected="<?php echo e($adm->icon); ?>"
                                                class="menu-icon icp icp-dd btn btn-default dropdown-toggle"
                                                type="button" aria-expanded="false" data-role="1"
                                                data-href="<?php echo e(route('menu.icon', ['module' => $adm->module])); ?>">
                                            <span class="caret"></span>
                                        </button>
                                        <div class="dropdown-menu iconpicker-container"></div>
                                    </div>
                                </td>
                                <td><?php echo trans('app.'.$adm->name); ?>  </td>
                                <td>
                                    <a data-rel="tooltip" data-original-title="<?php echo trans('app.'.'toggle'); ?>  "
                                       class="menu-view-toggle btn btn-xs btn-<?php echo e($adm->visible == 1 ? 'info' : 'default'); ?>"
                                       href="#" data-role="1"
                                       data-href="<?php echo e(route('menu.visible', ['module' => $adm->module])); ?>">
                                       <?php echo e(svg_image('solid/eye')); ?>
                                    </a>
                                </td>
                            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>
            
            
    </div>
</section>


<?php $__env->startPush('pagestyle'); ?>
<link rel="stylesheet" href="<?php echo e(getAsset('plugins/iconpicker/fontawesome-iconpicker.min.css')); ?>" type="text/css"/>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('pagescript'); ?>
    <?php echo $__env->make('stacks.js.iconpicker', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('stacks.js.menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('stacks.js.sortable', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>