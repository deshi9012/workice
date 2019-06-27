<div class="">
                    <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item m-t-xs">
                        <i class="<?php echo e(getIcon($file->ext)); ?> fa-3x text-danger pull-left m-xs"></i>
                        <a href="<?php echo e(route('files.download', ['id' => $file->id] )); ?>" data-rel="tooltip" title="<?php echo trans('app.'.'download'); ?>"><?php echo e($file->title); ?></a> 
                        <span class="text-muted pull-right small"><?php echo e(svg_image('solid/calendar-alt')); ?> <?php echo e(dateElapsed($file->created_at)); ?> 

                        </span>
                        <div class="text-muted"><?php echo parsedown($file->description); ?></div>
                        <div class="m-l-md text-muted text-semibold small"><?php echo trans('app.'.'size'); ?>: <?php echo e($file->size); ?>KB 
                            <span class="pull-right">
                                <?php if(!isset($limit)): ?>
                                <span class="m-r-sm"><?php echo e($file->filename); ?></span>
                                <?php endif; ?>

                                <?php if(Auth::id() == $file->user_id): ?> 
                                <a href="<?php echo e(route('files.edit', ['id' => $file->id])); ?>" data-toggle="ajaxModal" class="m-l-xs">
                                    <?php echo e(svg_image('solid/pencil-alt')); ?>
                                </a>
                                <?php endif; ?>
                                <?php if(isAdmin() || can('files_delete') || Auth::id() == $file->user_id): ?> 
                        <a href="<?php echo e(route('files.delete', ['id' => $file->id])); ?>" data-toggle="ajaxModal" class="m-l-xs">
                                <?php echo e(svg_image('solid/trash-alt')); ?>
                        </a>
                        <?php endif; ?>
                        
                            </span>
                        </div>
                    </li>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  
                </div>