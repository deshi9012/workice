<?php if($company->individual == 0): ?> 
        <section class="col-md-12">

            <header class="panel-heading">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('users_create')): ?>
                    <a href="<?php echo e(route('contacts.create', ['client' => $company->id])); ?>" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?>" data-toggle="ajaxModal">
                        <?php echo e(svg_image('solid/user-circle')); ?> <?php echo trans('app.'.'create'); ?>  
                   </a>
                <?php endif; ?>
            </header>
            


            <div id="ajaxData"></div>


            
        </section>


    <?php endif; ?>

<?php $__env->startPush('pagescript'); ?>
  <?php echo $__env->make('clients::_scripts._contacts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>