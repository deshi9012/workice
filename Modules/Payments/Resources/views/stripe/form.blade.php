
            <form class="bs-example form-horizontal" onsubmit="return false" id="stripe-form">

                @include('payments::_includes._options')


                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">@langapp('close')</a>
                    <button type="submit" id="launchButton" class="btn btn-success">
                    {{ langapp('pay_invoice') }} <i class="fab fa-stripe"></i>
                    </button>
                </div>
            </form>



<script>
    var handler = StripeCheckout.configure({
        key: '{{ config('services.stripe.key') }}',
        image: '{{ getStorageUrl(config('system.media_dir').'/'.get_option('company_logo')) }}',
        color: '#1ab394',
        token: function (token) {
            $("#stripeToken").val(token.id);
            $("#stripeEmail").val(token.email);
            $("#stripeForm").submit();
        }
    });
    $('#launchButton').on('click', function (e) {
        var amount = 0;
        var amt = $('input[name=amount]').val();
        var id = $('input[name=id]').val();
        var payment = $('input[name="payment"]:checked', '#stripe-form').val();
        var amount = getAmount(id, amt, payment).then(function(amount) {
            $("#tokenAmount").val(amount);
            $("#payment").val(payment);
            handler.open({
                name: '{{ get_option('company_name') }}',
                description: 'INV #{{ $invoice->reference_no }} - {{ $invoice->currency }} ' + parseFloat(amount),
                amount: amount * 100,
                currency: '{{ $invoice->currency }}'
            });
        });
        
        e.preventDefault();
    });
    $(window).on('popstate', function () {
        handler.close();
    });

    function getAmount(id, amt, payment) {
        var formData = {
            'id': id,
            'amount': amt,
            'payment': payment
        };
        var new_amount = 0;
        return axios.post('{{ route('payments.checkout') }}', formData)
                .then(function (response) {
                    this.response = response.data;
                    return this.response.amount;
            })
            .catch(function (error) {
                toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
            });
    }

</script>
<form action="{{ route('payments.stripe.checkout') }}" method="POST" id="stripeForm">
    {{ csrf_field() }}
<input type="hidden" id="stripeToken" name="stripeToken"/>
<input type="hidden" id="stripeEmail" name="stripeEmail"/>
<input type="hidden" id="payment" name="payment"/>
<input type="hidden" name="invoice" value="{{ $invoice->id }}"/>
<input type="hidden" name="ref" value="{{ $invoice->reference_no }}"/>
<input type="hidden" id="tokenAmount" name="amount" value="{{ $invoice->due() }}"/>
</form>
