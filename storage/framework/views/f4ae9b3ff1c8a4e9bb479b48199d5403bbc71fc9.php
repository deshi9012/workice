<aside class="b-l bg" id="">
    
    
    <section class="scrollable">
        <div class="slim-scroll" data-color="#333333" data-disable-fade-out="true" data-distance="0" data-height="auto" data-size="3px">
            <section class="padder">
                <div class="row m-l-none m-r-none m-sm">
                    <div class="col-sm-6 col-md-3 padder-v lt pallete b-b">
                        <a class="clear" href="<?php echo e(route('invoices.index')); ?>">
                            <span class="fa-stack fa-2x pull-left m-r-xs">
                                <i class="fas fa-square fa-stack-2x text-white"></i>
                                <i class="fas fa-exclamation-circle fa-stack-1x text-success"></i>
                            </span>
                            
                            <small class="text-uc" data-rel="tooltip" title="<?php echo trans('app.'.'outstanding'); ?>"><?php echo trans('app.'.'outstanding'); ?>  </small>
                            <span class="h4 block m-t-xs text-dark"><?php echo e(Auth::user()->profile->company > 0 ? formatCurrency(get_option('default_currency'), Auth::user()->profile->business->due()) : 'N/A'); ?></span>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-3 padder-v lt pallete b-b">
                        <a class="clear" href="<?php echo e(route('invoices.index')); ?>">
                            <span class="fa-stack fa-2x pull-left m-r-xs">
                                <i class="fas fa-square fa-stack-2x text-white"></i>
                                <i class="fas fa-calendar-times fa-stack-1x text-dracula"></i>
                            </span>
                            <small class="text-uc" data-rel="tooltip" title="<?php echo trans('app.'.'overdue'); ?>"><?php echo trans('app.'.'overdue'); ?> </small>
                            <span class="h4 block m-t-xs text-dark"><?php echo e(Auth::user()->profile->company > 0 ? formatCurrency(get_option('default_currency'), Auth::user()->profile->business->overdue()) : 'N/A'); ?></span>
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-3 padder-v pallete b-b">
                        <a class="clear" href="<?php echo e(route('tickets.index')); ?>">
                            <span class="fa-stack fa-2x pull-left m-r-xs">
                                <i class="fas fa-square fa-stack-2x text-white"></i>
                                <i class="fas fa-life-ring fa-stack-1x text-info"></i>
                            </span>
                            
                            <small class="text-uc" data-rel="tooltip" title="<?php echo trans('app.'.'tickets'); ?>"><?php echo trans('app.'.'tickets'); ?> </small>
                            <span class="h4 block m-t-xs text-dark"><span class="text-danger" data-rel="tooltip" title="Pending"><?php echo e(Auth::user()->tickets()->pending()->count()); ?></span> / <span class="text-success" data-rel="tooltip" title="Closed"><?php echo e(Auth::user()->tickets()->closed()->count()); ?></span></span> </a>
                        </div>
                        <div class="col-sm-6 col-md-3 padder-v pallete b-b">
                            <a class="clear" href="<?php echo e(route('creditnotes.index')); ?>">
                                <span class="fa-stack fa-2x pull-left m-r-xs">
                                    <i class="fas fa-square fa-stack-2x text-white"></i>
                                    <i class="fas fa-money-check fa-stack-1x text-danger"></i>
                                </span>
                                
                                <small class="text-uc" data-rel="tooltip" title="<?php echo trans('app.'.'credits'); ?> <?php echo trans('app.'.'balance'); ?>"><?php echo trans('app.'.'credits'); ?>   </small>
                                <span class="h4 block m-t-xs text-dark"><?php echo e(Auth::user()->profile->company > 0 ? formatCurrency(get_option('default_currency'), Auth::user()->profile->business->creditBalance()) : 'N/A'); ?></span>
                            </a>
                        </div>
                        
                    </div>

            <section class="panel panel-default">
                <header class="panel-heading"><?php echo trans('app.'.'outstanding'); ?> <?php echo trans('app.'.'invoices'); ?></header>
                <?php if(Auth::user()->profile->company > 0): ?>
                    
                <div class="table-responsive">
                  <table class="table table-striped b-t b-light">
                    <thead>
                      <tr>
                        <th class="th-sortable" data-toggle="class"><?php echo trans('app.'.'reference_no'); ?></th>
                        <th><?php echo trans('app.'.'payable'); ?></th>
                        <th><?php echo trans('app.'.'paid'); ?></th>
                        <th><?php echo trans('app.'.'balance'); ?></th>
                        <th><?php echo trans('app.'.'due_date'); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = Auth::user()->profile->business->invoices->take(15); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                            <td><a href="<?php echo e(route('invoices.view', $invoice->id)); ?>"><?php echo e($invoice->reference_no); ?></a></td>
                            <td><?php echo e(formatCurrency($invoice->currency, $invoice->payable())); ?></td>
                            <td><?php echo e(formatCurrency($invoice->currency, $invoice->paid())); ?></td>
                            <td><?php echo e(formatCurrency($invoice->currency, $invoice->due())); ?></td>
                            <td><?php echo e(dateTimeString($invoice->due_date)); ?></td>
                      </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      
                      
                    </tbody>
                  </table>
                </div>


                <?php endif; ?>
                
              </section>



              <section class="panel panel-default">
                <header class="panel-heading"><?php echo trans('app.'.'estimates'); ?></header>
                <?php if(Auth::user()->profile->company): ?>
                    
                <div class="table-responsive">
                  <table class="table table-striped b-t b-light">
                    <thead>
                      <tr>
                        <th class="th-sortable" data-toggle="class"><?php echo trans('app.'.'reference_no'); ?></th>
                        <th><?php echo trans('app.'.'sub_total'); ?></th>
                        <th><?php echo trans('app.'.'amount'); ?></th>
                        <th><?php echo trans('app.'.'due_date'); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = Auth::user()->profile->business->estimates->take(15); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estimate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                            <td><a href="<?php echo e(route('estimates.view', $estimate->id)); ?>"><?php echo e($estimate->reference_no); ?></a></td>
                            <td><?php echo e(formatCurrency($estimate->currency, $estimate->sub_total)); ?></td>
                            <td><?php echo e(formatCurrency($estimate->currency, $estimate->amount)); ?></td>
                            <td><?php echo e(dateTimeString($estimate->due_date)); ?></td>
                      </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      
                      
                    </tbody>
                  </table>
                </div>


                <?php endif; ?>
                
              </section>
                    

            <section class="panel panel-default">
                <header class="panel-heading"><?php echo trans('app.'.'projects'); ?></header>
                <?php if(Auth::user()->profile->company): ?>
                    
                <div class="table-responsive">
                  <table class="table table-striped b-t b-light">
                    <thead>
                      <tr>
                        <th class="th-sortable" data-toggle="class"><?php echo trans('app.'.'title'); ?></th>
                        <th><?php echo trans('app.'.'progress'); ?></th>
                        <th><?php echo trans('app.'.'expenses'); ?></th>
                        <th><?php echo trans('app.'.'due_date'); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = Auth::user()->profile->business->projects->take(15); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                            <td><a href="<?php echo e(route('projects.view', $project->id)); ?>"><?php echo e(str_limit($project->name,25)); ?></a></td>
                            <td><?php echo e($project->progress); ?>%</td>
                            <td><?php echo e(formatCurrency($project->currency, $project->total_expenses)); ?></td>
                            <td><?php echo e(dateTimeString($project->due_date)); ?></td>
                      </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      
                      
                    </tbody>
                  </table>
                </div>


                <?php endif; ?>
                
              </section>



              <section class="panel panel-default">
                <header class="panel-heading"><?php echo trans('app.'.'tickets'); ?></header>
                <?php if(Auth::user()->profile->company): ?>
                    
                <div class="table-responsive">
                  <table class="table table-striped b-t b-light">
                    <thead>
                      <tr>
                        <th class="th-sortable" data-toggle="class"><?php echo trans('app.'.'subject'); ?></th>
                        <th><?php echo trans('app.'.'department'); ?></th>
                        <th><?php echo trans('app.'.'status'); ?></th>
                        <th><?php echo trans('app.'.'due_date'); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = Auth::user()->tickets->take(15); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                            <td><a href="<?php echo e(route('tickets.view', $ticket->id)); ?>"><?php echo e(str_limit($ticket->subject, 25)); ?></a></td>
                            <td><?php echo e($ticket->dept->deptname); ?></td>
                            <td><?php echo e($ticket->AsStatus->status); ?></td>
                            <td><?php echo e(dateTimeString($ticket->due_date)); ?></td>
                      </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      
                      
                    </tbody>
                  </table>
                </div>


                <?php endif; ?>
                
              </section>
                    
                    
                    
                </section>





            </div>

        </section>
        
    </aside>
    <aside class="aside-lg b-l">
        <section class="vbox">
            
            <section class="scrollable" id="feeds">
                <div class="slim-scroll padder" data-color="#333333" data-disable-fade-out="true" data-distance="0" data-height="auto" data-size="3px">
                    
                    <?php echo app('arrilot.widget')->run('Activities\Feed', ['activities' => Modules\Activity\Entities\Activity::where('user_id', Auth::id())->take(50)->orderByDesc('id')->get(), 'view' => 'dashboard']); ?>
                    
                </div>
            </section>
            
        </section>
    </aside>