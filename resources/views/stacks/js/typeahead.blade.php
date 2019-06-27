<script type="text/javascript">
        $(document).ready(function () {

            var scope = $('#auto-item-name').attr('data-scope');
            if (scope == 'invoices' || scope == 'estimates' || scope == 'credits' || scope == 'deals') {

                var substringMatcher = function (strs) {
                    return function findMatches(q, cb) {
                        var substrRegex;
                        var matches = [];
                        substrRegex = new RegExp(q, 'i');
                        $.each(strs, function (i, str) {
                            if (substrRegex.test(str)) {
                                matches.push(str);
                            }
                        });
                        cb(matches);
                    };
                };

                $('#auto-item-name').on('keyup', function () {
                    $('#hidden-item-name').val($(this).val());
                });

                $.ajax({
                    url: '{{ route('items.autoitems') }}',
                    type: "POST",
                    data: { _token: '{{ csrf_token() }}' },
                    success: function (response) {
                        $('.typeahead').typeahead({
                                hint: true,
                                highlight: true,
                                minLength: 2
                            },
                            {
                                name: "name",
                                limit: 10,
                                source: substringMatcher(response)
                            });
                        $('.typeahead').bind('typeahead:select', function (ev, suggestion) {
                            $.ajax({
                                url: '{{ route('items.autoitem') }}',
                                type: "POST",
                                data: { _token: '{{ csrf_token() }}', name: suggestion},
                                success: function (response) {
                                    $('#hidden-item-name').val(response.name);
                                    $('#auto-item-desc').val(response.description).trigger('keyup');
                                    $('#auto-quantity').val(response.quantity);
                                    $('#auto-unit-cost').val(response.unit_cost);
                                }
                            });
                        });
                    }
                });
            }


        });
    </script>