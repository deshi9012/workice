<table>
    <thead>
    <tr>
        <th><?php echo trans('app.'.'name'); ?></th>
        <th><?php echo trans('app.'.'job_title'); ?></th>
        <th><?php echo trans('app.'.'company'); ?></th>
        <th><?php echo trans('app.'.'source'); ?></th>
        <th><?php echo trans('app.'.'lead_score'); ?></th>
        <th><?php echo trans('app.'.'stage'); ?></th>
        <th><?php echo trans('app.'.'email'); ?></th>
        <th><?php echo trans('app.'.'phone'); ?></th>
        <th><?php echo trans('app.'.'mobile'); ?></th>
        <th><?php echo trans('app.'.'address1'); ?></th>
        <th><?php echo trans('app.'.'address2'); ?></th>
        <th><?php echo trans('app.'.'city'); ?></th>
        <th><?php echo trans('app.'.'state'); ?></th>
        <th><?php echo trans('app.'.'zipcode'); ?></th>
        <th><?php echo trans('app.'.'country'); ?></th>
        <th><?php echo trans('app.'.'timezone'); ?></th>
        <th><?php echo trans('app.'.'website'); ?></th>
        <th>Skype</th>
        <th>Facebook</th>
        <th>Twitter</th>
        <th>LinkedIn</th>
        <th><?php echo trans('app.'.'sales_rep'); ?></th>
        <th><?php echo trans('app.'.'lead_value'); ?></th>
        <th><?php echo trans('app.'.'created_at'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($lead->name); ?></td>
            <td><?php echo e($lead->job_title); ?></td>
            <td><?php echo e($lead->company); ?></td>
            <td><?php echo e($lead->AsSource->name); ?></td>
            <td><?php echo e($lead->score); ?></td>
            <td><?php echo e($lead->status->name); ?></td>
            <td><?php echo e($lead->email); ?></td>
            <td><?php echo e(formatPhoneNumber($lead->phone)); ?></td>
            <td><?php echo e($lead->mobile); ?></td>
            <td><?php echo e($lead->address1); ?></td>
            <td><?php echo e($lead->address2); ?></td>
            <td><?php echo e($lead->city); ?></td>
            <td><?php echo e($lead->state); ?></td>
            <td><?php echo e($lead->zip_code); ?></td>
            <td><?php echo e($lead->country); ?></td>
            <td><?php echo e($lead->timezone); ?></td>
            <td><?php echo e($lead->website); ?></td>
            <td><?php echo e($lead->skype); ?></td>
            <td><?php echo e($lead->facebook); ?></td>
            <td><?php echo e($lead->twitter); ?></td>
            <td><?php echo e($lead->linkedin); ?></td>
            <td><?php echo e($lead->agent->name); ?></td>
            <td><?php echo e(formatCurrency(get_option('default_currency'), $lead->lead_value)); ?></td>
            <td><?php echo e($lead->created_at->toIso8601String()); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>