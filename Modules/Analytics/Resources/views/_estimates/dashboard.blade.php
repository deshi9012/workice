<div class="row">

        <div class="col-sm-4">
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('accepted') </span>
                        <small class="block pull-right m-l text-bold">
                            @metrics('estimates_accepted')
                        </small>
                    </div>
                </div>
            </section>
    
            <section class="panel panel-info">
                    <div class="panel-body">
                        <div class="clear">
                            <span class="text-dark">@langapp('declined') </span>
                            <small class="block text-danger pull-right m-l text-bold">
                                @metrics('estimates_rejected')
                            </small>
                        </div>
                    </div>
                </section>
        
        <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('this_month') </span>
                        <small class="block text-success pull-right m-l text-bold">
                                @metrics('estimates_this_month')
                        </small>
                    </div>
                </div>
            </section>
            
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('last_month') </span>
                        <small class="block text-danger pull-right m-l text-bold">
                                @metrics('estimates_last_month')
                        </small>
                    </div>
                </div>
            </section>
    
    
            
    
            
    
    
    
    
        </div>
    
    
        <div class="col-md-8 b-top">
    
            @widget('Estimates\YearlyOverview')
    
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
                    $janEstimates = getCalculated('estimates_1_'.$year); 
                    $febEstimates = getCalculated('estimates_2_'.$year); 
                    $marEstimates = getCalculated('estimates_3_'.$year);
                    $semOne = array($janEstimates, $febEstimates, $marEstimates); @endphp
                    <div class="clearfix m-b-md small">{{ langdate('cal_january') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $janEstimates) }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_february') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $febEstimates) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_march') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $marEstimates) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-bold">
                            <strong>
                                {{ formatCurrency(get_option('default_currency'), array_sum($semOne)) }}
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
                    $aprEstimates = getCalculated('estimates_4_'.$year); 
                    $mayEstimates = getCalculated('estimates_5_'.$year); 
                    $junEstimates = getCalculated('estimates_6_'.$year);
                    $semTwo = array($aprEstimates, $mayEstimates, $junEstimates); 
                    @endphp
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_april') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $aprEstimates) }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_may') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $mayEstimates) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_june') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $junEstimates) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-dark">
                            <strong>
                                {{ formatCurrency(get_option('default_currency'), array_sum($semTwo)) }}
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
                    $julEstimates = getCalculated('estimates_7_'.$year); 
                    $augEstimates = getCalculated('estimates_8_'.$year); 
                    $sepEstimates = getCalculated('estimates_9_'.$year);
                    $semThree = array($julEstimates, $augEstimates, $sepEstimates); 
                    @endphp
                    <div class="clearfix m-b-md small">{{ langdate('cal_july') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $julEstimates) }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_august') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $augEstimates) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_september') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $sepEstimates) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-dark">
                            <strong>
                                {{ formatCurrency(get_option('default_currency'), array_sum($semThree)) }}
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
                    $octEstimates = getCalculated('estimates_10_'.$year); 
                    $novEstimates = getCalculated('estimates_11_'.$year); 
                    $decEstimates = getCalculated('estimates_12_'.$year);
                    $semFour = array($octEstimates, $novEstimates, $decEstimates); 
                    @endphp
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_october') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $octEstimates) }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_november') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $novEstimates) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_december') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $decEstimates) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-dark">
                            <strong>
                                {{ formatCurrency(get_option('default_currency'), array_sum($semFour)) }}
                            </strong>
                        </div>
                    </div>
    
                </div>
                
            </div>
            
        </div>
        
    
    </div>