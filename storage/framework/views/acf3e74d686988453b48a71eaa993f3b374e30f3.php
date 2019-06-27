<?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php 
                        $options = $field->field_options;  
                        ?>

                        <?php if($field->type == 'dropdown'): ?>

                            <div class="form-group">
                                <label><?php echo e($field->label); ?> <?php echo ($field->required) ? '<abbr title="required">*</abbr>' : ''; ?></label>
                                <select class="form-control"
                                        name="<?php echo e('custom['.$field->name.']'); ?>" <?php echo e(($field->required) ? 'required' : ''); ?> >
                                    <?php $__currentLoopData = $options['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                        <option value="<?php echo e($opt['label']); ?>" <?php echo e(($opt['checked']) ? 'selected="selected"' : ''); ?>><?php echo e($opt['label']); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            <span class="help-block">
                                <?php echo e(isset($options['description']) ? $options['description'] : ''); ?>

                            </span>

                            </div>

                        <?php elseif($field->type == 'text'): ?>

                            <div class="form-group">
                                <label><?php echo e($field->label); ?> <?php echo ($field->required) ? '<abbr title="required">*</abbr>' : ''; ?></label>
                                <input type="text" name="<?php echo e('custom['.$field->name.']'); ?>" class="input-sm form-control" <?php echo e(($field->required) ? 'required' : ''); ?>>
                                <span class="help-block">
                                 <?php echo e(isset($options['description']) ? $options['description'] : ''); ?>

                                </span>
                            </div>

                            
                        <?php elseif($field->type == 'paragraph'): ?>

                            <div class="form-group">
                                <label><?php echo e($field->label); ?> <?php echo ($field->required) ? '<abbr title="required">*</abbr>' : ''; ?></label>
                                <textarea name="<?php echo e('custom['.$field->name.']'); ?>" class="form-control ta" <?php echo e(($field->required) ? 'required' : ''); ?>></textarea>
                                <span class="help-block">
                                    <?php echo e(isset($options['description']) ? $options['description'] : ''); ?>

                                </span>
                            </div>

                            
                        <?php elseif($field->type == 'radio'): ?>


                            <div class="form-group">
                                <label><?php echo e($field->label); ?> <?php echo ($field->required) ? '<abbr title="required">*</abbr>' : ''; ?></label>
                                <?php $__currentLoopData = $options['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                    <div class="form-radio">
                                        <label class="">
                                            <input type="radio"
                                                   name="<?php echo e('custom['.$field->name.']'); ?>" <?php echo e(($opt['checked']) ? 'checked' : ''); ?>

                                                   value="<?php echo e($opt['label']); ?>" >
                                             <span class="label-text"><?php echo e($opt['label']); ?></span>
                                        </label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <span class="help-block">
                                    <?php echo e(isset($options['description']) ? $options['description'] : ''); ?>

                                </span>
                            </div>

                            
                        <?php elseif($field->type == 'checkboxes'): ?>
                            <div class="form-group">
                                <label><?php echo e($field->label); ?> <?php echo ($field->required) ? '<abbr title="required">*</abbr>' : ''; ?></label>

                                <?php $__currentLoopData = $options['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-check">
                                        <label class="">
                                            <input type="checkbox"
                                                   name="<?php echo e('custom['.$field->name.']'); ?>[]" <?php echo e(($opt['checked']) ? 'checked' : ''); ?>

                                                   value="<?php echo e($opt['label']); ?>">
                                            
                                            <span class="label-text"><?php echo e($opt['label']); ?></span>

                                        </label>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <span class="help-block">
                                    <?php echo e(isset($options['description']) ? $options['description'] : ''); ?>

                                </span>

                            </div>
                            <!-- Email Field -->
                        <?php elseif($field->type == 'email'): ?>

                            <div class="form-group">
                                <label><?php echo e($field->label); ?> <?php echo ($field->required) ? '<abbr title="required">*</abbr>' : ''; ?></label>
                                <input type="email" name="<?php echo e('custom['.$field->name.']'); ?>" class="input-sm form-control" <?php echo e(($field->required) ? 'required' : ''); ?>>
                                <span class="help-block">
                                    <?php echo e(isset($options['description']) ? $options['description'] : ''); ?>

                                </span>
                            </div>

                        <?php elseif($field->type == 'section_break'): ?>
                            <hr/>
                        <?php endif; ?>


                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                