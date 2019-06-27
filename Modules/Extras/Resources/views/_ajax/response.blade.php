<li class="panel panel-default" id="response-{{ $canned->id }}">
  <div class="panel-heading">
    <a class="accordion-toggle subject" data-toggle="collapse" data-parent="#accordion2" href="#{{ slugify($canned->subject) }}">
      @icon('solid/envelope-open') {{ $canned->subject }}
    </a>
    <a href="#" class="delete-response pull-right canned-muted" data-response-id="{{$canned->id}}">@icon('solid/trash-alt') </a>
    <a href="{{ route('extras.edit.response', ['id' => $canned->id]) }}" class="pull-right canned-muted m-l-xs" data-toggle="ajaxModal">
      @icon('solid/pencil-alt')
    </a>
  </div>
  <div id="{{ slugify($canned->subject) }}" class="panel-collapse collapse">
    <div class="panel-body message">
      @parsedown($canned->message)
    </div>
  </div>
</li>