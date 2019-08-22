<style>
	/* The Modal (background) */
	.modal {
		display: none; /* Hidden by default */
		position: fixed; /* Stay in place */
		z-index: 1; /* Sit on top */
		padding-top: 100px; /* Location of the box */
		left: 0;
		top: 0;
		width: 100%; /* Full width */
		height: 100%; /* Full height */
		overflow: auto; /* Enable scroll if needed */
		background-color: rgb(0, 0, 0); /* Fallback color */
		background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
	}

	/* Modal Content */
	.modal-content {
		background-color: #fefefe;
		margin: auto;
		padding: 20px;
		border: 1px solid #888;
		width: 30%;
	}

	/* The Close Button */
	.close {
		color: #aaaaaa;
		float: right;
		font-size: 28px;
		font-weight: bold;
	}

	button#yes, button#no{
		margin:5px;
		width: 60px;
	}
</style>
<div class="row">
	<div class="col-lg-4 b-r">
		<section class="panel panel-default">
			<header class="panel-heading"><?php echo trans('app.'.'overview'); ?></header>
			<section class="panel-body">

				<div class="m-xs">
					<span class="text-muted">ID:</span>
					<span class="text-bold" id="lead-id"><?php echo e($lead->id); ?></span>
				</div>
				<div class="m-xs">
					<span class="text-muted"><?php echo trans('app.'.'created_at'); ?>:</span>
					<span class="text-bold"><?php echo e(dateFormatted($lead->created_at)); ?></span>
				</div>

				<div class="m-xs">
					<span class="text-muted">Desk:</span>
					<span class="text-bold text-danger"><?php echo e(ucfirst($lead->desk)); ?></span>
				</div>
				<div class="m-xs">
					<span class="text-muted"><?php echo e(langapp('stage')); ?>:</</span>
					
					<select id="custom_stage_id" name="stage_id">
						<?php $__currentLoopData = App\Entities\Category::leads()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option class="text-bold text-danger" value="<?php echo e($stage->id); ?>"
									<?php echo e($stage->id == $lead->stage_id ? ' selected' : ''); ?>><?php echo e(ucfirst($stage->name)); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
				</div>

				<div class="m-xs">
					<span class="text-muted"><?php echo trans('app.'.'source'); ?>:</span>
					<span class="text-bold"><?php echo e($lead->AsSource->name); ?></span>
				</div>

				<div class="m-xs">
					<span class="text-muted"><?php echo e(langapp('lead_age')); ?>:</span>
					<span class="text-bold"><?php echo e(dateElapsed($lead->created_at)); ?></span>
				</div>

				<div class="m-xs">
					<span class="text-muted"><?php echo e(langapp('lead_value')); ?>:</span>
					<span class="text-bold"><?php echo e($lead->computed_value); ?></span>
				</div>

				<div class="m-xs">
					<span class="text-muted"><?php echo trans('app.'.'next_followup'); ?>:</span>
					<span class="text-bold"><?php echo e(dateFormatted($lead->next_followup)); ?></span>
				</div>

				<div class="m-xs m-b-sm">
					<span class="text-muted" data-rel="tooltip" title="GDPR Privacy"><?php echo e(langapp('data_processing')); ?>

						:</span>
					<span class="text-bold text-danger"><?php echo e(is_null($lead->unsubscribed_at) ? '✔︎' : '✘'); ?>

						<?php if(!is_null($lead->unsubscribed_at)): ?>
							<a href="<?php echo e(route('leads.consent', ['lead' => $lead->id])); ?>" class="btn btn-xs btn-success"
							   data-rel="tooltip" title="Send Consent"><?php echo e(svg_image('solid/user-lock')); ?></a>
						<?php endif; ?>
					</span>
				</div>

				<div class="progress progress-xs progress-striped active">
					<div class="progress-bar progress-bar-success" data-toggle="tooltip"
						 data-original-title="<?php echo e($lead->score); ?>%" style="width:<?php echo e($lead->score); ?>%"></div>
				</div>

				<?php if($lead->sales_rep > 0): ?>

					<h4 class="font-thin"><?php echo trans('app.'.'sales_rep'); ?></h4>



					<div class="line"></div>

					<span class="thumb-sm avatar lobilist-check">
					<img src="<?php echo e($lead->agent->profile->photo); ?>" class="img-circle">
				</span> <strong><?php echo e($lead->agent->name); ?></strong>
				<?php endif; ?>


				<h4 class="font-thin">Lead Profile</h4>
				<div class="line"></div>

				<?php if(!empty($lead->name)): ?>
					<small class="text-uc text-xs text-muted"><?php echo trans('app.'.'name'); ?></small>
					<p><?php echo e($lead->name); ?></p>
				<?php endif; ?>

				<?php if(!empty($lead->email)): ?>
					<small class="text-uc text-xs text-muted"><?php echo trans('app.'.'email'); ?></small>
					<p><?php echo e($lead->email); ?></p>
				<?php endif; ?>
				<?php if(!empty($lead->mobile)): ?>
					<small class="text-uc text-xs text-muted"><?php echo trans('app.'.'mobile'); ?></small>
					<p><?php echo e($lead->mobile); ?></p>
				<?php endif; ?>

				<?php if(!empty($lead->phone)): ?>
					<small class="text-uc text-xs text-muted"><?php echo trans('app.'.'phone'); ?></small>
					<p><?php echo e(formatPhoneNumber($lead->phone)); ?></p>
				<?php endif; ?>

				
				
				
				

				<?php if(!empty($lead->timezone)): ?>
					<small class="text-uc text-xs text-muted"><?php echo trans('app.'.'timezone'); ?></small>
					<p><?php echo e($lead->timezone); ?></p>
				<?php endif; ?>

				<?php if(!empty($lead->address1)): ?>
					<small class="text-uc text-xs text-muted"><?php echo trans('app.'.'address'); ?> 1</small>
					<p><?php echo e($lead->address1); ?></p>
				<?php endif; ?>

				<?php if(!empty($lead->address2)): ?>
					<small class="text-uc text-xs text-muted"><?php echo trans('app.'.'address'); ?> 2</small>
					<p><?php echo e($lead->address2); ?></p>
				<?php endif; ?>

				<?php if(!empty($lead->city)): ?>
					<small class="text-uc text-xs text-muted"><?php echo trans('app.'.'city'); ?></small>
					<p><?php echo e($lead->city); ?></p>
				<?php endif; ?>

				<?php if(!empty($lead->zip_code)): ?>
					<small class="text-uc text-xs text-muted"><?php echo trans('app.'.'zipcode'); ?></small>
					<p><?php echo e($lead->zip_code); ?></p>
				<?php endif; ?>

				<?php if(!empty($lead->state)): ?>
					<small class="text-uc text-xs text-muted"><?php echo trans('app.'.'state'); ?></small>
					<p><?php echo e($lead->state); ?></p>
				<?php endif; ?>

				<?php if(!empty($lead->country)): ?>
					<small class="text-uc text-xs text-muted"><?php echo trans('app.'.'country'); ?></small>
					<p><?php echo e($lead->country); ?></p>
				<?php endif; ?>


				<div class="m-xs">
					<?php if(!empty($lead->skype)): ?>

						<a href="skype:<?php echo e($lead->skype); ?>?call" class="btn btn-rounded btn-info btn-icon shadowed">
							<?php echo e(svg_image('brands/skype')); ?></a>

					<?php endif; ?>

					<?php if(!empty($lead->twitter)): ?>
						<a href="<?php echo e($lead->twitter); ?>" target="_blank"
						   class="btn btn-rounded btn-twitter btn-icon shadowed">
							<?php echo e(svg_image('brands/twitter')); ?>
						</a>
					<?php endif; ?>

					<?php if(!empty($lead->facebook)): ?>
						<a href="<?php echo e($lead->facebook); ?>" target="_blank"
						   class="btn btn-rounded btn-info btn-icon shadowed">
							<?php echo e(svg_image('brands/facebook')); ?>
						</a>
					<?php endif; ?>

					<?php if(!empty($lead->linkedin)): ?>
						<a href="<?php echo e($lead->linkedin); ?>" target="_blank"
						   class="btn btn-rounded btn-primary btn-icon shadowed">
							<?php echo e(svg_image('brands/linkedin')); ?>
						</a>
					<?php endif; ?>

					<?php if(!empty($lead->website)): ?>
						<a href="<?php echo e($lead->website); ?>" target="_blank"
						   class="btn btn-rounded btn-danger btn-icon shadowed">
							<?php echo e(svg_image('solid/link')); ?>
						</a>
					<?php endif; ?>

				</div>

				
				
				
				

				
				


				<div class="line"></div>
				<small class="text-uc text-xs text-muted"><?php echo trans('app.'.'tags'); ?></small>
				<div class="m-xs">
					<?php
						$data['tags'] = $lead->tags;
					?>
					<?php echo $__env->make('partial.tags', $data, \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>

				<div class="line"></div>
				<small class="text-uc text-xs text-muted"><?php echo trans('app.'.'message'); ?></small>
				<div class="m-xs">
					<?php echo parsedown($lead->message); ?>
				</div>

			</section>
		</section>
		<section class="panel panel-default">
			<header class="panel-heading"><?php echo trans('app.'.'extras'); ?></header>
			<section class="panel-body">

				<?php $__currentLoopData = $lead->custom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if(App\Entities\CustomField::whereName($field->meta_key)->count() > 0): ?>

						<small class="text-uc text-xs text-muted"><?php echo e(ucfirst(humanize($field->meta_key, '-'))); ?></small>
						<p><?php echo e(isJson($field->meta_value) ? implode(', ', json_decode($field->meta_value)) : $field->meta_value); ?>

						</p>




					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</section>
		</section>
		<section class="panel panel-default">
			<header class="panel-heading"><?php echo trans('app.'.'activities'); ?></header>
			<div class="slim-scroll" data-color="#333333" data-disable-fade-out="true" data-distance="0"
				 data-height="500px" data-size="3px">
				<?php echo app('arrilot.widget')->run('Activities\Feed', ['activities' => $lead->activities]); ?>
			</div>
		</section>
	</div>

	<div class="col-lg-8">

		<?php
			$data = [
			'notes' => $lead->notes, 'noteable_type' => get_class($lead),
			'title' => $lead->name.' Note', 'noteable_id' => $lead->id
			];
		?>

		<?php echo app('arrilot.widget')->run('Notes\ShowNotes', $data); ?>


	</div>
	<!-- The Modal -->
	<div id="myModal" class="modal">

		<!-- Modal content -->
		<div class="modal-content">
			<span class="close">&times;</span>
			<div id="message-modal"></div>
		</div>

	</div>


</div>
<?php $__env->startPush('custom-pagescript'); ?>
	
	

	
	
	
	
	

	
	
	
	

	
	
	
	
	
	

	

<?php $__env->stopPush(); ?>
<?php $__env->startPush('pagescript'); ?>
	<script>
		var index = $('#custom_stage_id').prop('selectedIndex');
		var select = $('#custom_stage_id');

		var modal = $('#myModal');

		$('#custom_stage_id').on('change', function () {

			$('.close').on('click', function () {
				modal.css('display', 'none');

			});

			$('#message-modal').html(
				'<div> ' +
				'<p>Changing status to:'+$('#custom_stage_id option:selected').text()+ '</p>' +
				'<button id="yes" >Yes</button>' +
				'<button id="no" >No</button>' +
				'</div>'
			);
			modal.css('display', 'block');
			$('button#yes').click(function () {
				var lead_id = $('#lead-id').text();
				
				axios.patch('<?php echo e(route('leads.update-stage')); ?>', {lead_id: lead_id, stage_id: $('#custom_stage_id').val()})
					.then(function (response) {
						console.log('asf');
						modal.css('display', 'none');
					});
			});
			$('button#no').click(function () {

				$('#custom_stage_id').prop('selectedIndex', index);
				modal.css('display', 'none');
				return false;

			});

		});


	</script>
<?php $__env->stopPush(); ?>