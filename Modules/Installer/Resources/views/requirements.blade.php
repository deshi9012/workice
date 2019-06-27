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
                    <li data-target="#step1" class="active">Requirements</li>
                    <li data-target="#step2">Permissions</li>
                    <li data-target="#step3">Configuration</li>
                  </ul>
                </div>
                <div class="step-content clearfix">
                  

                 @foreach($requirements['requirements'] as $type => $requirement)
        <ul class="list">
            <li class="list__item list__title {{ $phpSupportInfo['supported'] ? 'success' : 'error' }}">
                <strong>{{ ucfirst($type) }}</strong>
                @if($type == 'php')
                    <strong>
                        <small>
                            (version {{ $phpSupportInfo['minimum'] }} required)
                        </small>
                    </strong>
                    <span class="pull-right">
                        <strong>
                            {{ $phpSupportInfo['current'] }}
                        </strong>
                        <span class="text-{{ $phpSupportInfo['supported']  ? 'success' : 'danger' }}">{{ $phpSupportInfo['supported'] ? '✔' : '✘' }}</span>
                    </span>
                @endif
            </li>
            @foreach($requirements['requirements'][$type] as $extention => $enabled)
                <li class="list__item {{ $enabled ? 'success' : 'error' }}">
                    {{ $extention }}
                    <span class="pull-right">
                        <span class="text-{{ $enabled  ? 'success' : 'danger' }}">{{ $enabled ? '✔' : '✘' }}</span>
                </span>
                </li>
            @endforeach
        </ul>
    @endforeach

    @if ( ! isset($requirements['errors']) && $phpSupportInfo['supported'] )
        <div class="buttons m-t-xs">
            <a class="btn btn-info btn-block" href="{{ route('LaravelInstaller::permissions') }}">
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