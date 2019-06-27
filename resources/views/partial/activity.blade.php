<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">@icon('solid/history') @langapp('activity')  </h4>
    </div>
    <div class="modal-body">
      <div class="comments-history scrollable">
        <ul class="list-unstyled">
          @foreach ($activities as $activity)
          <li class="">
            <div class="clearfix">
              <div class="comment-section pull-left">
                <div class="media">
                  <p>
                    <div class="pull-left">
                      <div class="txn-comment-icon circle-box">
                        <i class="fas {{ $activity->icon }} text-{{ get_option('theme_color') }}"></i>
                      </div>
                    </div>
                    <div class="media-body">
                      
                      <div class="comment">
                        <span class="description small">
                          @langactivity($activity->action, ['value1' => '<span class="text-bold">'.$activity->value1.'</span>', 'value2' => '<span class="text-bold">'.$activity->value2.'</span>'])
                          <br><a href="{{ $activity->url }}">@icon('solid/clock') {{ dateTimeFormatted($activity->created_at) }} - {{ $activity->user->name  }}</a>
                        </span>
                      </div>
                    </div>
                  </p>
                </div>
              </div>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>