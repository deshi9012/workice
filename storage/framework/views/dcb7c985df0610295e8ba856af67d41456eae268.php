<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title"><?php echo trans('app.'.'make_changes'); ?> - <?php echo e($lead->name); ?></h4>
		</div>
		<?php echo Form::open(['route' => ['leads.api.update', $lead->id ], 'class' => 'ajaxifyForm', 'method' => 'PUT', 'data-toggle' => 'validator', 'novalidate' => '']); ?>

		<div class="modal-body">
			<ul class="nav nav-tabs" role="tablist">
				<li class="active"><a data-toggle="tab" href="#tab-lead-general"><?php echo trans('app.'.'general'); ?> </a></li>
				
				
				
				
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade in active" id="tab-lead-general">
					<div class="form-group col-md-6 no-gutter-left">
						<label><?php echo trans('app.'.'fullname'); ?> <span class="text-danger">*</span></label>
						<?php if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager') || Auth::user()->hasRole('office manager')): ?>
							<input type="text" name="name" value="<?php echo e($lead->name); ?>" class="input-sm form-control"
								   required>
						<?php else: ?>
							<input type="text" name="name" value="<?php echo e($lead->name); ?>" class="input-sm form-control"
								   readonly>
						<?php endif; ?>
					</div>
					<div class="form-group col-md-6 no-gutter-right">
						<label><?php echo trans('app.'.'email'); ?> <span class="text-danger">*</span></label>
						<?php if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager') || Auth::user()->hasRole('office manager')): ?>
							<input type="email" name="email" value="<?php echo e($lead->email); ?>" class="input-sm form-control"
								   required>
						<?php else: ?>
							<input type="email" name="email" value="<?php echo e($lead->email); ?>" class="input-sm form-control"
								   readonly>
						<?php endif; ?>
					</div>
					<div class="form-group col-md-6 no-gutter-left">
						<label><?php echo trans('app.'.'mobile'); ?> </label>
						<?php if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager')|| Auth::user()->hasRole('office manager')): ?>
							<input type="text" name="mobile" class="input-sm form-control" value="<?php echo e($lead->mobile); ?>">
						<?php else: ?>
							<input type="text" name="mobile" class="input-sm form-control" value="<?php echo e($lead->mobile); ?>"
								   readonly>
						<?php endif; ?>
					</div>
					<div class="col-md-6">
						<label>Desk <span class="text-danger">*</span></label>
						<?php if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager')|| Auth::user()->hasRole('office manager')): ?>
							<select class="select2-option form-control" name="desk">
								<?php $__currentLoopData = App\Entities\Desk::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $desk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($desk->id); ?>" <?php echo e($desk->id == $lead->desk_id ? ' selected' : ''); ?>><?php echo e($desk->name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						<?php else: ?>
							<select class="select2-option form-control" name="desk" disabled>
								<?php $__currentLoopData = App\Entities\Desk::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $desk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($desk->id); ?>"
											<?php echo e($desk->id == $lead->desk_id ? ' selected' : ''); ?> > <?php echo e($desk->name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						<?php endif; ?>
					</div>
					
					
					
					
					<div class="form-group col-md-6 no-gutter-right">
						<label><?php echo trans('app.'.'source'); ?> </label>
						<?php if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager')|| Auth::user()->hasRole('office manager')): ?>
							<select name="source" class="form-control">
								<?php $__currentLoopData = App\Entities\Category::select('id', 'name')->whereModule('source')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($source->id); ?>" <?php echo e($source->id == $lead->source ? ' selected' : ''); ?>><?php echo e($source->name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						<?php else: ?>
							<select name="source" class="form-control" disabled>
								<?php $__currentLoopData = App\Entities\Category::select('id', 'name')->whereModule('source')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($source->id); ?>" <?php echo e($source->id == $lead->source ? ' selected' : ''); ?>><?php echo e($source->name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						<?php endif; ?>
					</div>
					<div class="form-group col-md-6 no-gutter-left">
						<label><?php echo trans('app.'.'stage'); ?></label>
						<select name="stage_id" class="form-control">
							<?php $__currentLoopData = App\Entities\Category::leads()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($stage->id); ?>" <?php echo e($stage->id == $lead->stage_id ? ' selected' : ''); ?>><?php echo e(ucfirst($stage->name)); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>
					<div class="form-group col-md-6 no-gutter-right">
						<label>Language</label>
						<?php if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager')|| Auth::user()->hasRole('office manager')): ?>
							<input type="text" name="language" class="input-sm form-control"
								   value="<?php echo e($lead->language); ?>">
						<?php else: ?>
							<input type="text" name="language" class="input-sm form-control"
								   value="<?php echo e($lead->language); ?>" readonly>
						<?php endif; ?>
					</div>

					<div class="form-group col-md-6 no-gutter-right">
						<label>Courses</label>
						<?php if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager')|| Auth::user()->hasRole('office manager')): ?>
							<input type="text" name="courses" class="input-sm form-control"
								   value="<?php echo e($lead->courses); ?>">
						<?php else: ?>
							<input type="text" name="courses" class="input-sm form-control" value="<?php echo e($lead->courses); ?>"
								   readonly>
						<?php endif; ?>
					</div>
					<div class="form-group col-md-6 no-gutter-left">
						
						
						

						
						

						
						
					</div>
					<div class="form-group col-md-6 no-gutter-right">
						<label>Change password</label>
						<?php if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager')|| Auth::user()->hasRole('office manager')): ?>
							<input type="text" name="change_password" class="input-sm form-control" value="">
						<?php else: ?>
							<input type="text" name="change_password" class="input-sm form-control" value="" readonly>
						<?php endif; ?>
					</div>

					<div class="row">
						<div class="form-group col-md-6">
							<label><?php echo trans('app.'.'lead_score'); ?> <span class="text-muted">(In % Ex. 50)</span>
							</label>
							<input type="text" value="<?php echo e($lead->lead_score); ?>" name="lead_score"
								   class="input-sm form-control">
						</div>
						<div class="form-group col-md-6">
							<label><?php echo trans('app.'.'lead_value'); ?></label>
							<input type="text" value="<?php echo e($lead->lead_value); ?>" name="lead_value"
								   class="input-sm form-control">
						</div>
						<div class="form-group col-md-6">
							<label><?php echo trans('app.'.'sales_rep'); ?></label>
							<?php if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('sales team leader') || Auth::user()->hasRole('desk manager') || Auth::user()->hasRole('office manager')): ?>
								<select class="select2-option form-control" name="sales_rep" required>
									<?php $__currentLoopData = app('user')->permission('leads_create')->offHoliday()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($user->id); ?>" <?php echo e($user->id == $lead->sales_rep ? ' selected' : ''); ?>><?php echo e($user->name); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							<?php else: ?>
								<select class="select2-option form-control" name="sales_rep" required disabled>
									<?php $__currentLoopData = app('user')->permission('leads_create')->offHoliday()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($user->id); ?>" <?php echo e($user->id == $lead->sales_rep ? ' selected' : ''); ?>><?php echo e($user->name); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							<?php endif; ?>
						</div>
						<div class="form-group col-md-6">
							<label><?php echo e(langapp('timezone')); ?> </label>
							<?php if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager')|| Auth::user()->hasRole('office manager')): ?>
								<select class="select2-option form-control" name="timezone" required>
									<?php $__currentLoopData = timezones(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timezone => $description): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($timezone); ?>"<?php echo e($lead->timezone == $timezone ? ' selected' : ''); ?>><?php echo e($description); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							<?php else: ?>
								<select class="select2-option form-control" name="timezone" disabled>
									<?php $__currentLoopData = timezones(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timezone => $description): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($timezone); ?>"<?php echo e($lead->timezone == $timezone ? ' selected' : ''); ?>><?php echo e($description); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							<?php endif; ?>
						</div>
						<div class="form-group col-md-6">
							<label><?php echo trans('app.'.'state'); ?> </label>
							<?php if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager')|| Auth::user()->hasRole('office manager')): ?>
								<input type="text" value="<?php echo e($lead->state); ?>" name="state"
									   class="input-sm form-control">
							<?php else: ?>
								<input type="text" value="<?php echo e($lead->state); ?>" name="state" class="input-sm form-control"
									   readonly>
							<?php endif; ?>
						</div>
						<div class="form-group col-md-6">
							<label><?php echo trans('app.'.'country'); ?> </label>
							<?php if( Auth::user()->hasRole('admin') || Auth::user()->hasRole('desk manager')|| Auth::user()->hasRole('office manager')): ?>
								<select class="form-control select2-option" name="country">
									<?php $__currentLoopData = countries(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($country['name']); ?>" <?php echo e($country['name'] == $lead->country ? 'selected' : ''); ?>><?php echo e($country['name']); ?>

										</option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							<?php else: ?>
								<select class="form-control select2-option" name="country" disabled>
									<?php $__currentLoopData = countries(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($country['name']); ?>" <?php echo e($country['name'] == $lead->country ? 'selected' : ''); ?>><?php echo e($country['name']); ?>

										</option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							<?php endif; ?>

						</div>
						<div class="form-group col-md-11">
							<label><?php echo trans('app.'.'tags'); ?> </label>
							<select class="select2-tags form-control" name="tags[]" multiple="multiple">
								<?php $__currentLoopData = App\Entities\Tag::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($tag->name); ?>" <?php echo e(in_array($tag->id, array_pluck($lead->tags->toArray(), 'id')) ? ' selected' : ''); ?>>
										<?php echo e($tag->name); ?>

									</option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div>
				</div>
				<div class="tab-pane fade in" id="tab-lead-location">
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					<div class="row">
						
						
						
						
						
						
						
						
						
						
						
						
						
					</div>
				</div>
				<div class="tab-pane fade in" id="tab-lead-web">
					<div class="form-group">
						<label><?php echo trans('app.'.'website'); ?> </label>
						<input type="text" value="<?php echo e($lead->website); ?>" name="website" class="input-sm form-control">
					</div>
					<div class="form-group">
						<label>Skype</label>
						<input type="text" value="<?php echo e($lead->skype); ?>" name="skype" class="input-sm form-control">
					</div>
					<div class="form-group">
						<label>LinkedIn</label>
						<input type="text" value="<?php echo e($lead->linkedin); ?>" name="linkedin" class="input-sm form-control">
					</div>
					<div class="form-group">
						<label>Facebook</label>
						<input type="text" value="<?php echo e($lead->facebook); ?>" name="facebook" class="input-sm form-control">
					</div>
					<div class="form-group">
						<label>Twitter</label>
						<input type="text" value="<?php echo e($lead->twitter); ?>" name="twitter" class="input-sm form-control">
					</div>
				</div>
				<div class="tab-pane fade in" id="tab-lead-message">
					<div class="form-group">
						<label><?php echo trans('app.'.'message'); ?> </label>
						<textarea name="message" class="form-control markdownEditor"
								  required><?php echo e($lead->message); ?> </textarea>
					</div>

				</div>
				<div class="tab-pane fade in" id="tab-lead-custom">
					<?php
						$data['fields'] = App\Entities\CustomField::whereModule('leads')->orderBy('order', 'desc')->get();
					?>
					<?php echo $__env->make('leads::_includes.updateCustom', $data, \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>
			<div class="modal-footer">
				<?php echo closeModalButton(); ?>

				<?php echo renderAjaxButton(); ?>

			</div>
			<?php echo Form::close(); ?>

		</div>
	</div>

<?php $__env->startPush('pagestyle'); ?>
	<?php echo $__env->make('stacks.css.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('pagescript'); ?>
	<?php echo $__env->make('stacks.js.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('stacks.js.markdown', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('partial.ajaxify', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->yieldPushContent('pagestyle'); ?>
<?php echo $__env->yieldPushContent('pagescript'); ?>