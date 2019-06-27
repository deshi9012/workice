@extends('layouts.app')
@section('content')
<section id="content">
  <section class="hbox stretch">
    <aside class="lter b-l">
      <section class="vbox">
        <header class="header bg-white b-b clearfix">
          <div class="row m-t-sm">
            <div class="col-sm-12 m-b-xs">
              <p class="h3">@langapp('send_email_to_leads')</p>
            </div>
          </div>
        </header>
        <section class="scrollable wrapper bg">
          <div class="panel panel-body">
            
            
            <section class="panel panel-default">
              
              
            <header class="panel-heading"><span class="text-dracula">{{ $leads->count() }} @langapp('leads')</span></header>
            {!! Form::open(['route' => 'leads.bulk.send', 'class' => 'bs-example ajaxifyForm', 'data-toggle' => 'validator']) !!}
            
            <div class="panel-body">
              
              <div class="form-group">
                <label class="control-label">@langapp('leads') @required</label>
                <select class="select2-option width100" multiple="multiple" name="leads[]">
                  @foreach ($leads  as $lead)
                  <option value="{{ $lead->id }}" selected>{{ $lead->name }} &laquo;{{ $lead->email }}&raquo;</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label class="control-label">@langapp('subject') @required</label>
                <input type="text" name="subject" class="form-control">
              </div>
              <div class="form-group">
                <label class="control-label">BCC</label>
                <input type="text" name="bcc" placeholder="you@domain.com" class="form-control">
              </div>
              @if(count(Auth::user()->cannedResponses) > 0)
              <select name="selectCanned" class="form-control m-b" id="insertCannedResponse" onChange="insertMessage(this.value);">
                <option value="0">--- @langapp('canned_responses') ---</option>
                @foreach (Auth::user()->cannedResponses as $template)
                <option value="{{ $template->id }}">{{ $template->subject }}</option>
                @endforeach
              </select>
              @endif
              <div class="form-group">
                <label class="control-label">@langapp('message') @required</label>
                <textarea name="message" class="form-control markdownEditor" id="cannedResponse"></textarea>
              </div>
              
              <div class="form-group display-none" id="queueLater">
                <label>{{ langapp('schedule') }}</label>
                <div class="input-group date">
                  <input type="text" class="form-control datetimepicker-input"
                  value="{{ timePickerFormat(now()) }}" name="later_date"
                  data-date-format="DD-MM-YYYY hh:mm A" data-date-start-date="0d">
                  <div class="input-group-addon">
                    @icon('solid/calendar-alt', 'text-muted')
                  </div>
                </div>
              </div>
              
              
              
            </div>
            <div class="panel-footer">
              {!! renderAjaxButton('send') !!}
              <a href="#" id="sendLater" class="btn btn-sm btn-success btn-rounded pull-right">@icon('solid/clock') Send Later</a>
            </div>
            {!! Form::close() !!}
          </section>
          
          
        </div>
      </section>
    </section>
  </aside>
</section>
</section>
@push('pagestyle')
@include('stacks.css.form')
@include('stacks.css.datepicker')
@endpush
@push('pagescript')
@include('stacks.js.form')
@include('stacks.js.markdown')
@include('stacks.js.datepicker')
<script type="text/javascript">
$('.datetimepicker-input').datetimepicker({showClose: true, showClear: true, minDate: moment() });
$( "#sendLater" ).click(function() {
$("#queueLater").show("fast");
  $( ".datetimepicker-input" ).focus();
});
function insertMessage(d) {
axios.post('{{ route('extras.canned_responses') }}', {
  "response_id": d
})
.then(function (response) {
  $("textarea#cannedResponse").html(response.data.message);
})
.catch(function (error) {
  toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
});
}
</script>
@endpush
@endsection