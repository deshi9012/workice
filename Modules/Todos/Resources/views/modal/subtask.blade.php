<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/plus') @langapp('create')  </h4>
        </div>

        {!! Form::open(['route' => 'todos.api.subtask', 'class' => 'form-horizontal ajaxifyForm']) !!}

        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <input type="hidden" name="order" value="0">
        <input type="hidden" name="parent" value="{{ $parent->id }}">
        <input type="hidden" name="assignee" value="{{ $parent->assignee }}">
        <input type="hidden" name="url" value="{{ url()->previous() }}">


        <div class="modal-body">


             <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('subject') @required</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" name="subject" placeholder="Send Proposal" required>
                </div>
            </div>


             <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('date') @required</label>
                <div class="col-lg-9">

                    <div class="input-group date">
                        <input type="text" class="form-control datetimepicker-input"
                               value="{{  timePickerFormat(now()->addHours(1)) }}" name="due_date"
                               data-date-format="DD-MM-YYYY hh:mm A" data-date-start-date="0d" required>
                        <div class="input-group-addon">
                            @icon('solid/calendar-alt', 'text-muted')
                        </div>
                    </div>
                </div>
            </div>

            


            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('notes')   </label>
                <div class="col-lg-9">
                    <textarea class="form-control markdownEditor" data-hidden-buttons='["cmdCode", "cmdQuote"]' name="notes"></textarea>
                </div>
            </div>
            
        
        </div>
        <div class="modal-footer">

            {!! closeModalButton() !!}
            {!! renderAjaxButton() !!}

        </div>

        {!! Form::close() !!}
    </div>
</div>

@push('pagestyle')
    @include('stacks.css.datepicker')
@endpush
@push('pagescript')
    @include('stacks.js.datepicker')
    @include('stacks.js.markdown')
    @include('partial.ajaxify')
    <script type="text/javascript">
    $('.datetimepicker-input').datetimepicker({showClose: true});
</script>
@endpush

@stack('pagestyle')
@stack('pagescript')