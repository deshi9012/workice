<div class="row">
    <div class="col-lg-12">

    
        <section class="panel panel-default">

            <?php echo Form::open(['route' => 'fields.module', 'class' => 'bs-example form-horizontal']); ?> 

            <header class="panel-heading">
                    <?php echo e(svg_image('solid/cogs')); ?> <?php echo trans('app.'.'settings'); ?>  
                    </header>
            <div class="panel-body">

    


                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo trans('app.'.'module'); ?> <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <div class="m-b">
                            <select name="module" class="form-control" required id="module">
                                <option value="clients"><?php echo trans('app.'.'clients'); ?></option>
                                <option value="tickets"><?php echo trans('app.'.'tickets'); ?></option>
                                <option value="deals"><?php echo trans('app.'.'deals'); ?></option>
                                <option value="leads"><?php echo trans('app.'.'leads'); ?></option>
                                <option value="invoices"><?php echo trans('app.'.'invoices'); ?></option>
                                <option value="estimates"><?php echo trans('app.'.'estimates'); ?></option>
                                <option value="expenses"><?php echo trans('app.'.'expenses'); ?></option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="select_department display-none">
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo trans('app.'.'department'); ?> <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <div class="m-b">
                                <select name="department" class="form-control">
                                    <option value="0">None</option>
                                    <?php $__currentLoopData = App\Entities\Department::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                        <option value="<?php echo e($d->deptid); ?>"><?php echo e($d->deptname); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="panel-footer">
                    <?php echo renderAjaxButton(); ?>

            </div>

<?php echo Form::close(); ?>


        </section>
        
    </div>
</div>
<?php $__env->startPush('pagescript'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#module").change(function () {
            $(this).find("option:selected").each(function () {
                if ($(this).attr("value") == "tickets") {
                    $(".select_department").show();
                }
                else {
                    $(".select_department").hide();
                }
            });
        }).change();
    });
</script>
<?php $__env->stopPush(); ?>

