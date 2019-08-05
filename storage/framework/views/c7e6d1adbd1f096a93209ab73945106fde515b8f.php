<div class="table-responsive">
    <table id="table-invoices" class="table table-striped">
        <thead>
            <tr>
                <th><?php echo trans('app.'.'reference_no'); ?> </th>
                <th><?php echo trans('app.'.'client'); ?> </th>
                <th><?php echo trans('app.'.'due_date'); ?> </th>
                <th><?php echo trans('app.'.'paid'); ?> </th>
                <th><?php echo trans('app.'.'status'); ?> </th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><a href="<?php echo e(route('invoices.view', ['id' => $invoice->id])); ?>"><?php echo e($invoice->reference_no); ?></a></td>
                <td><a href="<?php echo e(route('clients.view', ['id' => $invoice->client_id])); ?>"><?php echo e(optional($invoice->company)->name); ?></a></td>
                <td><?php echo e(dateFormatted($invoice->due_date)); ?></td>
                <td><?php echo e(formatCurrency($invoice->currency, $invoice->paid_amount)); ?></td>
                <td><?php echo e($invoice->status); ?></td>
                
            </tr>
            
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->startPush('pagestyle'); ?>
<?php echo $__env->make('stacks.css.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('pagescript'); ?>
<?php echo $__env->make('stacks.js.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
$('#table-invoices').DataTable({
processing: true,
order: [[ 0, "desc" ]],
pageLength: 25
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->yieldPushContent('pagestyle'); ?>
<?php echo $__env->yieldPushContent('pagescript'); ?>