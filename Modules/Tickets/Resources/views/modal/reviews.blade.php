<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">@icon('solid/star') {{  langapp('reviews')  }}</h4>
        </div>

        <div class="modal-body">

            
                <a href="#" class="thumb-sm pull-left m-r-sm">
                    <img src="{{ avatar($review->user_id) }}" class="img-circle">
                </a>
                <span class="clear">
                <small class="pull-right">{{ dateElapsed($review->updated_at) }}</small>
                    <strong class="block">{{ $review->user->name }}</strong>
                    
                    @empty ($review->message)
                        
                        <small>No Feedback Message</small>
                    
                    @endempty
                    
                    <small>@parsedown($review->message)</small>
                               
                  @if($review->satisfied)
                  <span class="heading-text pull-right">
                    @icon('solid/star', 'text-base text-warning')
                    @icon('solid/star', 'text-base text-warning')
                    @icon('solid/star', 'text-base text-warning')
                    @icon('solid/star', 'text-base text-warning')
                    @icon('solid/star', 'text-base text-warning')
                    </span>
                  @else
                  <span class="heading-text pull-right">
                    @icon('solid/star', 'text-base text-warning')
                    @icon('solid/star', 'text-base text-muted')
                    @icon('solid/star', 'text-base text-muted')
                    @icon('solid/star', 'text-base text-mutes')
                    @icon('solid/star', 'text-base text-muted')
                  </span>
                  @endif

                 


          </span>

           @if($review->satisfied)
                    <span class="text-success">@icon('solid/thumbs-up') Customer was satisfied</span>
                @else
                    <span class="text-danger pull-right">@icon('solid/thumbs-down')</i> Customer was unsatisfied</span>
            @endif
                              
                            
            

        </div>
        <div class="modal-footer">
            
            {!! closeModalButton() !!}
            
            
        </div>

    </div>
</div>