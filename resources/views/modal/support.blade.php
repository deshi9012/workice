<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/life-ring', 'text-success') {{ __('Workice Remote Support') }}</h4>
        </div>


        <div class="modal-body">

        {!! Form::open(['url' => config('system.support_uri'), 'class' => 'bs-example ajaxifyForm']) !!}
        
        <div class="alert alert-info">
          <button type="button" class="close" data-dismiss="alert">×</button>
          @icon('solid/life-ring') <strong>Note!</strong> Start by reading the <a href="https://docs.workice.com" target="_blank">docs here</a>  
        </div>

        <div class="form-group">
                <label class="control-label">@langapp('email') @required <span class="text-muted">({{ __('We will contact you using this email') }})</span></label>
                <input type="email" class="form-control" value="{{ Auth::user()->email }}" required name="email">
        </div>
        <div class="form-group">
                <label class="control-label">@langapp('subject') @required</label>
                <input type="text" class="form-control" placeholder="Billing Issue" required name="subject">
        </div>

        <div class="form-group">
                <label class="control-label">@langapp('message') @required</label>
                <textarea name="message" class="markdownEditor form-control" rows="10"></textarea>
        </div>

        <input type="hidden" name="priority" value="2">
        <input type="hidden" name="phpversion" value="{{ phpversion() }}">
        <input type="hidden" name="version" value="{{ getCurrentVersion()['version'] }}">
        <input type="hidden" name="build" value="{{ getCurrentVersion()['build'] }}">
        <input type="hidden" name="purchase_code" value="{{ get_option('purchase_code') }}">

            <div class="modal-footer">

            {!! closeModalButton() !!}
            
            @if(!isDemo())
            {!! renderAjaxButton('send') !!}
            @endif

            </div>
    {!! Form::close() !!}



        </div>
</div>
@push('pagescript')
@include('stacks.js.markdown')
<script>
    $('.ajaxifyForm').submit(function (event) {
        $(".formSaving").html('Processing..<i class="fas fa-spin fa-spinner"></i>');
        event.preventDefault();

        var data = new FormData(this);

        var instance = axios.create();
        delete instance.defaults.headers.common['X-CSRF-TOKEN'];
        delete instance.defaults.headers.common['X-Requested-With'];

        instance.post($(this).attr("action"), data)
            .then(function (response) {
                    toastr.success(response.data.message, '@langapp('response_status') ');
                    $(".formSaving").html('<i class="fas fa-check"></i> @langapp('save') </span>');
                    window.location.href = '/dashboard';
          })
          .catch(function (error) {
            var errors = error.response.data.errors;
            var errorsHtml= '';
            $.each( errors, function( key, value ) {
                errorsHtml += '<li>' + value[0] + '</li>'; 
            });
            toastr.error( errorsHtml , '@langapp('response_status') ');
            $(".formSaving").html('<i class="fas fa-sync"></i> Try Again</span>');
        }); 
        
    });
</script>


@endpush

@stack('pagescript')
