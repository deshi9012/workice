<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@svg('solid/trash-alt') @langapp('delete')  </h4>
        </div>
        {!! Form::open(['route' => ['vaults.api.delete', $id], 'method' => 'DELETE', 'class' => 'ajaxifyForm']) !!}
       
        <div class="modal-body">
            <p>@langapp('delete_warning')</p>

            <input type="hidden" name="id" value="{{  $id  }}">
            <input type="hidden" name="url" value="{{ url()->previous() }}">

        </div>
        <div class="modal-footer">

            {!! closeModalButton() !!}
            {!! renderAjaxButton('ok') !!}
            
        </div>
        
        {!! Form::close() !!}
    </div>
</div>
@include('partial.ajaxify')