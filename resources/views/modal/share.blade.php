<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">@icon('solid/share-alt') @langapp('tell_friend')  </h4>
    </div>
    <div class="modal-body">
      {!! Form::open(['route' => 'invite.friend', 'class' => 'bs-example ajaxifyForm']) !!}
      
      <div class="form-group">
        <label class="control-label">@langapp('email') @required</label>
        <input type="email" class="form-control" placeholder="johndoe@example.com" required name="email">
        <span class="help-block text-muted">{{ __('Enter your friend\'s email address to invite')}}</span>
      </div>
      <div class="form-group">
        <div class="checkbox">
          <label>
            <input type="hidden" name="anti_spam" value="0">
            <input type="checkbox" name="anti_spam" value="1">
            <span class="label-text text-muted">
              {{ __('To comply with anti-spam legislation, you declare that the intended recipients of your message are people with whom you have a personal relationship') }}
            </span>
          </label>
        </div>
      </div>
      <a class="twitter-share-button btn btn-sm btn-info"
        href="https://twitter.com/intent/tweet?text=RT%20Everything%20a%20freelancer%20needs%20from%20projects%20and%20tasks%20to%20leads,deals,support%20system%20and%20smarter%20invoicing,%20all%20in%20one%20platform&url=https://workice.com&hashtags=crm,envato,freelancer,laravel&via=wmandai">
      Tweet</a>
      <div class="modal-footer">
        {!! closeModalButton() !!}
        {!! renderAjaxButton('send_invite') !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
  @push('pagescript')
  <script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
  t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);
  t._e = [];
  t.ready = function(f) {
  t._e.push(f);
  };
  return t;
  }(document, "script", "twitter-wjs"));</script>
  @include('partial.ajaxify')
  @endpush
  @stack('pagescript')