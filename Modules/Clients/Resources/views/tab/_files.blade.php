<div class="col-md-12">
    <header class="panel-heading">
        @can('files_create')
        <a href="{{  route('files.upload', ['module' => 'clients', 'id' => $company->id])  }}"
            class="btn btn-{{ get_option('theme_color') }} btn-sm" data-toggle="ajaxModal"
            data-placement="left" title="@langapp('upload_file')  ">
        @icon('solid/cloud-upload-alt') @langapp('upload_file')  </a>
        @endcan
        
    </header>
    
    
    @include('partial._show_files', ['files' => $company->files])
    
    @if(settingEnabled('filestack_active'))
        @push('pagescript')
            <script src="https://static.filestackapi.com/v3/filestack.js"></script>
        @endpush
    @endif
</div>