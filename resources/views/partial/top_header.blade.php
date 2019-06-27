<header class="bg-{{ get_option('top_bar_color') }} header navbar navbar-fixed-top-xs nav-z">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav">
                @icon('solid/bars')
            </a>
            <a href="{{  url('/')  }}" class="navbar-brand">
                @php $display = get_option('logo_or_icon'); @endphp
                @if ($display == 'logo' || $display == 'logo_title')
                <img src="{{ getStorageUrl(config('system.media_dir').'/'.get_option('company_logo'))  }}" class="m-r-sm">
                @elseif ($display == 'icon' || $display == 'icon_title')
                <i class="fa {{  get_option('site_icon')  }}"></i>
                @endif
                @if ($display == 'logo_title' || $display == 'icon_title')
                @if (get_option('website_name') == '')
                {{ get_option('company_name') }}
                @else
                {{ get_option('website_name') }}
                @endif
                @endif
            </a>
            <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".nav-user">
                @icon('solid/cog')
            </a>
        </div>
        <ul class="nav navbar-nav hidden-xs" id="todolist">
            <li class="">
                
                <div class="m-t m-l-lg">
                    <a href="{{ route('calendar.todos') }}" class="" data-rel="tooltip" title="@langapp('todo')" data-placement="bottom">
                        @icon('solid/tasks')
                        <span class="badge badge-sm up bg-danger m-l-n-sm display-inline">{{ \Auth::user()->todoToday() }}</span>
                    </a>
                    <a href="{{ route('calendar.index') }}" class="m-l" data-rel="tooltip" title="@langapp('calendar')" data-placement="bottom">
                        @icon('solid/calendar-alt')
                    </a>

                    <a href="{{ route('calendar.appointments') }}" class="m-l" data-rel="tooltip" title="@langapp('appointments') " data-placement="bottom">
                        @icon('solid/calendar-check')
                    </a> 
                    
                </div>
                
            </li>
        </ul>


        <ul class="nav navbar-nav navbar-right hidden-xs nav-user">

            @if(count(runningTimers()) > 0)
            <li class="">
                <a href="{{ route('timetracking.timers') }}" title="@langapp('timers')" data-toggle="ajaxModal" data-rel="tooltip" data-placement="bottom">  
                    @icon('solid/clock', 'fa-spin fa-lg text-warning')
                    <span class="badge badge-sm up bg-info m-l-n-sm display-inline">{{ count(runningTimers()) }}</span>
                </a>
            </li>
            @endif

            @include('partial.notifications')
            @admin
            <li class="dropdown hidden-xs">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    @icon('solid/search', 'fa-fw')
                </a>
                <section class="dropdown-menu aside-xl animated fadeInUp">
                    <section class="panel bg-white">
                        <form action="{{ route('search.app') }}" method="POST" role="search">
                            {!! csrf_field() !!}
                            <div class="form-group wrapper m-b-none">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="keyword" placeholder="Type tag keyword">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-info btn-icon"><i class="fas fa-search"></i></button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </section>
                </section>
            </li>
            @endadmin


            
            
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="thumb-sm avatar pull-left">
                        <img src="{{ avatar() }}" class="img-circle">
                    </span>
                    {{ Auth::user()->name }} <b class="caret"></b>
                </a>
                <ul class="dropdown-menu animated fadeInRight">
                    <li class="arrow top"></li>
                    <li><a href="{{ route('users.profile') }}">@langapp('settings')  </a></li>
                    <li><a href="{{ route('tell.friend') }}" data-toggle="ajaxModal">@langapp('tell_friend')  </a></li>
                    <li><a href="{{ route('users.reminders') }}">@langapp('reminders')</a></li>
                    <li><a href="{{ route('users.notifications') }}">@langapp('notifications') </a></li>
                    <li><a href="{{ route('extras.user.templates') }}">@langapp('canned_responses')</a></li>
                    @admin
                    <li><a href="{{ route('support.ticket') }}" data-toggle="ajaxModal">Need Help?</a></li>
                    @endadmin
                    <li class="divider"></li>
                    @if(Auth::user()->isImpersonating())
                    <li><a href="{{ route('users.stopimpersonate') }}">@langapp('stop_impersonate')</a></li>
                    @endif
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            @icon('solid/sign-out-alt') Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="display-none">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</header>