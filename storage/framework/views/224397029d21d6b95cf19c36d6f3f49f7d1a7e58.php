<?php $__env->startSection('content'); ?>
<section id="content" class="bg">
    <section class="hbox stretch">
        <section class="vbox">
            <header class="header bg-white b-b b-light">

                <?php if (\Illuminate\Support\Facades\Blade::check('admin')): ?>
                <a href="<?php echo e(route('settings.stages.show', 'deals')); ?>" data-toggle="ajaxModal" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?> pull-right" data-rel="tooltip" title="<?php echo trans('app.'.'stages'); ?>" data-placement="bottom">
                    <?php echo e(svg_image('solid/cogs')); ?>
                </a>
                <?php endif; ?>
                <div class="btn-group pull-right">
                    <a href="<?php echo e(route('deals.index', ['view' => 'table'])); ?>" data-rel="tooltip" title="Table" data-placement="bottom" class="btn btn-sm btn-default">
                        <?php echo e(svg_image('solid/th')); ?>
                    </a>
                    <a href="<?php echo e(route('deals.index', ['view' => 'kanban'])); ?>" data-rel="tooltip" title="Kanban" data-placement="bottom" class="btn btn-sm btn-default">
                        <?php echo e(svg_image('solid/align-justify')); ?>
                    </a>
                </div>
                
                <div class="btn-group pull-right">
                    <button class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm dropdown-toggle btn-responsive"
                    data-toggle="dropdown"><?php echo e(svg_image('solid/ellipsis-h')); ?>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo e(route('deals.index', ['view' => 'forecast'])); ?>"><?php echo e(svg_image('solid/clock', 'text-muted')); ?> <?php echo trans('app.'.'forecasted'); ?></a></li>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deals_create')): ?>
                        <li><a href="<?php echo e(route('deals.import')); ?>" data-toggle="ajaxModal"><?php echo e(svg_image('solid/cloud-upload-alt', 'text-muted')); ?> <?php echo trans('app.'.'import'); ?></a></li>
                        <?php endif; ?>
                        <li><a href="<?php echo e(route('deals.export')); ?>"><?php echo e(svg_image('solid/cloud-download-alt', 'text-muted')); ?> <?php echo trans('app.'.'export'); ?></a></li>
                        <li><a href="<?php echo e(route('deals.index', ['filter' => 'won'])); ?>"><?php echo e(svg_image('solid/check', 'text-muted')); ?> <?php echo trans('app.'.'won'); ?></a></li>
                        <li><a href="<?php echo e(route('deals.index', ['filter' => 'lost'])); ?>"><?php echo e(svg_image('solid/times', 'text-muted')); ?> <?php echo trans('app.'.'lost'); ?></a></li>
                        <li><a href="<?php echo e(route('deals.index', ['filter' => 'archived'])); ?>"><?php echo e(svg_image('solid/archive', 'text-muted')); ?> <?php echo trans('app.'.'archived'); ?></a></li>
                    </ul>
                </div>
                <div class="btn-group pull-right">
                    <button class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm dropdown-toggle btn-responsive"
                    data-toggle="dropdown"> Pipeline <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <?php $__currentLoopData = App\Entities\Category::whereModule('pipeline')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(route('deals.index', ['pipeline' => $p->id])); ?>">
                                <?php echo e($p->name); ?>

                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
                
                
                
                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deals_create')): ?>
                <a href="<?php echo e(route('deals.create')); ?>"
                    class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm pull-right"
                    data-toggle="ajaxModal" data-rel="tooltip"
                title="<?php echo trans('app.'.'create'); ?>" data-placement="left"> <?php echo e(svg_image('solid/plus')); ?> <?php echo trans('app.'.'create'); ?>  </a>
                <?php endif; ?>
                <p class="h3"><?php echo trans('app.'.'deals'); ?> - <strong><?php echo e(optional(App\Entities\Category::whereId($pipeline)->first())->name); ?></strong></p>
                
            </header>
            <section class="scrollable wrapper overflow-x-auto">
                
                <div class="row">
                    
                    <?php if($dealDisplay == 'table'): ?>
                    <?php echo $__env->make('deals::table_view', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endif; ?>

                    <?php if($dealDisplay == 'forecast'): ?>
                    <?php echo $__env->make('deals::forecast', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endif; ?>

                    <?php if($dealDisplay == 'kanban'): ?>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body collapse in">
                                <div class="card-block">
                                    <div class="overflow-hidden">
                                        <div id="todo-lists-basic-demo"
                                            class="lobilists-wrapper lobilists single-line sortable ps-container ps-theme-dark ps-active-x">
                                           
                                            <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="lobilist-wrapper ps-container ps-theme-dark ps-active-y kanban-col">
                                                <div id="lobilist-list-0"
                                                    class="lobilist lobilist-default">
                                                    <div class="lobilist-header ui-sortable-handle">
                                                        <div class="lobilist-title text-ellipsis text-uc text-muted">
                                                            <span class="arrow right"></span> <?php echo e(ucfirst($card->name)); ?>

                                                        </div>
                                                    </div>
                                                    <div class="lobilist-body scrumboard slim-scroll" data-disable-fade-out="true"
                                                        data-distance="0" data-size="3px" data-height="550"
                                                        data-color="#333333">
                                                        <ul class="lobilist-items ui-sortable list" id="<?php echo e($card->id); ?>">
                                                            <?php $dealCounter = 0; ?>
                                                            <?php $__currentLoopData = $deals->where('stage_id', $card->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li id="<?php echo e($deal->id); ?>" draggable="true" class="lobilist-item kanban-entry grab <?php echo e($deal->rotten ? 'rotten-bg' : ''); ?>">
                                                                <div class="lobilist-item-title text-ellipsis m-l-xs font14">
                                                                    <a href="<?php echo e(route('deals.view', $deal->id)); ?>" class="<?php echo e($deal->rotten ? 'text-danger' : ''); ?>"><?php echo e($deal->title); ?></a>
                                                                    <?php if($deal->has_email): ?>
                                                                    <?php echo e(svg_image('regular/envelope', 'text-success')); ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="lobilist-item-description text-muted">
                                                                    <small class="pull-right xs"> <?php echo e(svg_image('regular/user')); ?>
                                                                    <?php echo e(optional($deal->contact)->name); ?>

                                                                    </small>
                                                                    
                                                                    <span class="text-bold">
                                                                        <?php echo e($deal->computed_value); ?>

                                                                        <?php if($deal->status == 'won'): ?>
                                                                        <label class="label bg-success"><?php echo e(svg_image('solid/check-circle')); ?> <?php echo e(ucfirst($deal->status)); ?></label>
                                                                        <?php endif; ?>
                                                                        <?php if($deal->status == 'lost'): ?>
                                                                        <label class="label bg-danger"><?php echo e(svg_image('solid/times')); ?> <?php echo e(ucfirst($deal->status)); ?></label>
                                                                        <?php endif; ?>
                                                                    </span>
                                                                </div>
                                                                <small class="text-muted">
                                                                <?php echo e(!empty($deal->due_date) ? dateElapsed($deal->due_date) : ''); ?>

                                                                </small>
                                                                <div class="lobilist-item-duedate">
                                                                    <?php echo e(dateFormatted($deal->due_date)); ?>

                                                                </div>
                                                                <?php if($deal->user_id > 0): ?>
                                                                <span class="thumb-xs avatar lobilist-check">
                                                                    <img src="<?php echo e($deal->user->profile->photo); ?>" class="img-circle">
                                                                </span>
                                                                <?php endif; ?>
                                                                <div class="todo-actions">
                                                                    <?php if($deal->has_activity): ?>
                                                                    <div class="edit-todo todo-action">
                                                                        <a href="<?php echo e(route('deals.view', ['id' => $deal->id, 'tab' => 'activity'])); ?>">
                                                                            <?php echo e(svg_image('solid/circle', 'text-warning')); ?>
                                                                        </a>
                                                                    </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="drag-handler"></div>
                                                                
                                                            </li>
                                                            <?php $dealCounter++; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </ul>
                                                    </div>
                                                    <div class="lobilist-footer">
                                                        <strong><?php echo metrics('deals_stage_'.$card->id); ?></strong>
                                                        <strong class="pull-right"><?php echo e($dealCounter); ?> Deal(s)</strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <div class="modal modal-static fade" id="processing-modal"
                                                role="dialog" aria-hidden="true">
                                                <div class="modal-dialog processing-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="text-center">
                                                                <?php echo e(svg_image('solid/sync-alt', 'fa-4x fa-spin')); ?>
                                                                <h4>Processing...</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>


            </section>
        </section>
    </section>
</section>
<?php $__env->startPush('pagescript'); ?>
<script type="text/javascript">
$(document).ready(function () {
var kanbanCol = $('.scrumboard');
draggableInit();
});
function draggableInit() {
var sourceId;
$('[draggable=true]').bind('dragstart', function (event) {
sourceId = $(this).parent().attr('id');
event.originalEvent.dataTransfer.setData("text/plain", event.target.getAttribute('id'));
});
$('.scrumboard').bind('dragover', function (event) {
event.preventDefault();
});
$('.scrumboard').bind('drop', function (event) {
var children = $(this).children();
var targetId = children.attr('id');
if (sourceId != targetId) {
var elementId = event.originalEvent.dataTransfer.getData("text/plain");
$('#processing-modal').modal('toggle');
setTimeout(function () {
var element = document.getElementById(elementId);
deal_id = element.getAttribute('id');
$.ajax({
type: "POST",
url: "<?php echo e(route('deals.movestage')); ?>",
data: {
'id': deal_id,
'_token': '<?php echo e(csrf_token()); ?>',
'target': targetId
},
success: function (msg) {
toastr.success(msg, '<?php echo trans('app.'.'success'); ?> ');
}
});
children.prepend(element);
$('#processing-modal').modal('toggle');
}, 1000);
}
event.preventDefault();
});
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>