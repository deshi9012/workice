<div class="row">

        <div class="col-sm-4">

            <section class="panel panel-info">
                    <div class="panel-body">
                        <div class="clear">
                            <span class="text-dark">@langapp('billed') </span>
                            <small class="block pull-right m-l text-bold">
                                @metrics('expenses_billed')
        
                            </small>
                        </div>
                    </div>
                </section>

                <section class="panel panel-info">
                        <div class="panel-body">
                            <div class="clear">
                                <span class="text-dark">@langapp('unbillable') </span>
                                <small class="block text-danger pull-right m-l text-bold">
                                    @metrics('expenses_unbillable')
            
                                </small>
                            </div>
                        </div>
                    </section>
    
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('this_year') </span>
                        <small class="block pull-right m-l text-bold">
                                @metrics('expenses_year_'.$year)
                        </small>
                    </div>
                </div>
            </section>
    
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('this_month') </span>
                        <small class="block text-success pull-right m-l text-bold">
                                @metrics('expenses_this_month')
                        </small>
                    </div>
                </div>
            </section>

            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('last_month') </span>
                        <small class="block pull-right m-l text-bold">
                                @metrics('expenses_last_month')
                        </small>
                    </div>
                </div>
            </section>
    
            
    
    
    
    
        </div>
    
    
        <div class="col-md-8 b-top">
    
                @widget('Expenses\BillableChart')
    
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
                    $janExpenses = getCalculated('expenses_1_'.$year); 
                    $febExpenses = getCalculated('expenses_2_'.$year); 
                    $marExpenses = getCalculated('expenses_3_'.$year);
                    $semOne = array($janExpenses, $febExpenses, $marExpenses); 
                    @endphp
                    <div class="clearfix m-b-md small">{{ langdate('cal_january') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $janExpenses) }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_february') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $febExpenses) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_march') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $marExpenses) }}
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
                    $aprExpenses = getCalculated('expenses_4_'.$year); 
                    $mayExpenses = getCalculated('expenses_5_'.$year); 
                    $junExpenses = getCalculated('expenses_6_'.$year);
                    $semTwo = array($aprExpenses, $mayExpenses, $junExpenses); @endphp
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_april') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $aprExpenses) }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_may') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $mayExpenses) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_june') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $junExpenses) }}
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
                    $julExpenses = getCalculated('expenses_7_'.$year); 
                    $augExpenses = getCalculated('expenses_8_'.$year); 
                    $sepExpenses = getCalculated('expenses_9_'.$year);
                    $semThree = array($julExpenses, $augExpenses, $sepExpenses); @endphp
                    <div class="clearfix m-b-md small">{{ langdate('cal_july') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $julExpenses) }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_august') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $augExpenses) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_september') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $sepExpenses) }}
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
                    $octExpenses = getCalculated('expenses_10_'.$year); 
                    $novExpenses = getCalculated('expenses_11_'.$year); 
                    $decExpenses = getCalculated('expenses_12_'.$year);
                    $semFour = array($octExpenses, $novExpenses, $decExpenses); @endphp
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_october') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $octExpenses) }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_november') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $novExpenses) }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_december') }}
                        <div class="pull-right text-bold">
                            {{ formatCurrency(get_option('default_currency'), $decExpenses) }}
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
    
    
    