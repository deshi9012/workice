@extends('layouts.app')

@section('content')

<section id="content" class="bg">
    <section class="hbox stretch">

        @include('partial.settings_menu')

        <aside>
            <section class="vbox">

                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">


                    </div>
                </header>
                <section class="scrollable wrapper custom-fields">

                <div class="alert alert-danger">@langapp('custom_field_warning')</div>

    {!! Form::open(['route' => 'fields.save', 'class' => 'ajaxifyForm']) !!}


                    <div class="table-head">{{  ucfirst($module)  }} @langapp('custom_fields')
                        <span class="pull-right">
    <span class="label label-warning changes">Unsaved</span>
  <input type="submit" class="btn btn-primary btn-sm save button-loader formSaving" value="Save" disabled="disabled"></span>
                        <input type="hidden" name="module" value="{{ $module }}"/>
                        <input type="hidden" name="deptid" value="{{ $department }}"/>
                        <input type="hidden" name="uniqid" value="{{ genUnique() }}"/>
                    </div>
                    <div class="table-div">
                        <br>

                        <textarea id="formcontent" class="hidden" name="formcontent"></textarea>

                     
                        <div class='fb-main'></div>
                    </div>
                        
                        {!! Form::close() !!}

                </section>
            </section>
        </aside>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>

@push('pagestyle')
    <link rel="stylesheet" href="{{ getAsset('plugins/formbuilder/formbuilder.css') }}" type="text/css"/>
@endpush

@push('pagescript')

<script src="{{ getAsset('plugins/formbuilder/formbuilder_vendor.js') }}"></script>
<script src="{{ getAsset('plugins/formbuilder/formbuilder.js') }}"></script>
    
<script>
    $(function () {

        fb = new Formbuilder({
            selector: '.fb-main',
            bootstrapData: [
                @foreach ($fields as $f) 
                {
                    "label": "{{ $f->label }}",
                    "field_type": "{{ $f->type }}",
                    "required": "{{ $f->required == 1 ? true : false  }}",
                    "cid": "{{ $f->cid }}",
                    'uniqid': "{{ $f->uniqid }}",
                    'module': "{{ $f->module }}",
                    "field_options":{!! json_encode($f->field_options) !!},
                },
                @endforeach
            ]
        });

        fb.on('save', function (payload) {
            $("#formcontent").text(payload);
        });


        switch (window.orientation) {

            case 0:
                alert('Please turn your phone sideways in order to use this page!');
                break;

        }

    });
</script>
@endpush

@endsection