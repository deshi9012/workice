@extends('layouts.app')

@section('content')

<section id="content" class="bg">

            <section class="vbox">

              <header class="header bg-white b-b clearfix">
                  <div class="row m-t-sm">
                    <div class="col-sm-5 m-b-xs m-t-xs">
                    <span class="h3">@langapp('contacts')</span>
                      
                    </div>
                    <div class="col-sm-7 m-b-xs">
                    
                    @can('contacts_create')
                    
                        <div class="btn-group pull-right">
                          <button class="btn btn-{{ get_option('theme_color') }} btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">@langapp('import') <span class="caret"></span></button>
                          <ul class="dropdown-menu">
                            <li><a href="{{ route('contacts.import', ['type' => 'contacts']) }}" data-toggle="ajaxModal">@langapp('csv_file')</a></li>
                            <li><a href="{{ route('contacts.import', ['type' => 'google']) }}">Google @langapp('contacts')</a></li>
                          </ul>
                        </div>
                    
                    @endcan

                    @can('contacts_view')
                    <a href="{{ route('contacts.export') }}" class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right">
                      @icon('solid/download') CSV
                    </a>
                    @endcan

                      
                    </div>
                  </div>
                </header>
                
    <section class="scrollable wrapper scrollpane">
                        
{!! Form::open(['route' => 'contacts.search', 'class' => '']) !!}
<div class="input-group m-xs">
  
    <input type="text" class="input-sm form-control contact-search search" name="keyword" placeholder="Enter contact name">
        <span class="input-group-btn"> 
            <button class="btn btn-sm btn-default" type="submit">@icon('solid/search') @langapp('search')</button>
        </span>
</div>
{!! Form::close() !!}           



            <div id="ajaxData"></div>
					




                </section>


            </section>

    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>


@push('pagescript')

  @include('contacts::_scripts._ajax')
  
@endpush

@endsection

