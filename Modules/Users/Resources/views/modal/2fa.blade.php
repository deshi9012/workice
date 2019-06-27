<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Set up Google Authenticator <span class="badge bg-info">{{ Auth::user()->google2fa_enable ? 'Enabled' : 'Disabled' }}</span></h4>
            </div>
    
    
            <div class="modal-body">
    
                

                <div class="panel-body">

                    <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <p>Set up your two factor authentication by scanning the barcode below.</p>
                    <p>Alternatively, you can use the code <strong>{{ $secret }}</strong></p>
                  </div>

                     <div class="row">
                         <div class="col-md-6"><img src="{{ $QR_Image }}"></div>
                         <div class="col-md-6">
                            <p>You must set up your Google Authenticator app before continuing. </p>
                                <p>You will be unable to login otherwise</p>
                            <a href="{{ route('users.2fa.complete', $secret) }}" class="btn btn-primary">@icon('regular/check-circle') Complete 2FA</a>
                            <a href="{{ route('users.2fa.disable') }}" class="btn btn-danger" data-rel="tooltip" title="Disable 2FA">@icon('regular/times-circle') Disable</a>
                        </div>
                     </div>
                    
    
                
    
                </div>

            </div>
    
    
        </div>

    </div>