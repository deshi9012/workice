<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@svg('solid/trash-alt') @langapp('delete')  </h4>
        </div>
        {!! Form::open(['route' => ['rates.destroy', $rate->id], 'method' => 'DELETE']) !!}
        
        <div class="modal-body">
            <p>@langapp('delete_rate_warning')  </p>

            <p>
                @langapp('name')  : <strong>{{ $rate->name }}</strong><br>
                @langapp('tax_rate')  : <strong>{{ $rate->rate }}%</strong><br>
            </p>

            <input type="hidden" name="id" value="{{  $rate->id  }}">

        </div>
        <div class="modal-footer">

            {!! closeModalButton() !!}
            {!! okModalButton() !!}
            
            
        </div>
        {!! Form::close() !!}
    </div>

</div>