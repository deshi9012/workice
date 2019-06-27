@extends('layouts.app')
@section('content')
<section id="content">
    <section class="hbox stretch">
        <section class="vbox">
            <header class="header bg-white b-b clearfix">
                <div class="row m-t-sm">
                    <div class="col-sm-8 m-b-xs">
                        <a href="{{ route('tickets.view', ['id' => $ticket->id]) }}" title="Back to Ticket"
                            data-rel="tooltip" data-placement="right" class="btn btn-{{ get_option('theme_color') }} btn-sm">
                            @icon('regular/question-circle') @langapp('ticket')
                        </a>
                    </div>
                    <div class="col-sm-4 m-b-xs">
                    </div>
                </div>
            </header>
            <section class="scrollable wrapper bg">
                <div class="row">
                    <div class="col-md-8">
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                @icon('solid/pencil-alt') @langapp('make_changes') - {{  $ticket->subject  }}
                            </header>
                            <div class="panel-body">
                                {!! Form::open(['route' => ['tickets.api.update', $ticket->id], 'class' => 'ajaxifyForm', 'method' => 'PUT', 'data-toggle' => 'validator']) !!}
                                <input type="hidden" name="id" value="{{ $ticket->id }}">
                                <div class="form-group">
                                    <label>@langapp('code') @required</label>
                                    <input type="text" class="form-control" value="{{  $ticket->code  }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>@langapp('department') </label>
                                    <div class="m-b">
                                        <select name="department" class="form-control" onChange="getTicketFields(this.value);" required>
                                            @foreach (App\Entities\Department::all() as $d)
                                            <option value="{{  $d->deptid  }}"{{  $ticket->department === $d->deptid ? ' selected' : ''  }}>
                                                {{  $d->deptname  }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>@langapp('subject') @required</label>
                                    <input type="text" class="form-control" value="{{  $ticket->subject  }}"
                                    name="subject" required>
                                </div>
                                <div class="form-group">
                                    <label>@langapp('priority') @required </label>
                                    <div class="m-b">
                                        <select name="priority" class="form-control">
                                            @foreach (App\Entities\Priority::all() as $p)
                                            <option value="{{  $p->id  }}" {{ $ticket->priority == $p->id ? 'selected' : ''  }}>
                                                @langapp(strtolower($p->priority))
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if (isAdmin() || can('tickets_reporter'))
                                <div class="form-group">
                                    
                                    <label>@langapp('reporter') @required</label>
                                    <div class="m-b">
                                        <select class="select2-option form-control" name="user_id">
                                            @foreach (app('user')->select('id','username', 'name')->offHoliday()->get() as $user)
                                            <option value="{{ $user->id }}" {{ $ticket->user_id === $user->id ? ' selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif
                                @admin
                                <div class="form-group">
                                    <label>@langapp('project')</label>
                                    <div class="m-b">
                                        <select class="select2-option form-control" name="project_id" required>
                                            <option value="0">None</option>
                                            @foreach (Modules\Projects\Entities\Project::select('id', 'name')->get() as $project)
                                            <option value="{{ $project->id }}" {{ $project->id == $ticket->project_id ? 'selected' : '' }}>{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endadmin
                                <div class="form-group">
                                    <label>@langapp('message')</label>
                                    <textarea name="body" class="form-control markdownEditor">{{ $ticket->body }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>@langapp('files')</label>
                                    <input type="file" name="uploads[]" multiple="">
                                </div>
                                <div id="dept-fields">
                                    @php
                                    $data['fields'] = App\Entities\CustomField::whereDeptid($ticket->department)->get();
                                    @endphp
                                    @include('tickets::_includes.updateCustom', $data)
                                </div>
                                @admin
                                <div class="form-group">
                                    <label class="control-label">@langapp('tags')  </label>
                                    <select class="select2-tags form-control" name="tags[]" multiple>
                                        @foreach (App\Entities\Tag::all() as $tag)
                                        <option value="{{ $tag->name  }}" {{ in_array($tag->id, array_pluck($ticket->tags->toArray(), 'id')) ? ' selected="selected"' : '' }}>
                                            {{ $tag->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                                
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="hidden" name="feedback_disabled" value="0">
                                            <input type="checkbox" name="feedback_disabled" {{ $ticket->feedback_disabled ? 'checked' :'' }} value="1">
                                            <span class="label-text" data-rel="tooltip" title="Ticket reporter will not be asked to give feedback on this ticket">@langapp('disable_feedback')</span>
                                        </label>
                                    </div>
                                </div>
                                @endadmin
                                <div class="line line-dashed line-lg pull-in"></div>
                                {!!  renderAjaxButton('edit') !!}
                                {!! Form::close() !!}
                            </div>
                        </section>
                    </div>
                    <div class="col-md-4">
                        <section class="panel panel-default">
                            <header class="panel-heading">
                                @icon('solid/history') @langapp('activities')
                            </header>
                            <div class="panel-body">
                                @widget('Activities\Feed', ['activities' => $ticket->activities])
                            </div>
                        </section>
                    </div>
                </section>
            </section>
        </section>
        <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
    </section>
    @push('pagestyle')
    @include('stacks.css.form')
    @include('stacks.css.datepicker')
    @endpush
    @push('pagescript')
    @include('stacks.js.form')
    @include('stacks.js.datepicker')
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