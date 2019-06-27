<div class="row">

    <div class="col-sm-4">

        <section class="panel panel-info">
            <div class="panel-body">
                <div class="clear">
                    <span class="text-dark">@langapp('tickets') </span>
                    <small class="block text-primary pull-right m-l text-bold">
                        {{ getCalculated('tickets_total') }}
                    </small>
                </div>
            </div>
        </section>

        <section class="panel panel-info">
            <div class="panel-body">
                <div class="clear">
                    <span class="text-dark">@langapp('open') </span>
                    <small class="block text-danger pull-right m-l text-bold">
                            {{ getCalculated('tickets_open') }}
                    </small>
                </div>
            </div>
        </section>


        <section class="panel panel-info">
            <div class="panel-body">
                <div class="clear">
                    <span class="text-dark">@langapp('closed') </span>
                    <small class="block text-success pull-right m-l text-bold">
                            {{ getCalculated('tickets_closed') }}
                    </small>
                </div>
            </div>
        </section>


        

        <section class="panel panel-info">
            <div class="panel-body">
                <div class="clear">
                    <span class="text-dark">@langapp('this_month') </span>
                    <small class="block text-primary pull-right m-l text-bold">
                        {{ getCalculated('tickets_this_month') }}
                    </small>
                </div>
            </div>
        </section>

        <section class="panel panel-info">
            <div class="panel-body">
                <div class="clear">
                    <span class="text-dark">Avg. @langapp('time_spent') </span>
                    <small class="block text-primary pull-right m-l text-bold">
                        {{ round(getCalculated('tickets_avg_response'), 3) }}
                    </small>
                </div>
            </div>
        </section>




    </div>


    <div class="col-md-8 b-top">

            @widget('Tickets\YearlyChartWidget')

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
                $janTasks = getCalculated('tickets_1_'.$year); 
                $febTasks = getCalculated('tickets_2_'.$year); 
                $marTasks = getCalculated('tickets_3_'.$year);
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
                    <div class="pull-right text-bold">
                            {{ array_sum($semOne) }} @langapp('tickets')
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
                $aprTasks = getCalculated('tickets_4_'.$year); 
                $mayTasks = getCalculated('tickets_5_'.$year); 
                $junTasks = getCalculated('tickets_6_'.$year);
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
                            {{ array_sum($semTwo) }} @langapp('tickets')
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
                $julTasks = getCalculated('tickets_7_'.$year); 
                $augTasks = getCalculated('tickets_8_'.$year); 
                $sepTasks = getCalculated('tickets_9_'.$year);
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
                    <div class="pull-right text-bold">
                            {{ array_sum($semThree) }} @langapp('tickets')
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
                $octTasks = getCalculated('tickets_10_'.$year); 
                $novTasks = getCalculated('tickets_11_'.$year); 
                $decTasks = getCalculated('tickets_12_'.$year);
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
                    <div class="pull-right text-bold">
                            {{ array_sum($semFour) }} @langapp('tickets')
                    </div>
                </div>

            </div>
            
        </div>
        
    </div>
    

</div>