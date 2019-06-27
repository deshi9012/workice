<script src="{{ getAsset('plugins/select2/select2.min.js') }}"></script>
<script src="{{ getAsset('plugins/select2/i18n/'.editorLocale().'.js') }}"></script>
<script src="{{ getAsset('plugins/validator/validator.min.js') }}"></script>
<script>
    $('.select2-option').select2({
    	language: '{{ editorLocale() }}',
    	theme: "bootstrap"
    });
    $(".select2-tags").select2({
            tags: true,
            language: '{{ editorLocale() }}'
    });
    $('.validator').validator();
    
</script>