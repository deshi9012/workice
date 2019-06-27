<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/shield-alt') @langapp('sign_contract')</h4>
        </div>

        {!! Form::open(['route' => ['contracts.api.sign', $contract->id], 'class' => 'bs-example form-horizontal ajaxifyForm', 'data-toggle' => 'validator']) !!}

        <div class="modal-body">
            <input type="hidden" name="contract_id" value="{{ $contract->id }}">
            <input type="hidden" name="ip_address" value="">
            <input type="hidden" name="unix_time" value="">
            <input type="hidden" name="device_agent" value="">
            <input type="hidden" name="device_platform" value="">
            <input type="hidden" name="sign_identity" value="">
            <input type="hidden" name="checksum" value="">
            <input type="hidden" name="signature" value="">

            <div class="pb15 signatureSec">

                <div id="target" class="signature">
            
                @if(Auth::user()->signed())
                <img src="{{ \Auth::user()->profile->sign }}" width="250" alt="">
                <input type="hidden" name="image" value="{{ \Auth::user()->profile->signature }}">
                <input type="hidden" class="form-control" name="signature" value="{{ Auth::user()->name }}">
                @endif

                </div>

            </div>

            @if(!Auth::user()->signed())

            <div class="form-group">
                <label class="col-lg-5 control-label">@langapp('type_your_name_to_sign') @required</label>
                <div class="col-lg-7">
                    <input type="text" id="sign" class="form-control" placeholder="Your Signature" name="signature"
                           required>
                </div>
            </div>
            @endif

            <p>@langapp('confirm_contract_sign_message', ['name' => Auth::user()->name, 'email' => Auth::user()->email])</p>


        </div>

        <div class="modal-footer">
            
            {!! closeModalButton() !!}
            {!!  renderAjaxButton('confirm_signature', 'fas fa fa-file-signature', true)  !!}

        </div>


        {!! Form::close() !!}


    </div>
</div>
<script>
    $('#sign').keyup(function () {
        $('#target').html($(this).val());
    });
</script>

@include('partial.ajaxify')
