<script type="text/javascript" src="{{ getAsset('plugins/nouislider/jquery.nouislider.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var progress = $('#progress').val();
            $('#progress-slider').noUiSlider({
                start: [progress],
                step: 10,
                connect: "lower",
                range: {
                    'min': 0,
                    'max': 100
                },
                format: {
                    to: function (value) {
                        return Math.floor(value);
                    },
                    from: function (value) {
                        return Math.floor(value);
                    }
                }
            });
            $('#progress-slider').on('slide', function () {
                var progress = $(this).val();
                $('#progress').val(progress);
                $('.noUi-handle').attr('title', progress + '%').tooltip('fixTitle').parent().find('.tooltip-inner').text(progress + '%');
            });

            $('#progress-slider').on('change', function () {
                var progress = $(this).val();
                $('#progress').val(progress);
            });

            $('#progress-slider').on('mouseover', function () {
                var progress = $(this).val();
                $('.noUi-handle').attr('title', progress + '%').tooltip('fixTitle').tooltip('show');
            });

            var invoiceHeight = $('#invoice-logo-height').val();
            $('#invoice-logo-slider').noUiSlider({
                start: [invoiceHeight],
                step: 1,
                connect: "lower",
                range: {
                    'min': 30,
                    'max': 150
                },
                format: {
                    to: function (value) {
                        return Math.floor(value);
                    },
                    from: function (value) {
                        return Math.floor(value);
                    }
                }
            });
            $('#invoice-logo-slider').on('slide', function () {
                var invoiceHeight = $(this).val();
                var invoiceWidth = $('.invoice_image img').width();
                $('#invoice-logo-height').val(invoiceHeight);
                $('#invoice-logo-width').val(invoiceWidth);
                $('.noUi-handle').attr('title', invoiceHeight + 'px').tooltip('fixTitle').parent().find('.tooltip-inner').text(invoiceHeight + 'px');
                $('.invoice_image img').css('height', invoiceHeight + 'px');
                $('#invoice-logo-dimensions').html(invoiceHeight + 'px x ' + invoiceWidth + 'px');
            });

            $('#invoice-logo-slider').on('change', function () {
                var invoiceHeight = $(this).val();
                var invoiceWidth = $('.invoice_image img').width();
                $('#invoice-logo-height').val(invoiceHeight);
                $('#invoice-logo-width').val(invoiceWidth);
                $('.invoice_image').css('height', invoiceHeight + 'px');
                $('#invoice-logo-dimensions').html(invoiceHeight + 'px x ' + invoiceWidth + 'px');
            });

            $('#invoice-logo-slider').on('mouseover', function () {
                var invoiceHeight = $(this).val();
                $('.noUi-handle').attr('title', invoiceHeight + 'px').tooltip('fixTitle').tooltip('show');
            });


        });
    </script>
{{-- / NOUI SLIDER --}}