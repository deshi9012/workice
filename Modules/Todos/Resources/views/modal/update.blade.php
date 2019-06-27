<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('make_changes')  </h4>
        </div>

        {!! Form::open(['route' => ['todos.api.update', $todo->id], 'class' => 'bs-example form-horizontal ajaxifyForm', 'method' => 'PUT']) !!}

        <input type="hidden" name="id" value="{{ $todo->id }}">
        <input type="hidden" name="url" value="{{ url()->previous() }}">
        <div class="modal-body">

            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('subject') @required</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control ta" name="subject" value="{{ $todo->subject }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('date') @required</label>
                <div class="col-lg-9">

                    <div class="input-group date">
                        <input type="text" class="form-control datetimepicker-input"
                               value="{{ timePickerFormat($todo->due_date) }}" name="due_date"
                               data-date-format="DD-MM-YYYY hh:mm A" data-date-start-date="0d" required>
                        <div class="input-group-addon">
                            @icon('solid/calendar-alt', 'text-muted')
                        </div>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('assigned')  </label>
                <div class="col-lg-9">

                    <select name="assignee" class="select2-option form-control">
                        @foreach (app('user')->select('id', 'username', 'name')->get() as $key => $user) 
                            <option value="{{  $user->id  }}" {{ $user->id == $todo->assignee ? 'selected="selected"' : '' }}>{{  $user->name  }}</option>
                        @endforeach

                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">@langapp('notes')</label>
                <div class="col-lg-9">
                    <textarea class="form-control markdownEditor" data-hidden-buttons='["cmdCode", "cmdQuote"]' name="notes">{{ $todo->notes }}</textarea>
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


@push('pagestyle')
    @include('stacks.css.datepicker')
    @include('stacks.css.form')
@endpush
@push('pagescript')
    @include('stacks.js.datepicker')
    @include('stacks.js.markdown')
    @include('stacks.js.form')
    <script type="text/javascript">
    $('.datetimepicker-input').datetimepicker({showClose: true});
</script>
@include('partial.ajaxify')

@endpush

@stack('pagestyle')
@stack('pagescript')