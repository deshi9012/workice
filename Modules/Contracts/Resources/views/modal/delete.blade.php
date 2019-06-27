<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@svg('solid/trash-alt') @langapp('delete')  </h4>
        </div>
        {!! Form::open(['route' => ['contracts.api.delete', $contract->id], 'class' => 'ajaxifyForm', 'method' => 'DELETE']) !!}
        <div class="modal-body">
            <p>@langapp('delete_warning')</p>

            @langapp('title') : <strong>{{ $contract->contract_title }}</strong>

            <input type="hidden" name="id" value="{{  $contract->id  }}">

        </div>
        <div class="modal-footer">
            
            {!! closeModalButton() !!}
            {!! renderAjaxButton('ok') !!}
            
        </div>
        {!! Form::close() !!}
    </div>
</div>
@include('partial.ajaxify')