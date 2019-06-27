<?php foreach ($fields as $field) : ?>
                        <?php $val = $ticket->metaValue($field->name);
                        if (isset($field->field_options['options'])) {
                            $options = $field->field_options['options'];
                        }
                        ?>
                        <!-- check if dropdown -->
                        <?php if ($field->type == 'dropdown') : ?>
                            <div class="form-group">
                                <label><?= $field->label ?> <?= ($field->required) ? '<abbr title="required">*</abbr>' : ''; ?></label>
                                <select class="form-control"
                                        name="<?= 'custom['.$field->name.']' ?>" <?= ($field->required) ? 'required' : ''; ?> >
                                    
                                    <?php foreach ($options as $opt) : ?>
                                        <option value="<?= $opt['label'] ?>" <?= ($opt['label'] == $val) ? 'selected="selected"' : ''; ?>><?= $opt['label'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="help-block"><?= isset($options['description']) ? $options['description'] : '' ?></span>

                            </div>

                            <!-- Text field -->
                        <?php elseif ($field->type == 'text') : ?>
                            <div class="form-group">
                                <label><?= $field->label ?> <?= ($field->required) ? '<abbr title="required">*</abbr>' : ''; ?></label>
                                <input type="text" name="<?= 'custom['.$field->name.']' ?>" class="input-sm form-control"
                                       value="<?= $val ?>" <?= ($field->required) ? 'required' : ''; ?>>
                                <span class="help-block"><?= isset($options['description']) ? $options['description'] : '' ?></span>
                            </div>

                            <!-- Textarea field -->
                        <?php elseif ($field->type == 'paragraph') : ?>
                            <div class="form-group">
                                <label><?= $field->label ?> <?= ($field->required) ? '<abbr title="required">*</abbr>' : ''; ?></label>
                                <textarea name="<?= 'custom['.$field->name.']' ?>"
                                          class="form-control ta" <?= ($field->required) ? 'required' : ''; ?>><?= $val ?></textarea>
                                <span class="help-block"><?= isset($options['description']) ? $options['description'] : '' ?></span>
                            </div>

                            <!-- Radio buttons -->
                        <?php elseif ($field->type == 'radio') : ?>
                            <div class="form-group">
                                <label><?= $field->label ?> <?= ($field->required) ? '<abbr title="required">*</abbr>' : ''; ?></label>
                                <?php foreach ($options as $opt) : ?>
                                     <div class="radio"> 

                                    <label class="">
                                        <input type="radio" name="<?= 'custom['.$field->name.']' ?>" <?= ($val == $opt['label']) ? 'checked="checked"' : ''; ?>
                                               value="<?= $opt['label'] ?>" <?= ($field->required) ? 'required' : ''; ?>>  <?= $opt['label'] ?>
                                    </label>
                                    </div>
                                <?php endforeach; ?>
                                <span class="help-block"><?= isset($options['description']) ? $options['description'] : '' ?></span>
                            </div>

                            <!-- Checkbox field -->
                        <?php elseif ($field->type == 'checkboxes') : ?>
                            <div class="form-group">
                                <label><?= $field->label ?> <?= ($field->required) ? '<abbr title="required">*</abbr>' : ''; ?></label>

                                <?php foreach ($options as $opt) : ?>
                                    <?php $sel_val = json_decode($val); ?>

                                  

                                    <div class="checkbox">
                                        <label class="">
                                            <?php if (is_array($sel_val)) : ?>
                                                <input type="checkbox"
                                                       name="<?= 'custom['.$field->name.']' ?>[]" <?= ($opt['checked'] || in_array($opt['label'], $sel_val)) ? 'checked="checked"' : ''; ?>
                                                       value="<?= $opt['label'] ?>">
                                            <?php else : ?>
                                                <input type="checkbox"
                                                       name="<?= 'custom['.$field->name.']' ?>[]" <?= ($opt['checked']) ? 'checked="checked"' : ''; ?>
                                                       value="<?= $opt['label'] ?>">
                                            <?php endif; ?>
                                            <?= $opt['label'] ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                                <span class="help-block"><?= isset($options['description']) ? $options['description'] : '' ?></span>

                            </div>
                            <!-- Email Field -->
                        <?php elseif ($field->type == 'email') : ?>
                            <div class="form-group">
                                <label><?= $field->label ?> <?= ($field->required) ? '<abbr title="required">*</abbr>' : ''; ?></label>
                                <input type="email" name="<?= 'custom['.$field->name.']' ?>" value="<?= $val ?>"
                                       class="input-sm form-control" <?= ($field->required) ? 'required' : '' ?>>
                                <span class="help-block"><?= isset($options['description']) ? $options['description'] : '' ?></span>
                            </div>

                        <?php elseif ($field->type == 'section_break') : ?>
                            <hr/>
                        <?php endif; ?>


<?php endforeach; ?>