@extends('layouts.app')

@section('content')



    <section id="content">
        <section class="hbox stretch">


                <section class="vbox">
                    <header class="header bg-white b-b clearfix">
                        <div class="row m-t-sm">
                            <div class="col-sm-8 m-b-xs">

                                @can('menu_users')
                                    <a href="{{ route('users.index') }}" data-toggle="tooltip" data-placement="bottom"
                                       class="btn btn-sm btn-{{ get_option('theme_color') }}" title="Back">
                                       @icon('solid/caret-left')
                                    </a>
                                @endcan



                                @can('users_update')
                                    <a href="{{ route('users.edit', ['id' => $user->id]) }}" data-toggle="ajaxModal"
                                       class="btn btn-sm btn-{{ get_option('theme_color') }}">
                                       @icon('solid/pencil-alt') @langapp('edit')
                                    </a>

                                    <a href="{{ route('users.permissions', ['id' => $user->id]) }}" data-rel="tooltip"
                                       class="btn btn-{{ get_option('theme_color') }} btn-sm" data-toggle="ajaxModal"
                                       title="@langapp('permission')" data-placement="bottom">
                                        @icon('solid/shield-alt') @langapp('permission')
                                    </a>
                                @endcan


                                @if ($user->id != Auth::id())

                                    @can('users_delete')
                                        <a href="{{ route('users.suspend', ['id' => $user->id]) }}" class="btn btn-{{ ($user->banned == '1') ? 'danger' : 'default' }} btn-sm"
                                           data-toggle="ajaxModal" data-rel="tooltip" title="@langapp('suspend')" data-placement="bottom">
                                            @icon('solid/thumbs-down')
                                        </a>

                                        <a href="{{ route('users.delete', ['id' => $user->id]) }}"
                                           class="btn btn-danger btn-sm" data-toggle="ajaxModal" data-rel="tooltip" data-placement="bottom"
                                           title="@langapp('delete')">
                                            @icon('solid/trash-alt')
                                        </a>
                                    @endcan
                                @endif


                            </div>
                            <div class="col-sm-4 m-b-xs">
                                
                            </div>
                        </div>
                    </header>
                    <section class="scrollable wrapper bg">


                        <div class="sub-tab text-uc small m-b-sm">

                            <ul class="nav pro-nav-tabs nav-tabs-dashed">
                                <li class="{{ ($tab == 'overview') ? 'active' : '' }}">
                                    <a href="{{ route('users.view', ['id' => $user->id, 'tab' => 'overview']) }}">
                                        @icon('solid/database') @langapp('overview')
                                    </a>
                                </li>

                                <li class="{{ ($tab == 'files') ? 'active' : '' }}">
                                    <a href="{{ route('users.view', ['id' => $user->id, 'tab' => 'files']) }}">
                                        @icon('solid/folder-open') @langapp('files') 
                                    </a>
                                </li>
                                <li class="{{ ($tab == 'tickets') ? 'active' : '' }}">
                                    <a href="{{ route('users.view', ['id' => $user->id, 'tab' => 'tickets']) }}">
                                        @icon('solid/life-ring') @langapp('tickets')
                                    </a>
                                </li>
                                <li class="{{ ($tab == 'projects') ? 'active' : '' }}">
                                    <a href="{{ route('users.view', ['id' => $user->id, 'tab' => 'projects']) }}">
                                    @icon('solid/clock') @langapp('projects')
                                    </a>
                                </li>


                                <li class="{{ ($tab == 'timesheet') ? 'active' : '' }}">
                                    <a href="{{ route('users.view', ['id' => $user->id, 'tab' => 'timesheet']) }}">
                                    @icon('solid/history') @langapp('timesheets')
                                    </a>
                                </li>


                                <li class="{{ ($tab == 'deals') ? 'active' : '' }}">
                                    <a href="{{ route('users.view', ['id' => $user->id, 'tab' => 'deals']) }}">
                                        @icon('solid/euro-sign') @langapp('deals')
                                    </a>
                                </li>


                            </ul>

                        </div>



                            @include('users::tab.'.$tab)




                    </section>


                </section>


        </section>
        <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open"
           data-target="#nav,html"></a>
    </section>

@endsection
