<?php
$cur = array_first(
    currencies(),
    function ($cur) use ($invoice) {
        return $cur['code'] == $invoice->currency;
    }
);
$nextInstallment = $invoice->nextUnpaidPartial();
$installment = $invoice->nextUnpaidPartial(false);
$due = $invoice->due();
?>

<?php
$payment_id = $invoice->payments()->max('id');
if ($payment_id > 0) {
    $lastPayment = Modules\Payments\Entities\Payment::find($payment_id);
    $lastPaymentCur = array_first(
        currencies(),
        function ($cur) use ($lastPayment) {
            return $cur['code'] == $lastPayment->currency;
        }
    );
}
?>
<p>
    For bank payments, use the Account Details below;
</p>
<div class="alert alert-info">
    <button class="close" data-dismiss="alert" type="button">×</button>
    <i class="fas fa-info-circle"></i> We will notify you when we receive your payment.
</div>
@parsedown(get_option('bank_details'))

<h3 class="h3 bt font14">@langapp('select_payment_amount')</h3>
        <div class="text-muted m-sm">@langapp('choose_from_available_options')</div>

<div class="m-xs">
    @langapp('minimum_payment_due')
<strong class="pull-right">{{ formatCurrency($cur['code'], $nextInstallment) }}</strong>
            <div class="text-muted m-l-md">@langapp('pay_minimum_amount')</div>
</div>
<div class="m-xs">
    @langapp('full_amount')
<strong class="pull-right">{{ formatCurrency($cur['code'], $due) }}</strong>
            <div class="text-muted m-l-md">@langapp('pay_full_amount').</div>
</div>
<div class="m-xs">
    @langapp('other_amount')
<div class="text-muted m-l-md">@langapp('pay_any_amount')</div>
</div>




<div class="modal-footer">
                <a href="#" class="btn btn-success" data-dismiss="modal">@langapp('ok')</a>
            </div>
