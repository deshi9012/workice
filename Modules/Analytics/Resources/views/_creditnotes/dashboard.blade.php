<div class="row">

        <div class="col-sm-4">
    
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('open_credits')</span>
                        <small class="block text-danger pull-right m-l text-bold">
                            @metrics('credits_open')
                        </small>
                    </div>
                </div>
            </section>
    
            <section class="panel panel-info">
                    <div class="panel-body">
                        <div class="clear">
                            <span class="text-dark">@langapp('closed_credits')</span>
                            <small class="block text-success pull-right m-l text-bold">
                            @metrics('credits_closed')        
                            </small>
                        </div>
                    </div>
                </section>
    
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('last_month') </span>
                        <small class="block text-primary pull-right m-l text-bold">
                                @metrics('credits_last_month')
                        </small>
                    </div>
                </div>
            </section>
    
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('this_month') </span>
                        <small class="block text-info pull-right m-l text-bold">
                                @metrics('credits_this_month')
                        </small>
                    </div>
                </div>
            </section>
    
            
    
    
    
    
        </div>
    
    
        <div class="col-md-8 b-top">
    
            @widget('Creditnotes\YearlyOverview')
    
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
                    $janCredits = getCalculated('credits_1_'.$year); 
                    $febCredits = getCalculated('credits_2_'.$year); 
                    $marCredits = getCalculated('credits_3_'.$year);
                    $semOne = array($janCredits, $febCredits, $marCredits); @endphp
                    <div class="clearfix m-b-md small">{{ langdate('cal_january') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $janCredits) }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_february') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $febCredits) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_march') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $marCredits) }}
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
                    $aprCredits = getCalculated('credits_4_'.$year); 
                    $mayCredits = getCalculated('credits_5_'.$year); 
                    $junCredits = getCalculated('credits_6_'.$year);
                    $semTwo = array($aprCredits, $mayCredits, $junCredits); 
                    @endphp
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_april') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $aprCredits) }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_may') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $mayCredits) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_june') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $junCredits) }}
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
                    $julCredits = getCalculated('credits_7_'.$year); 
                    $augCredits = getCalculated('credits_8_'.$year); 
                    $sepCredits = getCalculated('credits_9_'.$year);
                    $semThree = array($julCredits, $augCredits, $sepCredits); 
                    @endphp
                    <div class="clearfix m-b-md small">{{ langdate('cal_july') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $julCredits) }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_august') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $augCredits) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_september') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $sepCredits) }}
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
                    $octCredits = getCalculated('credits_10_'.$year); 
                    $novCredits = getCalculated('credits_11_'.$year); 
                    $decCredits = getCalculated('credits_12_'.$year);
                    $semFour = array($octCredits, $novCredits, $decCredits); 
                    @endphp
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_october') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $octCredits) }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_november') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $novCredits) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_december') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $decCredits) }}
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
    