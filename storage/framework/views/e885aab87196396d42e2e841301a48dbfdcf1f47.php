<script src="<?php echo e(getAsset('plugins/select2/select2.min.js')); ?>"></script>
<script src="<?php echo e(getAsset('plugins/select2/i18n/'.editorLocale().'.js')); ?>"></script>
<script src="<?php echo e(getAsset('plugins/validator/validator.min.js')); ?>"></script>
<script>
    $('.select2-option').select2({
    	language: '<?php echo e(editorLocale()); ?>',
    	theme: "bootstrap"
    });
    $(".select2-tags").select2({
            tags: true,
            language: '<?php echo e(editorLocale()); ?>'
    });
    $('.validator').validator();
    
</script>