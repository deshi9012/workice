<?php $__env->startSection('content'); ?>
<section id="content">
    <section class="hbox stretch">
        <aside>
            <section class="vbox">
                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-12 m-b-xs">
                            <p class="h3">Oauth Settings</p>
                        </div>
                        
                    </div>
                </header>
                <section class="scrollable wrapper bg">


            <div class="panel-group m-b" id="accordion2">
                    
                    <ul class="list no-style" id="responses-list">

                    <li class="panel panel-default" id="tokenize">
                      <div class="panel-heading">
                        <a class="accordion-toggle subject text-info" data-toggle="collapse" data-parent="#accordion2" href="#token-1">
                         <?php echo e(svg_image('solid/shield-alt')); ?> Show Access Token
                        </a>
                        <a href="<?php echo e(route('oauth.refresh.token')); ?>" class="pull-right text-muted m-l-xs" data-toggle="ajaxModal" data-rel="tooltip" title="Create New Access token" data-placement="left"><?php echo e(svg_image('solid/sync-alt')); ?></a>
                      </div>
                      <div id="token-1" class="panel-collapse collapse">
                        <div class="panel-body message">
                          <pre><code class="text-danger"><?php echo e(Auth::user()->access_token); ?></code></pre>
                        </div>
                      </div>

                      </li>
                    

                    </ul>
                    
                    
                    
                    
                  </div>

            

            <section class="panel panel-default">
                <header class="panel-heading">OAUTH Clients
                    <a href="<?php echo e(route('oauth.create.client')); ?>" class="btn btn-xs btn-info pull-right" data-toggle="ajaxModal">Create Client</a>
                </header>
                <div class="table-responsive">
                  <table class="table table-striped b-t b-light" id="oauth-clients">
                    
                      <tr>
                        <th class="th-sortable">Name</th>
                        <th>Client ID</th>
                        <th>Secret</th>
                        <th>Redirect</th>
                        <th></th>
                        <th></th>
                      </tr>
                  </table>
                </div>
              </section>



                    
                    
                </section>
            </section>
        </aside>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>



    <?php $__env->startPush('pagescript'); ?>
    <script>
        axios.get('/oauth/clients').then(function (response) {
                var clients = '';
                $.each(response.data, function (key, value){
                    clients += '<tr>';
                    clients += '<td>'+value.name+'</td>';
                    clients += '<td class="text-danger">'+value.id+'</td>';
                    clients += '<td class="text-danger">'+value.secret+'</td>';
                    clients += '<td class="text-info">'+value.redirect+'</td>';
                    clients += '<td><a href="/users/oauth/edit-client/'+value.id+'" data-toggle="ajaxModal" data-rel="tooltip" title="<?php echo trans('app.'.'make_changes'); ?>"><i class="fas fa-pencil-alt"></i></a></td>';
                    clients += '<td><a href="/users/oauth/delete-client/'+value.id+'" data-toggle="ajaxModal" data-rel="tooltip" title="<?php echo trans('app.'.'delete'); ?>"><i class="fas fa-trash-alt"></i></a></td>';
                    clients += '</tr>';
                });
                $('#oauth-clients').append(clients);
                $('[data-rel="tooltip"]').tooltip(); 
            })
            .catch(function (error) {
                toastr.error( 'Error performing ajax request' , '<?php echo trans('app.'.'response_status'); ?> ');
            }); 

    </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>