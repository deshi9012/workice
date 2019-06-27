<script type="text/javascript">

        $(document).ready(function () {

            $('.todo_complete input[type="checkbox"]').change(function () {

                var id = $(this).data().id;
                var todo_complete = $(this).is(":checked");

                var formData = {
                    'id': id,
                    '_token': '{{ csrf_token() }}',
                    'complete': todo_complete
                };
                $.ajax({
                    type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                    url: '{{ route('todo.status') }}', // the url where we want to POST
                    data: formData, // our data object
                    dataType: 'json', // what type of data do we expect back from the server
                    encode: true
                })
                // using the done promise callback
                    .done(function (data) {

                        if (!data.success) {
                            alert('There was a problem with AJAX');
                        } else {
                            toastr.info(data.message, '@langapp('response_status')');
                        }

                        // here we will handle errors and validation messages
                    });

            });

            $('body').on('click', '.todoDelete', function (e) {
                e.preventDefault();
                var tag, url, id, request;

                tag = $(this);
                id = tag.data('todo-id');
                url = '/todos/destroy/' + id;

                if(!confirm('Do you want to delete this note?')) {
                    return false;
                }

                request = $.ajax({
                    method: "post",
                    url: url,
                    data: {"id": id, '_token': '{{ csrf_token() }}'}
                });

                request.done(function(response) {
                    if (response.status == 'success') {
                        toastr.info( response.message , '@langapp('response_status') ');
                        $('#todo-' + id).hide(500, function () {
                            $(this).remove();
                        });
                    }
                });
            });

        });
</script>