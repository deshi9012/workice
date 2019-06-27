<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/plus') @langapp('create')</h4>
        </div>
        {!! Form::open(['route' => 'items.fromtemplate', 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}
        
        <input type="hidden" name="id" value="{{ $id }}">
        <input type="hidden" name="module" value="{{ $module }}">

        <div class="modal-body">

            <div class="form-group">
                <label class="col-md-3 control-label">@langapp('name') @required</label>
                <div class="col-md-9">
                    <select name="item" class="select2-option width100" required>
                        <option value="">@langapp('choose_template')  </option>
                        @foreach (Modules\Items\Entities\Item::templates()->get() as $key => $item) 
                <option value="{{  $item->id  }}">{{ $item->name }} - {{ $item->unit_cost }}</option>
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
@push('pagestyle')
    @include('stacks.css.form')
@endpush

@push('pagescript')
    @include('stacks.js.form')
    @include('partial.ajaxify')
@endpush

@stack('pagestyle')
@stack('pagescript')