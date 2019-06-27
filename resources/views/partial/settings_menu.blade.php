
<aside class="aside aside-md b-r">
            <section class="vbox">
                <header class="dk header b-b">
                    <a class="btn btn-icon btn-default btn-sm pull-right visible-xs m-r-xs" data-toggle="class:show"
                       data-target="#setting-nav">@icon('solid/bars')</a>
                    <p class="h3">@langapp('settings')  </p>
                </header>
                <section class="scrollable">
                    <div class="slim-scroll" data-color="#333333" data-disable-fade-out="true" data-distance="0" data-height="auto" data-size="3px"> 
                    <section id="setting-nav" class="hidden-xs">
                        <ul class="nav nav-pills nav-stacked no-radius">
                            @foreach (settingsMenu() as $menu)
                                <li class="{{ $section == $menu->route ? 'active' : '' }}">

                                    <a href="{{  route('settings.edit', ['section' => $menu->route])  }}">
                                        @icon('solid/angle-right', 'text-white')
                                        @langapp($menu->name)  
                                        
                                    </a>

                                </li>
                            @endforeach
                        </ul>
                    </section>
                </div>
                </section>
            </section>
        </aside>