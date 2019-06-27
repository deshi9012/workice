<div class="row">

        <div class="col-sm-4">
    
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('billable') </span>
                        <small class="block text-danger pull-right m-l text-bold">
                            {{ secToHours(getCalculated('time_billable')) }}
                        </small>
                    </div>
                </div>
            </section>
    
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('unbillable') </span>
                        <small class="block text-success pull-right m-l text-bold">
                                {{ secToHours(getCalculated('time_unbillable')) }}
                        </small>
                    </div>
                </div>
            </section>
    
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('billed') </span>
                        <small class="block text-danger pull-right m-l text-bold">
                                {{ secToHours(getCalculated('time_billed')) }}
                        </small>
                    </div>
                </div>
            </section>
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('unbilled') </span>
                        <small class="block text-muted pull-right m-l text-bold">
                            {{ secToHours(getCalculated('time_unbilled')) }}
                        </small>
                    </div>
                </div>
            </section>

            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('total_time') </span>
                        <small class="block text-muted pull-right m-l text-bold">
                            {{ secToHours(getCalculated('time_worked')) }}
                        </small>
                    </div>
                </div>
            </section>
    
    
    
    
        </div>
    
    
        <div class="col-md-8 b-top">
    
                @widget('Timetracking\YearlyOverview')
    
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
                    $janEntries = getCalculated('time_worked_1_'.$year); 
                    $febEntries = getCalculated('time_worked_2_'.$year); 
                    $marEntries = getCalculated('time_worked_3_'.$year);
                    $semOne = array($janEntries, $febEntries, $marEntries); 
                    @endphp
                    <div class="clearfix m-b-md small">{{ langdate('cal_january') }}
                        <div class="pull-right text-bold">
                            {{ $janEntries }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_february') }}
                        <div class="pull-right text-bold">
                            {{ $febEntries }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_march') }}
                        <div class="pull-right text-bold">
                            {{ $marEntries }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-bold">
                                {{ secToHours(array_sum($semOne)) }}
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
                    $aprEntries = getCalculated('time_worked_4_'.$year); 
                    $mayEntries = getCalculated('time_worked_5_'.$year); 
                    $junEntries = getCalculated('time_worked_6_'.$year);
                    $semTwo = array($aprEntries, $mayEntries, $junEntries); 
                    @endphp
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_april') }}
                        <div class="pull-right text-bold">
                            {{ secToHours($aprEntries) }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_may') }}
                        <div class="pull-right text-bold">
                            {{ secToHours($mayEntries) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_june') }}
                        <div class="pull-right text-bold">
                            {{ secToHours($junEntries) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-bold">
                                {{ secToHours(array_sum($semTwo)) }}
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
                    $julEntries = getCalculated('time_worked_7_'.$year); 
                    $augEntries = getCalculated('time_worked_8_'.$year); 
                    $sepEntries = getCalculated('time_worked_9_'.$year);
                    $semThree = array($julEntries, $augEntries, $sepEntries); 
                    @endphp
                    <div class="clearfix m-b-md small">{{ langdate('cal_july') }}
                        <div class="pull-right text-bold">
                            {{ secToHours($julEntries) }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_august') }}
                        <div class="pull-right text-bold">
                            {{ secToHours($augEntries) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_september') }}
                        <div class="pull-right text-bold">
                            {{ secToHours($sepEntries) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-bold">
                                {{ secToHours(array_sum($semThree)) }}
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
                    $octEntries = getCalculated('time_worked_10_'.$year); 
                    $novEntries = getCalculated('time_worked_11_'.$year); 
                    $decEntries = getCalculated('time_worked_12_'.$year);
                    $semFour = array($octEntries, $novEntries, $decEntries); 
                    @endphp
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_october') }}
                        <div class="pull-right text-bold">
                            {{ secToHours($octEntries) }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_november') }}
                        <div class="pull-right text-bold">
                            {{ secToHours($novEntries) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_december') }}
                        <div class="pull-right text-bold">
                            {{ secToHours($decEntries) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-bold">
                                {{ secToHours(array_sum($semFour)) }}
                        </div>
                    </div>
    
                </div>
                
            </div>
            
        </div>
        
    
    </div>