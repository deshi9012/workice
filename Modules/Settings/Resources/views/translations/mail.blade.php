@extends('layouts.app')
@section('content')
<section id="content">
    <section class="hbox stretch">
        @include('partial.settings_menu')
        <aside>
            <section class="vbox">
                <section class="scrollable wrapper bg">
                    <section class="panel panel-default">
                    <header class="panel-heading padder-v">@icon('solid/envelope-open') Email @langapp('translations')</header>
                    <div class="table-responsive">
                        <table id="table-translations" class="table table-striped language-list">
                            <thead>
                                <tr>
                                    <th>@langapp('language')</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Entities\Language::all() as $l)
                                <tr id="language-{{ $l->id }}">
                                    <td class="">{{  ucwords(str_replace('_', ' ', $l->name))  }}</td>
                                    <td class="text-right">
                                        
                                        
                                        <a data-rel="tooltip" data-original-title="@langapp('make_changes')" class="btn btn-xs btn-default"
                                            href="{{  route('translations.mail.change', $l->code)  }}">
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
        </aside>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen, open" data-target="#nav,html"></a>
</section>
@endsection