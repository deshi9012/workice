<script type="text/javascript">

        $(document).ready(function () {

            $('.task_complete input[type="checkbox"]').change(function () {

                var id = $(this).data().id;
                var progress = $(this).is(":checked");

                var formData = {
                    'id': id,
                    'done': progress,
                };
                 axios.post('/api/v1/tasks/'+id+'/progress', formData)
                .then(function (response) {
                    toastr.success(response.data.message, '@langapp('response_status') ');
                  })
                  .catch(function (error) {
                    toastr.error('There was an error processing your request.' , '@langapp('response_status') ');
                }); 
            });

        });
    </script>
