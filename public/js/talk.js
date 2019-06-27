$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('#talkSendMessage').on('submit', function(e) {
        $(".formSaving").html('Processing..<i class="fa fa-spin fa-spinner"></i>');

        e.preventDefault();
        var url, request, tag, data;
        tag = $(this);
        url = '/messages/ajax-send';
        data = tag.serialize();

        request = $.ajax({
            method: "post",
            url: url,
            data: data
        });

        request.done(function (response) {
            if (response.status == 'success') {
                $('#talkMessages').append(response.html);
            	toastr.info( response.message , 'Response');
                $(".formSaving").html('<i class="fa fa-paper-plane"></i> Send</span>');
                tag[0].reset();
            }
        });

        request.fail(function (data) {
            var errors = data.responseJSON.errors;
            var errorsHtml= '';
            $.each( errors, function( key, value ) {
                errorsHtml += '<li>' + value[0] + '</li>'; 
            });
            toastr.error( errorsHtml , 'Notification');
            $(".formSaving").html('<i class="fa fa-refresh"></i> Try Again</span>');
        });

    });


    $('body').on('click', '.talkDeleteMessage', function (e) {
        e.preventDefault();
        var tag, url, id, request;

        tag = $(this);
        id = tag.data('message-id');
        url = '/messages/ajax-delete/' + id;

        if(!confirm('Do you want to delete this message?')) {
            return false;
        }

        request = $.ajax({
            method: "post",
            url: url,
            data: {"method": "DELETE"}
        });

        request.done(function(response) {
           if (response.status == 'success') {
           	toastr.info( response.message , 'Notification');
                $('#message-' + id).hide(500, function () {
                    $(this).remove();
                });
           }
        });
    })
});
