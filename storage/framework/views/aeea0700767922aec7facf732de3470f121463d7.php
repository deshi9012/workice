<div class="col-md-4">
    <div class="panel-body text-center">
        <div class="content-group-sm user-name">
            <h6 class="text-dark">
            <?php echo e($user->name); ?>

            </h6>
            <span class="display-block"><?php echo e($user->profile->job_title); ?></span>
        </div>
        <a href="#" class="thumb-md display-inline-block content-group-sm">
            <img src="<?php echo e($user->profile->photo); ?>" class="img-circle">
        </a>
        
        <p id="social-buttons" class="m-t-sm">
            <?php if($user->profile->website): ?>
            <a href="<?php echo e($user->profile->website); ?>" class="btn btn-rounded btn-sm btn-icon btn-success" target="_blank">
                <?php echo e(svg_image('solid/link')); ?>
            </a>
            <?php endif; ?>
            <?php if($user->profile->twitter ): ?>
            <a href="https://twitter.com/<?php echo e($user->profile->twitter); ?>" class="btn btn-rounded btn-sm btn-icon btn-info" target="_blank">
                <?php echo e(svg_image('brands/twitter')); ?>
            </a>
            <?php endif; ?>
            <?php if($user->profile->skype): ?>
            <a href="skype:<?php echo e($user->profile->skype); ?>" class="btn btn-rounded btn-sm btn-icon btn-primary">
                <?php echo e(svg_image('brands/skype')); ?>
            </a>
            <?php endif; ?>
            
        </p>
    </div>
    <table class="table table-borderless table-xs content-group-sm">
        <tbody>
            
            
                
                
                    
                        
                    
                
            
            
            
            <tr>
                <td class="text-muted"><?php echo trans('app.'.'email'); ?></td>
                <td class="text-right"><?php echo e($user->email); ?></td>
            </tr>
            <tr>
                <td class="text-muted"><?php echo trans('app.'.'username'); ?></td>
                <td class="text-right"><?php echo e($user->username); ?></td>
            </tr>
            <tr>
                <td class="text-muted"><?php echo trans('app.'.'last_login'); ?></td>
                <td class="text-right"><?php echo e(dateTimeFormatted($user->last_login)); ?></td>
            </tr>
            <tr>
                <td class="text-muted"><?php echo trans('app.'.'role'); ?></td>
                <td class="text-right"><?php echo e($user->roles->pluck('name')); ?></td>
            </tr>
            
                
                
            
            <tr>
                <td class="text-muted"><?php echo trans('app.'.'mobile'); ?></td>
                <td class="text-right"><?php echo e($user->profile->mobile); ?></td>
            </tr>
            <tr>
                <td class="text-muted"><?php echo trans('app.'.'phone'); ?>   #</td>
                <td class="text-right"><?php echo e($user->profile->phone); ?></td>
            </tr>
            <tr>
                <td class="text-muted"><?php echo trans('app.'.'locale'); ?> </td>
                <td class="text-right"><?php echo e(ucfirst($user->locale)); ?></td>
            </tr>
            
                
                
            
            
                
                
            
            
                
                
            
            <tr>
                <td class="text-muted"><?php echo trans('app.'.'locale'); ?></td>
                <td class="text-right"><a href="#"><?php echo e($user->profile->locale); ?></a></td>
            </tr>
            
                
                
            
            <tr>
                <td class="text-muted"><?php echo trans('app.'.'verified_at'); ?> </td>
                <td class="text-right"><?php echo e($user->email_verified_at); ?></td>
            </tr>
            <tr>
                <td class="text-muted"><?php echo trans('app.'.'created_at'); ?> </td>
                <td class="text-right"><?php echo e(dateTimeFormatted($user->created_at)); ?></td>
            </tr>
            <tr>
                <td class="text-muted"><?php echo trans('app.'.'updated'); ?></td>
                <td class="text-right"><?php echo e(dateTimeFormatted($user->updated_at)); ?></td>
            </tr>
        </tbody>
    </table>
    <small class="text-uc text-xs text-muted">
    <?php echo trans('app.'.'vaults'); ?>
    <a href="<?php echo e(route('extras.vaults.create', ['module' => 'users', 'id' => $user->id])); ?>" class="btn btn-xs btn-danger pull-right" data-toggle="ajaxModal"><?php echo e(svg_image('solid/plus')); ?></a>
    </small>
    <div class="line"></div>
    <?php echo app('arrilot.widget')->run('Vaults\Show', ['vaults' => $user->vault]); ?>
</div>
<div class="col-md-8">
    <section class="slim-scroll" data-color="#333333" data-disable-fade-out="true" data-distance="0" data-height="700" data-size="5px">
        
        <section class="panel panel-default">
        <header class="panel-heading"><?php echo trans('app.'.'activities'); ?>  </header>
        
        <?php echo app('arrilot.widget')->run('Activities\Feed', ['activities' => $user->activities->take(100)]); ?>
    </section>
</section>

</div>