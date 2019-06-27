<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">@icon('solid/exclamation-triangle') Error: 403 Forbidden</h4>
    </div>
    <div class="modal-body">
      <div class="card card-transparent mx-auto text-center">
        <h1 class="text-muted font150">403</h1>
        
        <p class="lead">{{ __('Sorry, access to this resource on the server is denied') }}</p>
        <div class="m-md">
          <a href="{{ route('dashboard.index') }}" class="btn btn-sm btn-success btn-rounded">
            @icon('solid/home') @langapp('dashboard')
          </a>
        </div>
        
      </div>
      
      
    </div>
  </div>
</div>