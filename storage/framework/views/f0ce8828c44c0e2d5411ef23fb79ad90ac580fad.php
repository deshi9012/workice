<?php $__env->startSection('content'); ?>

<section id="content" class="bg">

            <section class="vbox">

              <header class="header bg-white b-b clearfix">
                  <div class="row m-t-sm">
                    <div class="col-sm-5 m-b-xs m-t-xs">
                    <span class="h3"><?php echo trans('app.'.'contacts'); ?></span>
                      
                    </div>
                    <div class="col-sm-7 m-b-xs">
                    
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contacts_create')): ?>
                    
                        <div class="btn-group pull-right">
                          <button class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php echo trans('app.'.'import'); ?> <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="<?php echo e(route('contacts.import', ['type' => 'contacts'])); ?>" data-toggle="ajaxModal"><?php echo trans('app.'.'csv_file'); ?></a></li>
                            <li><a href="<?php echo e(route('contacts.import', ['type' => 'google'])); ?>">Google <?php echo trans('app.'.'contacts'); ?></a></li>
                          </ul>
                        </div>
                    
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contacts_view')): ?>
                    <a href="<?php echo e(route('contacts.export')); ?>" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?> pull-right">
                      <?php echo e(svg_image('solid/download')); ?> CSV
                    </a>
                    <?php endif; ?>

                      
                    </div>
                  </div>
                </header>
                
    <section class="scrollable wrapper scrollpane">
                        
<?php echo Form::open(['route' => 'contacts.search', 'class' => '']); ?>

<div class="input-group m-xs">
  
    <input type="text" class="input-sm form-control contact-search search" name="keyword" placeholder="Enter contact name">
        <span class="input-group-btn"> 
            <button class="btn btn-sm btn-default" type="submit"><?php echo e(svg_image('solid/search')); ?> <?php echo trans('app.'.'search'); ?></button>
        </span>
</div>
<?php echo Form::close(); ?>           



            <div id="ajaxData"></div>
					




                </section>


            </section>

    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>


<?php $__env->startPush('pagescript'); ?>

  <?php echo $__env->make('contacts::_scripts._ajax', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>