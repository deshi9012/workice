@extends('layouts.app')

@section('content')

<section id="content">
    <section class="hbox stretch">
        @include('partial.settings_menu')

        <aside>
            <section class="vbox">

                <section class="scrollable wrapper bg">



<form method="POST" accept-charset="UTF-8" id="form-strings" class="form-horizontal">


<section class="panel panel-default">
    <header class="panel-heading padder-v">@icon('solid/language')

        @langapp('translations')   | <a
                href="{{  route('translations.view', ['locale' => $lang->code])  }}">{{  ucwords($lang->name)  }}</a>
         | {{  mb_strtolower($filename)  }}.php
        <button type="submit" id="save-translation" class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right saving">@icon('solid/check') @langapp('save')
        </button>
    </header>
    <div class="table-responsive">
        <table id="table-strings" class="table table-striped b-t b-light AppendDataTables">
            <thead>
            <tr>
                <th class="col-xs-5">English</th>
                <th class="col-xs-7">{{  ucwords($lang->name)  }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($keys as $key => $value)
                <tr>
                    <td>{{ trans($filename.'.'.$key, [], 'en')  }}</td>
                    <td><input class="form-control" width="100%" type="text"
                               value="{{ $value }}"
                               name="{{ $key }}"/></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>




    </section>

</form>

            </section>
        </aside>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>

@push('pagescript')
<script>
    $('#save-translation').on('click', function (e) {
        e.preventDefault();
        $(".saving").html('Saving..<i class="fas fa-spin fa-spinner"></i>');

        axios.post('{{ route('translations.save') }}', {
            "locale":'{{ $lang->code }}', 
            "filename":'{{ $filename }}', 
            "json": JSON.stringify($('#form-strings').serializeArray())
        }).then(function (response) {
            $(".saving").html('<i class="fas fa-check"></i> @langapp('save') </span>');
            toastr.success("@langapp('translation_updated_successfully') ", "@langapp('response_status') ");
            window.location.href = response.data.redirect;
        }).catch(function (error) {
            var errors = error.response.data.errors;
                var errorsHtml= '';
                $.each( errors, function( key, value ) {
                    errorsHtml += '<li>' + value[0] + '</li>'; 
                });
                toastr.error( errorsHtml , '@langapp('response_status') ');
                $(".saving").html('<i class="fas fa-sync"></i> Try Again</span>');
        }); 
            });
        </script>
@endpush

@endsection
