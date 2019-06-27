<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('calendar') - {{ $calendar->name }}</h4>
        </div>
        {!! Form::open(['route' => ['settings.calendars.update', $calendar->id], 'method' =>'PUT', 'class' => 'bs-example form-horizontal ajaxifyForm', 'id' => 'editCalendar']) !!}
        <input type="hidden" name="id" value="{{ $calendar->id }}">

        <div class="modal-body">
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('calendar') @required</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ $calendar->name }}" name="name">
                </div>
            </div>

        </div>
        <div class="modal-footer">

            {!! closeModalButton() !!}
            {!!  renderAjaxButton()  !!}
            
        </div>
        {!! Form::close() !!}
    </div>
</div>

@include('partial.ajaxify')