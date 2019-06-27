<div class="modal-dialog" id="eventModal">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@langapp('log_call')  </h4>
        </div>
        {!! Form::open(['route' => ['calls.api.update', $call->id], 'class' => 'bs-example ajaxifyForm', 'data-toggle' => 'validator', 'method' => 'PUT']) !!}
        
        <div class="modal-body">
            <input type="hidden" name="module" value="{{ $call->phoneable_type }}">
            <input type="hidden" name="module_id" value="{{ $call->phoneable_id }}">
            <input type="hidden" name="url" value="{{ url()->previous() }}">

            <div class="form-group">
                <label class="control-label">@langapp('subject') @required</label>
                <input type="text" class="form-control" name="subject" value="{{ $call->subject }}" required>
            </div>
            <div class="form-group">
                <label class="">@langapp('call_type') @required </label>
                <select class="form-control" name="type">
                    <option value="outbound" {{ $call->type === 'outbound' ? 'selected' : '' }}>@langapp('outbound')</option>
                    <option value="inbound" {{ $call->type === 'inbound' ? 'selected' : '' }}>@langapp('inbound')</option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label">@langapp('duration') <strong>(Format h:m:s i.e 00:35:20 means 35 Minutes and 20 Sec)</strong></label>
                <input type="text" class="form-control" name="duration" value="{{ gmsec($call->duration) }}" required>
            </div>
            <div class="form-group">
                <label class="">@langapp('assigned') @required </label>
                <select class="form-control select2-option" name="assignee">
                    @foreach (app('user')->select('id','username', 'name')->get() as $user)
                    <option value="{{  $user->id  }}" {{ $call->assignee === $user->id ? 'selected' : '' }}>{{  $user->name  }}</option>
                    @endforeach
                </select>
            </div>
           
        
            
            <div class="form-group">
                <label class="">@langapp('description')</label>
                <textarea class="form-control ta" name="description">{{ $call->description }}</textarea>
                
            </div>
            <div class="form-group">
                <label class="">@langapp('call_result')</label>
                <textarea class="form-control markdownEditor" name="result">{{ $call->result }}</textarea>
                
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
@include('stacks.css.form')
@endpush
@push('pagescript')
@include('stacks.js.datepicker')
@include('stacks.js.form')
@include('stacks.js.markdown')
@include('partial.ajaxify')
<script type="text/javascript">
$('.datetimepicker-input').datetimepicker({showClose: true, showClear: true, minDate: moment().add(-1, 'days') });
</script>
@endpush
@stack('pagestyle')
@stack('pagescript')