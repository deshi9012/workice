<?php $sort = strtoupper(get_option('date_picker_format')); ?>
    <script src="<?php echo e(getAsset('plugins/datatables/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(getAsset('plugins/datatables/dataTables.bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(getAsset('plugins/datatables/datetime-moment.js')); ?>"></script>

    <script>
        $(document).ready(function () {
        $.fn.dataTable.moment('<?php echo e($sort); ?>');
        $.fn.dataTable.moment('<?php echo e($sort); ?> HH:mm');

        $.extend( true, $.fn.dataTable.defaults, {
        "processing": true,
        "deferRender": true,
        "autoWidth": false,
        "pagingType": "full_numbers",
        "pageLength": <?php echo e(get_option('rows_per_table')); ?>,
        "language": {
                    "processing": "<?php echo trans('app.'.'processing'); ?> ",
                    "loadingRecords": "<?php echo trans('app.'.'loading'); ?> ",
                    "lengthMenu": "<?php echo trans('app.'.'show_entries'); ?> ",
                    "emptyTable": "<?php echo trans('app.'.'empty_table'); ?> ",
                    "info": "<?php echo trans('app.'.'pagination_info'); ?> ",
                    "infoEmpty": "<?php echo trans('app.'.'pagination_empty'); ?> ",
                    "infoFiltered": "<?php echo trans('app.'.'pagination_filtered'); ?> ",
                    "infoPostFix": "",
                    "search": "<?php echo trans('app.'.'search'); ?> :",
                    "url": "",
                    "paginate": {
                        "first": "<?php echo trans('app.'.'first'); ?> ",
                        "previous": "<?php echo trans('app.'.'previous'); ?> ",
                        "next": "<?php echo trans('app.'.'next'); ?> ",
                        "last": "<?php echo trans('app.'.'last'); ?> "
                    },
                },
        "ordering": [],
        "columnDefs": [{
                    "targets": ["no-sort"]
                    , "orderable": false
                }, {
                    "targets": ["hide"],
                    "visible": false
                }, {
                    "targets": ["col-date"],
                    "type": "date"
                }, {
                    "targets": ["col-currency"]
                    , "type": "num-fmt"
                }]
    } );
    });
    </script>
    
    <script type="text/javascript">

        $(document).ready(function () {
            
            $('#table-translations').on('click', '.backup-translation', function (e) {
                e.preventDefault();
                var target = $(this).attr('data-href');
                $.ajax({
                    url: target,
                    type: 'GET',
                    data: {},
                    success: function () {
                        toastr.success("<?php echo trans('app.'.'translation_backed_up_successfully'); ?> ", "<?php echo trans('app.'.'response_status'); ?> ");
                    },
                    error: function (xhr) {
                        alert('Error: ' + JSON.stringify(xhr));
                    }
                });
            });
            $("#table-translations").on('click', '.restore-translation', function (e) {
                e.preventDefault();
                var target = $(this).attr('data-href');
                $.ajax({
                    url: target,
                    type: 'GET',
                    data: {},
                    success: function () {
                        toastr.success("<?php echo trans('app.'.'translation_restored_successfully'); ?> ", "<?php echo trans('app.'.'response_status'); ?> ");
                    },
                    error: function (xhr) {
                        alert('Error: ' + JSON.stringify(xhr));
                    }
                });
            });
            $('#table-translations').on('click', '.submit-translation', function (e) {
                e.preventDefault();
                var target = $(this).attr('data-href');
                $.ajax({
                    url: target,
                    type: 'GET',
                    data: {},
                    success: function () {
                        toastr.success("<?php echo trans('app.'.'translation_submitted_successfully'); ?> ", "<?php echo trans('app.'.'response_status'); ?> ");
                    },
                    error: function (xhr) {
                        alert('Error: ' + JSON.stringify(xhr));
                    }
                });
            });
            

            

            $(".cron-enabled-toggle").on('click', function (e) {
                e.preventDefault();
                var target = $(this).attr('data-href');
                var role = $(this).attr('data-role');
                var ena = 1;
                if ($(this).hasClass('btn-success')) {
                    ena = 0;
                }
                $(this).toggleClass('btn-success').toggleClass('btn-default');
                $.ajax({
                    url: target,
                    type: 'POST',
                    data: {enabled: ena, access: role},
                    success: function () {
                    },
                    error: function (xhr) {
                    }
                });
            });


            $('[data-rel=tooltip]').tooltip();
        });
    </script>

