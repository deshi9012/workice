<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{ __('Sentry Integration') }}</h4>
        </div>
        
         {!! Form::open(['class' => 'bs-example form-horizontal']) !!}
        
        <div class="modal-body">

            <div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="fas fa-info-circle"></i> {{ __('Once an issue is created on Sentry it will appear in your project issues') }}
            </div>


            <ul>
                <li>{{ __('Copy the url below and add it to your list of sentry webhook urls') }}</li>
            </ul>
            <div class="form-group">
                <label class="col-lg-3 control-label">Webhook URL</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ route('sentry.incoming', $token) }}">
                </div>

                
            </div>

            

            


        <div class="line line-dashed"></div>

            
        </div>


        <div class="modal-footer">
            {!! closeModalButton() !!}
        </div>

        {!! Form::close() !!}

    </div>
</div>