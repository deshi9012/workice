<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('time_entry')</h4>
        </div>

        {!! Form::open(['route' => ['timers.api.update', $entry->id], 'class' => 'bs-example form-horizontal ajaxifyForm', 'method' => 'PUT']) !!}
        
        <input type="hidden" name="id" value="{{ $entry->id }}">
        <input type="hidden" name="url" value="{{ url()->previous() }}">
        
        <div class="modal-body">

            @isset($entry->timeable->tasks)
            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('task')</label>
                <div class="col-lg-8">
                    <select name="task_id" class="select2-option form-control">
                        <option value="">None</option>
                        @foreach ($entry->timeable->tasks as $key => $task) 
                            <option value="{{  $task->id  }}" {{ $entry->task_id === $task->id ? 'selected' : '' }}>{{  $task->name  }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            @endisset

            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('time_spent')  </label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" value="{{ gmsec($entry->worked) }}" name="total">
                    <span class="help-block text-dark small"><strong>HH:MM:SS</strong> e.g 4:00:00 (4hrs)</span>
                </div>

            </div>


            <div class="form-group">
                <label class="col-lg-4 control-label">@langapp('description')  </label>
                <div class="col-lg-8">
                    <textarea name="notes" class="form-control ta">{{ $entry->notes }}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4"></label>
                <div class="col-lg-8">
                    <label>
                        <input type="hidden" name="billable" value="0">
                        <input type="checkbox" name="billable" value="1" {{ $entry->billable ? 'checked' : '' }}>
                        <span class="label-text">@langapp('billable')</span>
                    </label>
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
    @include('stacks.css.form')
@endpush
@push('pagescript')
    @include('stacks.js.form')
    @include('partial.ajaxify')
@endpush

@stack('pagestyle')
@stack('pagescript')