<?php $__env->startSection('content'); ?>


<section id="content">
    <section class="hbox stretch">

            <section class="vbox">


                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-8 m-b-xs">


                                <a href="<?php echo e(route('contracts.index')); ?>" class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm" data-toggle="tooltip"
                                   title="<?php echo trans('app.'.'contracts'); ?>  " data-placement="bottom">
                                   <?php echo e(svg_image('solid/times')); ?> <?php echo trans('app.'.'cancel'); ?>  
                                </a>


                        </div>
                        <div class="col-sm-4 m-b-xs">


                        </div>
                    </div>
                </header>
                <section class="scrollable wrapper bg">

                    <div class="row">


                        <div class="panel-default">


                            <div class="panel-body">

            <?php echo Form::open(['route' => 'contracts.api.save', 'class' => 'm-b-sm ajaxifyForm']); ?>




                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label><?php echo trans('app.'.'contract_title'); ?> <span class="text-danger">*</span></label>
                                            <input type="text" placeholder="e.g Web Design" name="contract_title"
                                                   class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label><?php echo trans('app.'.'client'); ?> <span class="text-danger">*</span></label>
                            <select name="client_id" class="form-control select2-option" required>
        <?php $__currentLoopData = Modules\Clients\Entities\Client::select('id', 'name')->where('primary_contact', '>', 0)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($client->id); ?>"><?php echo e($client->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label><?php echo trans('app.'.'start_date'); ?> <span class="text-danger">*</span></label>

                                            <div class="input-group">

                <input class="datepicker-input form-control" size="16" type="text" value="<?php echo e(datePickerFormat(now())); ?>" name="start_date" data-date-format="<?php echo e(get_option('date_picker_format')); ?>"
                                                       required>
                                                <label class="input-group-addon btn" for="date">
                                                    <?php echo e(svg_image('solid/calendar-alt', 'text-muted')); ?>
                                                </label>
                                            </div>


                                        </div>
                                        <div class="col-md-6">
                                            <label><?php echo trans('app.'.'end_date'); ?> <span class="text-danger">*</span></label>
                                            <div class="input-group">
                <input class="datepicker-input form-control" size="16" type="text" value="<?php echo e(datePickerFormat(now()->addDays(30))); ?>" name="end_date" data-date-format="<?php echo e(get_option('date_picker_format')); ?>"
                                                       data-date-start-date="moment()" required>
                                                <label class="input-group-addon btn" for="date">
                                                    <?php echo e(svg_image('solid/calendar-alt', 'text-muted')); ?>
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label><?php echo trans('app.'.'fixed_rate'); ?></label>
                                            <select name="rate_is_fixed" class="form-control">
                                                <option value="0"><?php echo trans('app.'.'no'); ?>  </option>
                                                <option value="1"><?php echo trans('app.'.'yes'); ?>  </option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label><?php echo trans('app.'.'fixed_price'); ?></label>
                                            <input type="text" placeholder="e.g 450.00" class="form-control"
                                                   name="fixed_rate">
                                        </div>
                                        <div class="col-md-4">
                                            <label><?php echo trans('app.'.'hourly_rate'); ?></label>
                                            <input type="text" placeholder="e.g 50.00" class="form-control"
                                                   name="hourly_rate">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label><?php echo trans('app.'.'currency'); ?> <span class="text-danger">*</span></label>
                            <select name="currency" class="form-control select2-option" required>
                                    <?php $__currentLoopData = App\Entities\Currency::select('code', 'title')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($currency->code); ?>"><?php echo e($currency->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label><?php echo trans('app.'.'i_will_provide_this_service'); ?></label>
                                            <input type="text" name="services"
                                                   placeholder="e.g Web Design, Consulting, Writing"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label><?php echo trans('app.'.'who_will_own_your_work_product'); ?> <a href="" data-toggle="tooltip"
                                                                                      title="If your work is ‘made for hire’, your client is considered the author, and owns all copyrights to the work."
                                                                                      data-placement="right"><i
                                                            class="far fa-question-circle"></i></a></label>
                                            <select name="license_owner" class="form-control">
                                                <option value="freelancer"><?php echo trans('app.'.'i_will_retain_ownership'); ?> 
                                                </option>
                                                <option value="client"><?php echo trans('app.'.'made_for_hire_owned_by_client'); ?>
                                                </option>

                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label><?php echo trans('app.'.'how_long_should_client_take_to_countersign'); ?> <span class="text-danger">*</span> </label>
                                            <input type="text" placeholder="e.g 14, 30, 90" class="form-control"
                                                   name="expiry_date" required>
                                            <span class="help-block text-danger"><?php echo trans('app.'.'days'); ?>. <?php echo trans('app.'.'selected_expiration_date_after_start_date'); ?></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label><?php echo trans('app.'.'description'); ?>   <a href="" data-toggle="tooltip" title="<?php echo trans('app.'.'services_you_will_provide'); ?>" data-placement="right"><i
                                                            class="far fa-question-circle"></i></a></label>
                                            <textarea name="description" name="description"
                                                      class="form-control markdownEditor"></textarea>
                                        </div>

                                        <div class="col-md-6">
                                            <label><?php echo trans('app.'.'client_granted_rights'); ?></label>
                                            <textarea name="client_rights" class="form-control markdownEditor"><?php echo trans('app.'.'client_rights_text'); ?></textarea>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label><?php echo trans('app.'.'payment_terms'); ?> <span class="text-danger">*</span></label>
                                            <input type="text" placeholder="e.g 14, 30, 90" class="form-control"
                                                   name="payment_terms" required>
                                            <span class="help-block text-danger">Enter number of Days</span>
                                        </div>
                                        <div class="col-md-4">
                                            <label><?php echo trans('app.'.'late_fee'); ?></label>
                                            <input type="text" placeholder="e.g 10.00" name="late_payment_fee"
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label><?php echo trans('app.'.'late_fee_percent'); ?></label>
                                            <select name="late_fee_percent" class="form-control">
                                                <option value="1"><?php echo trans('app.'.'yes'); ?>  </option>
                                                <option value="0"><?php echo trans('app.'.'no'); ?>  </option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label><?php echo trans('app.'.'project_termination_period'); ?> <span class="text-danger">*</span></label>
                                            <input type="text" placeholder="e.g 14, 30, 90" class="form-control"
                                                   name="termination_notice" required>
                                            <span class="help-block text-danger">Enter number of Days</span>
                                        </div>
                                        <div class="col-md-3">
                                            <label><?php echo trans('app.'.'cancellation_fee'); ?><a href="#" data-toggle="tooltip"
                                                                       title="If your Client terminates your contract earlier without cause, you may charge a cancellation fee, commonly known as a 'kill fee'. Note that this cannot be unreasonable or punitive. You should consult an attorney to determine if your proposed cancellation fee would be legally enforceable."
                                                                       data-placement="top"><i
                                                            class="far fa-question-circle"></i></a></label>
                                            <input type="text" placeholder="e.g 10.00" class="form-control"
                                                   name="cancelation_fee">
                                        </div>
                                        <div class="col-md-3">
                                            <label><?php echo trans('app.'.'required_deposit'); ?> <a href="#" data-toggle="tooltip"
                                                                       data-placement="top"
                                                                       title="Getting money up front helps mitigate your risk in taking on work. We recommend that freelancers negotiate a deposit, especially for larger projects."><i
                                                            class="far fa-question-circle"></i></a></label>
                                            <input type="text" placeholder="e.g 30.00" name="deposit_required"
                                                   class="form-control">
                                        </div>

                                        <div class="col-md-3">
                                            <label><?php echo trans('app.'.'right_to_include_in_portfolio'); ?> <a href="#" data-toggle="tooltip"
                                                                                    data-placement="left"
                                                                                    title="Retain right to include work attribution in your portfolio."><i
                                                            class="far fa-question-circle"></i></a></label>
                                            <select name="portfolio_rights" class="form-control">
                                                <option value="1"><?php echo trans('app.'.'yes'); ?></option>
                                                <option value="0"><?php echo trans('app.'.'no'); ?></option>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label><?php echo trans('app.'.'add_noncompete'); ?> <a href="#" data-toggle="tooltip" data-placement="right" title="If enabled, remember to change the clause in Settings area">
                                                <i class="far fa-question-circle"></i></a>
                                            </label>
                                            <select name="non_compete" class="form-control">
                                                <option value="1"><?php echo trans('app.'.'yes'); ?></option>
                                                <option value="0"><?php echo trans('app.'.'no'); ?></option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label><?php echo trans('app.'.'limit_revisions'); ?></label>
                                            <input type="text" value="0" class="form-control" name="feedbacks" required>
                                            <span class="help-block text-danger">Default is 0 i.e no revision limits</span>
                                        </div>

                                        <div class="col-md-4">
                                            <label><?php echo trans('app.'.'add_sexual_harrassment'); ?></label>
                                            <select name="appropriate_conduct" class="form-control">
                                                <option value="1"><?php echo trans('app.'.'yes'); ?></option>
                                                <option value="0"><?php echo trans('app.'.'no'); ?></option>
                                            </select>
                                        </div>

                                    </div>
                                </div>


                                <div class="text-right">
                                    <?php echo renderAjaxButton(); ?>

                                </div>


                                <?php echo Form::close(); ?>



                            </div>


                        </div>

                </section>


            </section>
            


    </section>


</section>

 <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> 

</section>

<?php $__env->startPush('pagestyle'); ?>
<link href="//fonts.googleapis.com/css?family=Dawning+of+a+New+Day" rel="stylesheet">
    <?php echo $__env->make('stacks.css.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('stacks.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('pagescript'); ?>
    <?php echo $__env->make('stacks.js.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('stacks.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('stacks.js.markdown', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>