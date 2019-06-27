<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('delete') - {{ $currency->title }} </h4>
        </div>

        {!! Form::open(['route' => ['settings.currencies.destroy', $currency->id], 'class' => 'ajaxifyForm', 'method' => 'DELETE']) !!}
        <div class="modal-body">
            <p>@langapp('delete_warning')</p>

            <div class="m-sm">@langapp('code') : <strong>{{ $currency->code }} </strong></div>
            <div class="m-sm">@langapp('title') : <strong>{{ $currency->title }} </strong></div>
            <div class="m-sm">@langapp('currency_symbol') : <strong>{{ $currency->symbol }} </strong></div>

            <input type="hidden" name="id" value="{{  $currency->id  }}">

        </div>
        <div class="modal-footer">
            
            {!! closeModalButton() !!}
            {!! renderAjaxButton('ok') !!}
           
        </div>
        {!! Form::close() !!}
        
    </div>

</div>
@include('partial.ajaxify')