<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('make_changes')</h4>
        </div>

        {!! Form::open(['url' => 'api/v1/issues/'.$issue->id.'/status', 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}

        <input type="hidden" name="id" value="{{ $issue->id }}">
        <input type="hidden" name="url" value="{{ url()->previous() }}">
        <div class="modal-body">

            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('status')   </label>
                <div class="col-lg-8">
                    <select name="status" class="form-control">
                        @foreach (App\Entities\Status::all() as $status) 
                            <option value="{{ $status->id }}" {{ $status->id == $issue->status ? 'selected' : '' }}>{{  ucfirst($status->status)  }}</option>
                        @endforeach
                    </select>
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
