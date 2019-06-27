@extends('layouts.app')
@section('content')
<section id="content">
    <section class="hbox stretch">
        <aside>
            <section class="vbox">
                <header class="header bg-white b-b clearfix">
                    <div class="row m-t-sm">
                        <div class="col-sm-8 m-b-xs">
                        </div>
                        <div class="col-sm-4 m-b-xs">
                        </div>
                    </div>
                </header>
                <section class="scrollable wrapper bg">
                    {!! Form::open(['route' => 'kb.save', 'class' => 'm-b-sm ajaxifyForm']) !!}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>@langapp('subject') @required</label>
                                <input type="text" placeholder="e.g Installation" name="subject"
                                class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label>@langapp('category')  @required</label>
                                <select name="group" class="form-control" required>
                                    @foreach (App\Entities\Category::whereModule('knowledgebase')->get() as $cat)
                                    <option value="{{  $cat->id  }}">{{  $cat->name  }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>@langapp('description') @required</label>
                        <textarea name="description" class="form-control markdownEditor height300"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="hidden" name="allow_comments" value="0">
                                <input type="checkbox" name="allow_comments" value="1" checked>
                                <span class="label-text" data-rel="tooltip" title="Allow users to comment on article" data-placement="right">@langapp('allow_comments')</span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="hidden" name="active" value="0">
                                <input type="checkbox" name="active" value="1" checked>
                                <span class="label-text" data-rel="tooltip" title="Show on clients portal" data-placement="right">@langapp('published')</span>
                            </label>
                        </div>
                    </div>
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <input type="hidden" name="slug" value="subject">
                    <div class="text-right">
                        {!! renderAjaxButton()  !!}
                    </div>
                    {!! Form::close() !!}
                </section>
            </div>
        </section>
    </div>
</section>
</section>
</aside> </section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
@push('pagescript')
@include('stacks.js.markdown')
@endpush
@endsection