{!! Form::open(['route' => 'contacts.send', 'class' => 'bs-example ajaxifyForm', 'data-toggle' => 'validator', 'files' => true]) !!}
<input type="hidden" name="id" value="{{ $id }}">
<input type="hidden" name="url" value="{{ url()->previous() }}">
<div class="panel-body">
  <div class="form-group">
    <label class="control-label">@langapp('subject')  @required</label>
    <input type="text" class="form-control" value="{{ $subject }}" name="subject">
  </div>
  
  <div class="form-group">
    <label class="control-label">@langapp('message') @required</label>
    <textarea name="message" class="form-control markdownEditor" id="cannedResponse"></textarea>
  </div>
  @if(count(Auth::user()->cannedResponses) > 0)
  <select name="selectCanned" class="form-control m-b" id="insertCannedResponse" onChange="insertMessage(this.value);">
    <option value="0">--- @langapp('canned_responses') ---</option>
    @foreach (Auth::user()->cannedResponses as $template)
    <option value="{{ $template->id }}">{{ $template->subject }}</option>
    @endforeach
  </select>
  @endif
  <div class="line"></div>
  
  <div class="form-group">
    <label class="control-label">@langapp('attach_file')  </label>
    <input type="file" name="uploads[]" multiple="">
    
  </div>
  
  <div class="form-group display-none" id="queueLater">
    <label>@langapp('schedule')</label>
    <div class="input-group date">
      <input type="text" class="form-control datetimepicker-input"
      value="{{  timePickerFormat(now()) }}" name="reserved_at"
      data-date-format="DD-MM-YYYY hh:mm A" data-date-start-date="0d">
      <div class="input-group-addon">
        <span class="fas fa-calendar-alt"></span>
      </div>
    </div>
  </div>
  {!! renderAjaxButton('send') !!}
  <a href="#" id="sendLater" class="btn btn-sm btn-warning btn-rounded pull-right">@icon('solid/clock') @langapp('send_later')</a>
</div>
{!! Form::close() !!}