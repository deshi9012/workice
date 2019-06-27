<header class="header b-b clearfix">
    <div class="row m-t-sm">
        <div class="col-sm-12 m-b-xs">

            @can('files_create')
                <a href="{{  route('files.upload', ['module' => 'leads', 'id' => $lead->id])  }}"
                   class="btn btn-{{ get_option('theme_color') }} btn-sm pull-right" data-toggle="ajaxModal"
                   data-placement="left" title="@langapp('upload_file')  ">
                    @icon('solid/cloud-upload-alt') @langapp('upload_file')  </a>
            @endcan


        </div>
    </div>
</header>


<div class="">

    @include('partial._show_files', ['files' => $lead->files])

</div>

@if(settingEnabled('filestack_active'))
@push('pagescript')
<script src="//static.filestackapi.com/v3/filestack.js"></script>
@endpush
@endif