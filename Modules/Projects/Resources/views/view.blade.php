@extends('layouts.app')
@section('content')
<section id="content">
    <section class="hbox stretch">
        <aside class="b-l">
            <section class="vbox">
                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-6">
                            <h4 class="m-t-sm pull-left">{{  $project->name }}
                            @if ($project->rating)
                            @include('partial.five_star')
                            @endif
                            @if ($project->isOverdue())
                            <span class="label label-danger small">@langapp('overdue')</span>
                            @endif
                            </h4>
                        </div>
                        <div class="col-sm-6">
                            <div class="btn-group btn-group-animated pull-right">
                                <button type="button" class="btn btn-sm btn-{{ get_option('theme_color') }} dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                @icon('solid/ellipsis-h')
                                </button>
                                <ul class="dropdown-menu">
                                    @if ($project->client_id > 0)
                                    @can('invoices_create')
                                    <li>
                                        <a href="{{  route('projects.invoice', ['id' => $project->id])  }}" data-toggle="ajaxModal" data-rel="tooltip" title="@langapp('invoice')">
                                            @icon('solid/file-invoice-dollar') @langapp('invoice')
                                        </a>
                                    </li>
                                    @endcan
                                    @endif
                                    @can('reminders_create')
                                    <li>
                                        <a href="{{ route('calendar.reminder', ['module' => 'projects', 'id' => $project->id]) }}" data-toggle="ajaxModal" data-rel="tooltip"  data-placement="bottom" title="@langapp('set_reminder')  ">
                                            @icon('solid/clock') @langapp('reminder')
                                        </a>
                                    </li>
                                    @endcan
                                    
                                    @can('projects_copy')
                                    <li>
                                        <a href="{{ route('projects.copy', ['id' => $project->id]) }}" data-toggle="ajaxModal" data-rel="tooltip" title="@langapp('copy')">
                                            @icon('solid/copy') @langapp('copy')
                                        </a>
                                    </li>
                                    @endcan
                                    @can('projects_update')
                                    <li>
                                        <a href="{{ route('projects.edit', ['id' => $project->id]) }}" data-rel="tooltip" title="@langapp('make_changes')">
                                            @icon('solid/pencil-alt') @langapp('edit')
                                        </a>
                                    </li>
                                    @endcan
                                    @if(isAdmin() || $project->setting('show_project_links') || $project->isTeam())
                                    <li>
                                        <a href="{{ route('projects.view', ['id' => $project->id, 'tab' => 'links'])  }}">
                                            @icon('solid/link') @langapp('links')
                                        </a>
                                    </li>
                                    @endif
                                    @if($project->client_id > 0 && (isAdmin() || can('projects_download')))
                                    <li>
                                        <a href="{{ route('projects.export', ['id' => $project->id])  }}">
                                            @icon('regular/file-pdf') PDF
                                        </a>
                                    </li>
                                    @endif
                                    @admin
                                    @if(optional($project->company)->primary_contact)
                                    <li>
                                        <a href="{{ route('users.impersonate', ['id' => $project->company->contact->id ]) }}">
                                            @icon('solid/user-secret') As Client
                                        </a>
                                    </li>
                                    @endif
                                    @endadmin
                                    
                                    @if ($project->auto_progress && $project->manager == \Auth::id())
                                    <li>
                                        <a data-toggle="ajaxModal" data-rel="tooltip" title="@langapp('mark_as_complete')"
                                            href="{{ route('projects.done', ['id' => $project->id]) }}">
                                            @icon('solid/check-square') @langapp('done')
                                        </a>
                                    </li>
                                    @endif
                                    @can('projects_delete')
                                    <li>
                                        <a href="{{  route('projects.delete', ['id' => $project->id])  }}"
                                            data-toggle="ajaxModal" data-rel="tooltip" title="@langapp('delete')">
                                            @icon('solid/trash-alt') @langapp('delete')
                                        </a>
                                    </li>
                                    @endcan
                                </ul>
                            </div>
                            @if ($project->isTeam() || isAdmin())
                            <a href="{{  route('timetracking.create', ['module' => 'projects', 'id' => $project->id])  }}"
                                data-toggle="ajaxModal" class="btn btn-{{ get_option('theme_color') }} btn-sm pull-right">
                                @icon('solid/history') @langapp('time_entry')
                            </a>
                            @endif

                            
                            
                            @can('projects_update')
                            @php
                            $txt = $project->auto_progress ? 'auto_progress_off' : 'auto_progress_on';
                            @endphp
                            <a href="{{ route('projects.autoprogress', ['id' => $project->id]) }}" data-rel="tooltip" title="@langapp($txt)" data-placement="bottom"  class="btn btn-sm btn-default pull-right">
                                @icon('solid/plane')
                            </a>
                            @endcan
                            
                            @can('timer_start')
                            
                            @if ($project->timer_on)
                            <a data-toggle="tooltip" data-original-title="@langapp('stop_timer')"
                                data-placement="bottom" href="{{  route('clock.stop', ['id' => $project->id, 'module' => 'projects'])  }}" class="btn btn-default btn-sm pull-right">
                                @icon('solid/clock', 'fa-spin text-danger')
                            </a>
                            @else
                            <a data-toggle="tooltip" data-original-title="@langapp('start_timer')"
                                data-placement="bottom" href="{{  route('clock.start', ['id' => $project->id, 'module' => 'projects'])  }}"
                                class="btn btn-sm btn-default pull-right"> @icon('solid/stopwatch', 'text-success')
                            </a>
                            @endif
                            @endcan
                            <a data-rel="tooltip" title="@langapp('pin_sidebar')" data-placement="bottom" href="{{ route('users.pin', ['id' => $project->id, 'module' => 'projects']) }}"
                                class="btn btn-sm btn-default pull-right"> @icon('solid/bookmark')
                            </a>

                            @if ($project->is_template && isAdmin())
                            <a href="{{ route('projects.fromtemplate', $project->id) }}" data-toggle="ajaxModal" title="@langapp('create_from_template')" data-rel="tooltip" class="btn btn-{{ get_option('theme_color') }} btn-sm pull-right">
                                @icon('solid/recycle') @langapp('use_template')
                            </a>
                            @endif

                        </div>
                    </div>
                </header>
                
                <section class="scrollable wrapper bg scrollpane">
                    <div class="sub-tab m-b-10">
                        <ul class="nav pro-nav-tabs nav-tabs-dashed">
                            @foreach (projectMenu() as $menu)
                            @php $perm = true; @endphp
                            @if ($menu->permission != '')
                            @php $perm = $project->setting($menu->permission); @endphp
                            @endif
                            @if ($perm)
                            @php $timer_on = 0; @endphp
                            @if ($menu->module == 'project_timesheets')
                            @php
                            $timer_on = $project->timesheets()->running()->count();
                            @endphp
                            @endif
                            @endif
                            <li class="{{ $tab == $menu->route ? 'active' : ''  }}">
                                <a href="{{  route('projects.view', ['id' => $project->id, 'tab' => $menu->route])  }}">
                                    @langapp($menu->route)
                                    @if ($timer_on > 0)
                                    <span class="m-r-xs">@icon('solid/sync-alt', 'fa-spin text-danger')</span>
                                    @endif
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    
                    @include('projects::tab._'.$tab)
                </section>
            </section>
        </aside>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>
@endsection