<script src="{{ getAsset('plugins/wysiwyg/summernote.min.js') }}"></script>
@if (file_exists(asset('plugins/wysiwyg/lang/summernote-'.editorLocale().'.js')))
    <script src="{{ getAsset('plugins/wysiwyg/lang/summernote-'.editorLocale().'js') }}"></script>
@endif
<script type="text/javascript">
    $(document).ready(function() {
  		$('.htmleditor').summernote({
  			height: 300,
  			toolbar: [
					    // [groupName, [list of button]]
					    ['style', ['bold', 'italic', 'underline', 'clear']],
					    ['fontsize', ['fontsize']],
					    ['color', ['color']],
					    ['para', ['ul', 'ol', 'paragraph']],
					    ['height', ['height']]
					  ]
  		});
	});

</script>
