<div class="row">

	<div class="col-sm-4">


		<section class="panel panel-info">
			<div class="panel-body">
				<div class="clear">
					<span class="text-dark"><?php echo trans('app.'.'total_sales'); ?> </span>
					<small class="block pull-right m-l text-bold">
						<?php echo metrics('invoiced_total'); ?>
					</small>
				</div>
			</div>
		</section>

		<section class="panel panel-info">
				<div class="panel-body">
					<div class="clear">
						<span class="text-dark"><?php echo trans('app.'.'outstanding'); ?> </span>
						<small class="block pull-right m-l text-bold">
							<?php echo metrics('outstanding_balance'); ?>
						</small>
					</div>
				</div>
			</section>


		<section class="panel panel-info">
			<div class="panel-body">
				<div class="clear">
					<span class="text-dark"><?php echo trans('app.'.'this_year'); ?> </span>
					<small class="block text-success pull-right m-l text-bold">
							<?php echo metrics('invoiced_year_'.$year); ?>
					</small>
				</div>
			</div>
		</section>


		<section class="panel panel-info">
			<div class="panel-body">
				<div class="clear">
					<span class="text-dark"><?php echo trans('app.'.'this_month'); ?> </span>
					<small class="block text-success pull-right m-l text-bold">
							<?php echo metrics('invoiced_this_month'); ?>
					</small>
				</div>
			</div>
		</section>

		<section class="panel panel-info">
			<div class="panel-body">
				<div class="clear">
					<span class="text-dark"><?php echo trans('app.'.'last_month'); ?> </span>
					<small class="block text-danger pull-right m-l text-bold">
						<?php echo metrics('invoiced_last_month'); ?>
					</small>
				</div>
			</div>
		</section>




	</div>


	<div class="col-md-8 b-top">

		<?php echo app('arrilot.widget')->run('Invoices\InvoicingChart'); ?>

	</div>

</div>


