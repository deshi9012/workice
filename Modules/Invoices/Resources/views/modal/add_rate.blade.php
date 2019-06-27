<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('new_tax_rate')  </h4>
        </div>

        {!! Form::open(['route' => 'rates.save', 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}

        <div class="modal-body">

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('name') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="VAT" name="name" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('tax_rate') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control money" required placeholder="12.00" name="rate" required>
                </div>
            </div>


        </div>
        <div class="modal-footer">

            {!! closeModalButton() !!}
            {!! renderAjaxButton() !!}
            
        </div>
        {!! Form::close() !!}
    </div>
</div>

@push('pagescript')
    @include('partial.ajaxify')
    <script>
        $('.money').maskMoney({allowZero: true, thousands: '', allowNegative: true});
    </script>
@endpush

@stack('pagescript')