<div class="row">
    <div class="col-lg-12">
        <?php echo Form::open(['route' => ['settings.edit', $section], 'class' => 'bs-example form-horizontal ajaxifyForm']); ?>

        <section class="panel panel-default">
        <header class="panel-heading"><?php echo e(svg_image('solid/cogs')); ?> <?php echo trans('app.'.'company_details'); ?>  </header>
        <?php 
        $translations = Modules\Settings\Entities\Options::translations();
        $default_country = get_option('company_country');
        ?>
        <div class="panel-body">
            <input type="hidden" name="languages" value="<?php echo e(implode(',', $translations)); ?>">
            <?php if(count($translations) > 0): ?>
            <ul class="nav nav-tabs" role="tablist">
                <li><a class="active" data-toggle="tab" href="#tab-english">en</a></li>
                <?php $__currentLoopData = $translations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a data-toggle="tab" href="#tab-<?php echo e($lang); ?>"><?php echo e($lang); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <div class="tab-content tab-content-fix">
                <div class="tab-pane fade in active" id="tab-english">
                    <?php endif; ?>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'company_name'); ?> <span class="text-danger">*</span></label>
                        <div class="col-lg-6">
                            <input type="text" name="company_name" class="form-control"
                            value="<?php echo e(get_option('company_name')); ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'company_legal_name'); ?> <span class="text-danger">*</span></label>
                        <div class="col-lg-6">
                            <input type="text" name="company_legal_name" class="form-control"
                            value="<?php echo e(get_option('company_legal_name')); ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'contact_person'); ?>   </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="<?php echo e(get_option('contact_person')); ?>"
                            name="contact_person">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'company_address'); ?> <span class="text-danger">*</span></label>
                        <div class="col-lg-6">
                            <textarea class="form-control ta" name="company_address"
                            required><?php echo e(get_option('company_address')); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'zipcode'); ?></label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="<?php echo e(get_option('company_zip_code')); ?>"
                            name="company_zip_code">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'city'); ?>  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="<?php echo e(get_option('company_city')); ?>"
                            name="company_city">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'state'); ?>  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="<?php echo e(get_option('company_state')); ?>"
                            name="company_state">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'country'); ?></label>
                        <div class="col-lg-6">
                            <select class="select2-option form-control" name="company_country">
                                <?php $__currentLoopData = countries(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($country['name']); ?>" <?php echo e($country['name'] == $default_country ? 'selected' : ''); ?>><?php echo e($country['name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'company_email'); ?>  </label>
                        <div class="col-lg-6">
                            <input type="email" class="form-control" value="<?php echo e(get_option('company_email')); ?>"
                            name="company_email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'company_phone'); ?>  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="<?php echo e(get_option('company_phone')); ?>"
                            name="company_phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'company_phone'); ?>   2</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="<?php echo e(get_option('company_phone_2')); ?>"
                            name="company_phone_2">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'mobile'); ?>  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="<?php echo e(get_option('company_mobile')); ?>"
                            name="company_mobile">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'fax'); ?>   </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="<?php echo e(get_option('company_fax')); ?>"
                            name="company_fax">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'company_domain'); ?>  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="<?php echo e(get_option('company_domain')); ?>"
                            name="company_domain">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'company_registration'); ?>  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="<?php echo e(get_option('company_registration')); ?>" name="company_registration">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'tax_number'); ?>  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="<?php echo e(get_option('company_vat')); ?>"
                            name="company_vat">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'email_signature'); ?>  </label>
                        <div class="col-lg-6">
                            <textarea class="form-control ta" name="email_signature"><?php echo e(get_option('email_signature')); ?></textarea>
                        </div>
                    </div>
                    <?php if(count($translations) > 0): ?>
                </div>
                <?php $__currentLoopData = $translations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="tab-pane fade" id="tab-<?php echo e($lang); ?>">
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'company_name'); ?>   </label>
                        <div class="col-lg-6">
                            <input type="text" name="company_name_<?php echo e($lang); ?>" class="form-control"
                            value="<?php echo e(get_option('company_name_' . $lang)); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'company_legal_name'); ?>  </label>
                        <div class="col-lg-6">
                            <input type="text" name="company_legal_name_<?php echo e($lang); ?>" class="form-control"
                            value="<?php echo e(get_option('company_legal_name_' . $lang)); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'contact_person'); ?>   </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="<?php echo e(get_option('contact_person_' . $lang)); ?>"
                            name="contact_person_<?php echo e($lang); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'company_address'); ?></label>
                        <div class="col-lg-6">
                            <textarea class="form-control ta"
                            name="company_address_<?php echo e($lang); ?>"><?php echo e(get_option('company_address_' . $lang)); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'zipcode'); ?></label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="<?php echo e(get_option('company_zip_code_' . $lang)); ?>"
                            name="company_zip_code_<?php echo e($lang); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'city'); ?>  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="<?php echo e(get_option('company_city_' . $lang)); ?>"
                            name="company_city_<?php echo e($lang); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'state'); ?>  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="<?php echo e(get_option('company_state_' . $lang)); ?>"
                            name="company_state_<?php echo e($lang); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'country'); ?>  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="<?php echo e(get_option('company_country_' . $lang)); ?>"
                            name="company_country_<?php echo e($lang); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'company_email'); ?>  </label>
                        <div class="col-lg-6">
                            <input type="email" class="form-control"
                            value="<?php echo e(get_option('company_email_' . $lang)); ?>"
                            name="company_email_<?php echo e($lang); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'company_phone'); ?>  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="<?php echo e(get_option('company_phone_' . $lang)); ?>"
                            name="company_phone_<?php echo e($lang); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'company_phone'); ?>   2</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="<?php echo e(get_option('company_phone_2_' . $lang)); ?>"
                            name="company_phone_2_<?php echo e($lang); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'mobile'); ?>  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="<?php echo e(get_option('company_mobile_' . $lang)); ?>"
                            name="company_mobile_<?php echo e($lang); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'fax'); ?>   </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="<?php echo e(get_option('company_fax_' . $lang)); ?>"
                            name="company_fax_<?php echo e($lang); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'company_domain'); ?>  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="<?php echo e(get_option('company_domain_' . $lang)); ?>"
                            name="company_domain_<?php echo e($lang); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'company_registration'); ?>  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="<?php echo e(get_option('company_registration_' . $lang)); ?>"
                            name="company_registration_<?php echo e($lang); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'tax_number'); ?>  </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control"
                            value="<?php echo e(get_option('company_vat_' . $lang)); ?>"
                            name="company_vat_<?php echo e($lang); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'email_signature'); ?></label>
                        <div class="col-lg-6">
                            <textarea class="form-control ta" name="email_signature_<?php echo e($lang); ?>"><?php echo e(get_option('email_signature')); ?></textarea>
                        </div>
                    </div>
                    
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="panel-footer">
            <?php echo renderAjaxButton('save'); ?>

        </div>
    </section>
    <?php echo Form::close(); ?>

</div>

</div>
<?php $__env->startPush('pagestyle'); ?>
<?php echo $__env->make('stacks.css.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('pagescript'); ?>
<?php echo $__env->make('stacks.js.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>