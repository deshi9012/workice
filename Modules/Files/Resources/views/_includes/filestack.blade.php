<script type="text/javascript">
  
  var fsClient = filestack.init('{{ get_option('filestack_api_key') }}');
  function openPicker() {
    fsClient.pick({
      maxFiles: 10,
      startUploadingWhenMaxFilesReached: true,
      fromSources:["local_file_system","url","facebook","instagram","googledrive","dropbox","flickr","box","onedrive","clouddrive"]
    }).then(function(response) {
      handleFilestack(response);
    });
  }
  function handleFilestack(response) {
    $('#filestack').val(JSON.stringify(response.filesUploaded));
    $( "#uploadedFiles" ).append( '<div class=\"alert alert-info\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button><i class=\"fa fa-info-sign\"></i>'+ $(response.filesUploaded).length +' Files uploaded add a title/description.</div>' );
    $('#filePicker').hide('slow');
  }
</script>