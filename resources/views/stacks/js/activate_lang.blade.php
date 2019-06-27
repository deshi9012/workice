<script>
    $("#table-translations").on('click', '.active-translation', function (e) {
                e.preventDefault();
                var target = $(this).attr('data-href');
                var isActive = 0;
                if (!$(this).hasClass('btn-success')) {
                    isActive = 1;
                }
                $(this).toggleClass('btn-success').toggleClass('btn-default');

                 axios.post(target, {
                    active: isActive
                 })
            .then(function (response) {
                toastr.success(response.data.message, '@langapp('response_status') ');
                window.location.href = response.data.redirect;
          })
          .catch(function (error) {
            var errors = error.response.data.errors;
                var errorsHtml= '';
                $.each( errors, function( key, value ) {
                    errorsHtml += '<li>' + value[0] + '</li>'; 
                });
                toastr.error( errorsHtml , '@langapp('response_status') ');
        }); 

    });
</script>