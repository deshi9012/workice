<aside class="bg-{{ get_option('sidebar_theme') }} aside-md b-r {{ settingEnabled('hide_sidebar') ? 'nav-xs' : '' }} hidden-print hidden-xs"
	   id="nav">
	<section class="vbox">

		<header class="header bg-dark text-center clearfix">

			<div class="btn-group">
				<button type="button" class="btn btn-sm btn-{{ get_option('theme_color') }}" title="Language">
					@icon('solid/lightbulb')
				</button>
				<div class="btn-group hidden-nav-xs">
					<button type="button" class="btn btn-sm btn-{{ get_option('theme_color') }} dropdown-toggle"
							data-toggle="dropdown">
						@langapp('quick_links')
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu text-left">
						<li>
							@can('users_create')
								<a href="{{ route('invite') }}" data-toggle="ajaxModal">@icon('solid/envelope-open',
									'text-muted') @langapp('send_invite')</a>
							@endcan
							@modactive('projects')
							@can('projects_create')
								<a href="{{ route('projects.create') }}">@icon('solid/play', 'text-muted')
									@langapp('start_project')</a>
							@endcan
							@endmod
							@modactive('contracts')
							@can('contracts_create')
								<a href="{{ route('contracts.create') }}">@icon('solid/file-contract', 'text-muted')
									@langapp('start_contract')</a>
							@endcan
							@endmod
							@modactive('tickets')
							@can('tickets_create')
								<a href="{{ route('tickets.create') }}">@icon('solid/life-ring', 'text-muted')
									@langapp('new_ticket')</a>
							@endcan
							@endmod

						</li>

					</ul>
				</div>
			</div>


		</header>
		<section class="w-f scrollable">
			<div class="slim-scroll" data-color="#333333" data-disable-fade-out="true" data-distance="0"
				 data-height="auto" data-size="5px">

				<nav class="nav-primary hidden-xs">
					<ul class="nav">


						@foreach (mainMenu() as $menu)

							@if (count($menu['children']) > 0)

								<li class="nav-w-children {{ $page == langapp($menu['name']) && (in_array($menu['module'], array_pluck($menu['children'], 'parent'))) ? 'active'  : '' }}"
									id="{{ $menu['module'] }}">
									<a href="{{ site_url($menu['route']) }}">
										<i class="{{ $menu['icon'] }} icon">
											<b class="bg-{{ get_option('theme_color') }}"></b>
										</i>
										<span class="pull-right">
                                    <i class="fas fa-angle-down text"></i>
                                    <i class="fas fa-angle-up text-active"></i>
                                </span>
										<span>
                                    @langapp($menu['name'])
                                </span>
									</a>
									<ul class="nav lt">
										@foreach ($menu['children'] as $submenu)
											@if (Auth::user()->can($submenu['module']))
												<li class="{{ $page == langapp($submenu['name']) ? 'active' : '' }}">
													<a href="{{ site_url($submenu['route']) }}">
														<i class="{{ $submenu['icon'] }} icon">
															<b class="bg-{{ get_option('theme_color') }}"></b>
														</i>
														<span>
                                            @langapp($submenu['name']) 
                                        </span>
													</a>
												</li>
											@endif

										@endforeach
									</ul>
								</li>
							@else
								<li class="{{ $page === langapp($menu['name']) ? 'active' : '' }}">
									<a href="{{ site_url($menu['route']) }}">
										<i class="{{ $menu['icon'] }} icon">
											<b class="bg-{{ get_option('theme_color') }}"></b>
										</i>
										<span>
											@if($menu['name'] == 'users')
												Operators
											@else
												@langapp($menu['name'])
											@endif
                                </span>
									</a>
								</li>
							@endif


						@endforeach
					</ul>
				</nav>
				<div class="wrapper clearfix small p-10">
					@foreach (quickAccess() as $key => $entity)
						<div class="text-center-folded">
                        <span class="hidden-folded">
                            <a class="text-ellipsis" href="{{ $entity['url'] }}">
                                {{ str_limit($entity['name'], 25) }}
                            </a>
                        </span>
						</div>
						<div class="progress progress-xxs m-t-xs dk">
							<div class="progress-bar progress-bar-success" data-placement="top" data-rel="tooltip"
								 style="width: {{ $entity['progress'] }}%;" title="{{ $entity['progress'] }}%">
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</section>
		<footer class="footer lt hidden-xs b-t b-dark" id="changeLanguages">
			{{-- <a class="pull-right btn btn-sm btn-dark btn-icon" data-toggle="class:nav-xs" href="#nav">

			</a> --}}
			@if (settingEnabled('enable_languages'))
				<div class="btn-group dropup pull-right">
					<button class="btn btn-{{ get_option('theme_color') }} btn-xs dropdown-toggle"
							data-toggle="dropdown" aria-expanded="false">
						@icon('solid/chevron-up')
					</button>
					<ul class="dropdown-menu">
						@foreach (languages() as $lang)
							<li class="">
								<a href="{{ route('setLanguage', ['lang' => $lang['code']]) }}"
								   title="{{ ucwords(str_replace('_', ' ', $lang['name'])) }}">
									{{ ucwords(str_replace('_', ' ', $lang['name'])) }}
								</a>
							</li>
						@endforeach
					</ul>
				</div>
			@endif
			<div class="btn-group hidden-nav-xs">
			</div>
		</footer>
	</section>
</aside>
