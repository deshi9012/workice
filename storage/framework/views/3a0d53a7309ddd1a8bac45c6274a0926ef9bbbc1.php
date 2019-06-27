<?php $__env->startPush('pagescript'); ?>
    <script>

        $('.call-list').on('click', '.deleteCall', function (e) {
            e.preventDefault();
            var tag, id;

            tag = $(this);
            id = tag.data('call-id');

            if(!confirm('Do you want to delete this call?')) {
                return false;
            }

            axios.delete('/api/v1/calls/'+id, {
                    id: id,
            })
            .then(function (response) {
                    toastr.warning( response.data.message , '<?php echo trans('app.'.'response_status'); ?> ');
                    $('#call-' + id).hide(500, function () {
                        $(this).remove();
                    });
            })
            .catch(function (error) {
                toastr.error( 'Oops! Something went wrong!' , '<?php echo trans('app.'.'response_status'); ?> ');
        });

        });
    </script>
<?php $__env->stopPush(); ?>