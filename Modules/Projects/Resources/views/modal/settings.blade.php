@if (can('full_control'))

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">@langapp('settings')  </h4>
            </div>

            {!! Form::open(['method' => 'POST', 'route' => 'projects.settings', 'class' => 'ajaxifyForm']) !!}


            
            <input type="hidden" name="project_id" value="{{  $project->id  }}">
            <div class="modal-body">

                @foreach ($project->settings() as $key => $conf)


                    <div class="checkbox">
                        <label class="checkbox-custom">
                            <input name="{{  $conf->setting  }}"
                            @if (array_key_exists($conf->setting, $project->settings))
                                @php $chk = true; @endphp
                                {{ 'checked="checked"' }}
                            @endif type="checkbox">
                            <i class="far fa-fw fa-square @isset($chk) ? 'checked' : '' @endisset"></i>

                            @langapp($conf->setting)  

                        </label>
                    </div>

                    <div class="line line-dashed line-lg pull-in"></div>

                @endforeach


            </div>
            <div class="modal-footer">

                {!! closeModalButton() !!}
                {!! renderAjaxButton()  !!}


            </div>

            {!! Form::close() !!}

        </div>

    </div>


@endif


<script>
    $('.select2-option').select2();
    $('.checkbox-custom').checkbox();
</script>

@include('partial.ajaxify')
