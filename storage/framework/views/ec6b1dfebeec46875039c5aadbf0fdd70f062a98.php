<div class="modal-dialog">
    <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title h3"><?php echo e($appointment->name); ?></h4>
            </div>
            <div class="modal-body">
                <ul class="list-group no-radius">
                    <li class="list-group-item">
                    <span class="pull-right">
                        <?php echo e($appointment->name); ?>

                    </span>
                        <?php echo trans('app.'.'name'); ?>  
                    </li>

                   

                    <li class="list-group-item">
                    <span class="pull-right">
                         <label class="label label-success"><?php echo e(dateTimeFormatted($appointment->start_time)); ?></label>
                    </span>
                        <?php echo trans('app.'.'start_date'); ?>  
                    </li>
                    <li class="list-group-item">
                    <span class="pull-right">
                         <label class="label label-danger"><?php echo e(dateTimeFormatted($appointment->finish_time)); ?></label>
                    </span>
                        <?php echo trans('app.'.'end_date'); ?>  
                    </li>

                    <?php if(!is_null($appointment->venue)): ?>

                        <li class="list-group-item">
                    <span class="pull-right">
                         <?php echo e(svg_image('solid/building')); ?> <label class="label label-danger"> <?php echo e($appointment->venue); ?></label>
                    </span>
                            <?php echo trans('app.'.'venue'); ?>  
                        </li>

                    <?php endif; ?>


                    <li class="list-group-item">
                    <span class="pull-right">
                    <a class="thumb-xs avatar">
      <img src="<?php echo e($appointment->user->profile->photo); ?>" class="img-rounded image-radius">

          </a> <label class="label label-default"><?php echo e($appointment->user->name); ?></label></span>
                        
                        Operator - creator
                    </li>

                <?php if($appointment->lead_id > 0): ?> 

                        <li class="list-group-item">
                    <span class="pull-right">
                         <a href="<?php echo e(route('leads.view', ['id' => $appointment->lead_id])); ?>">
                         <?php echo e($appointment->lead->name); ?>

                         </a>
                    </span>
                            <?php echo trans('app.'.'lead'); ?>  
                        </li>
                <?php endif; ?>

                </ul>
                <?php echo parsedown($appointment->comments); ?>


                <div class="line line-dashed line-lg pull-in"></div>
                Operator assigned for this appointment:
                <div class="line line-dashed line-lg pull-in"></div>


            <?php if($appointment->attendee_id > 0): ?> 

                <a class="thumb-sm avatar" data-rel="tooltip" title="<?php echo e($appointment->attendee->name); ?>">
                    <img src="<?php echo e($appointment->attendee->profile->photo); ?>" class="img-rounded shadowed">
                </a>

            <?php endif; ?>


            </div>
            <div class="modal-footer">
                
                <?php if(can('events_update') || $appointment->user_id == Auth::id() || isAdmin()): ?>

                <?php echo closeModalButton(); ?>


                    <a href="<?php echo e(route('calendar.edit.appointment', ['id' => $appointment->id])); ?>"
                       class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-rounded text-white" data-toggle="ajaxModal"
                       data-dismiss="modal"><?php echo e(svg_image('solid/pencil-alt')); ?> <?php echo trans('app.'.'make_changes'); ?>  

                    </a>
                <?php endif; ?>
            </div>


    </div>
</div>

<script>
$(document).ready(function(){
    $('[data-rel="tooltip"]').tooltip(); 
});
</script>