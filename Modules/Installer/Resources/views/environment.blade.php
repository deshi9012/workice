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
            <li data-target="#step2">Permissions</li>
            <li data-target="#step3" class="active">Configuration</li>
          </ul>
        </div>
        <div class="step-content clearfix">
          @if(session('message')['status'])
          <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            ✘ Database connection/migration failed..
          </div>
          @endif
          
          <form method="post" action="{{ route('LaravelInstaller::environmentSaveWizard') }}" class="config-form tabs-wrap">
            <h4 class="text-muted">➤
            Environment
            </h4>
            
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group {{ $errors->has('app_name') ? ' has-error ' : '' }}">
              <label for="app_name">
                App Name <span class="text-danger">*</span>
              </label>
              <input type="text" name="app_name" id="app_name" class="form-control" value="{{ old('app_name') }}" placeholder="Workice" required>
              @if ($errors->has('app_name'))
              <span class="text-danger error-block help-block">
                <i class="fas fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                {{ $errors->first('app_name') }}
              </span>
              @endif
            </div>
            
            
            
            <div class="form-group {{ $errors->has('app_url') ? ' has-error ' : '' }}">
              <label for="app_url">
                App Url <span class="text-danger">*</span>
              </label>
              <input type="url" class="form-control" name="app_url" id="app_url" value="{{ request()->getSchemeAndHttpHost() }}" placeholder="https://portal.example.com" required>
              @if ($errors->has('app_url'))
              <span class="help-block text-danger error-block help-block">
                <i class="fas fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                {{ $errors->first('app_url') }}
              </span>
              @endif
            </div>
            
            
            
            <h4 class="text-muted">➤
            Database
            </h4>
            <div class="form-group {{ $errors->has('database_connection') ? ' has-error ' : '' }}">
              <label for="database_connection">
               Database Connection <span class="text-danger">*</span>
              </label>
              <select name="database_connection" class="form-control" id="database_connection">
                <option value="mysql" selected>Mysql</option>
                <option value="sqlite">Sqlite</option>
                <option value="pgsql">Pgsql</option>
                <option value="sqlsrv">Sqlsrv</option>
              </select>
              @if ($errors->has('database_connection'))
              <span class="text-danger error-block help-block">
                <i class="fas fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                {{ $errors->first('database_connection') }}
              </span>
              @endif
            </div>
            <div class="form-group {{ $errors->has('database_hostname') ? ' has-error ' : '' }}">
              <label for="database_hostname">
                Database host <span class="text-danger">*</span>
              </label>
              <input type="text" class="form-control" name="database_hostname" id="database_hostname" value="{{ old('database_hostname') }}" placeholder="localhost/127.0.0.1" required>
              @if ($errors->has('database_hostname'))
              <span class="text-danger error-block help-block">
                <i class="fas fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                {{ $errors->first('database_hostname') }}
              </span>
              @endif
            </div>
            <div class="form-group {{ $errors->has('database_port') ? ' has-error ' : '' }}">
              <label for="database_port">
                Database Port <span class="text-danger">*</span>
              </label>
              <input type="number" class="form-control" name="database_port" id="database_port" value="{{ old('database_port', '3306') }}" placeholder="3306" required>
              @if ($errors->has('database_port'))
              <span class="text-danger error-block help-block">
                <i class="fas fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                {{ $errors->first('database_port') }}
              </span>
              @endif
            </div>
            <div class="form-group {{ $errors->has('database_name') ? ' has-error ' : '' }}">
              <label for="database_name">
                Database Name <span class="text-danger">*</span>
              </label>
              <input type="text" class="form-control" name="database_name" id="database_name" value="{{ old('database_name') }}" placeholder="db_workice" required>
              @if ($errors->has('database_name'))
              <span class="text-danger error-block help-block">
                <i class="fas fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                {{ $errors->first('database_name') }}
              </span>
              @endif
            </div>
            <div class="form-group {{ $errors->has('database_username') ? ' has-error ' : '' }}">
              <label for="database_username">
                Database Username <span class="text-danger">*</span>
              </label>
              <input type="text" class="form-control" name="database_username" id="database_username" value="{{ old('database_username') }}" placeholder="Database Username" required>
              @if ($errors->has('database_username'))
              <span class="text-danger error-block help-block">
                <i class="fas fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                {{ $errors->first('database_username') }}
              </span>
              @endif
            </div>
            <div class="form-group {{ $errors->has('database_password') ? ' has-error ' : '' }}">
              <label for="database_password">
                Database Password <span class="text-danger">*</span>
              </label>
              <input type="password" class="form-control" name="database_password" id="database_password" value="{{ old('database_password') }}" placeholder="Database Password" required>
              @if ($errors->has('database_password'))
              <span class="text-danger error-block help-block">
                <i class="fas fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                {{ $errors->first('database_password') }}
              </span>
              @endif
            </div>
            
            
            
            <h4 class="text-muted">➤
            Account Details
            </h4>
            <div class="block">
              
              
              <div class="info">
                <div class="form-group {{ $errors->has('user.name') ? ' has-error ' : '' }}">
                  <label for="fullname">Fullname <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="user[name]" value="{{ old('user.name') }}" placeholder="John Doe" required>
                  @if ($errors->has('user.name'))
                  <span class="text-danger error-block help-block">
                    <i class="fas fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('user.name') }}
                  </span>
                  @endif
                </div>
                <div class="form-group {{ $errors->has('user.email') ? ' has-error ' : '' }}">
                  <label for="email">Email <span class="text-danger">*</span></label>
                  <input type="email" class="form-control" name="user[email]" value="{{ old('user.email') }}" placeholder="johndoe@example.com" required>
                  @if ($errors->has('user.email'))
                  <span class="text-danger error-block help-block">
                    <i class="fas fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('user.email') }}
                  </span>
                  @endif
                </div>
                <div class="form-group {{ $errors->has('profile.job_title') ? ' has-error ' : '' }}">
                  <label for="job_title">Job Title</label>
                  <input type="text" class="form-control" name="profile[job_title]" value="{{ old('profile.job_title') }}" placeholder="Project Manager" required>
                  @if ($errors->has('profile.job_title'))
                  <span class="text-danger error-block help-block">
                    <i class="fas fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('profile.job_title') }}
                  </span>
                  @endif
                </div>
                <div class="form-group {{ $errors->has('user.password') ? ' has-error ' : '' }}">
                  <label for="password">Admin Password</label>
                  <input type="password" class="form-control" name="user[password]" value="{{ old('user.password') }}" placeholder="Password" required>
                  @if ($errors->has('user.password'))
                  <span class="text-danger error-block help-block">
                    <i class="fas fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                    {{ $errors->first('user.password') }}
                  </span>
                  @endif
                </div>
                
                
                
                
              </div>
            </div>
            
            
            
            <div class="buttons">
              <button class="btn btn-block btn-info formSaving" type="submit">
              Install
              </button>
              
            </div>
            
          </form>
          
          
          
          
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

@section('scripts')
  <script>
    $('.config-form').submit(function (event) {
        $(".formSaving").html('Installing..➤');
      });
  </script>
@endsection
@endsection