@extends('layouts.app')
@section('content')

<section id="content">
    <section class="hbox stretch">
        <aside>
            <section class="vbox">
                <header class="header bg-white b-b clearfix hidden-print">
                    <div class="row m-t-sm">
                        <div class="col-md-12">
                            <a href="{{  route('kb.index') }}"
                                class="btn btn-sm btn-{{  get_option('theme_color')  }} btn-responsive"
                                data-toggle="tooltip" data-placement="right"
                                title="@langapp('knowledgebase')  ">
                            @icon('solid/level-up-alt') @langapp('knowledgebase')  </a>
                            @if (can('articles_create') || $article->user_id == Auth::id())
                            <a href="{{  route('kb.edit', ['id' => $article->id]) }}"
                                class="btn btn-sm btn-{{  get_option('theme_color')  }} btn-responsive"
                                title="@langapp('edit')  ">@icon('solid/pencil-alt') @langapp('edit')
                            </a>
                            @endif
                            @if (can('articles_delete') || $article->user_id == Auth::id())
                            <a href="{{  route('kb.delete', ['id' => $article->id]) }}" data-toggle="ajaxModal"
                                class="btn btn-sm btn-{{  get_option('theme_color')  }} pull-right"
                                title="@langapp('delete')  ">@icon('solid/trash-alt')
                            </a>
                            @endif
                        </div>
                    </div>
                </header>
                <section class="scrollable wrapper bg with-responsive-img kb-pad">
                    <div class="col-md-8">
                        <div class="content-group-lg">
                            <h3 class="mb-5">
                            <a href="" class="text-default">{{ $article->subject }}</a>
                            </h3>
                            @if($article->active == 0)
                            <div class="alert alert-warning alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <p>@icon('solid/exclamation-circle') This article is not published yet</p>
                            </div>
                            @endif
                            <ul class="list-inline list-inline-separate text-muted content-group small">
                                <li>By <a href="#" class="text-muted">{{ $article->user->name  }}  </a></li>
                                <li>
                                    @icon('solid/calendar-alt') {{ dateTimeFormatted($article->created_at) }}
                                </li>
                                @if ($article->allow_comments)
                                <li>
                                    <a href="#comments" data-rel="tooltip" title="@langapp('comments')">
                                        @icon('solid/comments') {{ $article->comments_count }} @langapp('comments')
                                    </a>
                                </li>
                                @endif
                                <li><a href="#" data-rel="tooltip" title="@langapp('views')">@icon('solid/eye') {{ $article->views }}</a></li>
                                <li><a href="#" data-rel="tooltip" title="@langapp('reviews')">@icon('regular/star') {{ $article->rating }}%</a></li>
                            </ul>
                            <div class="content-group text-justify">
                                @parsedown($article->description)
                            </div>
                            <div class="m-sm">
                                <a href="{{ route('kb.vote', ['id' => $article->id, 'rated' => 1]) }}" class="btn btn-success btn-sm btn-rounded">
                                    @icon('solid/thumbs-up') +1 this topic
                                </a>
                                <a href="{{ route('kb.vote', ['id' => $article->id, 'rated' => 0]) }}" class="btn btn-danger btn-sm btn-rounded pull-right">
                                    @icon('solid/thumbs-down') -1 this topic
                                </a>
                                
                            </div>
                        </div>
                        @if ($article->allow_comments)
                        <div class="panel-heading">
                            <h3 class="panel-title" id="comments">@langapp('comments')  </h3>
                        </div>
                        <div class="m-xs">
                            
                            <section class="comment-list block">
                                <article class="comment-item" id="comment-form">
                                    <a class="pull-left thumb-sm avatar">
                                        <img src="{{ avatar() }}" class="img-circle">
                                    </a>
                                    <span class="arrow left"></span>
                                    <section class="comment-body">
                                        <section class="panel panel-default">
                                            @widget('Comments\CreateWidget', ['commentable_type' => 'knowledgebase' , 'commentable_id' => $article->id, 'hasFiles' => true])
                                            
                                            
                                        </section>
                                    </section>
                                </article>
                                
                                
                                
                                @widget('Comments\ShowComments', ['comments' => $article->comments, 'withReplies' => true])
                                
                                
                                
                            </section>
                            
                            
                        </div>
                        
                        @endif
                    </div>
                    <div class="col-md-4">
                        <section class="panel panel-default">
                        <header class="panel-heading">@langapp('related_articles')</header>
                        <ul class="list-group alt">
                            @foreach (Modules\Knowledgebase\Entities\Knowledgebase::whereGroup($article->group)->orderByDesc('id')->get() as $related)
                            <li class="list-group-item">
                                <div class="media">
                                    
                                    
                                    <div class="media-body">
                                        <div>
                                            <a href="{{ route('kb.view', ['id' => $related->id]) }}" data-rel="tooltip" data-title="{{ $related->subject }}">
                                                {{ $related->subject }}
                                            </a>
                                            <p>@parsedown(str_limit($related->description, 100))</p>
                                            <div class="m-xs text-muted small">@langapp('created_at'): {{ dateTimeString($related->created_at) }} </div>
                                        </div>
                                        <span class="text-muted small">
                                            <span data-rel="tooltip" title="@langapp('views')">@icon('solid/desktop') {{ $related->views }}</span>
                                            <span class="pull-right" data-rel="tooltip" title="@langapp('comments')">@icon('regular/comments') {{ $related->comments_count }}</span>
                                        </span>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </section>
                </div>
            </section>
        </section>
    </aside>
</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
@push('pagescript')
@include('stacks.js.markdown')
@include('comments::_ajax.ajaxify')
@endpush
@endsection