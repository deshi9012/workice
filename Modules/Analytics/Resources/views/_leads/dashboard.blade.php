<div class="row">

        <div class="col-sm-4">
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('leads') </span>
                        <small class="block pull-right m-l text-bold">
                            {{ getCalculated('leads_total') }}
    
                        </small>
                    </div>
                </div>
            </section>
    
            <section class="panel panel-info">
                    <div class="panel-body">
                        <div class="clear">
                            <span class="text-dark">@langapp('converted')</span>
                            <small class="block text-success pull-right m-l text-bold">
                                {{ getCalculated('leads_converted') }}
        
                            </small>
                        </div>
                    </div>
                </section>



            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('this_month') </span>
                        <small class="block text-success pull-right m-l text-bold">
                            {{ getCalculated('leads_this_month') }}
                        </small>
                    </div>
                </div>
            </section>
    
    
            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('last_month') </span>
                        <small class="block text-danger pull-right m-l text-bold">
                            {{ getCalculated('leads_last_month') }}
                        </small>
                    </div>
                </div>
            </section>

            <section class="panel panel-info">
                <div class="panel-body">
                    <div class="clear">
                        <span class="text-dark">@langapp('lead_value') </span>
                        <small class="block pull-right m-l text-bold">
                            @metrics('leads_value')
    
                        </small>
                    </div>
                </div>
            </section>
    
    
        </div>
    
    
        <div class="col-md-8 b-top">
    
            @widget('Leads\YearlyOverview')
    
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
                    $janLeads = getCalculated('leads_1_'.$year); 
                    $febLeads = getCalculated('leads_2_'.$year); 
                    $marLeads = getCalculated('leads_3_'.$year);
                    $semOne = array($janLeads, $febLeads, $marLeads); 
                    @endphp
                    <div class="clearfix m-b-md small">{{ langdate('cal_january') }}
                        <div class="pull-right text-bold">
                            {{ $janLeads }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_february') }}
                        <div class="pull-right text-bold">
                            {{ $febLeads }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_march') }}
                        <div class="pull-right text-bold">
                            {{ $marLeads }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-bold">
                            <strong>
                                {{ array_sum($semOne) }} @langapp('leads')
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
                    $aprLeads = getCalculated('leads_4_'.$year); 
                    $mayLeads = getCalculated('leads_5_'.$year); 
                    $junLeads = getCalculated('leads_6_'.$year);
                    $semTwo = array($aprLeads, $mayLeads, $junLeads); 
                    @endphp
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_april') }}
                        <div class="pull-right text-bold">
                            {{ $aprLeads }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_may') }}
                        <div class="pull-right text-bold">
                            {{ $mayLeads }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_june') }}
                        <div class="pull-right text-bold">
                            {{ $junLeads }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-bold">
                            <strong>
                                {{ array_sum($semTwo) }} @langapp('leads')
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
                    $julLeads = getCalculated('leads_7_'.$year); 
                    $augLeads = getCalculated('leads_8_'.$year); 
                    $sepLeads = getCalculated('leads_9_'.$year);
                    $semThree = array($julLeads, $augLeads, $sepLeads); 
                    @endphp
                    <div class="clearfix m-b-md small">{{ langdate('cal_july') }}
                        <div class="pull-right text-bold">
                            {{ $julLeads }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_august') }}
                        <div class="pull-right text-bold">
                            {{ $augLeads }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_september') }}
                        <div class="pull-right text-bold">
                            {{ $sepLeads }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-bold">
                            <strong>
                                {{ array_sum($semThree) }} @langapp('leads')
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
                    $octLeads = getCalculated('leads_10_'.$year); 
                    $novLeads = getCalculated('leads_11_'.$year); 
                    $decLeads = getCalculated('leads_12_'.$year);
                    $semFour = array($octLeads, $novLeads, $decLeads); 
                    @endphp
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_october') }}
                        <div class="pull-right text-bold">
                            {{ $octLeads }}</div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_november') }}
                        <div class="pull-right text-bold">
                            {{ $novLeads }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">{{ langdate('cal_december') }}
                        <div class="pull-right text-bold">
                            {{ $decLeads }}
                        </div>
                    </div>
    
                    <div class="clearfix m-b-md small">
                        <div class="pull-right text-bold">
                            <strong>
                                {{ array_sum($semFour) }} @langapp('leads')
                            </strong>
                        </div>
                    </div>
    
                </div>
                
            </div>
            
        </div>
        
    
    </div>
    