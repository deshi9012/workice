<div class="row">

        <div class="col-sm-4">
    
    
    
    
    
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('total_receipts') </span>
                        <small class="block pull-right m-l text-bold">
                            @metrics('total_receipts')
                        </small>
                    </div>
                </div>
            </section>
    
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('collected_this_year') </span>
                        <small class="block text-success pull-right m-l text-bold">
                                @metrics('revenue_year_'.$year)
                        </small>
                    </div>
                </div>
            </section>
    
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('paid_this_month') </span>
                        <small class="block text-success pull-right m-l text-bold">
                                @metrics('revenue_this_month')
                        </small>
                    </div>
                </div>
            </section>
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('last_month') </span>
                        <small class="block text-danger pull-right m-l text-bold">
                            @metrics('revenue_last_month')
                        </small>
                    </div>
                </div>
            </section>
    
    
    
    
        </div>
    
    
        <div class="col-md-8 b-top">
    
                @widget('Payments\ReceiptsChart')
    
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
                    $janPayments = getCalculated('payments_1_'.$year); 
                    $febPayments = getCalculated('payments_2_'.$year); 
                    $marPayments = getCalculated('payments_3_'.$year);
                    $semOne = array($janPayments, $febPayments, $marPayments); 
                    @endphp
                    <div class="clearfix m-b-md small">{{ langdate('cal_january') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $janPayments) }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_february') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $febPayments) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_march') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $marPayments) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-dark">
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
                    $aprPayments = getCalculated('payments_4_'.$year); 
                    $mayPayments = getCalculated('payments_5_'.$year); 
                    $junPayments = getCalculated('payments_6_'.$year);
                    $semTwo = array($aprPayments, $mayPayments, $junPayments); 
                    @endphp
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_april') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $aprPayments) }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_may') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $mayPayments) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_june') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $junPayments) }}
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
                    $julPayments = getCalculated('payments_7_'.$year); 
                    $augPayments = getCalculated('payments_8_'.$year); 
                    $sepPayments = getCalculated('payments_9_'.$year);
                    $semThree = array($julPayments, $augPayments, $sepPayments); 
                    @endphp
                    <div class="clearfix m-b-md small">{{ langdate('cal_july') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $julPayments) }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_august') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $augPayments) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_september') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $sepPayments) }}
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
                    $octPayments = getCalculated('payments_10_'.$year); 
                    $novPayments = getCalculated('payments_11_'.$year); 
                    $decPayments = getCalculated('payments_12_'.$year);
                    $semFour = array($octPayments, $novPayments, $decPayments); 
                    @endphp
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_october') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $octPayments) }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_november') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $novPayments) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_december') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $decPayments) }}
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