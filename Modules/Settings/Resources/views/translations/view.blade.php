@extends('layouts.app')

@section('content')

<section id="content">
    <section class="hbox stretch">
        @include('partial.settings_menu')

        <aside>
            <section class="vbox">

                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">


                    </div>
                </header>
                <section class="scrollable wrapper">

               
<section class="panel panel-default">
        <header class="panel-heading">@icon('solid/language') @langapp('translations')  
            - {{  ucwords($lang->name)  }}</header>
        <div class="table-responsive">
            <table id="table-translations-files" class="table table-striped">
                <thead>
                <tr>
                    <th class="col-xs-3">@langapp('file')  </th>
                    <th class="col-xs-1">@langapp('total')  </th>
                    <th class="col-options no-sort col-xs-1">@langapp('action')  </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($files as $key => $file)
                @php $file = pathinfo($file); @endphp
                    <tr>
                        <td class="">
                            <a href="{{  route('translations.edit', ['locale' => $lang->code ,'file' => $file['filename']])  }}">{{ $file['basename'] }}</a>
                        </td>
                        
                        <td class="">{{ count(\Lang::get($file['filename'], [], $lang->code)) }} Lines</td>
                        <td class="">
                            <a href="{{ route('translations.edit', ['locale' => $lang->code ,'file' => $file['filename']]) }}">
                               @icon('solid/pencil-alt')
                           </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

                </section>
            </section>
        </aside>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>


@endsection