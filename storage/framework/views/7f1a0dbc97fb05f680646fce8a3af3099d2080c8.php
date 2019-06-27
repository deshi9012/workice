<ol class="dd-list">
<?php $__currentLoopData = $todos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<li class="dd-item dd3-item" data-id="<?php echo e($task->id); ?>" id="todo-<?php echo e($task->id); ?>" >
  
  <span class="pull-right m-xs">
    <a href="<?php echo e(route('todo.edit', $task->id)); ?>" data-toggle="ajaxModal">
      <?php echo e(svg_image('solid/pencil-alt', 'icon-muted fa-fw m-r-xs')); ?>
    </a>
    
    <a href="<?php echo e(route('todo.subtask', ['id' => $task->id])); ?>" data-toggle="ajaxModal">
      <?php echo e(svg_image('solid/plus', 'icon-muted fa-fw m-r-xs')); ?>
    </a>
    
    <?php if($task->user_id === Auth::id()): ?>
    <a href="#" class="deleteTodo" data-todo-id="<?php echo e($task->id); ?>" title="<?php echo trans('app.'.'delete'); ?>">
      <?php echo e(svg_image('solid/times', 'icon-muted fa-fw m-r-xs')); ?>
    </a>
    <?php endif; ?>
  </span>
  
  <div class="dd3-content">
    <label>
      <input type="checkbox" class="checkItem" data-id="<?php echo e($task->id); ?>" <?php echo $task->completed ? 'checked="checked"' : ''; ?>>
      <span class="label-text">
        <span class="<?php echo $task->completed ? 'text-success' : 'text-danger'; ?>" id="task-id-<?php echo e($task->id); ?>">
          <?php echo e($task->subject); ?> <small class="text-muted small m-l-sm" data-rel="tooltip" title="<?php echo e($task->agent->name); ?>"><?php echo e(svg_image('solid/calendar-alt')); ?> <?php echo e(dateTimeFormatted($task->due_date)); ?></small>
        </span>
      </span>
    </label>
    <p class="m-xs"><?php echo parsedown($task->notes); ?></p>
    
  </div>

    <?php if($task->child->count() > 0): ?>
      <?php echo app('arrilot.widget')->run('Todos\ShowTodos', ['todos' => $task->child]); ?>
    <?php endif; ?>
</li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ol>