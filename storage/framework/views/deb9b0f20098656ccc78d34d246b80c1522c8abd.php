<?php $__env->startSection('content'); ?>
<section id="content">
    <section class="hbox stretch">

            <section class="vbox">
                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-8 m-xs"><?php echo e(svg_image('solid/bullhorn')); ?> <?php echo trans('app.'.'announcements'); ?></div>
                        <div class="col-sm-4 m-b-xs">
                        </div>
                    </div>
                </header>
                <section class="scrollable wrapper bg" id="announcements">

                    <?php echo Form::open(['route' => 'announcements.api.save', 'novalidate' => '', 'id' => 'save-announcement']); ?>


                  <input type="hidden" name="user_id" value="<?php echo e(Auth::id()); ?>">

                  <div class="row">
                            <div class="col-md-6">
                                <label><?php echo trans('app.'.'subject'); ?> <span class="text-danger">*</span></label>
                                <input type="text" placeholder="Privacy Changes" name="subject" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label>URL</label>
                                <input type="text" placeholder="https://domain.com/privacy-changes" name="url" class="form-control">
                            </div>
                        </div>

                   

                    <div class="form-group">
                    <label class="control-label"><?php echo trans('app.'.'message'); ?> <span class="text-danger">*</span></label>

                        <textarea class="form-control markdownEditor" name="message" placeholder="Type text..."></textarea>
                    
                  </div>

                  <div class="form-group">
                <label><?php echo e(langapp('schedule')); ?> (<span class="small text-muted">Default 10 minutes from now</span>)</label>
                <div class="input-group date">
                  <input type="text" class="form-control datetimepicker-input"
                  value="<?php echo e(timePickerFormat(now()->addMinutes(10))); ?>" name="announce_at"
                  data-date-format="DD-MM-YYYY hh:mm A" data-date-start-date="0d">
                  <div class="input-group-addon">
                    <?php echo e(svg_image('solid/calendar-alt', 'text-muted')); ?>
                  </div>
                </div>
              </div>

                  <footer class="panel-footer bg-light lter m-b-sm">
                    <?php echo renderAjaxButton(); ?>

                    <ul class="nav nav-pills nav-sm"></ul>
            </footer>


                <?php echo Form::close(); ?>


                  <div class="panel-group m-b" id="accordion2">

                    <div class="input-group m-b-sm">
                <input type="text" class="form-control search" placeholder="Search by Subject or Message">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-icon"><?php echo e(svg_image('solid/search')); ?></button>
                </span>
              </div>
                    
                    <ul class="list no-style" id="announcement-list">
                    <?php $__currentLoopData = Auth::user()->announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="panel panel-default" id="announcement-<?php echo e($announcement->id); ?>">
                      <div class="panel-heading">
                        <a class="accordion-toggle subject" data-toggle="collapse" data-parent="#accordion2" href="#<?php echo e(slugify($announcement->subject)); ?>">
                         <?php echo e(svg_image('solid/bullhorn')); ?> <?php echo e($announcement->subject); ?>

                        </a>
                        <a href="#" class="delete-announcement pull-right text-muted" data-announcement-id="<?php echo e($announcement->id); ?>"><?php echo e(svg_image('solid/trash-alt')); ?></a>
                        <a href="<?php echo e(route('announcements.update', $announcement->id)); ?>" class="pull-right text-muted m-l-xs" data-toggle="ajaxModal"><?php echo e(svg_image('solid/pencil-alt')); ?></a>
                      </div>
                      <div id="<?php echo e(slugify($announcement->subject)); ?>" class="panel-collapse collapse">
                        <div class="panel-body message">
                          <?php echo parsedown($announcement->message); ?>
                          <?php if(!empty($announcement->url)): ?>
                          <a class="btn btn-sm btn-info" href="<?php echo e($announcement->url); ?>" target="_blank">Read More</a>
                          <?php endif; ?>
                        </div>
                      </div>

                      </li>
                    
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>
                    
                    
                    
                    
                  </div>


                </section>
            </section>

    </section>
</section>
<a class="hide nav-off-screen-block" data-target="#nav" data-toggle="class:nav-off-screen" href="#">
</a>

<?php $__env->startPush('pagestyle'); ?>
<?php echo $__env->make('stacks.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('pagescript'); ?>
    <?php echo $__env->make('stacks.js.markdown', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('stacks.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <script src='<?php echo e(getAsset('plugins/apps/list.min.js')); ?>'></script>

    <script>
      $('.datetimepicker-input').datetimepicker({showClose: true, showClear: true, minDate: moment() });
      var options = {
      valueNames: [ 'subject', 'message' ]
    };
    var ResponseList = new List('announcements', options);
    </script>

    <?php echo $__env->make('users::announcements._ajaxify', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>