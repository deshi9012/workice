<aside class="b-l bg" id="">
            <ul class="dashmenu text-uc text-muted no-border no-radius">

                @modactive('invoices')
                <li class="{{ $dashboard == 'invoices' ? 'active' : '' }}"><a href="{{ route('dashboard.index', ['dashboard' => 'invoices']) }}">@icon('solid/file-invoice-dollar') @langapp('invoicing')</a></li>
                @endmod
                @modactive('deals')
                <li class="{{ $dashboard == 'deals' ? 'active' : '' }}"><a href="{{ route('dashboard.index', ['dashboard' => 'deals']) }}">@svg('solid/chart-line') @langapp('sales')</a></li>
                @endmod
                @modactive('expenses')
                <li class="{{ $dashboard == 'expenses' ? 'active' : '' }}"><a href="{{ route('dashboard.index', ['dashboard' => 'expenses']) }}">@icon('solid/shopping-basket') @langapp('expenses')</a></li>
                @endmod
                @modactive('payments')
                <li class="{{ $dashboard == 'payments' ? 'active' : '' }}"><a href="{{ route('dashboard.index', ['dashboard' => 'payments']) }}">@icon('solid/credit-card') @langapp('payments')</a></li>
                @endmod
                {{--@modactive('projects')--}}
                {{--<li class="{{ $dashboard == 'projects' ? 'active' : '' }}"><a href="{{ route('dashboard.index', ['dashboard' => 'projects']) }}">@icon('solid/clock') @langapp('projects')</a></li>--}}
                {{--@endmod--}}
                @modactive('tickets')
                <li class="{{ $dashboard == 'tickets' ? 'active' : '' }}"><a href="{{ route('dashboard.index', ['dashboard' => 'tickets']) }}">@icon('solid/life-ring') @langapp('ticketing')</a></li>
                @endmod
            </ul>
            
                <section class="scrollable">
                    <div class="slim-scroll" data-color="#333333" data-disable-fade-out="true" data-distance="0" data-height="auto" data-size="3px">
                        <section class="padder">

                            @if (get_option('valid_license') != 'TRUE' && get_option('demo_mode') != 'TRUE')
                            <div class="alert alert-danger" role="alert">
                                <strong>@langapp('fo_not_validated')</strong><br/>
                                To validate your purchase enter your purchase code in Settings or buy Workice CRM at <a href="{{ config('system.saleurl') }}">Envato Market</a>
                            </div>
                            
                            @endif

                            
                            @include('dashboard::_includes.'.$dashboard)
                            
                            
                        </section>
                    </div>
                </section>
                
            </aside>

            <aside class="aside-lg b-l">
                <section class="vbox">

                    <section class="scrollable" id="feeds">

                    <div class="slim-scroll padder" data-color="#333333" data-disable-fade-out="true" data-distance="0" data-height="auto" data-size="3px">
                    
                        @include('dashboard::_sidebar.'.$dashboard)

                    </div>

                </section>
                    
                </section>
            </aside>