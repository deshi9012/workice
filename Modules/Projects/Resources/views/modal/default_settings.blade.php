<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-success">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{ __('Default Project Settings') }}</h4>
        </div>

        {!! Form::open(['route' => ['projects.default.setup'], 'class' => 'bs-example form-horizontal ajaxifyForm']) !!}


        <div class="modal-body">
            <p>{{ __('Select your default project settings') }}</p>

            @php $defaults = array_keys(json_decode(get_option('default_project_settings'), true)); @endphp

            @foreach (Modules\Projects\Entities\ProjectSetting::all() as $config)
                
                <div class="checkbox">
                <label>
                    <input name="{{ $config->setting }}" type="checkbox" {{ in_array($config->setting, $defaults) ? 'checked' : '' }}>
                    <span class="label-text">{{ $config->description }}</span>
                </label>
            </div>

            @endforeach
            

            <div class="line line-dashed line-lg pull-in"></div>


        </div>
        <div class="modal-footer">
            
            {!! closeModalButton() !!}
            {!! renderAjaxButton() !!}
            
        </div>
        {!! Form::close() !!}
    </div>
</div>

@include('partial.ajaxify')