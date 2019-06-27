<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('use_credits')</h4>
        </div>

        {{ Form::open(['route' => 'creditnotes.api.credits', 'class' => 'bs-example form-horizontal ajaxifyForm']) }}

        <div class="modal-body">

            <input type="hidden" name="invoice_id" value="{{ $invoice->id  }}">

            <div class="form-group">
                <label class="col-md-3 control-label">@langapp('creditnotes') @required</label>
                <div class="col-md-9">
                    <select class="select2-option width100" name="creditnote_id" required id="sel_credit">
                        <option value="0">--Select--</option>
                        @foreach ($invoice->company->creditsWithBalance() as $credit)
                            <option value="{{ $credit->id  }}">{{ $credit->reference_no  }}
                                - {{ formatCurrency($credit->currency, $credit->balance())  }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">@langapp('amount') (10.35) @required</label>
                <div class="col-md-9">
                    <input type="text" name="credited_amount" class="form-control money" id="credit" required>
                </div>
            </div>


            <div class="line line-dashed line-lg pull-in"></div>
            <div class="row m-sm small">


                <div class="col-md-6">
                    @langapp('reference_no')  :
                    <strong id="ref"></strong><br>
                    @langapp('total')  :
                    <strong id="total"></strong><br>
                    @langapp('balance')  :
                    <strong id="availableCredits"></strong><br>
                </div>

                <div class="col-md-5">
                    @langapp('client')  :
                    <strong id="clientName"></strong><br>
                    @langapp('date')  :
                    <strong id="created"></strong><br>
                    @langapp('status')  :
                    <strong class="label label-dracula text-uc" id="status"></strong><br>
                </div>


            </div>

            <div class="modal-footer">
                {!! closeModalButton() !!}
                {!! renderAjaxButton()  !!}
            </div>
        {!! Form::close() !!}
        </div>
        
    </div>
</div>

@push('pagescript')
<script type="text/javascript">
    $(document).ready(function () {
        $('.select2-option').select2();
        $('.money').maskMoney({allowZero: true, thousands: '', allowNegative: true});

        $("#sel_credit").change(function () {
            var creditid = $(this).val();
            axios.get('/api/v1/creditnotes/'+creditid, {
                "id": creditid
            })
          .then(function (response) {
                    $('#credit').val(response.data.attributes.balance);
                    $('#total').text(response.data.attributes.amount);
                    $('#ref').text(response.data.attributes.reference_no);
                    $('#availableCredits').text(response.data.attributes.balance);
                    $('#created').text(response.data.attributes.created_at);
                    $('#status').text(response.data.attributes.status);
                    $('#clientName').text(response.data.attributes.business.name);
          })
          .catch(function (error) {
            var errors = error.response.data.errors;
            toastr.error( errors.message , '@langapp('response_status') ');
          });
        });

    });
</script>
@include('partial.ajaxify')
@endpush
@stack('pagescript')
