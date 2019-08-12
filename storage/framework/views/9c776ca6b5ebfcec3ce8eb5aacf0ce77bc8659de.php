<?php $__env->startSection('content'); ?>
<section id="content">
  <section class="vbox">
    <header class="header bg-white b-b b-light">
      <p class=""><?php echo e($contact->name); ?></p>
      
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('contacts_delete')): ?>
      
      <a href="<?php echo e(route('users.delete', ['id' => $contact->id])); ?>" data-toggle="ajaxModal" class="btn btn-sm btn-danger pull-right">
        <?php echo e(svg_image('solid/trash-alt')); ?> <?php echo trans('app.'.'delete'); ?>
      </a>
      
      <?php endif; ?>
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('deals_create')): ?>
      
      <a href="<?php echo e(route('deals.create', ['contact' => $contact->id, 'company' => $contact->profile->company])); ?>" data-toggle="ajaxModal" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?> pull-right">
        <?php echo e(svg_image('solid/award')); ?> <?php echo trans('app.'.'deal'); ?>
      </a>
      
      <?php endif; ?>
    </header>
    <section class="scrollable">
      <section class="hbox stretch">
        <aside class="aside-lg bg-light lter b-r">
          <section class="vbox">
            <section class="scrollable bg">
              <div class="wrapper">
                <div class="clearfix m-b">
                  <a href="#" class="pull-left thumb m-r">
                    <img src="<?php echo e($contact->profile->photo); ?>" class="img-circle">
                  </a>
                  <div class="clear">
                    <div class="h3 m-t-xs m-b-xs"><?php echo e($contact->name); ?></div>
                    <small class="text-muted"><?php echo e(svg_image('solid/id-badge')); ?> <?php echo e($contact->profile->job_title); ?></small>
                  </div>
                </div>
                <div class="panel wrapper panel-success">
                  <div class="row">
                    <div class="col-xs-6">
                      <a href="#">
                        <span class="m-b-xs h4 block"> <?php echo e($contact->comments->count()); ?></span>
                        <small class="text-muted"><?php echo trans('app.'.'comments'); ?> </small>
                      </a>
                    </div>
                    <div class="col-xs-6">
                      <a href="#">
                        <span class="m-b-xs h4 block"><?php echo e($contact->activities->count()); ?></span>
                        <small class="text-muted"><?php echo trans('app.'.'activity'); ?> </small>
                      </a>
                    </div>
                  </div>
                </div>
                
                <div>
                  <?php if(!empty($contact->email)): ?>
                  <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'email'); ?> </small>
                  <p><?php echo e($contact->email); ?></p>
                  <?php endif; ?>
                  
                  <?php if($contact->profile->company > 0): ?>
                  <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'company_name'); ?> </small>
                  <p>
                    <a href="<?php echo e(route('clients.view', $contact->profile->company)); ?>"><?php echo e($contact->profile->business->name); ?></a>
                  </p>
                  <?php endif; ?>
                  <?php if(!empty($contact->profile->address)): ?>
                  <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'address'); ?> </small>
                  <p><?php echo e($contact->profile->address); ?></p>
                  <?php endif; ?>
                  <?php if(!empty($contact->profile->phone)): ?>
                  <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'phone'); ?> </small>
                  <p><?php echo e($contact->profile->phone); ?></p>
                  <?php endif; ?>
                  <?php if(!empty($contact->profile->mobile)): ?>
                  <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'mobile'); ?> </small>
                  <p><?php echo e($contact->profile->mobile); ?></p>
                  <?php endif; ?>
                  <?php if(!empty($contact->profile->city)): ?>
                  <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'city'); ?> </small>
                  <p><?php echo e($contact->profile->city); ?></p>
                  <?php endif; ?>
                  <?php if(!empty($contact->profile->state)): ?>
                  <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'state'); ?> </small>
                  <p><?php echo e($contact->profile->state); ?></p>
                  <?php endif; ?>
                  <?php if(!empty($contact->profile->zip_code)): ?>
                  <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'zipcode'); ?> </small>
                  <p><?php echo e($contact->profile->zip_code); ?></p>
                  <?php endif; ?>
                  <?php if(!empty($contact->profile->country)): ?>
                  <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'country'); ?> </small>
                  <p><?php echo e($contact->profile->country); ?></p>
                  <?php endif; ?>
                  <?php if(!empty($contact->locale)): ?>
                  <small class="text-uc text-xs text-muted"><?php echo trans('app.'.'locale'); ?> </small>
                  <p><?php echo e($contact->locale); ?></p>
                  <?php endif; ?>
                  
                  <div class="line"></div>
                  <small class="text-uc text-xs text-muted">Connection</small>
                  <p class="m-t-sm">
                    <?php if(!empty($contact->profile->twitter)): ?>
                    <a href="https://twitter.com/<?php echo e($contact->profile->twitter); ?>" class="btn btn-rounded btn-twitter btn-icon"><?php echo e(svg_image('brands/twitter')); ?>
                      <?php endif; ?>
                      
                      <?php if(!empty($contact->profile->skype)): ?>
                      <a href="skype:<?php echo e($contact->profile->skype); ?>?call" class="btn btn-rounded btn-info btn-icon"><?php echo e(svg_image('brands/skype')); ?></a>
                      <?php endif; ?>
                      
                      <a href="<?php echo e(route('contacts.email', $contact->id)); ?>" class="btn btn-rounded btn-dracula btn-icon" data-toggle="ajaxModal">
                        <?php echo e(svg_image('solid/envelope-open')); ?>
                      </a>
                    </p>
                    
                    
                    
                  </div>
                </div>
              </section>
            </section>
          </aside>
          <aside class="bg-white">
            <section class="vbox">
              
              <section class="scrollable bg">

                <?php echo app('arrilot.widget')->run('Emails\SendContactEmail', ['id' => $contact->id, 'subject' => optional($contact->emails->first())->subject]); ?>


                <?php echo app('arrilot.widget')->run('Emails\ShowEmails', ['emails' => $contact->emails]); ?>

                
                
                
                
              </section>
            </section>
          </aside>
          
        </section>
      </section>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
  </section>
  <?php $__env->startPush('pagestyle'); ?>
    <?php echo $__env->make('stacks.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('pagescript'); ?>
<?php echo $__env->make('stacks.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('stacks.js.markdown', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <script>
        $('.datetimepicker-input').datetimepicker({showClose: true, showClear: true, minDate: moment() });
   
    $( "#sendLater" ).click(function() {
      $("#queueLater").show("fast");
      $( ".datetimepicker-input" ).focus();
    });

        function insertMessage(d) {
        axios.post('<?php echo e(route('extras.canned_responses')); ?>', {
          "response_id": d
        })
        .then(function (response) {
          $("textarea#cannedResponse").val(response.data.message);
        })
        .catch(function (error) {
          toastr.error('Oops! Request failed to complete.', '<?php echo trans('app.'.'response_status'); ?> ');
        });
}
    </script>
<?php $__env->stopPush(); ?>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>