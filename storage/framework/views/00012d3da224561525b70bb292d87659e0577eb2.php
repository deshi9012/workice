<?php $__env->startPush('pagescript'); ?>
<script>
        $('#sendComment').on('submit', function(e) {
            $(".formSaving").html('Processing..<i class="fas fa-spin fa-spinner"></i>');
            e.preventDefault();
            var url, tag;
            tag = $(this);
            var formData = new FormData($(this)[0]);

             axios.post('<?php echo e(route('comments.ajaxsend')); ?>', formData)
            .then(function (response) {
                    $('#commentMessages').prepend(response.data.html);
                    toastr.success( response.data.message , '<?php echo trans('app.'.'response_status'); ?> ');
                    $(".formSaving").html('<i class="fas fa-paper-plane"></i> <?php echo trans('app.'.'send'); ?> </span>');
                    tag[0].reset();
            })
            .catch(function (error) {
                var errors = error.response.data.errors;
                var errorsHtml= '';
                $.each( errors, function( key, value ) {
                errorsHtml += '<li>' + value[0] + '</li>';
                });
                toastr.error( errorsHtml , '<?php echo trans('app.'.'response_status'); ?> ');
                $(".formSaving").html('<i class="fas fa-sync"></i> <?php echo trans('app.'.'try_again'); ?>');
        });    

        });


        $('.comment-list').on('click', '.deleteComment', function (e) {
            e.preventDefault();
            var tag, id;

            tag = $(this);
            id = tag.data('comment-id');

            if(!confirm('Do you want to delete this message?')) {
                return false;
            }
            axios.post('<?php echo e(route('comments.ajaxdelete')); ?>', {
                id: id
            })
            .then(function (response) {
                    toastr.warning( response.data.message , '<?php echo trans('app.'.'response_status'); ?> ');
                    $('#comment-' + id).hide(500, function () {
                        $(this).remove();
                    });
            })
            .catch(function (error) {
                toastr.error( 'Oop! Something went wrong!' , '<?php echo trans('app.'.'response_status'); ?> ');
        }); 

        });

</script>
<?php $__env->stopPush(); ?>