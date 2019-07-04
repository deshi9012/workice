<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?php echo e(langapp('stage')); ?></h4>
        </div>
        <?php echo Form::open(['route' => 'settings.stages.save', 'class' => 'bs-example form-horizontal', 'id' => 'saveStage']); ?>

        <input type="hidden" name="module" value="<?php echo e($module); ?>">
        <input type="hidden" name="color" value="info">
        <input type="hidden" name="active" value="1">
        
        <div class="modal-body">
            <div class="form-group">
                <label class="col-lg-4 control-label"><?php echo e(langapp('stage')); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="e.g Initial Contact" name="name">
                </div>
            </div>

            <?php if($module === 'deals'): ?>

            <div class="form-group">
                <label class="col-lg-4 control-label"><?php echo trans('app.'.'pipeline'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <select name="pipeline" class="form-control">
                        <?php $__currentLoopData = App\Entities\Category::whereModule('pipeline')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pipeline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option value="<?php echo e($pipeline->id); ?>" <?php echo e($pipeline->id == get_option('default_deal_stage') ? 'selected' : ''); ?>><?php echo e($pipeline->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </select>
                </div>
            </div>

            <?php endif; ?>

            <ul class="list-group gutter list-group-lg list-group-sp sortable" id="stageList">

                <?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item" draggable="true" id="stage-<?php echo e($stage->id); ?>">
                    <span class="pull-right">
                    <a href="<?php echo e(route('settings.stages.edit', $stage->id)); ?>" data-toggle="ajaxModal" data-dismiss="modal">
                            <?php echo e(svg_image('solid/pencil-alt', 'icon-muted fa-fw m-r-xs')); ?>
                    </a>
                        <a href="#" class="deleteStage" data-stage-id="<?php echo e($stage->id); ?>">
                            <?php echo e(svg_image('solid/times', 'icon-muted fa-fw')); ?>
                        </a>
                    </span>

                    <span class="pull-left media-xs"><?php echo e(svg_image('solid/arrows-alt', 'm-r-sm')); ?></span>

                    <div class="clear"><?php echo e($stage->name); ?>

                        <?php if($stage->module === 'deals'): ?>
                        <span class="badge bg-info"><?php echo e($stage->AsPipeline()->name); ?></span>
                        <?php endif; ?>
                    </div>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                
            </ul>
        </div>
        <div class="modal-footer">

            <?php echo closeModalButton(); ?>

            <?php echo renderAjaxButton('save'); ?>


        </div>

    <?php echo Form::close(); ?>

</div>

</div>

<?php $__env->startPush('pagescript'); ?>
<script src="<?php echo e(getAsset('plugins/sortable/jquery-sortable.js')); ?>"></script>
    <script>
    $('#saveStage').on('submit', function(e) {
        $(".formSaving").html('Processing..<i class="fas fa-spin fa-spinner"></i>');

        e.preventDefault();
        var tag, data;
        tag = $(this);
        data = tag.serialize();


        axios.post('<?php echo e(route('settings.stages.save')); ?>', data)
          .then(function (response) {
            $('#stageList').append(response.data.html);
                toastr.info( response.data.message , '<?php echo trans('app.'.'response_status'); ?> ');
                $(".formSaving").html('<i class="fas fa-paper-plane"></i> <?php echo trans('app.'.'send'); ?> </span>');
                tag[0].reset();
          })
          .catch(function (error) {
            var errors = error.response.data.errors;
            var errorsHtml= '';
            $.each( errors, function( key, value ) {
                errorsHtml += '<li>' + value[0] + '</li>'; 
            });
            toastr.error( errorsHtml , '<?php echo trans('app.'.'response_status'); ?> ');
            $(".formSaving").html('<i class="fas fa-sync"></i> Try Again</span>');
        });
        

    });


    $('body').on('click', '.deleteStage', function (e) {
        e.preventDefault();
        var tag, id;

        tag = $(this);
        id = tag.data('stage-id');

        if(!confirm('Do you want to delete this message?')) {
            return false;
        }
        axios.post('<?php echo e(route('settings.stages.delete')); ?>', {
            "id":id
        })
          .then(function (response) {
                toastr.warning( response.data.message , '<?php echo trans('app.'.'response_status'); ?> ');
                $('#stage-' + id).hide(500, function () {
                    $(this).remove();
                });
          })
          .catch(function (error) {
            toastr.error('Oops! Request failed to complete.', '<?php echo trans('app.'.'response_status'); ?> ');
        });

        
    });
        
$(function  () {
  $("ul#stageList").sortable({
    placeholder: '<li class="placeholder list-group-item"/>',
    serialize: function ($parent, $children, parentIsContainer) {
      var result = $.extend({}, {id:$parent.attr('id')});
      if(parentIsContainer)
        return $children;
      else if ($children[0]) 
        result.children = $children;
      return result;

    }, 
    onDrop: function ($item, container, _super) {
        $item.removeClass("dragged").removeAttr("style");
        $("body").removeClass("dragging");

        var dataToSend = $("ul#stageList").sortable("serialize").get();

        axios.post('<?php echo e(route('settings.stages.order')); ?>', {
            "sortedList":dataToSend
        })
          .then(function (response) {
                toastr.info( response.data.message , '<?php echo trans('app.'.'response_status'); ?> ');
          })
          .catch(function (error) {
                toastr.error('Oops! Request failed to complete.', '<?php echo trans('app.'.'response_status'); ?> ');
        });
    }
  });
});      
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->yieldPushContent('pagescript'); ?>