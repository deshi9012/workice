<section class="" id="taskapp">
    <aside>
        <section class="">
            
            <header class="header">
                <a href="<?php echo e(route('extras.call.create', ['module' => 'leads', 'id' => $lead->id])); ?>" data-toggle="ajaxModal" class="btn btn-success btn-sm pull-right btn-icon" id="new-call" data-rel="tooltip" title="<?php echo trans('app.'.'log_call'); ?>">
                    <?php echo e(svg_image('solid/phone')); ?>
                </a>
                
            </header>
            
            <section class="">
                <div class="sortable">
                    <div class="call-list">
                        <ol class="dd-list activity-list">
                            <?php echo app('arrilot.widget')->run('Calls\ShowCalls', ['calls' => $lead->calls()->where(function ($query) {
                                $query->where('user_id', Auth::id())->orWhere('assignee', Auth::id());
                            })->get()]); ?>
                            
                        </ol>
                    </div>
                </div>
                
                
            </section>
        </section>
    </aside>
    
    <?php $__env->startPush('pagestyle'); ?>
    <link rel=stylesheet href="<?php echo e(getAsset('plugins/nestable/nestable.css')); ?>">
    <?php $__env->stopPush(); ?>
    <?php $__env->startPush('pagescript'); ?>
    <?php echo $__env->make('extras::_ajax.callsjs', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php $__env->stopPush(); ?>
</section>