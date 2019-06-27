<section class="">
  
  <div class="chat-history">
    <article class="chat-item chat-message clearfix" id="chat-form">
      <a class="pull-left thumb-sm avatar">
      <img src="{{ avatar() }}" class="img-circle"></a>
      <section class="chat-body">
        {!! Form::open(['route' => ['leads.email', $lead->id], 'class' => 'bs-example ajaxifyForm m-b-none', 'id' => 'sendMail', 'data-toggle' => 'validator', 'files' => true]) !!}
        <input type="hidden" name="to" value="{{ $lead->id }}">
        <input type="hidden" name="from" value="{{ $lead->sales_rep }}">
        <div class="form-group">
          <label class="control-label">@langapp('subject') @required</label>
          <input type="text" name="subject" value="{{ optional($lead->emails->last())->subject }}" class="form-control">
        </div>
        <textarea name="message" id="cannedResponse" class="form-control markdownEditor" placeholder="Message"></textarea>
        <input type="file" class="form-control" name="uploads[]" multiple="">
        <div class="line"></div>
        @if(count(Auth::user()->cannedResponses) > 0)
        <select name="selectCanned" class="form-control m-b" id="insertCannedResponse" onChange="insertMessage(this.value);">
          <option value="0">--- @langapp('canned_responses') ---</option>
          @foreach (Auth::user()->cannedResponses as $template)
          <option value="{{ $template->id }}">{{ $template->subject }}</option>
          @endforeach
        </select>
        @endif
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
        <a href="#" id="sendLater" class="btn btn-sm btn-warning btn-rounded pull-right">@icon('solid/clock') Send Later</a>
        
        {!! Form::close() !!}
      </section>
    </article>
    
    <section class="chat-list panel-body" id="msg-list">
      
      @include('messages::partials.search')
      
      <ul id="leadConversations" class="list">
        @foreach($lead->emails as $message)
        
        <article id="message-{{$message->id}}" class="chat-item {{ $message->from == $lead->sales_rep ? 'left' : 'right' }}">
          <a href="#" class="pull-{{ $message->from == $lead->sales_rep ? 'left' : 'right' }} thumb-sm avatar">
          <img src="{{ getAvatarImage($lead->name) }}" class="img-circle"></a>
          
          <section class="chat-body comment-body">
            <div class="panel b-light m-b-none" >
              <header class="panel-heading bg-white b-b">
                <a href="#" class="{{ $message->opened ? 'text-success': '' }}">{{ $message->subject }}</a>
                <label class="label bg-info m-l-xs">{{ $message->meta['sender'] }}</label>
                <span class="text-muted m-l-sm pull-right">
                  @icon('solid/clock') {{ dateElapsed($message->created_at) }}
                </span>
              </header>
              <div class="panel-body">
                <span class="arrow {{ $message->from === $lead->sales_rep ? 'left' : 'right' }}"></span>
                <div class="message other-message float-right m-b-sm">
                  @parsedown($message->message)
                </div>
                @include('partial._show_files', ['files' => $message->files])
                <span class="message-data-name text-muted" >
                  <a href="#" class="deleteMessage" data-message-id="{{$message->id}}" title="@langappapp('delete')">
                    @icon('solid/trash', 'pull-right')
                  </a>
                  @if($message->from == $lead->sales_rep)
                  <i class="fas fa-{{ $message->opened > 0 ? 'envelope-open text-success' : 'envelope text-danger'  }}" data-rel="tooltip" title="{{ $message->opened >= 1 ? 'Email Viewed' : 'Not Viewed' }}"></i>
                  @endif
                </span>
                
              </div>
            </div>
            <small class="text-muted message-data-time small">@icon('solid/user-circle') {{ $lead->name }}
            <span class="m-l-sm">@icon('solid/calendar-alt') {{ dateTimeFormatted($message->created_at) }}</span>
            </small>
            
          </section>
        </article>
        
        @if($message->from != Auth::id())
        {{ $message->markRead() }}
        @endif
        @endforeach
      </ul>
    </section>
    
    
    
    
  </div>
  
</section>
@push('pagestyle')
@include('stacks.css.datepicker')
@endpush
@push('pagescript')
@include('stacks.js.list')
@include('stacks.js.datepicker')
<script type="text/javascript">
$('.datetimepicker-input').datetimepicker({showClose: true, showClear: true, minDate: moment() });

$( "#sendLater" ).click(function() {
$("#queueLater").show("fast");
$( ".datetimepicker-input" ).focus();
});
var options = {
valueNames: [ 'message' ]
};
var msgList = new List('msg-list', options);
$('.chat-list').on('click', '.deleteMessage', function (e) {
e.preventDefault();
var tag, url, id, request;
tag = $(this);
id = tag.data('message-id');
url = '{{ route('leads.email.delete') }}';
if(!confirm('Do you want to delete this message?')) {
  return false;
}
request = $.ajax({
  method: "post",
  url: url,
  data: {
  id: id,
  _token: '{{ csrf_token() }}'
  }
});
request.done(function(response) {
if (response.status == 'success') {
toastr.info( response.message , '@langapp('response_status')');
  $('#message-' + id).hide(500, function () {
$(this).remove();
});
}
});
});
function insertMessage(d) {
axios.post('{{ route('extras.canned_responses') }}', {
  "response_id": d
})
.then(function (response) {
  $("textarea#cannedResponse").val(response.data.message);
})
.catch(function (error) {
  toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
});
}
</script>
@endpush