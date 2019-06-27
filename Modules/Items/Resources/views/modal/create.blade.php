<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/plus') @langapp('create') </h4>
        </div>

        {!! Form::open(['route' => 'items.api.save.template', 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}
        
        <div class="modal-body">

            <input type="hidden" name="itemable_id" value="0">
            <input type="hidden" name="itemable_type" value="">
            <input type="hidden" name="url" value="{{ url()->previous() }}">

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('name') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="@langapp('name')" name="name">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('description')</label>
                <div class="col-lg-8">
                    <textarea class="form-control ta" name="description" placeholder="@langapp('description')"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('quantity') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control money" placeholder="2" name="quantity">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">{{ itemUnit() }} @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control money" placeholder="350.00" name="unit_cost">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('tax_rate') @required</label>
                <div class="col-lg-8">
                    <select name="tax_rate" class="form-control m-b">
                        <option value="0.00">@langapp('none')  </option>
                        @foreach(App\Entities\TaxRate::all() as $tax) 
                            <option value="{{ $tax->rate }}">{{ $tax->name  }} - {{ $tax->rate }}%</option>
                        @endforeach
                    </select>
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