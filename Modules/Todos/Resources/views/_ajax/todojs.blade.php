@push('pagescript')
	<script>

        $('#createTodo').on('submit', function(e) {
            $(".formSaving").html('Processing..<i class="fas fa-spin fa-spinner"></i>');

            e.preventDefault();
            var tag, data;
            tag = $(this);
            data = tag.serialize();

            axios.post('{{ route('todos.api.save') }}', data)
            .then(function (response) {
                    $('.todo-list').prepend(response.data.html);
                    toastr.success( response.data.message , '@langapp('response_status') ');
                    $(".formSaving").html('<i class="fas fa-save"></i> @langapp('save') </span>');
                    tag[0].reset();
            })
            .catch(function (error) {
                var errors = error.response.data.errors;
                var errorsHtml= '';
                $.each( errors, function( key, value ) {
                errorsHtml += '<li>' + value[0] + '</li>';
                });
                toastr.error( errorsHtml , '@langapp('response_status') ');
                $(".formSaving").html('<i class="fas fa-sync"></i> Try Again');
        });

        });

        $('.dd-item input[type="checkbox"]').change(function () {
                var id = $(this).data().id;
                var complete = $(this).is(":checked");

            axios.post('/api/v1/todos/'+id+'/status', {
                    id: id,
                    complete: complete
            })
            .then(function (response) {
                    toastr.success(response.data.message, '@langapp('response_status') ');
                    $(".progress-bar").css("width", response.data.percentage+'%');
                    $('.progress-bar').attr('data-original-title', response.data.percentage+'%');
                    $("#task-id-"+response.data.todo).removeClass().addClass('text-semibold text-'+response.data.status);
            })
            .catch(function (error) {
                toastr.error( 'Oops! Something went wrong!' , '@langapp('response_status') ');
        });

        });

        $("#checkAll").click(function(){
            if($("#checkAll").is(':checked')){
                $(':checkbox.checkItem').prop('checked', this.checked);

            var id = $(this).attr("data-id");
            var type = $("#checkAll").attr("name");
             axios.post('{{ route('todos.api.done') }}', {
                id: id,
                module: type
                })
              .then(function (response) {
                toastr.success( response.data.message , '@langapp('response_status') ');
              })
              .catch(function (error) {
                toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
              });
        }
        });

		$('.todo-list').on('click', '.deleteTodo', function (e) {
            e.preventDefault();
            var tag, id;

            tag = $(this);
            id = tag.data('todo-id');

            if(!confirm('Do you want to delete this message?')) {
                return false;
            }

            axios.delete('/api/v1/todos/'+id, {
                    id: id,
            })
            .then(function (response) {
                    toastr.warning( response.data.message , '@langapp('response_status') ');
                    $('#todo-' + id).hide(500, function () {
                        $(this).remove();
                    });
            })
            .catch(function (error) {
                toastr.error( 'Oops! Something went wrong!' , '@langapp('response_status') ');
        });

        });
	</script>
@endpush