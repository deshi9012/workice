@extends('installer::layouts.master')
@section('content')
<section id="content" class="wrapper-md installer content">
  <div class="container aside-xxl animated fadeInUp">
    <section class="panel panel-default bg-white m-t-sm b-r-xs">
      <header class="panel-heading text-center login-heading">
        <strong>Workice CRM Installation</strong>
      </header>
      <div class="panel-body">
        @if (session('message')['status'] === 'success')
        <div class="alert alert-success">
          <button type="button" class="close" id="close_alert" data-dismiss="alert" aria-hidden="true">
          <i class="fas fa-close" aria-hidden="true"></i>
          </button>
          <span class="text-sm">
            @icon('solid/check-circle') {{ session('message')['message'] }}
          </span>
        </div>
        @endif
        
        <p><strong>Migration and seed output:</strong></p>
      <pre><code>database migrations and seeds completed</code></pre>
      <p><strong>Application Console Output:</strong></p>
    <pre><code>published successfully</code></pre>
    <p><strong>Final .env file</strong></p>
  <pre><code>application configuration completed</code></pre>
  <a href="{{ url('/') }}" class="btn btn-block btn-info">Exit</a>
</div>
</section>
</div>
</section>
@endsection