<div class="alert alert-info">
    @langapp('paypal_redirection_alert')
</div>

          
            <form action="{{ route('payments.paytm.checkout') }}" id="paytm-form" class="bs-example form-horizontal" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="currency" value="{{ $invoice->currency }}">
            <input type="hidden" name="email" value="{{ $invoice->company->email }}">
            <input type="hidden" name="mobile" value="{{ $invoice->company->mobile }}">
            <input type="hidden" name="customer_id" value="{{ $invoice->client_id }}">
            <input type="hidden" name="order_id" value="{{ $invoice->id.'-'.trCode() }}">

            @include('payments::_includes._options')

            <div class="m-sm">
            <img src="{{ getStorageUrl(config('system.media_dir').'/payment_american.png') }}">
            <img src="{{ getStorageUrl(config('system.media_dir').'/payment_discover.png') }}">
            <img src="{{ getStorageUrl(config('system.media_dir').'/payment_maestro.png') }}">
            <img src="{{ getStorageUrl(config('system.media_dir').'/payment_paypal.png') }}">
            </div>


            <div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal">{{ langapp('close') }}</a>
                <button type="submit" id="paytm_submit" class="btn btn-success pay-btn">{{ langapp('pay_invoice') }}</button>
            </div>



        </form>


<script>
    $("#amount").change(function () {
        if ($("#amount").val() > {{$invoice->due()}})
            $('#paytm_submit').attr('disabled', 'disabled');
        else {
            $('#paytm_submit').removeAttr('disabled');
        }
    });
</script>
<script>
    $(document).ready(function () {
        $('#paytm_submit').click(function (event) {
            $(".pay-btn").html('Processing..<i class="fas fa-spin fa-spinner"></i>');
            var formData = {
                'id': $('input[name=id]').val(),
                'amount': $('input[name=amount]').val(),
                'payment': $('input[name="payment"]:checked', '#paytm-form').val()
            };
            axios.post('{{ route('payments.checkout') }}', formData)
                .then(function (response) {
                    $(".pay-btn").html('<i class="fas fa-sync fa-spin"></i> Redirecting..</span>');
                    $('input[name="amount"]').val(response.data.amount);
                    $("#paytm-form").submit();
            })
                .catch(function (error) {
                    toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
            });
            event.preventDefault();
        });

    });
</script>
