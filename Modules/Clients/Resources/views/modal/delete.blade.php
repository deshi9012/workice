<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('delete') - {{ $client->name }} </h4>
        </div>
        {!! Form::open(['route' => ['clients.destroy', $client->id], 'method' => 'DELETE']) !!}
        <div class="modal-body">
            <p class="text-danger">@langapp('delete_warning') </p>


            <input type="hidden" name="id" value="{{  $client->id }}">

        </div>
        <div class="modal-footer">

            {!! closeModalButton() !!}
            {!! okModalButton() !!}
            
        </div>

        {!! Form::close() !!}
    </div>
</div>
