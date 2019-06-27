<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/history') @langapp('time_entry')  </h4>
        </div>
        <div class="modal-body">
            <div class="comments-history scrollable">
                <ul class="list-unstyled">
                    <li class="">
                        <div class="clearfix">
                            <div class="comment-section pull-left">
                                
                                <div class="media">
                                    @foreach ($entries as $entry)
                                    
                                    <div class="pull-left">
                                        <div class="txn-comment-icon circle-box">
                                            @icon('solid/clock')
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <div class="comment">
                                            <span class="description small"><strong>{{  $entry->user->name  }}</strong> worked for {{  secToHours($entry->worked)  }}
                                                on <span class="text-danger">{{  $entry->created_at->toDayDateTimeString()  }}</span></span>
                                                <span class="small text-muted">
                                                    @parsedown($entry->notes)
                                                </span>
                                            </div>
                                        </div>
                                        
                                        
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            </div>    <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->