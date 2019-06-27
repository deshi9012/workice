<script type="text/javascript" src="{{ getAsset('plugins/sortable/jquery-sortable.js') }}"></script>
    <script type="text/javascript">
        var t1, t2, t3, t4, t5;
        $('#inv-details, #est-details').sortable({
            cursorAt: {top: 20, left: 0},
            containerSelector: 'table',
            handle: '.drag-handle',
            revert: true,
            itemPath: '> tbody',
            itemSelector: 'tr.sortable',
            placeholder: '<tr class="placeholder"/>',
            afterMove: function () {
                clearTimeout(t1);
                t1 = setTimeout('saveOrder()', 500);
            }
        });
        $('#menu-main').sortable({
            cursorAt: {top: 20, right: 20},
            containerSelector: 'table',
            handle: '.drag-handle',
            revert: true,
            itemPath: '> tbody',
            itemSelector: 'tr.sortable',
            placeholder: '<tr class="placeholder"/>',
            afterMove: function () {
                clearTimeout(t2);
                t2 = setTimeout('saveMenu(\'main\',1)', 500);
            }
        });
        $('#menu-client').sortable({
            cursorAt: {top: 20, right: 20},
            containerSelector: 'table',
            handle: '.drag-handle',
            revert: true,
            itemPath: '> tbody',
            itemSelector: 'tr.sortable',
            placeholder: '<tr class="placeholder"/>',
            afterMove: function () {
                clearTimeout(t3);
                t3 = setTimeout('saveMenu(\'client\',2)', 500);
            }
        });
        $('#menu-staff').sortable({
            cursorAt: {top: 20, right: 20},
            containerSelector: 'table',
            handle: '.drag-handle',
            revert: true,
            itemPath: '> tbody',
            itemSelector: 'tr.sortable',
            placeholder: '<tr class="placeholder"/>',
            afterMove: function () {
                clearTimeout(t4);
                t4 = setTimeout('saveMenu(\'staff\',3)', 500);
            }
        });
        $('#cron-jobs').sortable({
            cursorAt: {top: 20, left: 20},
            containerSelector: 'table',
            handle: '.drag-handle',
            revert: true,
            itemPath: '> tbody',
            itemSelector: 'tr.sortable',
            placeholder: '<tr class="placeholder"/>',
            afterMove: function () {
                clearTimeout(t5);
                t5 = setTimeout('setCron()', 500);
            }
        });

        function saveOrder() {
            var data = $('.sorted_table').sortable("serialize").get();
            var items = JSON.stringify(data);
            var table = $('.sorted_table').attr('type');
            axios.post('{{ route('items.reorder') }}', {
                "json": items,
                "table": table
            })
          .then(function (response) {
            toastr.info(response.data.message, '@langapp('response_status') ');
          })
          .catch(function (error) {
            toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
          });

        }
        function saveMenu(table, access) {
            var data = $("#menu-" + table).sortable("serialize").get();
            var items = JSON.stringify(data);
            $.ajax({
                url: "{{ route('menu.reorder') }}",
                type: "POST",
                dataType: 'json',
                data: {_token: '{{ csrf_token() }}', json: items},
                success: function (data) {
                    toastr.success(data.message, '@langapp('response_status') ');
                    window.location.href = data.redirect;
                }
            });
        }

        function setCron() {
            var data = $('#cron-jobs').sortable("serialize").get();
            var items = JSON.stringify(data);
            $.ajax({
                url: "{{ site_url() }}/settings/hook/reorder/1",
                type: "POST",
                dataType: 'json',
                data: {json: items},
                success: function () {
                }
            });
        }
    </script>