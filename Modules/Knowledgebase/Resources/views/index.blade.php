@extends('layouts.app')
@section('content')
@php $categories = App\Entities\Category::with('articles')->whereModule('knowledgebase')->get(); @endphp
<section id="content">
    <section class="hbox stretch">
        <aside>
            <section class="vbox">
                <header class="header panel-heading bg-white b-b b-light">
                    <div class="btn-group">
                        <button class="btn btn-{{  get_option('theme_color') }} btn-sm dropdown-toggle" data-toggle="dropdown">@langapp('filter') 
                        <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            @foreach ($categories as $cat)
                            <li>
                                <a href="{{  route('kb.index', ['sort' => $cat->id]) }}">
                                    {{ $cat->name }}
                                </a>
                            </li>
                            @endforeach
                            <li>
                                <a href="{{  route('kb.index') }}">
                                    @langapp('all') 
                                </a>
                            </li>
                        </ul>
                    </div>
                    @can('articles_create')
                    <a href="{{ route('kb.category.show') }}" class="btn btn-sm btn-{{ get_option('theme_color') }} pull-right" data-toggle="ajaxModal" data-rel="tooltip" title="@langapp('category')" data-placement="bottom">
                        @icon('solid/cogs')
                    </a>
                    
                    <a href="{{  route('kb.create')  }}" class="btn btn-sm btn-{{  get_option('theme_color') }} pull-right">
                        @icon('solid/plus') @langapp('create') 
                    </a>
                    
                    @endcan
                </header>
                <section class="scrollable wrapper bg">
                    <section class="panel panel-default">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-flat">
                                    <div class="panel-heading">
                                        <h6 class="panel-title">Browse articles</h6>
                                    </div>
                                    <div class="panel-body">

                                        @if(request('sort'))
                                            @php
                                            $categories = App\Entities\Category::with('articles')->whereModule('knowledgebase')->where('id', request('sort'))->get();
                                            @endphp
                                        @endif


                                        @foreach ($categories->chunk(3) as $chunk)
                                        <div class="row">
                                            @foreach ($chunk as $group)

                                            <div class="col-md-4">
                                                <div class="content-group">
                                                    <h6 class="heading-divided">
                                                    @icon('solid/folder-open', 'position-left') {{ $group->name }}
                                                    <small class="position-right">({{ count($group->articles) }})</small>
                                                    </h6>
                                                    <div class="list-group no-border">
                                                        @foreach ($group->articles->take(10) as $article)
                                                        <a href="{{  route('kb.view', ['id' => $article->id])  }}" class="list-group-item text-ellipsis">
                                                            @icon('solid/lightbulb', 'text-danger') {{ $article->subject }}
                                                            @if ($article->active === 0)
                                                            <span class="label label-danger">@langapp('closed') </span>
                                                            @endif
                                                        </a>
                                                        @endforeach
                                                        
                                                        @if (count($group->articles) > 10)
                                                        <a href="#" class="list-group-item">
                                                            @icon('solid/angle-right') Show all articles({{ count($group->articles) }})
                                                        </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>


                                            @endforeach
                                        </div>
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </section>
                </section>
            </section>
        </aside>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>

@endsection