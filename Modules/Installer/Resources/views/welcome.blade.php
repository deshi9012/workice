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
                    <li data-target="#step1" class="active"><span class="badge badge-info">1</span>Step 1</li>
                    <li data-target="#step2"><span class="badge">2</span>Step 2</li>
                    <li data-target="#step3"><span class="badge">3</span>Step 3</li>
                  </ul>
                </div>
                <div class="step-content clearfix">
                  

                   <p class="text-center">
              Easy installation and setup wizard
            </p>

            <p class="text-center">
  <a href="{{ route('LaravelInstaller::requirements') }}" class="btn btn-info btn-block">
    Check Requirements
    <i class="fas fa-angle-right fa-fw" aria-hidden="true"></i>
  </a>
</p>

                  
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