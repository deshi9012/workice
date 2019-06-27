<form action="{{ route('payments.wepay.checkout') }}" class="bs-example form-horizontal" id="wepay-form" method="POST">
{{ csrf_field() }}
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    @icon('solid/info-circle') @langapp('card_store_notice')
                </div>

          @include('payments::_includes._options')

            <div class="m-sm">
            <img src="{{ getStorageUrl(config('system.media_dir').'/wepay-logo.svg') }}" width="150" alt="WePay">
            </div>


            <div class="modal-footer">
                <a href="#" class="btn btn-default" data-dismiss="modal">@langapp('close')</a>
                <button type="submit" class="btn btn-success pay-btn" id="submit">@langapp('pay_invoice')</button>
            </div>


</form>


        

<script>
    $(document).ready(function () {
        $('#wepay-form').submit(function (event) {
            $(".pay-btn").html('Processing..<i class="fas fa-spin fa-spinner"></i>');
            var formData = {
                'id': $('input[name=id]').val(),
                'payment': $('input[name="payment"]:checked', '#wepay-form').val(),
                'amount': $('input[name=amount]').val()
            };

            axios.post('{{ route('payments.checkout') }}', formData)
                .then(function (response) {
                    $('input[name="amount"]').val(response.data.amount);
                    $(".pay-btn").html('<i class="fas fa-sync fa-spin"></i> Authorizing..</span>');

                            axios.post('{{ route('payments.wepay.checkout') }}', {
                                id:$('input[name=id]').val(),
                                amount:response.data.amount
                            }).then(function (response) {
                                $(".pay-btn").html('<i class="fas fa-sync fa-spin"></i> Redirecting..</span>');
                                window.location.href = response.data.redirect;
                            })
                                .catch(function (error) {
                                    toastr.error('Wepay checkout failed', '@langapp('response_status') ');
                            });
            })
                .catch(function (error) {
                    toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
            });

            event.preventDefault();
        });

    });
</script>
