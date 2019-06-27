@extends('layouts.app') 
@section('content')
<section id="content" class="">
	
	<section class="vbox">
		<header class="header panel-heading bg-white b-b b-light">
			<div class="btn-group">
				<button class="btn btn-{{  get_option('theme_color') }} btn-sm dropdown-toggle" data-toggle="dropdown"> @langapp('filter')
				<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<li>
						<a href="{{  route('contracts.index', ['filter' => 'viewed'])  }}">
							@langapp('viewed')
						</a>
					</li>
					<li>
						<a href="{{  route('contracts.index', ['filter' => 'draft'])  }}">
							@langapp('draft')
						</a>
					</li>
					<li>
						<a href="{{  route('contracts.index', ['filter' => 'signed'])  }}">
							@langapp('signed')
						</a>
					</li>
					<li>
						<a href="{{  route('contracts.index', ['filter' => 'sent'])  }}">
							@langapp('sent')
						</a>
					</li>
					<li>
						<a href="{{  route('contracts.index', ['filter' => 'expired'])  }}">
							@langapp('expired')
						</a>
					</li>
					<li>
						<a href="{{  route('contracts.index', ['filter' => 'rejected'])  }}">
							@langapp('rejected')
						</a>
					</li>
					<li>
						<a href="{{  route('contracts.index')  }}">@langapp('contracts') </a>
					</li>
				</ul>
			</div>
			@can('contracts_create')
			<a href="{{  route('contracts.create')  }}" class="btn btn-{{  get_option('theme_color') }} btn-sm pull-right" title="@langapp('create')  ">
			@icon('solid/plus') @langapp('create') </a>
			@endcan
		</header>
		<section class="scrollable wrapper scrollpane bg">

			<div id="ajaxData"></div>
				
			
		</section>
	</section>
	<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>

@push('pagescript')
  @include('contracts::_scripts._contracts')
@endpush

@endsection