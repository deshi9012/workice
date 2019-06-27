<script>
    $('.ajaxifyForm').submit(function (event) {
        $(".formSaving").html('Processing..<i class="fas fa-spin fa-spinner"></i>');
        event.preventDefault();

        var data = new FormData(this);

        axios.post($(this).attr("action"), data)
            .then(function (response) {
                    toastr.success(response.data.message, '@langapp('response_status') ');
                    $(".formSaving").html('<i class="fas fa-check"></i> @langapp('save') </span>');
                    window.location.href = response.data.redirect;
          })
          .catch(function (error) {
            if(error.response.data.exception){
                toastr.error('@langapp('request_failed')' , '@langapp('response_status') ');
                $(".formSaving").html('<i class="fas fa-sync"></i> @langapp('try_again')</span>');
            }else{
                var errors = error.response.data.errors;
                var errorsHtml= '';
                $.each( errors, function( key, value ) {
                    errorsHtml += '<li>' + value[0] + '</li>'; 
                });
                toastr.error( errorsHtml , '@langapp('response_status') ');
                $(".formSaving").html('<i class="fas fa-sync"></i> @langapp('try_again')</span>');
            }
            
            
        }); 
        
    });
</script>
