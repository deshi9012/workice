<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title"><?php echo trans('app.'.'lead'); ?> </h4>
		</div>
		<?php echo Form::open(['route' => 'leads.api.save', 'class' => 'ajaxifyForm', 'data-toggle' => 'validator', 'novalidate' => '']); ?>

		<div class="modal-body">

			<ul class="nav nav-tabs" role="tablist">
				<li class="active"><a href="#tab-lead-general" data-toggle="tab"><?php echo trans('app.'.'general'); ?> </a></li>
				
				
				
				
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade in active" id="tab-lead-general">
					<div class="form-group col-md-6 no-gutter-left">
						<label><?php echo trans('app.'.'fullname'); ?> <span class="text-danger">*</span></label>
						<input type="text" name="name" value="" class="input-sm form-control" required>
					</div>
					<div class="form-group col-md-6 no-gutter-right">
						<label><?php echo trans('app.'.'email'); ?> <span class="text-danger">*</span></label>
						<input type="email" name="email" value="" class="input-sm form-control" required>
					</div>
					<div class="form-group col-md-6 no-gutter-left">
						<label><?php echo trans('app.'.'mobile'); ?> </label>
						<input type="text" name="mobile" class="input-sm form-control">
					</div>
					
					
					
					

					<div class="form-group col-md-6 no-gutter-right">
						<label><?php echo trans('app.'.'source'); ?> <span class="text-danger">*</span></label>
						<select name="source" class="form-control">
							<?php $__currentLoopData = App\Entities\Category::select('id', 'name')->whereModule('source')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($source->id); ?>"><?php echo e($source->name); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>
					
						
						
							
								
							
						
					
					<div class="row">
						<div class="form-group col-md-6">
							<label>Language</label>
							<input type="text" name="language" class="input-sm form-control">
						</div><div class="form-group col-md-6">
							<label>Courses</label>
							<input type="text" name="language" class="input-sm form-control">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label>Sales Status</label>
							
							<select class="form-control select2-option" name="sales_status" required>
								<?php $__currentLoopData = statuses(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($status); ?>" ><?php echo e($status); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="form-group col-md-6">
							<label><?php echo trans('app.'.'lead_score'); ?> <span class="text-muted">(In % Ex. 50)</span>
							</label>
							<input type="text" value="10" name="lead_score" class="input-sm form-control">
						</div>
						<div class="form-group col-md-6">
							<label><?php echo trans('app.'.'lead_value'); ?> </label>
							<input type="text" value="0.00" name="lead_value" class="input-sm form-control money">
						</div>
						<div class="form-group col-md-6">
							<label><?php echo trans('app.'.'sales_rep'); ?> <span class="text-danger">*</span> </label>
							<select class="form-control select2-option" name="sales_rep" required>

								<?php $__currentLoopData = app('user')->permission('leads_create')->offHoliday()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($user->id); ?>" <?php echo e($user->id == get_option('default_sales_rep') ? 'selected="selected"' : ''); ?>><?php echo e($user->name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

							</select>

						</div>


						<div class="form-group col-md-6">
							<label><?php echo trans('app.'.'timezone'); ?> </label>
							<select class="form-control select2-option" name="timezone" required>
								<?php $__currentLoopData = timezones(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timezone => $description): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($timezone); ?>"<?php echo e(get_option('timezone') == $timezone ? ' selected="selected"' : ''); ?>><?php echo e($description); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label><?php echo trans('app.'.'state'); ?> </label>
							<input type="text" value="" name="state" class="input-sm form-control">
						</div>
						<div class="form-group col-md-6">
							<label><?php echo trans('app.'.'country'); ?></label>
							<select class="form-control select2-option" name="country">
								<?php $__currentLoopData = countries(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($country['name']); ?>" <?php echo e($country['name'] == get_option('company_country') ? 'selected' : ''); ?>><?php echo e($country['name']); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>

						<div class="form-group col-md-11">
							<label><?php echo trans('app.'.'tags'); ?> </label>
							<select class="select2-tags form-control" name="tags[]" multiple="multiple">
								<?php $__currentLoopData = App\Entities\Tag::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($tag->name); ?>"><?php echo e($tag->name); ?></option>
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
						<input type="text" value="" name="website" class="input-sm form-control">
					</div>
					<div class="form-group">
						<label>Skype</label>
						<input type="text" value="" name="skype" class="input-sm form-control">
					</div>
					<div class="form-group">
						<label>LinkedIn</label>
						<input type="text" value="" name="linkedin" class="input-sm form-control">
					</div>
					<div class="form-group">
						<label>Facebook</label>
						<input type="text" value="" name="facebook" class="input-sm form-control">
					</div>
					<div class="form-group">
						<label>Twitter</label>
						<input type="text" value="" name="twitter" class="input-sm form-control">
					</div>
				</div>

				<div class="tab-pane fade in" id="tab-lead-message">
					<div class="form-group">
						<label><?php echo trans('app.'.'message'); ?> </label>
						<textarea name="message" class="form-control markdownEditor" required></textarea>
					</div>


				</div>

				<div class="tab-pane fade in" id="tab-lead-custom">
					<?php
						$data['fields'] = App\Entities\CustomField::whereModule('leads')->get();
					?>
					<?php echo $__env->make('partial.customfields.createNoCol', $data, \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
			</div>

			<?php echo $__env->make('partial.privacy_consent', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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
		<script>
			$('.money').maskMoney({allowZero: true, thousands: ''});
		</script>
<?php echo $__env->make('stacks.js.form', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('stacks.js.markdown', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('partial.ajaxify', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>


<?php echo $__env->yieldPushContent('pagestyle'); ?>
<?php echo $__env->yieldPushContent('pagescript'); ?>