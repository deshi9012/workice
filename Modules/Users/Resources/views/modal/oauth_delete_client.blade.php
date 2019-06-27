<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('delete') Oauth Client - {{ $client->name }}</h4>
        </div>



        {!! Form::open(['url' => ['/oauth/clients', $client->id], 'class' => 'ajaxifyForm', 'method' => 'DELETE']) !!}

        <div class="modal-body">

            <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="fa fa-ban-circle"></i><strong>Note!</strong> You are about to delete Oauth Client <strong>{{ $client->name }}</strong>
                  </div>


        </div>
        <div class="modal-footer">

            {!! closeModalButton() !!}
            {!! renderAjaxButton('ok') !!}

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
                    toastr.warning('Oauth Client deleted successfully', '@langapp('response_status') ');
                    $(".formSaving").html('<i class="fas fa-check"></i> @langapp('save') </span>');
                    window.location.href = '/users/api-setup';
          })
          .catch(function (error) {
            toastr.error( 'Failed to create oauth client' , '@langapp('response_status') ');
            $(".formSaving").html('<i class="fas fa-sync"></i> Try Again</span>');
        }); 
        
    });
</script>