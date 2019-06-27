<div class="row">

        <div class="col-sm-4">
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('active') </span>
                        <small class="block text-danger pull-right m-l text-bold">
                            {{ getCalculated('tasks_active') }}
                        </small>
                    </div>
                </div>
            </section>
    
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('done') </span>
                        <small class="block text-success pull-right m-l text-bold">
                                {{ getCalculated('tasks_done') }}
                        </small>
                    </div>
                </div>
            </section>
    
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('overdue') </span>
                        <small class="block text-danger pull-right m-l text-bold">
                                {{ getCalculated('tasks_overdue') }}
                        </small>
                    </div>
                </div>
            </section>
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">Avg. @langapp('progress') </span>
                        <small class="block text-muted pull-right m-l text-bold">
                            {{ percent(getCalculated('tasks_average_progress')) }}%
                        </small>
                    </div>
                </div>
            </section>

            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">Avg. @langapp('time_spent') </span>
                        <small class="block text-muted pull-right m-l text-bold">
                            {{ secToHours(getCalculated('tasks_average_time')) }}
                        </small>
                    </div>
                </div>
            </section>
    
    
    
    
        </div>
    
    
        <div class="col-md-8 b-top">
    
                @widget('Tasks\YearlyOverview')
    
        </div>
    
    </div>
    
    
    <div class="row b-t">
    
    
        <div class="col-md-3 col-sm-6">
            <div class="widget">
                <header class="widget-header">
                    <h4 class="widget-title">1st @langapp('quarter') , {{ $year }}</h4>
                </header>
                
                <hr class="widget-separator">
                <div class="widget-body p-t-lg">
                    @php 
                    $janTasks = getCalculated('tasks_done_1_'.$year); 
                    $febTasks = getCalculated('tasks_done_2_'.$year); 
                    $marTasks = getCalculated('tasks_done_3_'.$year);
                    $semOne = array($janTasks, $febTasks, $marTasks); 
                    @endphp
                    <div class="clearfix m-b-md small">{{ langdate('cal_january') }}
                        <div class="pull-right text-bold">
                            {{ $janTasks }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_february') }}
                        <div class="pull-right text-bold">
                            {{ $febTasks }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_march') }}
                        <div class="pull-right text-bold">
                            {{ $marTasks }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-dark">
                            <strong>
                                {{ array_sum($semOne) }} @langapp('tasks')
                            </strong>
                        </div>
                    </div>
    
                </div>
               
            </div>
            
        </div>
    
        
        <div class="col-md-3 col-sm-6">
            <div class="widget">
                <header class="widget-header">
                    <h4 class="widget-title">2nd @langapp('quarter') , {{ $year }}</h4>
                </header>
                
                <hr class="widget-separator">
                <div class="widget-body p-t-lg">
                    @php 
                    $aprTasks = getCalculated('tasks_done_4_'.$year); 
                    $mayTasks = getCalculated('tasks_done_5_'.$year); 
                    $junTasks = getCalculated('tasks_done_6_'.$year);
                    $semTwo = array($aprTasks, $mayTasks, $junTasks); 
                    @endphp
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_april') }}
                        <div class="pull-right text-bold">
                            {{ $aprTasks }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_may') }}
                        <div class="pull-right text-bold">
                            {{ $mayTasks }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_june') }}
                        <div class="pull-right text-bold">
                            {{ $junTasks }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-bold">
                            <strong>
                                {{ array_sum($semTwo) }} @langapp('tasks')
                            </strong>
                        </div>
                    </div>
    
                </div>
                
            </div>
            
        </div>
    
        
    
        <div class="col-md-3 col-sm-6">
            <div class="widget">
                <header class="widget-header">
                    <h4 class="widget-title">3rd @langapp('quarter') , {{ $year }}</h4>
                </header>
                
                <hr class="widget-separator">
                <div class="widget-body p-t-lg">
                    @php 
                    $julTasks = getCalculated('tasks_done_7_'.$year); 
                    $augTasks = getCalculated('tasks_done_8_'.$year); 
                    $sepTasks = getCalculated('tasks_done_9_'.$year);
                    $semThree = array($julTasks, $augTasks, $sepTasks); 
                    @endphp
                    <div class="clearfix m-b-md small">{{ langdate('cal_july') }}
                        <div class="pull-right text-bold">
                            {{ $julTasks }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_august') }}
                        <div class="pull-right text-bold">
                            {{ $augTasks }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_september') }}
                        <div class="pull-right text-bold">
                            {{ $sepTasks }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-dark">
                            <strong>
                                {{ array_sum($semThree) }} @langapp('tasks')
                            </strong>
                        </div>
                    </div>
    
                </div>
                
            </div>
            
        </div>
        
    
        <div class="col-md-3 col-sm-6">
            <div class="widget">
                <header class="widget-header">
                    <h4 class="widget-title">4th @langapp('quarter') , {{ $year }}</h4>
                </header>
                
                <hr class="widget-separator">
                <div class="widget-body p-t-lg">
                    @php 
                    $octTasks = getCalculated('tasks_done_10_'.$year); 
                    $novTasks = getCalculated('tasks_done_11_'.$year); 
                    $decTasks = getCalculated('tasks_done_12_'.$year);
                    $semFour = array($octTasks, $novTasks, $decTasks); 
                    @endphp
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_october') }}
                        <div class="pull-right text-bold">
                            {{ $octTasks }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_november') }}
                        <div class="pull-right text-bold">
                            {{ $novTasks }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_december') }}
                        <div class="pull-right text-bold">
                            {{ $decTasks }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-dark">
                            <strong>
                                {{ array_sum($semFour) }} @langapp('tasks')
                            </strong>
                        </div>
                    </div>
    
                </div>
                
            </div>
            
        </div>
        
    
    </div>