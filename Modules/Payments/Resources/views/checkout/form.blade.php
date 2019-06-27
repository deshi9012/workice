<form action="{{ route('payments.2checkout.checkout') }}" class="bs-example form-horizontal" id="tcoPay" method="POST">
            {{ csrf_field() }}
            
            @include('payments::_includes._options')

            <div class="m-xs">

            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                @icon('solid/info-circle') @langapp('card_store_notice')
            </div>
            
            <input id="token" name="token" type="hidden" value=""/>
            <input id="sellerId" type="hidden" value="{{ config('services.2checkout.sellerId') }}"/>
            <input id="publishableKey" type="hidden" value="{{ config('services.2checkout.publishableKey') }}"/>
            <input id="billingAddr" name="billingAddr" type="hidden" value="{{ $invoice->company->address1 }}"/>

            <h3 class="h3 font14">@langapp('payment_settings')</h3>
            <div class="form-group">
                <label class="col-lg-4 control-label">Card Number</label>
                <div class="col-lg-5">
                    <input type="text" id="ccNo" size="20" class="form-control card-number input-medium"
                           autocomplete="off" placeholder="5555555555554444" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">CVC</label>
                <div class="col-lg-2">
                    <input type="text" id="cvv" size="3" class="form-control card-cvc input-mini" autocomplete="off"
                           placeholder="123" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">Expiration (MM/YYYY)</label>
                <div class="col-lg-2">
                    <input type="text" size="2" id="expMonth" class="form-control input-mini" autocomplete="off"
                           placeholder="MM" required>

                </div>
                <div class="col-lg-2">
                    <input type="text" size="4" id="expYear" class="form-control input-mini" placeholder="YYYY" required>
                </div>
            </div>

            <div class="m-sm">
            <img src="{{ getStorageUrl(config('system.media_dir').'/payment_american.png') }}">
            <img src="{{ getStorageUrl(config('system.media_dir').'/payment_discover.png') }}">
            <img src="{{ getStorageUrl(config('system.media_dir').'/payment_maestro.png') }}">
            <img src="{{ getStorageUrl(config('system.media_dir').'/payment_paypal.png') }}">
            </div>

            <div class="modal-footer">
                <a href="#" class="btn btn-default" data-dismiss="modal">@langapp('close')</a>
                <button type="submit" class="btn btn-success pay-btn" id="checkout-submit">@langapp('pay_invoice')</button>
            </div>


            </div>


            </form>


@push('pagescript')
@if (settingEnabled('2checkout_live'))
    <script type="text/javascript" src="https://2checkout.com/checkout/api/2co.min.js"></script>
    <script type="text/javascript" src="https://2checkout.com/checkout/api/script/publickey/"></script>
@else
    <script type="text/javascript" src="https://sandbox.2checkout.com/checkout/api/2co.min.js"></script>
    <script type="text/javascript" src="https://sandbox.2checkout.com/checkout/api/script/publickey/"></script>
@endif

    <script>

        $("#amount").change(function () {
        if ($("#amount").val() > {{$invoice->due()}})
            $('#checkout-submit').attr('disabled', 'disabled');
        else {
            $('#checkout-submit').removeAttr('disabled');
        }
        });

        

    function successCallback(data) {
        var myForm = document.getElementById('tcoPay');
        myForm.token.value = data.response.token.token;
        myForm.submit();
    }

    function errorCallback(data) {
        if (data.errorCode === 200) {
            TCO.requestToken(successCallback,
                errorCallback, 'tcoPay');
        } else {
            alert(data.errorMsg);
        }
    }

    $('#tcoPay').submit(function (event) {
            $(".pay-btn").html('Processing..<i class="fas fa-spin fa-spinner"></i>');
            var formData = {
                'id': $('input[name=id]').val(),
                'amount': $('input[name=amount]').val(),
                'payment': $('input[name="payment"]:checked', '#tcoPay').val()
            };

            axios.post('{{ route('payments.checkout') }}', formData)
                .then(function (response) {
                    TCO.loadPubKey('{{ settingEnabled('2checkout_live') ? 'production' : 'sandbox' }}');
                    $('input[name="amount"]').val(response.data.amount);
                    $(".pay-btn").html('<i class="fas fa-sync-alt fa-spin"></i> Processing, Please Wait</span>');
                    var args = {
                            sellerId: "{{ config('services.2checkout.sellerId') }}",
                            publishableKey: "{{ config('services.2checkout.publishableKey') }}",
                            ccNo: $("#ccNo").val(),
                            cvv: $("#cvv").val(),
                            expMonth: $("#expMonth").val(),
                            expYear: $("#expYear").val(),
                            billingAddr: $("#billingAddr").val()
                    };
                    TCO.requestToken(successCallback, errorCallback, args);
            })
                .catch(function (error) {
                    toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
            });

            event.preventDefault();
    });

    
</script>
@endpush

@stack('pagescript')


