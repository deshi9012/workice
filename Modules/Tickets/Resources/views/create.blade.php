@extends('layouts.app')
@section('content')
<section id="content">
    <section class="hbox stretch">
        <section class="vbox">
            <header class="header bg-white b-b clearfix">
                <div class="row m-t-sm">
                    <div class="col-sm-8 m-b-xs">
                        
                        <a href="{{ route('kb.index') }}" class="btn btn-sm btn-{{ get_option('theme_color') }}">
                            @icon('solid/lightbulb') @langapp('knowledgebase')
                        </a>
                        
                    </div>
                    <div class="col-sm-4 m-b-xs">
                    </div>
                </div>
            </header>
            <section class="scrollable wrapper bg">
                
                <div class="col-sm-8">
                    <section class="panel panel-default">
                    <header class="panel-heading">@icon('solid/plus') @langapp('create')  </header>
                    <div class="panel-body">
                        {!! Form::open(['route' => 'tickets.api.save', 'class' => 'ajaxifyForm', 'data-toggle' => 'validator', 'files' => true]) !!}

                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="project_id" value="0">

                        <input type="hidden" name="status" value="1">
                        <div class="form-group">
                            <label class="control-label">@langapp('department')@required</label>
                            <div class="m-b">
                                <select name="department" class="form-control" id="selectedDept" onChange="getTicketFields(this.value);" required>
                                    @foreach (App\Entities\Department::all() as $d)
                                    <option value="{{  $d->deptid  }}">{{  ucfirst($d->deptname)  }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>@langapp('subject') @required</label>
                            <input type="text" class="form-control" placeholder="Billing Isssue" name="subject"
                            required>
                        </div>
                        @if (isAdmin() || can('tickets_reporter'))
                        <div class="form-group">
                            <label>@langapp('reporter') @required</label>
                            <div class="m-b">
                                <select class="select2-option form-control" name="user_id" required>
                                    @foreach (Modules\Users\Entities\User::select('id','username', 'name')->offHoliday()->get() as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif

                    @admin
                        <div class="form-group">
                            <label>@langapp('project')</label>
                            <div class="m-b">
                                <select class="select2-option form-control" name="project_id">
                                    <option value="0">None</option>
                                    @foreach (Modules\Projects\Entities\Project::select('id', 'name')->get() as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endadmin


                        <div class="form-group">
                            <label>@langapp('priority') @required</label>
                            <div class="m-b">
                                <select name="priority" class="form-control">
                                    @foreach (App\Entities\Priority::all() as $p)
                                    <option value="{{  $p->id  }}">@langapp(strtolower($p->priority))</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>@langapp('message')</label>
                            <textarea name="body" class="form-control markdownEditor"></textarea>
                        </div>
                        <div id="dept-fields"></div>
                        @admin
                        <div class="form-group">
                            <label class="control-label">@langapp('tags')</label>
                            <select class="select2-tags form-control" name="tags[]" multiple>
                                @foreach (App\Entities\Tag::all() as $tag)
                                <option value="{{  $tag->name  }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endadmin
                        <div class="form-group">
                            <label>@langapp('files')</label>
                            <input type="file" name="uploads[]" multiple="" >
                        </div>

                        @include('partial.privacy_consent')


                        <div class="line line-dashed line-lg pull-in"></div>
                        {!!  renderAjaxButton('open')  !!}
                        {!! Form::close() !!}
                    </div>
                </section>
            </div>
            <div class="col-md-4">
                <section class="panel panel-default">
                <header class="panel-heading"> @langapp('knowledgebase')  </header>
                <ul class="list-group alt">
                    @foreach (Modules\Knowledgebase\Entities\Knowledgebase::active()->inRandomOrder()->get()->take(30) as $article)
                    <li class="list-group-item">
                        <div class="media">
                            <div class="media-body">
                                <div>
                                    <a href="{{ route('kb.view', ['id' => $article->id]) }}" class="text-ellipsis">@icon('solid/lightbulb') {{ $article->subject }}</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </section>
        </div>
    </section>
</section>

</section>
<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>
@push('pagestyle')
    @include('stacks.css.datepicker')
    @include('stacks.css.form')
@endpush
@push('pagescript')
    @include('stacks.js.datepicker')
    @include('stacks.js.form')
    @include('stacks.js.markdown')
<script>
function getTicketFields(val) {
axios.post('{{ route('tickets.ajaxfields') }}', {
    "department": val
})
.then(function (response) {
    $("#dept-fields").html(response.data);
})
.catch(function (error) {
    toastr.error('Oops! Request failed to complete.', '@langapp('response_status') ');
});
}
</script>
@endpush
@endsection