<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('add_currency')  </h4>
        </div>

        {!! Form::open(['route' => 'settings.currencies.save', 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}

        <div class="modal-body">

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('code') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="USD" name="code" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('title') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="United States Dollar" name="title" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('currency_symbol') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="$" name="symbol" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Native @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="$" name="native" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('thousand_separator')</label>
                <div class="col-lg-8">
                    <select name="thousands_sep" class="form-control">
                        <option value="," selected>,</option>
                        <option value=".">.</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('decimal_separator')</label>
                <div class="col-lg-8">
                    <select name="decimal_sep" class="form-control">
                        <option value=",">,</option>
                        <option value="." selected>.</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('symbol_left')</label>
                <div class="col-lg-8">
                    <select name="symbol_left" class="form-control">
                        <option value="1">@langapp('yes')</option>
                        <option value="0">@langapp('no')</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('space_between')</label>
                <div class="col-lg-8">
                    <select name="space_between" class="form-control">
                        <option value="1">@langapp('yes')</option>
                        <option value="0">@langapp('no')</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-4 control-label">Exp</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="2" name="exp">
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