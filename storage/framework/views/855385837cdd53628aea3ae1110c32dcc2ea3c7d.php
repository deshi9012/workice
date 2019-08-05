<?php $__env->startSection('content'); ?>
<section id="content">
    <section class="hbox stretch">
        <aside>
            <section class="vbox">
                <section class="scrollable wrapper bg">
                    <section class="panel panel-default">
                        <header class="panel-heading">
                            <?php echo $__env->make('analytics::report_header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </header>
                        <div class="panel-body">
                            <?php
                            $start_date = date('F d, Y', strtotime($range[0]));
                            $end_date = date('F d, Y', strtotime($range[1]));
                            ?>
                            <section class="panel panel-default">
                            <header class="panel-heading"><?php echo trans('app.'.'invoices_reports'); ?></header>
                            <div class="row wrapper analytics">
                                <div class="col-sm-12 m-b-xs">
                                    <form>
                                        <div class="inline v-middle col-md-4">
                                            <label><?php echo trans('app.'.'date_range'); ?></label>
                                            <input type="text" class="form-control" id="reportrange" name="range">
                                        </div>
                                        <div class="inline v-middle">
                                            <label><?php echo trans('app.'.'client'); ?></label>
                                            <select class="form-control input-s-sm" name="client" id="filter-client">
                                                <option value="-">-</option>
                                                <?php $__currentLoopData = Modules\Invoices\Entities\Invoice::select('id', 'client_id')->groupBy('client_id')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($invoice->client_id); ?>"><?php echo e(optional($invoice->company)->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="inline v-middle">
                                            <label><?php echo trans('app.'.'recurring'); ?></label>
                                            <select class="form-control input-s-sm" name="recurring" id="filter-recurring">
                                                <option value="-">-</option>
                                                <option value="0"><?php echo trans('app.'.'no'); ?> </option>
                                                <option value="1"><?php echo trans('app.'.'yes'); ?> </option>
                                            </select>
                                        </div>
                                        
                                        <div class="inline v-middle">
                                            <label><?php echo trans('app.'.'status'); ?></label>
                                            <select class="form-control input-s-sm" name="status" id="filter-status">
                                                <option value="-">-</option>
                                                <option value="not_paid" selected><?php echo trans('app.'.'not_paid'); ?> </option>
                                                <option value="partially_paid"><?php echo trans('app.'.'partially_paid'); ?></option>
                                                <option value="fully_paid"><?php echo trans('app.'.'paid'); ?> </option>
                                                <option value="cancelled"><?php echo trans('app.'.'cancelled'); ?> </option>
                                                <option value="overdue"><?php echo trans('app.'.'overdue'); ?> </option>
                                            </select>
                                        </div>
                                        <div class="inline v-middle">
                                            <label><?php echo trans('app.'.'sent'); ?></label>
                                            <select class="form-control input-s-sm" name="sent" id="filter-sent">
                                                <option value="-">-</option>
                                                <option value="0"><?php echo trans('app.'.'no'); ?> </option>
                                                <option value="1"><?php echo trans('app.'.'yes'); ?> </option>
                                                
                                            </select>
                                        </div>
                                        
                                        
                                    </form>
                                </div>
                            </div>
                            
                            <div id="ajaxData"></div>
                            
                            
                            
                        </section>
                    </div>
                </section>
            </section>
        </section>
    </aside>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
<?php $__env->startPush('pagescript'); ?>
<?php echo $__env->make('analytics::_daterangepicker', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <script type="text/javascript">
    $('#reportrange, #filter-client, #filter-recurring, #filter-status, #filter-sent').change(function(event) {
        loadData(event);
    }).change();

    function loadData(val) {
            axios.post('<?php echo e(route('reports.invoices.filter')); ?>', {
                range: $('#reportrange').val(),
                client: $('#filter-client').val(),
                recurring: $('#filter-recurring').val(),
                status: $('#filter-status').val(),
                sent: $('#filter-sent').val(),
            })
            .then(function (response) {
                    $('#ajaxData').html(response.data.html);
            })
            .catch(function (error) {
                var errors = error.response.data.errors;
                var errorsHtml= '';
                $.each( errors, function( key, value ) {
                errorsHtml += '<li>' + value[0] + '</li>';
                });
                toastr.error( errorsHtml , '<?php echo trans('app.'.'response_status'); ?> ');
        });
}

    </script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>