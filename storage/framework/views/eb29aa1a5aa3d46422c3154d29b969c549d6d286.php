<?php $__env->startSection('content'); ?>
<section id="content" class="bg">
    <section class="hbox stretch">
        <section class="vbox">
            <header class="header panel-heading b-b bg-white">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('menu_users')): ?>
                <a href="<?php echo e(route('users.index')); ?>" class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm">
                    <?php echo e(svg_image('solid/user-circle')); ?>
                    Operators
                    
                </a>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('roles_create')): ?>
                <a href="<?php echo e(route('users.perm.create')); ?>" data-toggle="ajaxModal" class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm pull-right">
                    <?php echo e(svg_image('solid/plus')); ?> <?php echo trans('app.'.'create'); ?>
                </a>
                <?php endif; ?>
            </header>
            <section class="scrollable wrapper">
                <section class="panel panel-default">
                    <div class="table-responsive">
                        <table class="table table-striped" id="permissions-table">
                            <thead>
                                <tr>
                                    <th class=""><?php echo trans('app.'.'name'); ?>  </th>
                                    <th class=""><?php echo trans('app.'.'description'); ?>  </th>
                                    <th class=""></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = Spatie\Permission\Models\Permission::getPermissions([]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(humanize($permission->name)); ?></td>
                                    <td class="text-muted"><?php echo e($permission->description); ?></td>
                                    <td>
                                        
                                        <a href="<?php echo e(route('users.perm.edit', ['id' => $permission->id])); ?>" class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-xs" data-toggle="ajaxModal">
                                            <?php echo e(svg_image('solid/pencil-alt')); ?>
                                        </a>
                                        <a href="<?php echo e(route('users.perm.delete', ['id' => $permission->id])); ?>" class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-xs" data-toggle="ajaxModal">
                                            <?php echo e(svg_image('solid/trash-alt')); ?>
                                        </a>
                                        
                                    </td>
                                    
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    
                </section>
            </section>
        </section>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
<?php $__env->startPush('pagestyle'); ?>
<?php echo $__env->make('stacks.css.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('pagescript'); ?>
<?php echo $__env->make('stacks.js.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
$(function() {
    var table = $('#permissions-table').DataTable({
    processing: true,
    order: [[ 0, "asc" ]],
});
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>