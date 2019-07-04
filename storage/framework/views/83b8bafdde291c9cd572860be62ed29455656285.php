<?php $__env->startSection('content'); ?>
<section id="content">
    <section class="hbox stretch">
        <aside>
            <section class="vbox">
                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-5 m-b-xs">
                            <span class="h3"><?php echo e(__('CSV Map Fields')); ?> </span>
                        </div>
                        <div class="col-sm-7 m-b-xs">
                            <a href="<?php echo e(route('leads.export')); ?>" class="btn btn-sm btn-info pull-right">
                                <?php echo e(svg_image('solid/cloud-download-alt')); ?> CSV
                            </a>
                        </div>
                    </div>
                </header>
                <section class="scrollable wrapper bg">
                    <section class="panel panel-default">
                        <div class="panel-body">
                            <?php echo Form::open(['route' => 'leads.csvprocess', 'class' => 'form-horizontal ajaxifyForm']); ?>

                            <?php $__env->startComponent('components.csv-note'); ?> <?php echo $__env->renderComponent(); ?>
                            <input type="hidden" name="csv_data_file_id" value="<?php echo e($csv_data_file->id); ?>" />
                            <div class="table-responsive">
                                <table class="table table-striped" id="csvmap">
                                    <thead>
                                        <?php if(isset($csv_header_fields)): ?>
                                        <tr>
                                            <?php $__currentLoopData = $csv_header_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $csv_header_field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <th><?php echo e(humanize($csv_header_field)); ?></th>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tr>
                                        <?php endif; ?>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $csv_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td><?php echo e(is_numeric($value) ? sprintf('%.0f', $value) : $value); ?></td>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <?php $__currentLoopData = $csv_data[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td>
                                                <select name="fields[<?php echo e($key); ?>]" class="form-control">
                                                    <option value="-">No Selection</option>
                                                    <?php $__currentLoopData = config('db-fields.lead'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $db_field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e((\Request::has('header')) ? $db_field : $loop->index); ?>" <?php if($key === $db_field): ?> selected <?php endif; ?>><?php echo e($db_field); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="pull-right m-sm">
                                <?php echo renderAjaxButton('import', 'fa fa-cloud-upload', true); ?>

                            </div>
                            <?php echo Form::close(); ?>

                        </div>
                    </div>
                </section>
            </section>
        </section>
    </aside>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>

<?php $__env->startPush('pagescript'); ?>
<?php echo $__env->make('stacks.js.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script type="text/javascript">
$(document).ready(function() {
$('#csvmap').DataTable( {
    "paging":   false,
    "searching": false,
} );
} );
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>