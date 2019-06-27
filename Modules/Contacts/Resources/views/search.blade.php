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
      
      @foreach ($contacts->chunk(4) as $chunk)
      <div class="row">
        @foreach ($chunk as $contact)
        <div class="col-lg-3 col-md-6">
          <div class="thumbnail">
            <div class="thumb thumb-rounded">
              <a href="{{ route('contacts.view', $contact->user_id) }}">
                <img src="{{ $contact->photo }}" alt="" class="avatar-img">
              </a>
              
            </div>
            
            <div class="caption text-center">
              <h6>
              <a href="{{ route('contacts.view', $contact->user_id) }}" >
                {{ $contact->name }}
              </a>
              <span class="display-block text-muted m-xs">{{ $contact->job_title }}</span>
              @if($contact->company > 0)
              <span class="display-block text-muted m-xs">{{ optional($contact->business)->name }}</span>
              @endif
              </h6>
              <p class="m-t-sm">
                
                @if(!empty($contact->twitter))
                <a href="{{ $contact->twitter }}" target="_blank" class="btn btn-rounded btn-twitter btn-icon">@icon('brands/twitter')</a>
                @endif
                @if(!empty($contact->skype))
                <a href="skype:{{ $contact->skype }}?call" class="btn btn-rounded btn-info btn-icon">@icon('brands/skype')</a>
                @endif
                <a href="{{ route('contacts.email', $contact->user_id) }}" class="btn btn-rounded btn-dracula btn-icon" data-toggle="ajaxModal" data-rel="tooltip" title="@langapp('send_email')">@icon('solid/paper-plane')</a>
                
              </p>
              
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @endforeach
      
    </section>
  </section>
  <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
@endsection