<form action="{{ route('payments.braintree.checkout') }}" class="bs-example form-horizontal" id="braintree-form" method="POST">
            {{ csrf_field() }}
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    @icon('solid/info-circle') @langapp('card_store_notice')
                </div>

            @include('payments::_includes._options')

            <input type="hidden" name="nonce" value="">



            <div id="dropin-container"></div>


            <div class="modal-footer">
                <a href="#" class="btn btn-default" data-dismiss="modal">@langapp('close')</a>
                <button class="btn btn-success pay-btn" id="pay-btn">@langapp('pay_invoice')</button>
            </div>


</form>

    <script>

    braintree.dropin.create({
      authorization: '{{ $token }}',
      container: '#dropin-container'
    }, function (createErr, instance) {
        $('#pay-btn').click(function (event) {
        instance.requestPaymentMethod(function (err, payload) {
            var formData = {
                'id': $('input[name=id]').val(),
                'amount': $('input[name=amount]').val(),
                'payment': $('input[name="payment"]:checked', '#braintree-form').val()
            };

            axios.post('{{ route('payments.checkout') }}', formData)
                .then(function (response) {
                    $('input[name="amount"]').val(response.data.amount);
                    $('input[name="nonce"]').val(payload.nonce);
                    $(".pay-btn").html('<i class="fas fa-sync fa-spin"></i> Processing..</span>');
                    $("#braintree-form").submit();
            })
                .catch(function (error) {
                    toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
            });
        });
        event.preventDefault();
      });
    });
  </script>