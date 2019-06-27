<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('make_changes')</h4>
        </div>


        <div class="modal-body">

        {!! Form::open(['url' => ['/oauth/clients', $client->id], 'class' => 'bs-example ajaxifyForm', 'method' => 'PUT']) !!}
        

        <div class="form-group">
                <label class="control-label">@langapp('name') @required</label>
               
                    <input type="text" class="form-control" name="name" value="{{ $client->name }}">
                    <span class="help-block text-muted">Something your users will recognize and trust.</span>
                
        </div>

        <div class="form-group">
                <label class="control-label">Oauth Redirect URL @required</label>
                
                    <input type="text" class="form-control" name="redirect" value="{{ $client->redirect }}">
                    <span class="help-block text-muted">Your application's authorization callback URL.</span>
                
        </div>



            <div class="modal-footer">
            {!! closeModalButton() !!}
        {!!  renderAjaxButton()  !!}
    </div>
    {!! Form::close() !!}



        </div>
</div>
<script>
    $('.ajaxifyForm').submit(function (event) {
        $(".formSaving").html('Processing..<i class="fas fa-spin fa-spinner"></i>');
        event.preventDefault();
        var data = new FormData(this);
        axios.post($(this).attr("action"), data)
            .then(function (response) {
                    toastr.success('Oauth Client changed successfully', '@langapp('response_status') ');
                    $(".formSaving").html('<i class="fas fa-check"></i> @langapp('save') </span>');
                    window.location.href = '/users/api-setup';
          })
          .catch(function (error) {
            toastr.error( 'Failed to create oauth client' , '@langapp('response_status') ');
            $(".formSaving").html('<i class="fas fa-sync"></i> Try Again</span>');
        }); 
        
    });
</script>