<script src="{{ getAsset('plugins/wysiwyg/showdown.min.js') }}"></script>
@if (file_exists(asset('plugins/wysiwyg/locale/bootstrap-markdown.'.editorLocale().'.js')))
    <script src="{{ getAsset('plugins/wysiwyg/locale/bootstrap-markdown.'.editorLocale().'js') }}"></script>
@endif
<script type="text/javascript">
    $(document).ready(function () {
        $(".markdownEditor").markdown({
            autofocus: false,
            savable: false,
            iconlibrary: 'fa',
            language: '{{ editorLocale() }}',
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
