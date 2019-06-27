<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@svg('solid/trash-alt') @langapp('delete')  </h4>
        </div>
        {!! Form::open(['route' => ['items.api.delete', $item->id], 'class' => 'ajaxifyForm', 'method' => 'DELETE']) !!}
       
        <div class="modal-body">
            <p>@langapp('delete_warning')  </p>

            <input type="hidden" name="id" value="{{ $item->id }}">
            <input type="hidden" name="url" value="{{ url()->previous() }}">

            <p>@langapp('name'): <strong>{{ $item->name }}</strong></p>
             <p>{{ itemUnit() }}: <strong>{{ $item->unit_cost }}</strong></p>
             <p>@langapp('quantity'): <strong>{{ $item->quantity }}</strong></p>

             @parsedown(str_limit($item->description, 255))




        </div>
        <div class="modal-footer">

            {!! closeModalButton() !!}
            {!! okModalButton() !!}
            
        </div>
        
        {!! Form::close() !!}
    </div>
</div>

@include('partial.ajaxify')