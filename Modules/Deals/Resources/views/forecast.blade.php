<div class="col-lg-12">
    <div class="card">
        <div class="card-body collapse in">
            <div class="card-block">
                <div class="overflow-hidden">
                    <div id="todo-lists-basic-demo"
                         class="lobilists-wrapper lobilists single-line sortable ps-container ps-theme-dark ps-active-x">
                        @php
                        $now = new DateTime(date('Y-m'));
                        $period = new DatePeriod($now, new DateInterval('P1M'), 3);
                        $model = new Modules\Deals\Entities\Deal;
                        @endphp

                        @foreach ($period as $dt)
                            @php
                            $month = $dt->format('F Y');
                            $m = $dt->format('m');
                            $y = $dt->format('Y');

                            $openTotal = getCalculated('deals_open_'.$m.'_'.$dt->format('Y').'_'.$pipeline);
                            $wonTotal = getCalculated('deals_won_'.$m.'_'.$dt->format('Y').'_'.$pipeline);
                            $potentialValue = $openTotal + $wonTotal;
                            @endphp
                            <div class="lobilist-wrapper ps-container ps-theme-dark ps-active-y">
                                <div id="lobilist-list-0" class="lobilist lobilist-info">
                                    <div class="lobilist-header ui-sortable-handle forecast-header">
                                        <div class="lobilist-actions">

                                        </div>
                                        <div class="text-ellipsis month-board">
                                        <span class="lobilist-title col-md-8 text-muted text-uc forecast-padding">
                                        {{ $month }}</span>
                                            <span class="deal-summary col-md-4 pull-right">
                                            <span class="text-bold text-muted">
                                                {{  formatCurrency(get_option('default_currency'), $openTotal)  }}
                                            </span><br>
                                            <span class="text-bold text-success b-b" data-rel="tooltip" title="Won Deals" data-placement="left">
                                            + {{  formatCurrency(get_option('default_currency'), $wonTotal)  }}
                                        </span><br>
                                            <span class="text-bold text-muted" data-rel="tooltip" title="Potential Deals Value" data-placement="left"> 
                                            {{  formatCurrency(get_option('default_currency'), $potentialValue)  }}
                                        </span>
                                        </span>
                                        </div>
                                    </div>
                                    <div class="lobilist-body scrumboard slim-scroll" data-height="420"
                                         data-disable-fade-out="true" data-distance="0" data-size="5px"
                                         data-color="#333333">


                                        <ul class="lobilist-items ui-sortable" id=" {{  underscore($month)  }}">

        @foreach ($model->whereMonth('due_date', $m)->whereYear('due_date', $y)->wherePipeline($pipeline)->orderBy('id', 'desc')->get() as $deal)

                                                <li id=" {{ $deal->id }}" class="lobilist-item">
                                                    <div class="lobilist-item-title text-ellipsis font14">
                                                        <a href=" {{ route('deals.view', ['id' => $deal->id]) }}"> {{  $deal->title  }}</a>
                                                    </div>
                                                    <div class="lobilist-item-description text-muted">
                                                        <small class="pull-right">
                                                            {{ optional($deal->company)->name }}
                                                        </small>
                                                        <span class="text-bold"> {{ $deal->computed_value }}</span>
                                                    </div>
                                                    <div class="lobilist-item-duedate">

                                                        {{ !is_null($deal->due_date) ? dateFormatted($deal->due_date) : '' }}

                                                    </div>
                @if ($deal->user_id > 0)
                    <span class="thumb-xs avatar lobilist-check">
                        <img src="{{  $deal->user->profile->photo }}" class="img-circle">
                    </span>
                @endif


                                                    <div class="todo-actions">

                                                        @if ($deal->status === 'won')
                                                            <label class="label bg-success">
                                                            @icon('solid/check-circle') @langapp('won')  
                                                        </label>

                                                        @endif


                                                    </div>

                                                    <div class="drag-handler"></div>
                                                </li>
                                            @endforeach

                                        </ul>


                                    </div>

                                    <div class="lobilist-footer">
                                        @php
                                            $numDeals = $model->whereMonth('due_date', $m)->wherePipeline($pipeline)->count();
                                        @endphp
                                        <strong>
                       {{ $numDeals }} {{ str_plural(langapp('deal'), $numDeals) }}
                                        </strong>
                                        <strong class="pull-right">
                       {{ $model->whereMonth('due_date', $m)->won()->wherePipeline($pipeline)->count() }}
                                            @langapp('won_deals')  
                                        </strong>
                                    </div>
                                </div>


                            </div>

                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>