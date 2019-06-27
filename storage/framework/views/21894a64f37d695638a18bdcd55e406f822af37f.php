<script src="<?php echo e(getAsset('plugins/wysiwyg/showdown.min.js')); ?>"></script>
<?php if(file_exists(asset('plugins/wysiwyg/locale/bootstrap-markdown.'.editorLocale().'.js'))): ?>
    <script src="<?php echo e(getAsset('plugins/wysiwyg/locale/bootstrap-markdown.'.editorLocale().'js')); ?>"></script>
<?php endif; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $(".markdownEditor").markdown({
            autofocus: false,
            savable: false,
            iconlibrary: 'fa',
            language: '<?php echo e(editorLocale()); ?>',
        })
    });
</script>
<script>
    var markdown = new showdown.Converter();
    markdown.setFlavor('github');
    markdown.toHTML = function (val) {
        return markdown.makeHtml(val);
    }
</script>
