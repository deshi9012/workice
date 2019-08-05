<?php $__env->startPush('pagestyle'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(getAsset('plugins/datepicker/daterangepicker.css')); ?>" /> 
<?php $__env->stopPush(); ?> 
<?php $__env->startPush('pagescript'); ?>
<script type="text/javascript" src="<?php echo e(getAsset('plugins/datepicker/daterangepicker.min.js')); ?>"></script>
<script type="text/javascript">
	$('#reportrange').daterangepicker({
        locale: {
            format: 'MMMM D, YYYY'
        },
        startDate: '<?php echo e($start_date); ?>',
        endDate: '<?php echo e($end_date); ?>',
        "opens": "right",
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

</script>

<?php $__env->stopPush(); ?> 