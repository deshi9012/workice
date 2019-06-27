<div class="row">

        <div class="col-sm-4">
    


            <section class="panel panel-info">
                    <div class="panel-body">
                        <div class="clear">
                            <span class="text-dark">@langapp('won_deals') </span>
                            <small class="block pull-right m-l text-bold">
                                @metrics('deals_won')
                            </small>
                        </div>
                    </div>
                </section>

                <section class="panel panel-info">
                        <div class="panel-body">
                            <div class="clear">
                                <span class="text-dark">@langapp('lost') </span>
                                <small class="block text-danger pull-right m-l text-bold">
                                    @metrics('deals_lost')
            
                                </small>
                            </div>
                        </div>
                    </section>
    

            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('this_month') </span>
                        <small class="block text-success pull-right m-l text-bold">
                            
                                @metrics('deals_this_month')
                            
                        </small>
                    </div>
                </div>
            </section>
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('last_month') </span>
                        <small class="block pull-right m-l text-bold">
                            
                                @metrics('deals_last_month')
                            
                        </small>
                    </div>
                </div>
            </section>

            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('sales_velocity') </span>
                        <small class="block text-primary pull-right m-l text-bold">
                            
                                {{ getCalculated('sales-velocity') }}
                            
                        </small>
                    </div>
                </div>
            </section>

            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('conversion_rate') </span>
                        <small class="block text-primary pull-right m-l text-bold">
                            
                                {{ round(getCalculated('conversion-rate'),2) }}%
                            
                        </small>
                    </div>
                </div>
            </section>
    
    
            
    
            
    
    
    
    
        </div>
    
    
        <div class="col-md-8 b-top">
    
                @widget('Deals\WonLostChart')
    
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
                    $janDeals = getCalculated('deals_1_'.$year); 
                    $febDeals = getCalculated('deals_2_'.$year); 
                    $marDeals = getCalculated('deals_3_'.$year);
                    $semOne = array($janDeals, $febDeals, $marDeals); 
                    @endphp
                    <div class="clearfix m-b-md small">{{ langdate('cal_january') }}
                        <div class="pull-right text-bold">
                            {{ $janDeals }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_february') }}
                        <div class="pull-right text-bold">
                            {{ $febDeals }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_march') }}
                        <div class="pull-right text-bold">
                            {{ $marDeals }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-bold">
                                {{ array_sum($semOne) }} @langapp('deals')
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
                    $aprDeals = getCalculated('deals_4_'.$year); 
                    $mayDeals = getCalculated('deals_5_'.$year); 
                    $junDeals = getCalculated('deals_6_'.$year);
                    $semTwo = array($aprDeals, $mayDeals, $junDeals); @endphp
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_april') }}
                        <div class="pull-right text-bold">
                            {{ $aprDeals }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_may') }}
                        <div class="pull-right text-bold">
                            {{ $mayDeals }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_june') }}
                        <div class="pull-right text-bold">
                            {{ $junDeals }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-bold">
                                {{ array_sum($semTwo) }} @langapp('deals')
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
                    $julDeals = getCalculated('deals_7_'.$year); 
                    $augDeals = getCalculated('deals_8_'.$year); 
                    $sepDeals = getCalculated('deals_9_'.$year);
                    $semThree = array($julDeals, $augDeals, $sepDeals); @endphp
                    <div class="clearfix m-b-md small">{{ langdate('cal_july') }}
                        <div class="pull-right text-bold">
                            {{ $julDeals }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_august') }}
                        <div class="pull-right text-bold">
                            {{ $augDeals }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_september') }}
                        <div class="pull-right text-bold">
                            {{ $sepDeals }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-bold">
                                {{ array_sum($semThree) }} @langapp('deals')
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
                    $octDeals = getCalculated('deals_10_'.$year); 
                    $novDeals = getCalculated('deals_11_'.$year); 
                    $decDeals = getCalculated('deals_12_'.$year);
                    $semFour = array($octDeals, $novDeals, $decDeals); @endphp
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_october') }}
                        <div class="pull-right text-bold">
                            {{ $octDeals }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_november') }}
                        <div class="pull-right text-bold">
                            {{ $novDeals }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_december') }}
                        <div class="pull-right text-bold">
                            {{ $decDeals }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-bold">
                                {{ array_sum($semFour) }} @langapp('deals')
                        </div>
                    </div>
    
                </div>
               
            </div>
            
        </div>
        
    
    </div>
    
    
    