<div class="row m-sm">
    <div class="col-md-3 padder-v b-r bg-dark b-light pallete">
        <a class="clear" href="<?php echo e(route('creditnotes.index')); ?>">
            <span class="fa-stack fa-2x pull-left m-r-sm"> <?php echo e(svg_image('solid/balance-scale', 'fa-stack-1x text-white')); ?>
            </span>
            <small class="text-uc"><?php echo trans('app.'.'credit_note'); ?>   </small>
            <span class="h4 block m-t-xs"><?php echo e(formatCurrency($company->currency, $company->creditBalance())); ?></span>
        </a>
    </div>
    <div class="col-md-3 padder-v b-r bg-dark pallete">
        <a class="clear" href="<?php echo e(route('invoices.index')); ?>">
            <span class="fa-stack fa-2x pull-left m-r-sm"> <?php echo e(svg_image('solid/exclamation-triangle', 'fa-stack-1x')); ?>
            </span>
            <small class="text-uc"><?php echo trans('app.'.'balance_due'); ?>   </small>
            <span class="h4 block m-t-xs"><?php echo e(formatCurrency($company->currency, $company->balance)); ?></span>
        </a>
    </div>
    <div class="col-md-3 padder-v b-r bg-dark b-light pallete">
        <a class="clear" href="<?php echo e(route('expenses.index')); ?>">
            <span class="fa-stack fa-2x pull-left m-r-sm"><?php echo e(svg_image('regular/credit-card', 'fa-stack-1x')); ?>
            </span>
            <small class="text-uc"><?php echo trans('app.'.'expenses'); ?></small>
            <span class="h4 block m-t-xs"><?php echo e(formatCurrency($company->currency, $company->expense)); ?></span>
        </a>
    </div>
    <div class="col-md-3 padder-v b-r bg-dark b-light pallete">
        <a class="clear" href="<?php echo e(route('payments.index')); ?>">
            <span class="fa-stack fa-2x pull-left m-r-sm"> <?php echo e(svg_image('solid/check-circle', 'fa-stack-1x')); ?>
            </span>
            <small class="text-uc"><?php echo trans('app.'.'received_amount'); ?></small>
            <span class="h4 block m-t-xs"><?php echo e(formatCurrency($company->currency, $company->paid)); ?></span>
        </a>
    </div>
