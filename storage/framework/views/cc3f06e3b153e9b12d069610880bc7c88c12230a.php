<script type="text/javascript" src="<?php echo e(getAsset('plugins/iconpicker/fontawesome-iconpicker.min.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#site-icon').iconpicker({hideOnSelect: true, placement: 'bottomLeft'});
            $('.menu-icon').iconpicker().on('iconpickerSelected', function (event) {
                var role = $(this).attr('data-role');
                var target = $(this).attr('data-href');
                $(this).siblings('div.iconpicker-container').hide();
                $.ajax({
                    url: target,
                    type: 'POST',
                    data: {icon: event.iconpickerValue, access: role, _token: '<?php echo e(csrf_token()); ?>'},
                    success: function (data) {
                        toastr.success(data.message, '<?php echo trans('app.'.'response_status'); ?> ');
                        window.location.href = data.redirect;
                    },
                    error: function (xhr) {
                    }
                });
            });
        });
    </script>