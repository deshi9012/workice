@extends('layouts.app')

@section('content')

<section id="content" class="bg">
    <section class="hbox stretch">
        
        @include('partial.settings_menu')

        <aside>
            <section class="vbox">

                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-12 m-b-xs">

                        @if($section == 'general')
                        <a href="{{ route('settings.index', 'clauses') }}" class="btn btn-sm btn-{{ get_option('theme_color') }}">@icon('solid/file-contract') @langapp('clauses')</a>
                        @endif

                        @if($section == 'payments')
                        <a href="{{ route('settings.index', 'currencies') }}" class="btn btn-sm btn-{{ get_option('theme_color') }}">@langapp('currencies')</a>
                        @endif

                        @if($section == 'theme')
                        <a href="{{ route('settings.index', 'css') }}" class="btn btn-sm btn-{{ get_option('theme_color') }}">@langapp('custom_css')</a>
                        @endif

                        @if($section == 'info')
                        @admin
                        <a href="{{ route('settings.test.mail') }}" class="btn btn-sm btn-{{ get_option('theme_color') }}" data-toggle="ajaxModal">@icon('solid/at') @langapp('test_email')</a>
                        <div class="btn-group">
                          <button class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">@langapp('import') <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="{{ route('settings.import', ['type' => 'fo']) }}" data-toggle="ajaxModal">Freelancer Office</a></li>
                          </ul>
                        </div>
                        <a href="{{ route('settings.index', 'commands') }}" class="btn btn-sm btn-{{ get_option('theme_color') }}">@icon('solid/terminal') Commands</a>
                        <a href="{{ route('updates.schedule') }}" class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right" data-toggle="ajaxModal">@icon('solid/laptop-code') @langapp('schedule_update')</a>
                        
                        @endadmin
                        @endif

                        @if($section == 'support')
                        <a href="{{ route('settings.statuses.show') }}" class="btn btn-sm btn-{{ get_option('theme_color') }}" data-toggle="ajaxModal" data-rel="tooltip" title="@langapp('statuses')" data-placement="bottom">
                            @icon('solid/ellipsis-v') @langapp('statuses')
                        </a>
                        @endif

                        @if($section == 'translations')
                        <a href="{{ route('translations.mail') }}" class="btn btn-sm btn-{{ get_option('theme_color') }}" data-rel="tooltip" title="Modify email templates" data-placement="bottom">
                            @icon('solid/envelope-open') @langapp('emails')
                        </a>
                        @endif

                        

                        @if($section == 'leads')
                        <a href="{{ route('settings.stages.show', 'leads') }}" class="btn btn-sm btn-{{ get_option('theme_color') }}" data-toggle="ajaxModal" data-rel="tooltip" title="@langapp('preview') " data-placement="bottom">
                            @icon('solid/shoe-prints') @langapp('stages')
                        </a>

                        <a href="{{ route('settings.sources.show') }}" class="btn btn-sm btn-{{ get_option('theme_color') }}" data-toggle="ajaxModal" data-rel="tooltip" title="@langapp('source') " data-placement="bottom">
                            @icon('solid/globe') @langapp('source')
                        </a>

                        <a href="{{ route('web.lead') }}" class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right" data-rel="tooltip" title="Web to Lead form" data-placement="bottom" target="_blank">
                            @icon('solid/phone-volume') @langapp('lead_form')
                        </a>

                        @endif

                        @if($section == 'deals')
                        <a href="{{ route('settings.stages.show', 'deals') }}" class="btn btn-sm btn-{{ get_option('theme_color') }}" data-toggle="ajaxModal" data-rel="tooltip" title="@langapp('stages') " data-placement="bottom">
                            @icon('solid/shoe-prints') @langapp('stages')
                        </a> 
                        <a href="{{ route('settings.pipelines.show') }}" class="btn btn-sm btn-{{ get_option('theme_color') }}" data-toggle="ajaxModal" data-rel="tooltip" title="@langapp('deal_pipelines')" data-placement="bottom">
                            @icon('solid/chart-line') @langapp('deal_pipelines')
                        </a> 
                        @endif


                        </div>
                    </div>
                </header>
                <section class="scrollable wrapper">
                    @include('settings::sections.'.$section)
                </section>
            </section>
        </aside>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html">

    </a>
</section>

@endsection
