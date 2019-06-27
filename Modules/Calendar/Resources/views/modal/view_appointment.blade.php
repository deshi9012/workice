<div class="modal-dialog">
    <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title h3">{{  $appointment->name  }}</h4>
            </div>
            <div class="modal-body">
                <ul class="list-group no-radius">
                    <li class="list-group-item">
                    <span class="pull-right">
                        {{  $appointment->name  }}
                    </span>
                        @langapp('name')  
                    </li>

                   

                    <li class="list-group-item">
                    <span class="pull-right">
                         <label class="label label-success">{{  dateTimeFormatted($appointment->start_time)  }}</label>
                    </span>
                        @langapp('start_date')  
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                         <label class="label label-danger">{{  dateTimeFormatted($appointment->finish_time)  }}</label>
                    </span>
                        @langapp('end_date')  
                    </li>

                    @if (!is_null($appointment->venue))

                        <li class="list-group-item">
                    <span class="pull-right">
                         @icon('solid/building') <label class="label label-danger"> {{  $appointment->venue  }}</label>
                    </span>
                            @langapp('venue')  
                        </li>

                    @endif


                    <li class="list-group-item">
                    <span class="pull-right">
                    <a class="thumb-xs avatar">
      <img src="{{ $appointment->user->profile->photo }}" class="img-rounded image-radius">

          </a> <label class="label label-default">{{  $appointment->user->name  }}</label></span>
                        @langapp('user')  
                    </li>

                @if ($appointment->lead_id > 0) 

                        <li class="list-group-item">
                    <span class="pull-right">
                         <a href="{{  route('leads.view', ['id' => $appointment->lead_id]) }}">
                         {{  $appointment->lead->name }}
                         </a>
                    </span>
                            @langapp('lead')  
                        </li>
                @endif

                </ul>
                @parsedown($appointment->comments)


                <div class="line line-dashed line-lg pull-in"></div>


            @if ($appointment->attendee_id > 0) 

                <a class="thumb-sm avatar" data-rel="tooltip" title="{{ $appointment->attendee->name }}">
                    <img src="{{ $appointment->attendee->profile->photo }}" class="img-rounded shadowed">
                </a>

            @endif


            </div>
            <div class="modal-footer">
                
                @if(can('events_update') || $appointment->user_id == Auth::id() || isAdmin())

                {!! closeModalButton() !!}

                    <a href="{{  route('calendar.edit.appointment', ['id' => $appointment->id])  }}"
                       class="btn btn-{{ get_option('theme_color') }} btn-rounded text-white" data-toggle="ajaxModal"
                       data-dismiss="modal">@icon('solid/pencil-alt') @langapp('make_changes')  

                    </a>
                @endif
            </div>


    </div>
</div>

<script>
$(document).ready(function(){
    $('[data-rel="tooltip"]').tooltip(); 
});
</script>