</div>
<div class="col-md-5">
    <section class="panel panel-default">
        <section class="panel-body">
            <?php if($company->primary_contact > 0): ?>
            <div class="clearfix m-b">
                <a href="#" class="pull-left thumb m-r">
                    <img src="<?php echo e($company->logo); ?>" class="img-circle">
                </a>
                <div class="clear">
                    <div class="h3 m-t-xs m-b-xs"><?php echo e($company->name); ?>

                    </div>
                    <span class="text-muted"><?php echo e(svg_image('regular/user-circle')); ?> <?php echo e($company->contact->name); ?></span>
                    <br/>
                    <span class="text-muted"><?php echo e(svg_image('solid/award')); ?> <?php echo e(optional($company->contact->profile)->job_title); ?></span>
                </div>
            </div>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clients_update')): ?>
            <?php if($company->email): ?>
            <a href="<?php echo e(route('clients.email', ['id' => $company->id])); ?>" class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm" data-toggle="ajaxModal">
                <?php echo e(svg_image('solid/paper-plane')); ?> <?php echo trans('app.'.'send_email'); ?>
            </a>
            <?php endif; ?>
            <a href="<?php echo e(route('clients.edit', ['id' => $company->id])); ?>"
                class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm" data-toggle="ajaxModal"
                title="<?php echo trans('app.'.'edit'); ?>  "><?php echo e(svg_image('solid/pencil-alt')); ?> <?php echo trans('app.'.'edit'); ?>
            </a>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clients_delete')): ?>
            <a href="<?php echo e(route('clients.delete', ['id' => $company->id])); ?>"
                class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm" data-toggle="ajaxModal"
            title="<?php echo trans('app.'.'delete'); ?>  "><?php echo e(svg_image('solid/trash-alt')); ?></a>
            <?php endif; ?>
            <div class="company_data">
                <div class="line"></div>
                <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'notes'); ?>  </small>
                <p><?php echo ($company->notes == '') ? 'No Notes' : parsedown($company->notes); ?></p>
                <div class="line"></div>
                <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'contacts'); ?>  </small>
                <ul class="list-cust">
                    <li class="m-xs">
                        <span class="text-muted"><?php echo e(svg_image('solid/phone')); ?> <?php echo trans('app.'.'phone'); ?>  :</span>
                        <a href="tel:<?php echo e($company->phone); ?>"><?php echo e($company->phone); ?></a>
                    </li>
                    <li class="m-xs">
                        <span class="text-muted"><?php echo e(svg_image('solid/mobile-alt')); ?> <?php echo trans('app.'.'mobile'); ?>
                        :</span> <a
                    href="tel:<?php echo e($company->mobile); ?>"><?php echo e($company->mobile); ?></a>
                </li>
                <li class="m-xs">
                    <span class="text-muted"><?php echo e(svg_image('solid/fax')); ?> <?php echo trans('app.'.'fax'); ?>  : </span> <a
                href="tel:<?php echo e($company->fax); ?>"><?php echo e($company->fax); ?></a>
            </li>
            <li class="m-xs">
                <span class="text-muted"><?php echo e(svg_image('solid/gavel')); ?> <?php echo trans('app.'.'tax'); ?>
                : </span> <?php echo e($company->tax_number); ?>

            </li>
            <li class="m-xs">
                <span class="text-muted"><?php echo e(svg_image('solid/envelope')); ?> <?php echo trans('app.'.'email'); ?>  : </span> <a
            href="mailto:<?php echo e($company->email); ?>"><?php echo e($company->email); ?></a>
        </li>
        
    </ul>
    <div class="line"></div>
    <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'social'); ?>  </small>
    <div class="m-xs">
        <?php if(!empty($company->skype)): ?>
        <a href="skype:<?php echo e($company->skype); ?>?call" class="btn btn-rounded btn-info btn-icon shadowed">
        <?php echo e(svg_image('brands/skype')); ?></a>
        <?php endif; ?>
        <?php if(!empty($company->twitter)): ?>
        <a href="<?php echo e($company->twitter); ?>" target="_blank" class="btn btn-rounded btn-twitter btn-icon shadowed">
            <?php echo e(svg_image('brands/twitter')); ?>
        </a>
        <?php endif; ?>
        <?php if(!empty($company->facebook)): ?>
        <a href="<?php echo e($company->facebook); ?>" target="_blank" class="btn btn-rounded btn-info btn-icon shadowed">
            <?php echo e(svg_image('brands/facebook')); ?>
        </a>
        <?php endif; ?>
        <?php if(!empty($company->linkedin)): ?>
        <a href="<?php echo e($company->linkedin); ?>" target="_blank" class="btn btn-rounded btn-primary btn-icon shadowed">
            <?php echo e(svg_image('brands/linkedin')); ?>
        </a>
        <?php endif; ?>
        <?php if(!empty($company->website)): ?>
        <a href="<?php echo e($company->website); ?>" target="_blank" class="btn btn-rounded btn-danger btn-icon shadowed">
            <?php echo e(svg_image('solid/link')); ?>
        </a>
        <?php endif; ?>
    </div>
    <div class="line"></div>
    <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'address'); ?>  </small>
    <?php if(!empty($company->address1)): ?>
    <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'address'); ?> 1</small>
    <p><?php echo e($company->address1); ?></p>
    <?php endif; ?>
    <?php if(!empty($company->address2)): ?>
    <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'address'); ?> 2</small>
    <p><?php echo e($company->address2); ?></p>
    <?php endif; ?>
    <?php if(!empty($company->city)): ?>
    <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'city'); ?></small>
    <p><?php echo e($company->city); ?></p>
    <?php endif; ?>
    <?php if(!empty($company->state)): ?>
    <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'state'); ?></small>
    <p><?php echo e($company->state); ?></p>
    <?php endif; ?>
    <?php if(!empty($company->zip_code)): ?>
    <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'zipcode'); ?></small>
    <p><?php echo e($company->zip_code); ?></p>
    <?php endif; ?>
    <?php if(!empty($company->country)): ?>
    <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'country'); ?></small>
    <p><?php echo e($company->country); ?></p>
    <?php endif; ?>
    <?php if(!empty($company->locale)): ?>
    <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'locale'); ?></small>
    <p><?php echo e($company->locale); ?></p>
    <?php endif; ?>
    <?php if(!empty($company->currency)): ?>
    <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'currency'); ?></small>
    <p><?php echo e($company->currency); ?></p>
    <?php endif; ?>
    <div class="map">
        <a href="<?php echo e($company->maplink); ?>" rel="nofollow" target="_blank">
            <img src="//maps.googleapis.com/maps/api/staticmap?center=<?php echo e($company->map); ?>&amp;zoom=14&amp;scale=2&amp;size=600x340&amp;maptype=roadmap&amp;format=png&amp;visual_refresh=true&amp;key=AIzaSyAzrmdGlvKbFu9F7vPaY0Jg74q1WQo7B0w" alt="Google Map">
            
        </a>
    </div>
    <?php echo app('arrilot.widget')->run('CustomFields\Extras', ['custom' => $company->custom]); ?>
    <small class="text-uc text-xs text-muted">
    <?php echo trans('app.'.'vaults'); ?>
    <a href="<?php echo e(route('extras.vaults.create', ['module' => 'clients', 'id' => $company->id])); ?>" class="btn btn-xs btn-danger pull-right" data-toggle="ajaxModal"><?php echo e(svg_image('solid/plus')); ?></a>
    </small>
    <div class="line"></div>
    <?php echo app('arrilot.widget')->run('Vaults\Show', ['vaults' => $company->vault]); ?>
    <div class="line"></div>
    <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'tags'); ?>  </small>
    <div class="m-xs">
        <?php
        $data['tags'] = $company->tags;
        ?>
        <?php echo $__env->make('partial.tags', $data, \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
</div>
</section>
</section>
</div>
<div class="col-md-7">
<section class="scrollable wrapper">
<section class="comment-list block">
<article class="comment-item" id="comment-form">
    <a class="pull-left thumb-sm avatar">
        <img src="<?php echo e(avatar()); ?>" class="img-circle">
    </a>
    <span class="arrow left"></span>
    <section class="comment-body">
        <section class="panel panel-default">
            <?php echo app('arrilot.widget')->run('Comments\CreateWidget', ['commentable_type' => 'clients' , 'commentable_id' => $company->id]); ?>
            
            
        </section>
    </section>
</article>
<?php echo app('arrilot.widget')->run('Comments\ShowComments', ['comments' => $company->comments]); ?>
</section>
</section>
</div>
<?php $__env->startPush('pagescript'); ?>
<?php echo $__env->make('comments::_ajax.ajaxify', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('partial.ajaxify', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>