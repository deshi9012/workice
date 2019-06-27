<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('make_changes') - {{ $currency->title }} </h4>
        </div>

        {!! Form::open(['route' => ['settings.currencies.update', $currency->id], 'class' => 'bs-example form-horizontal ajaxifyForm', 'method' => 'PUT']) !!}

        <div class="modal-body">

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('code') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ $currency->code }}" name="code" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('title') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ $currency->title }}" name="title" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('currency_symbol') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ $currency->symbol }}" name="symbol" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Native @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ $currency->native }}" name="native" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('thousand_separator')</label>
                <div class="col-lg-8">
                    <select name="thousands_sep" class="form-control">
                        <option value="," {{ $currency->thousands_sep == ',' ? 'selected' : '' }}>,</option>
                        <option value="." {{ $currency->thousands_sep == '.' ? 'selected' : '' }}>.</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('decimal_separator')</label>
                <div class="col-lg-8">
                    <select name="decimal_sep" class="form-control">
                        <option value="," {{ $currency->decimal_sep == ',' ? 'selected' : '' }}>,</option>
                        <option value="." {{ $currency->decimal_sep == '.' ? 'selected' : '' }}>.</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('symbol_left')</label>
                <div class="col-lg-8">
                    <select name="symbol_left" class="form-control">
                        <option value="1" {{ $currency->symbol_left == 1 ? 'selected' : '' }}>@langapp('yes')</option>
                        <option value="0" {{ $currency->symbol_left == 0 ? 'selected' : '' }}>@langapp('no')</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('space_between')</label>
                <div class="col-lg-8">
                    <select name="space_between" class="form-control">
                        <option value="1" {{ $currency->space_between == 1 ? 'selected' : '' }}>@langapp('yes')</option>
                        <option value="0" {{ $currency->space_between == 0 ? 'selected' : '' }}>@langapp('no')</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Exp</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ $currency->exp }}" name="exp">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('xrate')</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ $currency->xrate }}" name="xrate">
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
@endpush

@stack('pagescript')