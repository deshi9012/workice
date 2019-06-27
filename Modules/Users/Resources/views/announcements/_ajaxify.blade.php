@push('pagescript')
<script>
    $(document).ready(function () {

        $('#save-announcement').on('submit', function(e) {
            $(".formSaving").html('Processing..<i class="fas fa-spin fa-spinner"></i>');

            e.preventDefault();
            var tag, data;
            tag = $(this);
            data = tag.serialize();

             axios.post($(this).attr("action"), data)
            .then(function (response) {
                    $('#announcement-list').prepend(response.data.html);
                    toastr.success( response.data.message , '@langapp('response_status') ');
                    $(".formSaving").html('<i class="fas fa-paper-plane"></i> @langapp('save') </span>');
                    tag[0].reset();
                    window.location.href = response.data.redirect;
            })
            .catch(function (error) {
                var errors = error.response.data.errors;
                var errorsHtml= '';
                $.each( errors, function( key, value ) {
                    errorsHtml += '<li>' + value[0] + '</li>'; 
                });
                toastr.error( errorsHtml , '@langapp('response_status') ');
                $(".formSaving").html('<i class="fas fa-sync"></i> @langapp('try_again')</span>');
            });


        });


        $('.list').on('click', '.delete-announcement', function (e) {
            e.preventDefault();
            var tag, id, request;

            tag = $(this);
            id = tag.data('announcement-id');

            if(!confirm('Do you want to delete this message?')) {
                return false;
            }
            axios.delete('/api/v1/announcements/'+id)
            .then(function (response) {
                toastr.warning( response.data.message , '@langapp('response_status') ');
                $('#announcement-' + id).hide(500, function () {
                    $(this).remove();
                });
            })
            .catch(function (error) {
                toastr.error( 'Something went wrong please try again' , '@langapp('response_status') ');
            });

        })
    });

</script>
@endpush