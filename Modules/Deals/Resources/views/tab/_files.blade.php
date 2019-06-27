<div class="col-sm-12">
	@can('files_create')
	<header class="header b-b clearfix">
		<a href="{{  route('files.upload', ['module' => 'deals', 'id' => $deal->id]) }}"
			class="btn btn-{{ get_option('theme_color') }} btn-sm pull-right" data-toggle="ajaxModal"
			data-placement="left" title="@langapp('upload_file')  ">
		@icon('solid/cloud-upload-alt') @langapp('upload_file')  </a>
	</header>
	@endcan
	@include('partial._show_files', ['files' => $deal->files])
	@if(settingEnabled('filestack_active'))
		@push('pagescript')
			<script src="//static.filestackapi.com/v3/filestack.js"></script>
		@endpush
	@endif
</div>