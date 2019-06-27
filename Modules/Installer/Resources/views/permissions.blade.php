@extends('installer::layouts.master')
@section('content')
<section id="content" class="wrapper-md installer content">
  <div id="login-form" class="container aside-xxl animated fadeInUp">
    <section class="panel panel-default bg-white m-t-sm b-r-xs">
      <header class="panel-heading text-center login-heading">
        <strong>Workice CRM Installation</strong>
      </header>
      <div class="wizard">
        <div class="wizard-steps clearfix" id="form-wizard">
          <ul class="steps">
                    <li data-target="#step1">Requirements</li>
                    <li data-target="#step2" class="active">Permissions</li>
                    <li data-target="#step3">Configuration</li>
                  </ul>
        </div>
        <div class="step-content clearfix">
          
          <ul class="list">
            @foreach($permissions['permissions'] as $permission)
            <li class="list__item list__item--permissions {{ $permission['isSet'] ? 'success' : 'error' }}">
             ➤ {{ $permission['folder'] }}
              <span class="pull-right">
                <span class="text-{{ $permission['isSet']  ? 'success' : 'danger' }}">{{ $permission['isSet'] ? '✔' : '✘' }}</span>
                {{ $permission['permission'] }}
              </span>
            </li>
            @endforeach
          </ul>
          @if ( ! isset($permissions['errors']))
          <div class="buttons m-t-xs">
            <a href="{{ route('LaravelInstaller::environment') }}" class="btn btn-info btn-block">
              Next
            </a>
          </div>
          @endif
          
        </div>
      </div>
      {{-- Footer --}}
      @if (!settingEnabled('hide_branding'))
      @include('partial.branding')
      @endif
      {{-- /Footer --}}
    </section>
  </div>
</section>
@endsection