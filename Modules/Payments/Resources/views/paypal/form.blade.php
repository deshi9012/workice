<div class="alert alert-info">
    @langapp('paypal_redirection_alert')
</div>

            @if (settingEnabled('paypal_live'))
               <form action="https://www.paypal.com/cgi-bin/webscr" id="paypal-form" class="bs-example form-horizontal" method="POST">
            @else
            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" id="paypal-form" class="bs-example form-horizontal" method="POST">
            @endif

            

            <input type="hidden" name="rm" value="2">
            <input type="hidden" name="cmd" value="_xclick">
            <input type="hidden" name="currency_code" value="{{ $invoice->currency }}">
            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="business" value="{{ get_option('paypal_email') }}">
            <input type="hidden" name="return" value="{{ route('paypal.success') }}">
            <input type="hidden" name="cancel_return" value="{{ route('paypal.cancel') }}">
            <input type="hidden" name="notify_url" value="{{ route('paypal.ipn') }}">
            <input type="hidden" name="custom" value="{{ $invoice->client_id }}">
            <input type="hidden" name="item_name" value="{{ $invoice->reference_no }}">
            <input type="hidden" name="item_number" value="{{ $invoice->id }}">

            @include('payments::_includes._options')

            <div class="m-sm">
            <img src="{{ getStorageUrl(config('system.media_dir').'/payment_american.png') }}">
            <img src="{{ getStorageUrl(config('system.media_dir').'/payment_discover.png') }}">
            <img src="{{ getStorageUrl(config('system.media_dir').'/payment_maestro.png') }}">
            <img src="{{ getStorageUrl(config('system.media_dir').'/payment_paypal.png') }}">
            </div>


            <div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal">{{ langapp('close') }}</a>
                <button type="submit" id="paypal_submit" class="btn btn-success pay-btn">{{ langapp('pay_invoice') }} <i class="fab fa-paypal"></i></button>
            </div>



        </form>


<script>
    $("#amount").change(function () {
        if ($("#amount").val() > {{$invoice->due()}})
            $('#paypal_submit').attr('disabled', 'disabled');
        else {
            $('#paypal_submit').removeAttr('disabled');
        }
    });
</script>
<script>
    $(document).ready(function () {
        $('#paypal_submit').click(function (event) {
            $(".pay-btn").html('Processing..<i class="fas fa-spin fa-spinner"></i>');
            var formData = {
                'id': $('input[name=id]').val(),
                'amount': $('input[name=amount]').val(),
                'payment': $('input[name="payment"]:checked', '#paypal-form').val()
            };
            axios.post('{{ route('payments.checkout') }}', formData)
                .then(function (response) {
                    $(".pay-btn").html('<i class="fas fa-sync fa-spin"></i> Redirecting..</span>');
                    $('input[name="amount"]').val(response.data.amount);
                    $("#paypal-form").submit();
            })
                .catch(function (error) {
                    toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
            });
            event.preventDefault();
        });

    });
</script>
