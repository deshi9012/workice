<header class="header b-b clearfix">
        <div class="col-sm-12">

            @can('files_create')
                <a href="{{  route('files.upload', ['module' => 'users', 'id' => $user->id]) }}"
                   class="btn btn-{{ get_option('theme_color') }} btn-sm pull-right" data-toggle="ajaxModal"
                   data-placement="left" title="@langapp('upload_file')  ">
                    @icon('solid/cloud-upload-alt') @langapp('upload_file')  </a>
            @endcan

        </div>
</header>


        @include('partial._show_files', ['files' => $user->files])
            


@if(settingEnabled('filestack_active'))
@push('pagescript')
	<script src="//static.filestackapi.com/v3/filestack.js"></script>
@endpush
@endif