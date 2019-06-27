<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/shield-alt') @langapp('sign_contract') 
                - {{ $contract->contract_title }}</h4>
        </div>

        
        {!! Form::open(['route' => ['contracts.client.sign', $contract->id], 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}

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

            @if(!is_null($contract->company->contact->profile->signature))
                <img src="{{ $contract->company->contact->profile->sign }}" width="250" alt="">
            <input type="hidden" name="image" value="{{ $contract->company->contact->profile->signature }}">
            <input type="hidden" class="form-control" name="signature" value="{{ $contract->company->contact->name }}">
            @else

                <div id="target" class="signature"></div>
            @endif

            </div>


            <div class="form-group">
                <label class="col-lg-5 control-label">@langapp('type_your_name_to_sign') @required</label>
                <div class="col-lg-7">
                    <input type="text" id="sign" class="form-control" placeholder="Your Signature" name="signature"
                           required>
                </div>
            </div>

            <p>@langapp('confirm_contract_sign_message', ['name' => $contract->company->contact_person, 'email' => $contract->company->contact->email])
            </p>


        </div>

        <div class="modal-footer">
            {!! closeModalButton() !!}
            
            {!!  renderAjaxButton('confirm_signature', 'fas fa fa-file-contract', true)  !!}

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
