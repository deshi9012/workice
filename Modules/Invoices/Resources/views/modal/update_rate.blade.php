<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('make_changes')  </h4>
        </div>

        {!! Form::open(['route' => 'rates.update', 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}
        
        <input type="hidden" name="id" value="{{  $rate->id  }}">
        <div class="modal-body">

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('name') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ $rate->name }}"
                           name="name" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('tax_rate') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control money" value="{{  $rate->rate  }}"
                           name="rate" required>
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
<script>
        $('.money').maskMoney({allowZero: true, thousands: '', allowNegative: true});
</script>
@include('partial.ajaxify')
@endpush

@stack('pagescript')