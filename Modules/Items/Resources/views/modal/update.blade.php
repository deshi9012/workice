<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/pencil-alt') @langapp('make_changes')</h4>
        </div>

        {!! Form::open(['route' => ['items.api.update', $item->id], 'class' => 'bs-example form-horizontal ajaxifyForm', 'method' => 'put']) !!}
        
        <input type="hidden" name="id" value="{{ $item->id }}">
        <input type="hidden" name="url" value="{{ url()->previous() }}">
        <div class="modal-body">

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('name') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ $item->name }}" name="name">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('description')</label>
                <div class="col-lg-8">
                    <textarea class="form-control ta" name="description">{{ $item->description  }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('quantity') @required</label>
                <div class="col-lg-8">
                <input type="text" class="form-control money" value="{{ formatQuantity($item->quantity) }}" name="quantity">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">{{ itemUnit() }} @required</label>
                <div class="col-lg-8">
                <input type="text" class="form-control money" value="{{ formatQuantity($item->unit_cost) }}" name="unit_cost">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('discount') %</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control money" value="{{  $item->discount  }}" name="discount">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('tax_rate') @required</label>
                <div class="col-lg-8">
                    <select name="tax_rate" class="form-control m-b">
                        <option value="0.00">@langapp('none')  </option>
                        @foreach (App\Entities\TaxRate::all() as $key => $tax) 
                        <option value="{{ $tax->rate }}" {{ $tax->rate == $item->tax_rate ? 'selected="selected"' : '' }}>{{  $tax->name  }} - {{ $tax->rate }}%</option>
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
    <script>
        $('.money').maskMoney({allowZero: true, thousands: '', allowNegative: true});
    </script>
    @include('partial.ajaxify')
@endpush

@stack('pagescript')