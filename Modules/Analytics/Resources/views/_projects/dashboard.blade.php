<div class="row">

        <div class="col-sm-4">
    
    
    
    
    
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('active') </span>
                        <small class="block text-danger pull-right m-l text-bold">
                            {{ getCalculated('projects_active') }}
                        </small>
                    </div>
                </div>
            </section>
    
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('done') </span>
                        <small class="block text-success pull-right m-l text-bold">
                                {{ getCalculated('projects_done') }}
                        </small>
                    </div>
                </div>
            </section>
    
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">Avg. @langapp('used_budget') </span>
                        <small class="block text-primary pull-right m-l text-bold">
                                {{ percent(getCalculated('projects_average_budget')) }}%
                        </small>
                    </div>
                </div>
            </section>
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">Avg. @langapp('billable') </span>
                        <small class="block text-bold pull-right m-l text-bold">
                            {{ secToHours(getCalculated('projects_average_billable')) }}
    
                        </small>
                    </div>
                </div>
            </section>
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">Avg. @langapp('expenses') </span>
                        <small class="block text-primary pull-right m-l text-bold">
                            @metrics('projects_average_expenses')
    
                        </small>
                    </div>
                </div>
            </section>
    
    
    
    
        </div>
    
    
        <div class="col-md-8 b-top">
    
                @widget('Projects\TaskProjectChart')
    
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
                    $janProjects = getCalculated('projects_done_1_'.$year); 
                    $febProjects = getCalculated('projects_done_2_'.$year); 
                    $marProjects = getCalculated('projects_done_3_'.$year);
                    $semOne = array($janProjects, $febProjects, $marProjects); 
                    @endphp
                    <div class="clearfix m-b-md small">{{ langdate('cal_january') }}
                        <div class="pull-right text-bold">
                            {{ $janProjects }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_february') }}
                        <div class="pull-right text-bold">
                            {{ $febProjects }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_march') }}
                        <div class="pull-right text-bold">
                            {{ $marProjects }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-dark">
                            <strong>
                                {{ array_sum($semOne) }} @langapp('projects')
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
                    $aprProjects = getCalculated('projects_done_4_'.$year); 
                    $mayProjects = getCalculated('projects_done_5_'.$year); 
                    $junProjects = getCalculated('projects_done_6_'.$year);
                    $semTwo = array($aprProjects, $mayProjects, $junProjects); 
                    @endphp
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_april') }}
                        <div class="pull-right text-bold">
                            {{ $aprProjects }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_may') }}
                        <div class="pull-right text-bold">
                            {{ $mayProjects }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_june') }}
                        <div class="pull-right text-bold">
                            {{ $junProjects }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-dark">
                            <strong>
                                {{ array_sum($semTwo) }} @langapp('projects')
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
                    $julProjects = getCalculated('projects_done_7_'.$year); 
                    $augProjects = getCalculated('projects_done_8_'.$year); 
                    $sepProjects = getCalculated('projects_done_9_'.$year);
                    $semThree = array($julProjects, $augProjects, $sepProjects); 
                    @endphp
                    <div class="clearfix m-b-md small">{{ langdate('cal_july') }}
                        <div class="pull-right text-bold">
                            {{ $julProjects }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_august') }}
                        <div class="pull-right text-bold">
                            {{ $augProjects }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_september') }}
                        <div class="pull-right text-bold">
                            {{ $sepProjects }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-dark">
                            <strong>
                                {{ array_sum($semThree) }} @langapp('projects')
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
                    $octProjects = getCalculated('projects_done_10_'.$year); 
                    $novProjects = getCalculated('projects_done_11_'.$year); 
                    $decProjects = getCalculated('projects_done_12_'.$year);
                    $semFour = array($octProjects, $novProjects, $decProjects); 
                    @endphp
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_october') }}
                        <div class="pull-right text-bold">
                            {{ $octProjects }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_november') }}
                        <div class="pull-right text-bold">
                            {{ $novProjects }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_december') }}
                        <div class="pull-right text-bold">
                            {{ $decProjects }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-dark">
                            <strong>
                                {{ array_sum($semFour) }} @langapp('projects')
                            </strong>
                        </div>
                    </div>
    
                </div>
                
            </div>
            
        </div>
        
    
    </div>