<div class="row b-t">


	<div class="col-md-3 col-sm-6">
		<div class="widget">
			<header class="widget-header">
				<h4 class="widget-title">1st <?php echo trans('app.'.'quarter'); ?> , <?php echo e($year); ?></h4>
			</header>
			<hr class="widget-separator">
			<div class="widget-body p-t-lg">
				<?php 
				$janSales = getCalculated('invoiced_1_'.$year); 
				$febSales = getCalculated('invoiced_2_'.$year); 
				$marSales = getCalculated('invoiced_3_'.$year);
				$semOne = array($janSales, $febSales, $marSales); ?>
				<div class="clearfix m-b-md small"><?php echo e(langdate('cal_january')); ?>

					<div class="pull-right text-bold">
						<?php echo e(formatCurrency(get_option('default_currency'), $janSales)); ?></div>
				</div>

				<div class="clearfix m-b-md small"><?php echo e(langdate('cal_february')); ?>

					<div class="pull-right text-bold">
						<?php echo e(formatCurrency(get_option('default_currency'), $febSales)); ?>

					</div>
				</div>

				<div class="clearfix m-b-md small"><?php echo e(langdate('cal_march')); ?>

					<div class="pull-right text-bold">
						<?php echo e(formatCurrency(get_option('default_currency'), $marSales)); ?>

					</div>
				</div>

				<div class="clearfix m-b-md small">
					<div class="pull-right text-bold">
						<?php echo e(formatCurrency(get_option('default_currency'), array_sum($semOne))); ?>

					</div>
				</div>

			</div>
		</div>
	</div>

	
	<div class="col-md-3 col-sm-6">
		<div class="widget">
			<header class="widget-header">
				<h4 class="widget-title">2nd <?php echo trans('app.'.'quarter'); ?> , <?php echo e($year); ?></h4>
			</header>
			<hr class="widget-separator">
			<div class="widget-body p-t-lg">
				<?php 
				$aprSales = getCalculated('invoiced_4_'.$year); 
				$maySales = getCalculated('invoiced_5_'.$year); 
				$junSales = getCalculated('invoiced_6_'.$year);
				$semTwo = array($aprSales, $maySales, $junSales); 
				?>

				<div class="clearfix m-b-md small"><?php echo e(langdate('cal_april')); ?>

					<div class="pull-right text-bold">
						<?php echo e(formatCurrency(get_option('default_currency'), $aprSales)); ?></div>
				</div>

				<div class="clearfix m-b-md small"><?php echo e(langdate('cal_may')); ?>

					<div class="pull-right text-bold">
						<?php echo e(formatCurrency(get_option('default_currency'), $maySales)); ?>

					</div>
				</div>

				<div class="clearfix m-b-md small"><?php echo e(langdate('cal_june')); ?>

					<div class="pull-right text-bold">
						<?php echo e(formatCurrency(get_option('default_currency'), $junSales)); ?>

					</div>
				</div>

				<div class="clearfix m-b-md small">
					<div class="pull-right text-bold">
							<?php echo e(formatCurrency(get_option('default_currency'), array_sum($semTwo))); ?>

					</div>
				</div>

			</div>
		</div>
	</div>

	

	<div class="col-md-3 col-sm-6">
		<div class="widget">
			<header class="widget-header">
				<h4 class="widget-title">3rd <?php echo trans('app.'.'quarter'); ?> , <?php echo e($year); ?></h4>
			</header>
			<hr class="widget-separator">
			<div class="widget-body p-t-lg">
				<?php 
				$julSales = getCalculated('invoiced_7_'.$year); 
				$augSales = getCalculated('invoiced_8_'.$year); 
				$sepSales = getCalculated('invoiced_9_'.$year);
				$semThree = array($julSales, $augSales, $sepSales); 
				?>
				<div class="clearfix m-b-md small"><?php echo e(langdate('cal_july')); ?>

					<div class="pull-right text-bold">
						<?php echo e(formatCurrency(get_option('default_currency'), $julSales)); ?></div>
				</div>

				<div class="clearfix m-b-md small"><?php echo e(langdate('cal_august')); ?>

					<div class="pull-right text-bold">
						<?php echo e(formatCurrency(get_option('default_currency'), $augSales)); ?>

					</div>
				</div>

				<div class="clearfix m-b-md small"><?php echo e(langdate('cal_september')); ?>

					<div class="pull-right text-bold">
						<?php echo e(formatCurrency(get_option('default_currency'), $sepSales)); ?>

					</div>
				</div>

				<div class="clearfix m-b-md small">
					<div class="pull-right text-bold">
						<?php echo e(formatCurrency(get_option('default_currency'), array_sum($semThree))); ?>

					</div>
				</div>

			</div>
		</div>
	</div>
	

	<div class="col-md-3 col-sm-6">
		<div class="widget">
			<header class="widget-header">
				<h4 class="widget-title">4th <?php echo trans('app.'.'quarter'); ?> , <?php echo e($year); ?></h4>
			</header>
			<hr class="widget-separator">
			<div class="widget-body p-t-lg">
				<?php 
				$octSales = getCalculated('invoiced_10_'.$year); 
				$novSales = getCalculated('invoiced_11_'.$year); 
				$decSales = getCalculated('invoiced_12_'.$year);
				$semFour = array($octSales, $novSales, $decSales); 
				?>

				<div class="clearfix m-b-md small"><?php echo e(langdate('cal_october')); ?>

					<div class="pull-right text-bold">
						<?php echo e(formatCurrency(get_option('default_currency'), $octSales)); ?></div>
				</div>

				<div class="clearfix m-b-md small"><?php echo e(langdate('cal_november')); ?>

					<div class="pull-right text-bold">
						<?php echo e(formatCurrency(get_option('default_currency'), $novSales)); ?>

					</div>
				</div>

				<div class="clearfix m-b-md small"><?php echo e(langdate('cal_december')); ?>

					<div class="pull-right text-bold">
						<?php echo e(formatCurrency(get_option('default_currency'), $decSales)); ?>

					</div>
				</div>

				<div class="clearfix m-b-md small">
					<div class="pull-right text-bold">
						<?php echo e(formatCurrency(get_option('default_currency'), array_sum($semFour))); ?>

					</div>
				</div>

			</div>
		</div>
	</div>
	

</div>
