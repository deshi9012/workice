<?php $__env->startSection('content'); ?>
<section id="content" class="bg">
    
    <section class="vbox">
        <header class="header bg-white b-b b-light">

            

            <div class="btn-group">
                <button class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm dropdown-toggle"
                data-toggle="dropdown"> <?php echo trans('app.'.'filter'); ?>
                <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo e(route('clients.index', ['filter' => 'balance'])); ?>">
                        <?php echo trans('app.'.'outstanding'); ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('clients.index', ['filter' => 'expenses'])); ?>">
                    <?php echo trans('app.'.'expenses'); ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('clients.index', ['filter' => 'prospects'])); ?>">
                    <?php echo trans('app.'.'prospects'); ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('clients.index', ['filter' => 'customers'])); ?>">
                    <?php echo trans('app.'.'customers'); ?>
                    </a>
                </li>
            <li><a href="<?php echo e(route('clients.index')); ?>"><?php echo trans('app.'.'all'); ?> </a></li>
        </ul>
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clients_create')): ?>

    <a href="<?php echo e(route('clients.create')); ?>"
        class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm btn-responsive" data-toggle="ajaxModal"
        title="<?php echo trans('app.'.'create'); ?> " data-placement="bottom">
        <?php echo e(svg_image('solid/plus')); ?> <?php echo trans('app.'.'create'); ?>
    </a>
    
    <a href="<?php echo e(route('clients.import')); ?>" class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm btn-responsive" title="<?php echo trans('app.'.'import_clients'); ?> " data-placement="bottom" data-toggle="ajaxModal">
        <?php echo e(svg_image('solid/cloud-upload-alt')); ?> <?php echo trans('app.'.'import'); ?>
    </a>
    <a href="<?php echo e(route('clients.export')); ?>"
        class="btn btn-<?php echo e(get_option('theme_color')); ?> btn-sm btn-responsive" title="CSV" data-placement="bottom">
        <?php echo e(svg_image('solid/cloud-download-alt')); ?> CSV
    </a>
    
    <?php endif; ?>



    


</header>
<section class="scrollable wrapper">
            <section class="panel panel-default">
                <form id="frm-client" method="POST">
                    <div class="table-responsive">
                    <table class="table table-striped" id="clients-table">
                        <thead>
                            <tr>
                                <th class="hide"></th>
                                <th class="no-sort">
                                    <label>
                                        <input name="select_all" value="1" id="select-all" type="checkbox" />
                                        <span class="label-text"></span>
                                    </label>
                                </th>
                                <th><?php echo trans('app.'.'name'); ?></th>
                                <th class="col-currency"><?php echo trans('app.'.'balance'); ?> </th>
                                <th class="col-currency"><?php echo trans('app.'.'expenses'); ?> </th>
                                <th><?php echo trans('app.'.'contact_person'); ?> </th>
                                <th><?php echo trans('app.'.'email'); ?> </th>
                            </tr>
                        </thead>
                    </table>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('clients_delete')): ?>
                    <button type="submit" id="button" class="btn btn-sm btn-<?php echo e(get_option('theme_color')); ?> m-xs" value="bulk-delete">
                    <span class=""><?php echo e(svg_image('solid/trash-alt')); ?> <?php echo trans('app.'.'delete'); ?></span>
                    </button>
                    <?php endif; ?>

                    </div>
                </form>
            </section>
</section>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>
<?php $__env->startPush('pagestyle'); ?>
<?php echo $__env->make('stacks.css.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('pagescript'); ?>
<?php echo $__env->make('stacks.js.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
$(function() {
var table = $('#clients-table').DataTable({
processing: true,
serverSide: true,
ajax: {
url: '<?php echo route('clients.data'); ?>',
data: {
"filter": '<?php echo e($filter); ?>',
}
},
order: [[ 0, "desc" ]],
columns: [
{ data: 'id', name: 'id', searchable: false },
{ data: 'chk', name: 'chk', searchable: false, orderable:false },
{ data: 'name', name: 'name', searchable: true },
{ data: 'outstanding', name: 'balance' },
{ data: 'expense_cost', name: 'expense' },
{ data: 'contact_person', name: 'contact_person', orderable:false, searchable: false },
{ data: 'email', name: 'email' }
]
});
$("#frm-client button").click(function(ev){
ev.preventDefault();
if($(this).attr("value")=="bulk-delete"){
var form = $("#frm-client").serialize();
axios.post('<?php echo e(route('clients.bulk.delete')); ?>', form)
.then(function (response) {
    toastr.warning(response.data.message, '<?php echo trans('app.'.'response_status'); ?> ');
    window.location.href = response.data.redirect;
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


});
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>