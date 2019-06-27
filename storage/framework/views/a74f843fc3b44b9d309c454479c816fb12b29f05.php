<script src="<?php echo e(getAsset('plugins/datepicker/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(getAsset('plugins/datepicker/locales/bootstrap-datepicker.'.datePickerLocale().'.min.js')); ?>" charset="UTF-8"></script>
<script src="<?php echo e(getAsset('plugins/datepicker/bootstrap-datetimepicker.js')); ?>"></script>
<script type="text/javascript">
$('.datepicker-input').datepicker({
    todayHighlight: true,
    todayBtn: "linked",
    language: '<?php echo e(datePickerLocale()); ?>',
    autoclose: true
});
</script>