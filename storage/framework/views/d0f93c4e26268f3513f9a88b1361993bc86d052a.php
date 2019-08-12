<div class="row">
    <div class="col-lg-4 b-r">
        <section class="panel panel-default">
        <header class="panel-heading"><?php echo trans('app.'.'overview'); ?>  </header>
        <section class="panel-body">
            <div class="inline m pull-right">
                <div class="easypiechart text-success" data-percent="<?php echo e($deal->propability); ?>" data-line-width="5" data-track-Color="#f0f0f0" data-bar-color="#3869D4" data-rotate="180" data-scale-Color="false" data-size="80" data-animate="2000">
                    <span class="h2 step"><?php echo e($deal->propability); ?></span>%
                    <div class="easypie-text text-muted">Propability</div>
                </div>
            </div>
            <?php if($deal->user_id > 0): ?>
            <span class="thumb-sm avatar lobilist-check">
                <img src="<?php echo e($deal->user->profile->photo); ?>" class="img-circle">
            </span> <strong><?php echo e($deal->user->name); ?></strong>
            <?php endif; ?>
            <div class="m-xs">
                <span class="text-muted"><?php echo trans('app.'.'pipeline'); ?>  : </span>
                <span class="text-bold"><?php echo e(ucfirst($deal->pipe->name)); ?></span>
            </div>
            <div class="m-xs">
                <span class="text-muted"><?php echo trans('app.'.'status'); ?>  : </span>
                <span class="text-bold text-danger"><?php echo e(ucfirst($deal->status)); ?></span>
            </div>
            <div class="m-xs">
                <span class="text-muted"><?php echo trans('app.'.'deal_age'); ?>  : </span>
                <span class="text-bold"><?php echo e(dateElapsed($deal->created_at)); ?></span>
            </div>
            <div class="m-xs">
                <span class="text-muted"><?php echo trans('app.'.'source'); ?>  : </span>
                <span class="text-bold"><?php echo e(optional($deal->AsSource)->name); ?></span>
            </div>
            <div class="m-xs">
                <span class="text-muted"><?php echo trans('app.'.'date'); ?>  : </span>
                <span class="text-bold"><?php echo e(dateFormatted($deal->created_at)); ?></span>
            </div>
            <div class="m-xs">
                <span class="text-muted"><?php echo trans('app.'.'due_date'); ?>  : </span>
                <span class="text-bold text-danger"><?php echo e(dateFormatted($deal->due_date)); ?></span>
            </div>

            
            <div class="m-xs">
                <span class="text-muted"><?php echo trans('app.'.'deal_value'); ?>  : </span>
                <span class="text-bold"><?php echo e(formatCurrency($deal->currency, $deal->deal_value)); ?></span>
            </div>

            
            <div class="line"></div>

            <?php if($deal->project_id > 0): ?>
            <div class="line"></div>
            <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'project'); ?>  </small>
            <div class="m-xs">
                <a href="<?php echo e(route('projects.view', $deal->project_id)); ?>">
                <span class=""><?php echo e($deal->project->name); ?></span>
                </a>
            </div>
            <?php endif; ?>

            <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'company'); ?>  </small>
            <div class="m-xs">
                <span class="text-bold">
                    <a href="<?php echo e(route('clients.view', ['id' => $deal->company->id])); ?>"><?php echo e($deal->company->name); ?></a>
                </span>
            </div>
            
            <?php if($deal->contact_person > 0): ?>
            <div class="line"></div>
            <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'contact_person'); ?>  </small>
            <div class="m-xs">
                <a href="<?php echo e(route('contacts.view', $deal->contact->id)); ?>">
                <span class=""><?php echo e($deal->contact->name); ?></span>
                </a>
            </div>
            <?php endif; ?>
            <div class="map">
                <a href="<?php echo e($deal->company->maplink); ?>" rel="nofollow" target="_blank">
                    <img src="//maps.googleapis.com/maps/api/staticmap?center=<?php echo e($deal->company->map); ?>&amp;zoom=14&amp;scale=2&amp;size=600x340&amp;maptype=roadmap&amp;format=png&amp;visual_refresh=true&amp;key=AIzaSyC0XyInNlB2mAnQbJLRZFQ2FjX--ZrP4Mk" alt="Google Map">
                    
                </a>
            </div>
            <div class="line"></div>
            <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'tags'); ?>  </small>
            <div class="m-xs">
                <?php
                $data['tags'] = $deal->tags;
                ?>
                <?php echo $__env->make('partial.tags', $data, \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
            <div class="line"></div>
            <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'extras'); ?>  </small>
            <?php $__currentLoopData = $deal->custom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(App\Entities\CustomField::where('name', $field->meta_key)->count() > 0): ?>
            <div class="m-xs">
                <span class="text-muted"><?php echo e(svg_image('solid/caret-right')); ?>
                <?php echo e(ucfirst(humanize($field->meta_key, '-'))); ?>: </span>
                <span class="">
                    <?php echo e((isJson($field->meta_value)) ? implode(', ', json_decode($field->meta_value)) : $field->meta_value); ?>

                </span>
            </div>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if($deal->status == 'lost'): ?>
            <div class="line"></div>
            <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'reason'); ?>  </small>
            <?php echo parsedown($deal->lost_reason); ?>
            <?php endif; ?>
        </section>
    </section>
    <section class="panel panel-default">
    <header class="panel-heading"><?php echo trans('app.'.'activities'); ?>  </header>
    <div class="slim-scroll" data-color="#333333" data-disable-fade-out="true" data-distance="0" data-height="500px" data-size="3px">
        <?php echo app('arrilot.widget')->run('Activities\Feed', ['activities' => $deal->activities]); ?>
    </div>
</section>
</div>
<div class="col-lg-8">
<?php
$data = [
'notes' => $deal->notes, 'noteable_type' => get_class($deal) ,
'title' => $deal->title.' Note', 'noteable_id' => $deal->id
];
?>
<?php echo app('arrilot.widget')->run('Notes\ShowNotes', $data); ?>
</div>
</div>