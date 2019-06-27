@php $sort = strtoupper(get_option('date_picker_format')); @endphp
    <script src="{{ getAsset('plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ getAsset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ getAsset('plugins/datatables/datetime-moment.js') }}"></script>

    <script>
        $(document).ready(function () {
        $.fn.dataTable.moment('{{ $sort }}');
        $.fn.dataTable.moment('{{ $sort }} HH:mm');

        $.extend( true, $.fn.dataTable.defaults, {
        "processing": true,
        "deferRender": true,
        "autoWidth": false,
        "pagingType": "full_numbers",
        "pageLength": {{ get_option('rows_per_table') }},
        "language": {
                    "processing": "@langapp('processing') ",
                    "loadingRecords": "@langapp('loading') ",
                    "lengthMenu": "@langapp('show_entries') ",
                    "emptyTable": "@langapp('empty_table') ",
                    "info": "@langapp('pagination_info') ",
                    "infoEmpty": "@langapp('pagination_empty') ",
                    "infoFiltered": "@langapp('pagination_filtered') ",
                    "infoPostFix": "",
                    "search": "@langapp('search') :",
                    "url": "",
                    "paginate": {
                        "first": "@langapp('first') ",
                        "previous": "@langapp('previous') ",
                        "next": "@langapp('next') ",
                        "last": "@langapp('last') "
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
                        toastr.success("@langapp('translation_backed_up_successfully') ", "@langapp('response_status') ");
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
                        toastr.success("@langapp('translation_restored_successfully') ", "@langapp('response_status') ");
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
                        toastr.success("@langapp('translation_submitted_successfully') ", "@langapp('response_status') ");
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

{{-- END DATATABLES --}}