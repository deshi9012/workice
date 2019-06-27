<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('next_stage')</h4>
        </div>
        @php
        $nextStage = $lead->nextStage() ? $lead->nextStage() : App\Entities\Category::leads()->max('order');
        @endphp
        {!! Form::open(['route' => ['leads.api.next.stage', $lead->id], 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}
        <input type="hidden" name="id" value="{{  $lead->id  }}">
        <input type="hidden" name="url" value="{{ url()->previous() }}">
        <div class="modal-body">
            <input type="hidden" value="{{ App\Entities\Category::leads()->whereOrder($nextStage)->first()->id }}" name="stage">
            <div class="padder m-b-lg">
                @langapp('lead_next_stage_message', ['name' => $lead->name, 'from' => $lead->status->name, 'to' => App\Entities\Category::leads()->whereOrder($nextStage)->first()->name])
            </div>
            <div class="modal-footer">
                
                {!! closeModalButton() !!}
                {!! renderAjaxButton()  !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@include('partial.ajaxify')