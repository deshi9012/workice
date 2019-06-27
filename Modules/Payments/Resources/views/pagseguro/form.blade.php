<div class="alert alert-info">
    @langapp('pagseguro_redirection_alert')
</div>
            <form action="{{ route('pagseguro.form') }}" id="pagseguro-form" class="bs-example form-horizontal" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="currency" value="{{ $invoice->currency }}">
            <input type="hidden" name="receiverEmail" value="{{ get_option('pagseguro_email') }}">
            <input type="hidden" name="redirectURL" value="{{ route('pagseguro.callback') }}">
            <input type="hidden" name="notificationURL" value="{{ route('pagseguro.notification') }}">
            <input type="hidden" name="custom" value="{{ $invoice->client_id }}">
            <input type="hidden" name="itemDescription1" value="@langapp('invoice') - {{ $invoice->reference_no }}">
            <input type="hidden" name="itemId1" value="{{ $invoice->reference_no }}">
            <input type="hidden" name="reference" value="{{ $invoice->id }}">
            <input type="hidden" name="senderName" value="{{ $invoice->company->name }}">
            <input type="hidden" name="senderEmail" value="{{ $invoice->company->email }}">
            <input type="hidden" name="senderPhone" value="{{ $invoice->company->phone }}">
            <input type="hidden" name="itemQuantity1" value="1">
            <input type="hidden" name="itemAmount1" value="1">

            @include('payments::_includes._options')

            


            <div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal">{{ langapp('close') }}</a>
                <button type="submit" id="pagseguro_submit" class="btn btn-success pay-btn">{{ langapp('pay_invoice') }} <i class="fas fa-paper-plane"></i></button>
            </div>



        </form>


<script>
    $("#amount").change(function () {
        if ($("#amount").val() > {{$invoice->due()}})
            $('#pagseguro_submit').attr('disabled', 'disabled');
        else {
            $('#pagseguro_submit').removeAttr('disabled');
        }
    });
</script>
<script>
    $(document).ready(function () {
        $('#pagseguro_submit').click(function (event) {
            $(".pay-btn").html('Processing..<i class="fas fa-spin fa-spinner"></i>');
            var formData = {
                'id': $('input[name=id]').val(),
                'amount': $('input[name=amount]').val(),
                'payment': $('input[name="payment"]:checked', '#pagseguro-form').val()
            };
            axios.post('{{ route('payments.checkout') }}', formData)
                .then(function (response) {
                    $(".pay-btn").html('<i class="fas fa-sync fa-spin"></i> Redirecting..</span>');
                    $('input[name="itemAmount1"]').val(parseFloat(response.data.amount).toFixed(2));
                    $("#pagseguro-form").submit();
            })
                .catch(function (error) {
                    toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
            });
            event.preventDefault();
        });

    });
</script>
