<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/trash-alt') @langapp('delete')  </h4>
        </div>

        {!! Form::open(['route' => ['links.destroy', $link->link_id], 'method' => 'DELETE']) !!}

        <div class="modal-body">
            <p>@langapp('delete_link_warning')  </p>

            <a href="{{ $link->link_url }}" target="_blank">{{ $link->link_title }}</a>

            <input type="hidden" name="link_id" value="{{  $link->link_id  }}">

        </div>
        <div class="modal-footer">
            
            {!! closeModalButton() !!}
            {!! okModalButton() !!}
            
        </div>


        {!! Form::close() !!}
    </div>
</div>